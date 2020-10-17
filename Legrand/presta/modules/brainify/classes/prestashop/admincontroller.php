<?php
/**
 * Copyright (C) 2015-2018 Brainify - All Rights Reserved
 *
 * @author    Brainify <tech@brainify.it>
 * @copyright 2015-2018 Brainify
 * @license   Proprietary License
 */

include_once _PS_MODULE_DIR_ . 'brainify/classes/services/webservice.php';
include_once _PS_MODULE_DIR_ . 'brainify/classes/exception.php';
class BrainifyPrestashopAdminController extends \ModuleAdminController
{


    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Catch module exception to display an error json
     * @return bool
     */
    public function postProcess()
    {
        try {
            return parent::postProcess();
        } catch (BrainifyException $exception) {
            echo $this->returnException($exception);
            die;
        }
    }


    /**
     * Method to return json to send in case of exception
     * @param BrainifyException $exception
     * @return string
     */
    protected function returnException(BrainifyException $exception)
    {
        $output = array(
            'return_code' => 1,
            'errors' => array(
                'An error occured during the request'
            ),
            'exception' => var_export($exception, true)
        );

        return \Tools::jsonEncode($output);
    }

    /**
     * Get smarty instance
     * @return \Smarty
     * @throws \SmartyException
     */
    protected function getSmarty()
    {
        $smarty = new \Smarty();
        $smarty->setTemplateDir($this->getTemplatePath());
        $smarty->assign('_basepath', rtrim($this->module->getPathUri(), '/'));
        smartyRegisterFunction($smarty, 'function', 'l', 'smartyTranslate', false);
        return $smarty;
    }

    /**
     * Get Webservice object
     * @return BrainifyServicesWebservice
     */
    protected function getWebservice()
    {
        if (!isset($this->webservice)) {
            $this->webservice = new BrainifyServicesWebservice(
                BrainifyConfig::BRAINIFY_API_URL,
                BrainifyConfig::BRAINIFY_API_AUTH,
                BrainifyConfig::BRAINIFY_API_USERS,
                BrainifyConfig::BRAINIFY_API_SITES
            );
        }
        if (isset($this->context->cookie->brainify_token)) {
            $this->webservice->setToken($this->context->cookie->brainify_token);
        }
        return $this->webservice;
    }
}
