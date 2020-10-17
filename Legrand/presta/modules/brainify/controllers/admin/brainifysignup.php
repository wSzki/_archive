<?php
/**
 * Copyright (C) 2015-2018 Brainify - All Rights Reserved
 *
 * @author    Brainify <tech@brainify.it>
 * @copyright 2015-2018 Brainify
 * @license   Proprietary License
 */

include_once _PS_MODULE_DIR_ . 'brainify/classes/prestashop/admincontroller.php';
include_once _PS_MODULE_DIR_ . 'brainify/classes/brainifyLogger.php';

class BrainifySignupController extends BrainifyPrestashopAdminController
{

    /**
     * Return html code to display configure page
     *
     * @return string
     * @throws Exception
     * @throws SmartyException
     */
    public function getConfigurePage()
    {
        BrainifyLogger::addLog('in getConfigurePage');

        try {
            $this->processConfirmTokenFromUrl();

            $isLogged = ($this->context->cookie->brainify_token && $this->context->cookie->brainify_token != '');

            if ($isLogged) {
                $this->checkUserSitesAndEventuallyStore();
            }

            $USER_ID = Configuration::get(BrainifyConfig::BRAINIFY_USER_ID);
            $USER_EMAIL = Configuration::get(BrainifyConfig::BRAINIFY_USER_EMAIL);
            $SITE_ID = Configuration::get(BrainifyConfig::BRAINIFY_SITE_ID);
            $USER_STATUS = Configuration::get(BrainifyConfig::BRAINIFY_USER_STATUS);
            $ACCOUNT_KEY = Configuration::get(BrainifyConfig::BRAINIFY_ACCOUNT_KEY);
            $API_KEY = Configuration::get(BrainifyConfig::BRAINIFY_API_KEY);

            if ($USER_ID == false && $USER_EMAIL == false && $USER_STATUS == false) {
                $this->context->cookie->brainify_token = '';
            }

            $this->context->smarty->assign('loginUrl', $this->getAjaxUrl('Login'));
            $this->context->smarty->assign('signupUrl', $this->getAjaxUrl('Signup'));
            $this->context->smarty->assign('getActivitiesUrl', $this->getAjaxUrl('GetActivities'));
            $this->context->smarty->assign('confirmUrl', $this->getAjaxUrl('Verify'));
            $this->context->smarty->assign('resetPasswordUrl', $this->getAjaxUrl('ResetPassword'));
            $this->context->smarty->assign('onboardSiteUrl', $this->getAjaxUrl('OnboardSite'));
            $this->context->smarty->assign('getShopUrl', $this->getAjaxUrl('GetShop'));
            $this->context->smarty->assign('getUserSitesUrl', $this->getAjaxUrl('GetUserSites'));
            $this->context->smarty->assign('keysUrl', $this->getAjaxUrl('SaveKeys'));
            $this->context->smarty->assign('logoutUrl', $this->getAjaxUrl('Logout'));
            $this->context->smarty->assign('resetUrl', $this->getAjaxUrl('Reset'));
            $this->context->smarty->assign('resendConfirmationEmail', $this->getAjaxUrl('ResendConfirmationEmail'));
            $this->context->smarty->assign('brainifyEmail', $USER_EMAIL);


            if ($USER_STATUS !== false) {
                $this->context->smarty->assign('userStatus', $USER_STATUS);
            } else {
                $this->context->smarty->assign('userStatus', 'not_created');
            }

            if ($USER_EMAIL !== false) {
                $this->context->smarty->assign('userEmail', $USER_EMAIL);
            } else {
                $this->context->smarty->assign('userEmail', '');
            }

            if ($ACCOUNT_KEY == false && $API_KEY == false) {
                $this->context->smarty->assign('isOnboarded', false);
            } elseif ($SITE_ID !== false && $SITE_ID !== '') {
                $this->context->smarty->assign('isOnboarded', true);
                $this->context->smarty->assign('apiKey', $API_KEY);
                $this->context->smarty->assign('accountKey', $ACCOUNT_KEY);
            }

            if ($this->context->cookie->brainify_token && $this->context->cookie->brainify_token != '') {
                $this->context->smarty->assign('isLogged', true);
            } else {
                $this->context->smarty->assign('isLogged', false);
            }

            $this->prepareCountry();

            $this->context->smarty->assign('lang', $this->context->language->iso_code);
            $this->context->smarty->assign('email', $this->context->employee->email);
            $this->context->smarty->assign('userName', $this->context->employee->firstname . ' ' . $this->context->employee->lastname);
            $this->context->smarty->assign('shopUrl', $this->getShopUrl());

            $bodyContent = $this->context->smarty->fetch($this->getTemplatePath() . 'configure.tpl');

            $this->context->smarty->assign('bodyContent', $bodyContent);
            return $this->context->smarty->fetch($this->getTemplatePath() . 'layout/layout.tpl');
        } catch (BrainifyException $exception) {
            BrainifyLogger::addLog('in getConfigurePage : Exception - ' . $exception->getMessage());

            $bodyContent = $this->context->smarty->fetch($this->getTemplatePath() . 'error.tpl');
            $this->context->smarty->assign('bodyContent', $bodyContent);
            return $this->context->smarty->fetch($this->getTemplatePath() . 'layout/layout.tpl');
        }
    }

    /**
     * Prepare country for smarty
     */
    private function prepareCountry()
    {
        $smarty = $this->getSmarty();
        $country = $this->context->country->iso_code;
        $countries = $this->loadCountries();

        foreach ($countries as $item) {
            if ($item->alpha2 == $country) {
                $smarty->assign('country', $item->name);
            }
        }
    }

    private function firstUserLogin(array $response)
    {
        BrainifyLogger::addLog('in firstUserLogin');

        if (isset($response['token'])) {
            $this->context->cookie->brainify_token = $response['token'];
            $this->context->cookie->write();
            BrainifyLogger::addLog('in firstUserLogin - Token written : ' . $response['token']);
        }

        $USER_ID = Configuration::get(BrainifyConfig::BRAINIFY_USER_ID);

        $checkSite = false;
        if ($USER_ID === false || $USER_ID == '') {
            BrainifyLogger::addLog('in firstUserLogin : Setting USER_ID + USER_EMAIL + USER_STATUS');
            Configuration::updateValue(BrainifyConfig::BRAINIFY_USER_ID, $response['id']);
            Configuration::updateValue(BrainifyConfig::BRAINIFY_USER_EMAIL, $response['email']);
            Configuration::updateValue(BrainifyConfig::BRAINIFY_USER_STATUS, $response['status']);
            $checkSite = true;
        } elseif ($USER_ID == $response['id']) {
            BrainifyLogger::addLog('in firstUserLogin : Setting USER_EMAIL + USER_STATUS');
            Configuration::updateValue(BrainifyConfig::BRAINIFY_USER_EMAIL, $response['email']);
            Configuration::updateValue(BrainifyConfig::BRAINIFY_USER_STATUS, $response['status']);
            $checkSite = true;
        }

        if ($checkSite) {
            $response['site'] = $this->checkUserSitesAndEventuallyStore();
        }

        return $response;
    }

    /**
     * Process confirm token from $_GET request
     */
    private function processConfirmTokenFromUrl()
    {
        BrainifyLogger::addLog('in processConfirmTokenFromUrl');

        $USER_STATUS = Configuration::get(BrainifyConfig::BRAINIFY_USER_STATUS);

        if (Tools::getIsset('brainify_confirmation_token') && $USER_STATUS === 'confirmation') {
            $response = $this->getWebservice()->postConfirm(array('token' => Tools::getValue('brainify_confirmation_token')));
            if ($this->getWebservice()->isLastHttpCode2xx()) {
                BrainifyLogger::addLog('in processConfirmTokenFromUrl : postConfirm code is 2xx');
                $this->firstUserLogin($response);
            } else {
                BrainifyLogger::addLog('in processConfirmTokenFromUrl : postConfirm code is not 2xx');
            }
        }
    }

    /**
     * Method for ajax call with action SignUp
     */
    public function ajaxProcessLogin()
    {
        BrainifyLogger::addLog('in ajaxProcessLogin');

        $webservice = $this->getWebservice();

        $response = $webservice->postLogin($_POST);

        if ($webservice->isLastHttpCode2xx()) {
            $response = $this->firstUserLogin($response);
        }

        echo Tools::jsonEncode($response);
        die;
    }

    public function ajaxProcessLogout()
    {
        $this->context->cookie->brainify_token = '';
        $this->context->cookie->write();
        $this->getWebservice()->setToken('');

        echo Tools::jsonEncode(array('status' => 'ok'));
        die;
    }

    public function ajaxProcessSaveKeys()
    {
        $response = array('status' => 'ok');
        if (Tools::getIsset('apiKey') && $this->validateKey(Tools::getValue('apiKey'))) {
            Configuration::updateValue(BrainifyConfig::BRAINIFY_API_KEY, Tools::getValue('apiKey'));
        } else {
            $response['status'] = 'error';
            $response['msg'] = 'Invalid api key';
        }
        if (Tools::getIsset('accountKey') && $this->validateKey(Tools::getValue('accountKey'))) {
            Configuration::updateValue(BrainifyConfig::BRAINIFY_ACCOUNT_KEY, Tools::getValue('accountKey'));
        } else {
            $response['status'] = 'error';
            $response['msg'] = 'Invalid account key';
        }
        echo Tools::jsonEncode($response);
        die;
    }

    /**
     * Process ajax request fetch presta shops
     */
    public function ajaxProcessGetShop()
    {
        //Shop::getShopById prestashop code not working, so I do the request manually
        $aShop = Db::getInstance()->executeS(
            "SELECT `id_shop`, `name` 
            FROM `" . _DB_PREFIX_ . "shop`
            WHERE `id_shop` = " . (int)$this->context->shop->id
        );

        echo Tools::jsonEncode($aShop[0]);
        die;
    }

    /**
     * Process ajax request fetch shop activities
     */
    public function ajaxProcessGetActivities()
    {
        $response = $this->getWebservice()->getActivities();
        $tmp = array();
        foreach ($response as $key => $value) {
            $tmp[$key] = $this->module->l($value);
        }
        echo Tools::jsonEncode($tmp);
        die;
    }

    /**
     * Process ajax request signup user
     */
    public function ajaxProcessSignup()
    {
        BrainifyLogger::addLog('in ajaxProcessSignup');

        $webservice = $this->getWebservice();
        $_POST['timezone'] = Configuration::get('PS_TIMEZONE');
        $response = $webservice->postSignup($_POST);

        $userStatus = $response['status'];
        if (isset($response['token'])) {
            $this->context->cookie->brainify_token = $response['token'];
            $this->context->cookie->write();
        }

        if ($webservice->isLastHttpCode2xx() && isset($response['id'])) {
            Configuration::updateValue(BrainifyConfig::BRAINIFY_USER_ID, $response['id']);
            Configuration::updateValue(BrainifyConfig::BRAINIFY_USER_STATUS, $userStatus);
            Configuration::updateValue(BrainifyConfig::BRAINIFY_USER_EMAIL, $response['email']);
            $response = $this->confirmationEmail("false");
            if ($webservice->isLastHttpCode2xx() && $response['status'] != $userStatus) {
                Configuration::updateValue(BrainifyConfig::BRAINIFY_USER_STATUS, $response['status']);
            }
        }

        echo \Tools::jsonEncode($response);
        die;
    }

    /**
     * Process ajax request email verification
     */
    public function ajaxProcessVerify()
    {
        BrainifyLogger::addLog('in ajaxProcessVerify');
        $webservice = $this->getWebservice();
        $response = $webservice->postConfirm(array('token' => Tools::getValue('confirmation')));
        if ($webservice->isLastHttpCode2xx()) {
            BrainifyLogger::addLog('in ajaxProcessVerify : postConfirm code is 2xx');
            $response = $this->firstUserLogin($response);
        } else {
            BrainifyLogger::addLog('in ajaxProcessVerify : postConfirm code is not 2xx');
        }

        echo \Tools::jsonEncode($response);
        die;
    }


    /**
     * Process ajax request reset password
     */
    public function ajaxProcessResetPassword()
    {
        $response = $this->getWebservice()->postForgotPassword($_POST);
        echo \Tools::jsonEncode($response);
        die;
    }

    /**
     * Process ajax request onboarding site
     */
    public function ajaxProcessOnboardSite()
    {
        $data = $_POST;
        $data['platform'] = 'prestashop';
        $data['timezone'] = Configuration::get('PS_TIMEZONE');
        $data['clientId'] = Configuration::get(BrainifyConfig::BRAINIFY_USER_ID);
        $data['currency'] = $this->context->currency->iso_code;

        $response = $this->getWebservice()->postOnboardSite($data);

        if ($this->getWebservice()->isLastHttpCode2xx() && isset($response['id'])) {
            $response['shop_id'] = Tools::getValue('shop_id');
            $this->storeSite($response);
        }

        echo \Tools::jsonEncode($response);
        die;
    }

    public function ajaxProcessGetUserSites()
    {
        $response = $this->getWebservice()->getUserSites();
        echo \Tools::jsonEncode($response);
        die;
    }

    public function ajaxProcessReset()
    {
        $this->context->cookie->brainify_token = null;
        $this->context->cookie->write();

        Db::getInstance()->Execute('TRUNCATE `' . _DB_PREFIX_ . 'brainify_update`');
        Db::getInstance()->Execute('TRUNCATE `' . _DB_PREFIX_ . 'brainify_infos`');

        Configuration::deleteFromContext(BrainifyConfig::BRAINIFY_API_KEY);
        Configuration::deleteFromContext(BrainifyConfig::BRAINIFY_SITE_ID);
        Configuration::deleteFromContext(BrainifyConfig::BRAINIFY_ACCOUNT_KEY);
        Configuration::deleteFromContext(BrainifyConfig::BRAINIFY_USER_EMAIL);
        Configuration::deleteFromContext(BrainifyConfig::BRAINIFY_USER_ID);
        Configuration::deleteFromContext(BrainifyConfig::BRAINIFY_USER_STATUS);
        Configuration::deleteFromContext(BrainifyConfig::BRAINIFY_SHOP_ID);

        echo \Tools::jsonEncode(array('status' => 'ok'));
        die;
    }

    public function ajaxProcessResendConfirmationEmail()
    {
        $response = array();
        if ($this->context->cookie->brainify_token && $this->context->cookie->brainify_token != '') {
            $webservice = $this->getWebservice();
            $webservice->setToken($this->context->cookie->brainify_token);
            $response = $this->confirmationEmail("true");
        } else {
            $response["status"] = "error";
            $response["msg"] = "You must logged before resend confirmation email";
        }
        echo \Tools::jsonEncode($response);
        die;
    }

    private function confirmationEmail($resend)
    {
        $webservice = $this->getWebservice();
        $webservice->setToken($this->context->cookie->brainify_token);

        $adminBaseUrl = explode("/", _PS_ADMIN_DIR_);

        if (Tools::getIsset('presta_token')
            && Tools::getValue('presta_token') != 'undefined'
            && Tools::getValue('presta_token') != ''
        ) {
            $token = Tools::getValue('presta_token');
        } else {
            $token = Tools::getAdminToken(
                'AdminModules'
                . (int) Tab::getIdFromClassName('AdminModules')
                . (int) Context::getContext()->employee->id
            );
        }
        $query = http_build_query(array(
            'controller' => 'AdminModules',
            'token' => $token,
            'action' => 'Confirm',
            'configure' => $this->module->name,
            'tab_module' => $this->module->tab,
            'module_name' => $this->module->name
        ));

        $data = array(
            'redirectUrl' => Tools::getHttpHost(true)
                . __PS_BASE_URI__ . $adminBaseUrl[count($adminBaseUrl) - 1] . '/index.php?' . $query
        );

        if ($resend == "true") {
            return $webservice->postResendConfirmationEmail(Configuration::get(BrainifyConfig::BRAINIFY_USER_ID), $data);
        } else {
            return $webservice->postSendConfirmationEmail($data);
        }
    }

    /**
     * Get url for ajax call
     * @param string $action
     * @return string
     */
    private function getAjaxUrl($action)
    {
        $token_carriers = Tools::getAdminToken(
            'BrainifySignup'
            . (int) Tab::getIdFromClassName('BrainifySignup') . (int) Context::getContext()->employee->id
        );

        $query = http_build_query(array(
            'controller' => 'BrainifySignup',
            'token' => $token_carriers,
            'ajax' => 'true',
            'action' => $action,
            'configure' => $this->module->name
        ));

        return 'index.php?' . $query;
    }

    /**
     * Load countries definition from json file
     * @return mixed string json
     */
    private function loadCountries()
    {
        $content = Tools::file_get_contents(_PS_MODULE_DIR_ . '/brainify/views/js/countries.json');
        return Tools::jsonDecode($content);
    }

    /**
     * Returns current shop url
     *
     * @return string shop url
     */
    private function getShopUrl()
    {
        if (!Configuration::get('PS_SSL_ENABLED')) {
            return "http://" . $this->context->shop->domain . $this->context->shop->physical_uri . $this->context->shop->virtual_uri;
        }
        return "https://" . $this->context->shop->domain . $this->context->shop->physical_uri . $this->context->shop->virtual_uri;
    }


    /**
     * Fetch user sites from brainify api and save if site url is equal current shop url
     */
    private function checkUserSitesAndEventuallyStore()
    {
        BrainifyLogger::addLog('in checkUserSitesAndEventuallyStore');

        $SITE_ID = Configuration::get(BrainifyConfig::BRAINIFY_SITE_ID);
        $SITE_API_KEY = Configuration::get(BrainifyConfig::BRAINIFY_API_KEY);
        $SITE_ACCOUNT_KEY = Configuration::get(BrainifyConfig::BRAINIFY_ACCOUNT_KEY);

        if ($SITE_ID !== false && $SITE_ACCOUNT_KEY !== false && $SITE_API_KEY !== false) {
            BrainifyLogger::addLog('in checkUserSitesAndEventuallyStore : Configuration already exists');

            return array(
                'id' => $SITE_ID,
                'settings' => array(
                    'apikey' => $SITE_API_KEY,
                    'accountkey' => $SITE_ACCOUNT_KEY
                )
            );
        } else {
            BrainifyLogger::addLog('in checkUserSitesAndEventuallyStore : retrieve sites');
            $sites = $this->getWebservice()->getUserSites();
            $shopUrl = $this->getShopUrl();

            $tmp = array();
            foreach ($sites as $site) {
                if (($site['url'] == $shopUrl || $site['url'] . "/" == $shopUrl) &&
                    $this->context->shop->name == $site['name']) {
                    $tmp = $site;
                    $tmp['shop_id'] = $this->context->shop->id;
                    break;
                }
            }

            if (isset($tmp['id'])) {
                BrainifyLogger::addLog('in checkUserSitesAndEventuallyStore : found matching site - storing');
                $this->storeSite($tmp);
            }

            return $tmp;
        }
    }

    /**
     * Store site parameters in configuration table
     * @param $site
     */
    private function storeSite($site)
    {
        $id = (isset($site['uuid'])) ? $site['uuid'] : $site['id'];

        Configuration::updateValue(BrainifyConfig::BRAINIFY_SITE_ID, $id);
        if (isset($site['shop_id'])) {
            Configuration::updateValue(BrainifyConfig::BRAINIFY_SHOP_ID, $site['shop_id']);
        }
        Configuration::updateValue(BrainifyConfig::BRAINIFY_ACCOUNT_KEY, $site['settings']['accountkey']);
        Configuration::updateValue(BrainifyConfig::BRAINIFY_API_KEY, $site['settings']['apikey']);
    }

    /**
     * Check if key is UUID v4
     *
     * @param $key uuid string
     * @return bool if key is uuid
     */
    private function validateKey($key)
    {
        return preg_match('/([a-f0-9]{8}-[a-f0-9]{4}-[a-f0-9]{4}-[a-f0-9]{4}-[a-f0-9]{12})/', $key, $m) === 1;
    }
}
