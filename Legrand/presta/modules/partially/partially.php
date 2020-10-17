<?php
/**
* Copyright 2018 Partial.ly
*
* Licensed under the Apache License, Version 2.0 (the "License");
* you may not use this file except in compliance with the License.
* You may obtain a copy of the License at
*
*    http://www.apache.org/licenses/LICENSE-2.0
*
* Unless required by applicable law or agreed to in writing, software
* distributed under the License is distributed on an "AS IS" BASIS,
* WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
* See the License for the specific language governing permissions and
* limitations under the License.
*
*  @author Partial.ly <partiallyapp@gmail.com>
*  @copyright  2015-2018 Partial.ly
*  @license    http://www.apache.org/licenses/LICENSE-2.0  Apache License, Version 2.0
*/

use PrestaShop\PrestaShop\Core\Payment\PaymentOption;

if (!defined('_PS_VERSION_')) {
    exit;
}

class Partially extends PaymentModule
{
    private $_configHtml = '';
    private $_postErrors = array();

    public $apiKey;
    public $offerId;
    public $orderState;
    public $pendingState;
    public $paidState;
    public $checkoutTitle;
    public $checkoutDescription;
    public $widgetEnabled;
    public $widgetStyle;
    public $widgetTitle;
    public $widgetBody;
    public $widgetTriggerText;
    public $widgetPopupDetails;
    public $widgetCheckoutEnabled;
    public $widgetCheckoutText;
    public $endpoint = 'https://partial.ly';

    public function __construct()
    {
        // standard properties
        $this->name = 'partially';
        $this->tab = 'payments_gateways';
        $this->version = '1.0.0';
        $this->module_key = '34d7a61ca427a8805cf2cbec00ab6bc8';
        $this->ps_versions_compliancy = array('min' => '1.7', 'max' => _PS_VERSION_);
        $this->author = 'Partial.ly';
        //$this->need_instance = 0;
        $this->controllers = array('process', 'notify');
        $this->is_eu_compatible = true;
        $this->currencies = true;
        $this->currencies_mode = 'checkbox';
        $this->bootstrap = true;

        parent::__construct();

        // custom properties
        $this->apiKey = Configuration::get('PARTIALLY_API_KEY');
        $this->offerId = Configuration::get('PARTIALLY_OFFER_ID');
        // state to set orders to when partial.ly checkout started
        $this->pendingState = Configuration::get('PARTIALLY_OS_PENDING');
        // the state to set orders to after checkout complete
        $this->orderState = Configuration::get('PARTIALLY_ORDER_STATE');
        // the state to set orders to after plan paid
        $this->paidState = Configuration::get('PARTIALLY_PAID_STATE');
        // front end checkout display
        $this->checkoutTitle = Configuration::get('PARTIALLY_CHECKOUT_TITLE');
        $this->checkoutDescription = Configuration::get('PARTIALLY_CHECKOUT_DESCRIPTION');
        // widget stuff
        $this->widgetEnabled = Configuration::get('PARTIALLY_WIDGET_ENABLED');
        $this->widgetStyle = Configuration::get('PARTIALLY_WIDGET_STYLE');
        $this->widgetTitle = Configuration::get('PARTIALLY_WIDGET_TITLE');
        $this->widgetBody = Configuration::get('PARTIALLY_WIDGET_BODY');
        $this->widgetTriggerText = Configuration::get('PARTIALLY_WIDGET_TRIGGER_TEXT');
        $this->widgetPopupDetails = Configuration::get('PARTIALLY_WIDGET_POPUP_DETAILS');
        $this->widgetCheckoutEnabled = Configuration::get('PARTIALLY_WIDGET_CHECKOUT_ENABLED');
        $this->widgetCheckoutText = Configuration::get('PARTIALLY_WIDGET_CHECKOUT_TEXT');

        // admin display
        $this->displayName = $this->l('Partial.ly Payment Plans');
        $this->description = $this->l('Offer a flexible payment plan option to your customers with Partial.ly');
    }

    public function install()
    {
        if (Shop::isFeatureActive()) {
            //Shop::setContext(Shop::CONTEXT_ALL);
        }

        // order plan info table
        Db::getInstance()->Execute('
		CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'partially_plan` (
			`id_order` int(10) unsigned NOT NULL,
			`partially_id` varchar(255) NOT NULL,
			`partially_number` varchar(255) DEFAULT NULL,
			PRIMARY KEY (`id_order`)
		) ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8');

        // check for custom status
        if (!$this->pendingState) {
            $lang_id = 1;
            $pending_state = new OrderState(null, $lang_id);
            $pending_state->name = 'Partial.ly checkout pending';
            $pending_state->invoice = false;
            $pending_state->send_email = false;
            $pending_state->module_name = $this->name;
            $pending_state->color = '#ffffff';
            $pending_state->unremovable = false;
            $pending_state->hidden = false;
            $pending_state->logable = false;
            $pending_state->delivery = false;
            $pending_state->shipped = false;
            $pending_state->paid = false;
            $pending_state->pdf_invoice = false;
            $pending_state->pdf_delivery = false;
            $pending_state->delete = false;
            if ($pending_state->save()) {
                PrestaShopLogger::addLog('Partial.ly created pending state: '.$pending_state->id);
                $this->pendingState = $pending_state->id;
                Configuration::updateValue('PARTIALLY_OS_PENDING', $this->pendingState);
                $icon_path = _PS_ORDER_STATE_IMG_DIR_.$this->pendingState.'.gif';
                if (!file_exists($icon_path)) {
                    file_put_contents($icon_path, Tools::file_get_contents(_PS_MODULE_DIR_.$this->name.'/views/img/state_icon.gif'));
                }
            }
        }

        if (!Configuration::get('PARTIALLY_OS_OPEN')) {
            $lang_id = 1;
            $open_state = new OrderState(null, $lang_id);
            $open_state->name = 'Partial.ly plan opened';
            $open_state->invoice = false;
            $open_state->send_email = false;
            $open_state->module_name = $this->name;
            $open_state->color = '#32CD32';
            $open_state->unremovable = false;
            $open_state->hidden = false;
            $open_state->logable = false;
            $open_state->delivery = false;
            $open_state->shipped = false;
            $open_state->paid = false;
            $open_state->pdf_invoice = false;
            $open_state->pdf_delivery = false;
            $open_state->delete = false;
            if ($open_state->save()) {
                PrestaShopLogger::addLog('Partial.ly created open state: '.$open_state->id);
                $this->orderState = $open_state->id;
                Configuration::updateValue('PARTIALLY_OS_OPEN', $this->orderState);
                $icon_path = _PS_ORDER_STATE_IMG_DIR_.$this->orderState.'.gif';
                if (!file_exists($icon_path)) {
                    file_put_contents($icon_path, Tools::file_get_contents(_PS_MODULE_DIR_.$this->name.'/views/img/state_icon.gif'));
                }
            }
        }

        // defaults
        Configuration::updateValue('PARTIALLY_CHECKOUT_TITLE', $this->l('Partial.ly payment plan'));
        Configuration::updateValue('PARTIALLY_WIDGET_STYLE', 'stacked');
        Configuration::updateValue('PARTIALLY_WIDGET_TITLE', $this->l('Flexible Payments'));
        Configuration::updateValue('PARTIALLY_WIDGET_TRIGGER_TEXT', $this->l('learn more'));
        Configuration::updateValue('PARTIALLY_WIDGET_CHECKOUT_TEXT', $this->l('Purchase with Partial.ly'));

        if (!parent::install() || !$this->registerHook('paymentOptions') ||
            !$this->registerHook('paymentReturn') || !$this->registerHook('displayProductAdditionalInfo')
            || !$this->registerHook('productFooter') || !$this->registerHook('shoppingCartExtra')
            || !$this->registerHook('displayBackOfficeOrderActions')) {
            return false;
        }

        return true;
    }

    public function uninstall()
    {
        if (!parent::uninstall()) {
            return false;
        }

        return true;
    }

    public function hookPaymentOptions($params)
    {
        if (!$this->active) {
            return;
        }
        $opt = new PaymentOption();
        $opt->setCallToActionText($this->checkoutTitle)
            ->setAction($this->context->link->getModuleLink($this->name, 'process', array(), true))
            ->setLogo('https://d2nacfpe3n8791.cloudfront.net/images/glyph-gradient-sm.png');

        if (!empty($this->checkoutDescription)) {
            $opt->setAdditionalInformation($this->checkoutDescription);
        }

        return array($opt);
    }

    public function hookPaymentReturn($params)
    {
        // need to figure out what this does, I think it's just to display extra info on order confirmed page
        return '';
    }

    public function hookDisplayBackOfficeOrderActions()
    {
        $order = new Order(Tools::getValue('id_order'));
        if ($order->module == 'partially') {
            $q = 'select * FROM `'._DB_PREFIX_.'partially_plan` where id_order='.$order->id;
            $row = Db::getInstance()->getRow($q);
            if ($row) {
                $this->context->smarty->assign(array(
                'planUrl' => $this->endpoint.'/merchant/plan/'.$row['partially_id']
                )
                );
                return $this->fetchTemplate('/views/templates/admin/order-view-plan.tpl');
            }
        }
    }

    public function fetchTemplate($name)
    {
        if (version_compare(_PS_VERSION_, '1.4', '<')) {
            $this->context->smarty->currentTemplate = $name;
        } elseif (version_compare(_PS_VERSION_, '1.5', '<')) {
            $views = 'views/templates/';
            if (@filemtime(dirname(__FILE__).'/'.$name)) {
                return $this->display(__FILE__, $name);
            } elseif (@filemtime(dirname(__FILE__).'/'.$views.'hook/'.$name)) {
                return $this->display(__FILE__, $views.'hook/'.$name);
            } elseif (@filemtime(dirname(__FILE__).'/'.$views.'front/'.$name)) {
                return $this->display(__FILE__, $views.'front/'.$name);
            } elseif (@filemtime(dirname(__FILE__).'/'.$views.'admin/'.$name)) {
                return $this->display(__FILE__, $views.'admin/'.$name);
            }
        }
        return $this->display(__FILE__, $name);
    }

    public function hookProductFooter($params)
    {
        return false;
    }

    public function hookShoppingCartExtra($params)
    {
        return false;
    }

    public function hookDisplayProductAdditionalInfo($params)
    {
        //PrestaShopLogger::addLog('hookDisplayProductAdditionalInfo with params keys: '.print_r(array_keys($params), true));
        if ($this->widgetEnabled) {
            $product = $params['product'];

            $currency_id = Configuration::get('PS_CURRENCY_DEFAULT');
            $currency = new Currency($currency_id);

            $widget_config = array(
                'amount' => $product['price_tax_exc'],
                'offer' => $this->offerId,
                'quantity' => 1,
                'currency' => $currency->iso_code,
                'targetSelector' => '#widgetContainer',
                'style' => $this->widgetStyle,
                'title' => $this->widgetTitle,
                'actionText' => $this->widgetTriggerText,
                'popupDetails' => $this->widgetPopupDetails,
                'quantitySelector' => '.quantity input',
                'source' => 'prestashop',
                'partiallyUrl' => $this->endpoint,
            );

            if (!empty($this->widgetBody)) {
                $widget_config['body'] = $this->widgetBody;
            }

            // check for checkout button config
            if ($this->widgetCheckoutEnabled) {
                //PrestaShopLogger::addLog('hookDisplayProductAdditionalInfo adding button with product: '.print_r($product, true));
                //PrestaShopLogger::addLog('hproduct keys: '.print_r(array_keys($product), true));
                $widget_config['includeCheckout'] = true;
                $widget_config['checkoutButtonText'] = $this->widgetCheckoutText;
                $product_data = array(
                    'id' => $product['id'],
                    'product_id' => $product['id'],
                    'quantity' => 1,
                    'price' => $product['price_tax_exc'],
                    'total' => $product['price_tax_exc'],
                    'sku' => $product['reference'],
                    'name' => $product['name'],
                );
                if (isset($product['id_product_attribute'])) {
                    $product_data['variant_id'] = $product['id_product_attribute'];
                }
                //PrestaShopLogger::addLog('Prod images: '.print_r($product['cover'], true));
                $imgSize = ImageType::getFormattedName('small');
                if (isset($product['cover']) && isset($product['cover']['bySize'])
                    && isset($product['cover']['bySize'][$imgSize])) {
                    $product_data['image'] = $product['cover']['bySize'][$imgSize]['url'];
                }

                $proto = 'http://';
                if (Configuration::get('PS_SSL_ENABLED')) {
                    $proto = 'https://';
                }
                $link = new Link($proto, $proto);

                $widget_config['checkoutButtonConfig'] = array(
                    'amount' => $product['price_tax_exc'],
                    'offer' => $this->offerId,
                    'quantity' => 1,
                    'currency' => $currency->iso_code,
                    'returnUrl' => $product['link'],
                    'quantitySelector' => '.quantity input',
                    'baseUrl' => $this->endpoint,
                    'meta' => array(
                    'source' => 'prestashop',
                    'prestashop_order_url' => $link->getModuleLink($this->module->name, 'notify', array('action' => 'create_order')),
                    'items' => array($product_data),
                ),
                );
            }

            $this->context->smarty->assign(array(
              'widget_config_json' => json_encode($widget_config),
              'js_url' => $this->endpoint.'/js/partially-widget.js'
            ));

            return $this->fetchTemplate('/views/templates/hook/widget.tpl');
        }
    }

    public function getContent()
    {
        $this->_configHtml = '';

        if (Tools::isSubmit('btnSubmit')) {
            $this->_postValidation();
            if (!count($this->_postErrors)) {
                $this->_postProcess();
            } else {
                foreach ($this->_postErrors as $err) {
                    $this->_configHtml .= $this->displayError($err);
                }
            }
        }

        $this->_configHtml .= $this->display(__FILE__, './views/templates/admin/info.tpl');
        $this->_configHtml .= $this->renderForm();

        return $this->_configHtml;
    }

    public function renderForm()
    {
        $gateway_form = array(
            'form' => array(
            'legend' => array(
            'title' => $this->l('Gateway options'),
            'icon' => 'icon-credit-card',
            ),
            'input' => array(
            array(
            'type' => 'text',
            'label' => $this->l('API Key'),
            'name' => 'PARTIALLY_API_KEY',
            'required' => true,
            'desc' => $this->l('Your Partial.ly API key can be found in the settings area of Partial.ly merchant portal'),
            ),
            ),
        ),
        );

        $offers = $this->getOffers();

        if ($offers) {
            $gateway_form['form']['input'] [] = array(
                'type' => 'select',
                'label' => $this->l('Offer ID'),
                'name' => 'PARTIALLY_OFFER_ID',
                'desc' => $this->l('Offer ID to use. Create an offer in the Partial.ly merchant portal'),
                'options' => array(
                'query' => $offers,
                'id' => 'id',
                'name' => 'name',
            ),
            );
        } else {
            $gateway_form['form']['input'] [] = array(
                'type' => 'text',
                'label' => $this->l('Offer ID', array(), 'Modules.Partially.Admin'),
                'name' => 'PARTIALLY_OFFER_ID',
                'desc' => $this->l('Offer ID to use. Create an offer in the Partial.ly merchant portal'),
            );
        }

        // order statuses
        $gateway_form['form']['input'] [] = array(
            'type' => 'select',
            'label' => $this->l('Order State'),
            'desc' => $this->l('State of orders after Partial.ly payment plan opened'),
            'name' => 'PARTIALLY_ORDER_STATE',
            'options' => array(
            'query' => OrderState::getOrderStates((int) Context::getContext()->language->id),
            'id' => 'id_order_state',
            'name' => 'name',
        ),
        );

        // order statuses
        $gateway_form['form']['input'] [] = array(
            'type' => 'select',
            'label' => $this->l('Order Paid State'),
            'desc' => $this->l('State of orders after Partial.ly payment plan paid'),
            'name' => 'PARTIALLY_PAID_STATE',
            'options' => array(
            'query' => OrderState::getOrderStates((int) Context::getContext()->language->id),
            'id' => 'id_order_state',
            'name' => 'name',
        ),
        );

        $gateway_form['form']['input'] [] = array(
            'type' => 'text',
            'label' => $this->l('Checkout title'),
            'name' => 'PARTIALLY_CHECKOUT_TITLE',
            'desc' => $this->l('Title of the Partial.ly payment method option customer sees at checkout'),
        );

        $gateway_form['form']['input'] [] = array(
            'type' => 'text',
            'label' => $this->l('Checkout description'),
            'name' => 'PARTIALLY_CHECKOUT_DESCRIPTION',
            'desc' => $this->l('Additional information to display when Partial.ly payment method is selected at checkout'),
        );

        $gateway_form['form']['submit'] = array(
            'title' => $this->l('Save'),
        );

        $widget_form = array(
            'form' => array(
            'legend' => array(
            'title' => $this->l('Widget options'),
            'icon' => 'icon-link',
            ),
            'input' => array(
            array(
            'type' => 'select',
            'label' => $this->l('Show widget'),
            'name' => 'PARTIALLY_WIDGET_ENABLED',
            'desc' => $this->l('Display the Partial.ly widget on product landing pages'),
            'options' => array(
            'query' => array(
            array('id' => 0, 'name' => $this->l('No')),
            array('id' => 1, 'name' => $this->l('Yes')),
            ),
            'id' => 'id',
            'name' => 'name',
            ),
            ),
            array(
            'type' => 'select',
            'label' => $this->l('Style'),
            'name' => 'PARTIALLY_WIDGET_STYLE',
            'options' => array(
            'query' => array(
            array('id' => 'stacked', 'name' => $this->l('Stacked')),
            array('id' => 'thin', 'name' => $this->l('Thin')),
            ),
            'id' => 'id',
            'name' => 'name',
            ),
            ),
            array(
            'type' => 'text',
            'label' => $this->l('Title'),
            'name' => 'PARTIALLY_WIDGET_TITLE',
            ),
            array(
            'type' => 'text',
            'label' => $this->l('Body'),
            'name' => 'PARTIALLY_WIDGET_BODY',
            'desc' => $this->l('Customize the text for the widget. Leave empty for default text'),
            ),
            array(
            'type' => 'text',
            'label' => $this->l('Trigger text'),
            'name' => 'PARTIALLY_WIDGET_TRIGGER_TEXT',
            ),
            array(
            'type' => 'textarea',
            'label' => $this->l('Popup additional details'),
            'name' => 'PARTIALLY_WIDGET_POPUP_DETAILS',
            ),
            // disabling until we can get the create order functionality
            /*
                  array(
                      'type' => 'select',
                      'label' => $this->l('Checkout button enabled'),
                      'name' => 'PARTIALLY_WIDGET_CHECKOUT_ENABLED',
                      'desc' => $this->l('Enable Partial.ly checkout directly from the widget'),
                      'options' => array(
                        'query' => array(
                          array('id' => 0, 'name' => $this->l('No')),
                          array('id' => 1, 'name' => $this->l('Yes'))
                        ),
                        'id' => 'id',
                        'name' => 'name'
                      )
                  ),
                  array(
                      'type' => 'text',
                      'label' => $this->l('Popup checkout button text'),
                      'name' => 'PARTIALLY_WIDGET_CHECKOUT_TEXT'
                  )
                  */
            ),
            'submit' => array(
            'title' => $this->l('Save'),
            ),
        ),
        );

        $helper = new HelperForm();
        $helper->show_toolbar = false;
        $helper->id = (int) Tools::getValue('id_carrier');
        $helper->identifier = $this->identifier;
        $helper->submit_action = 'btnSubmit';
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false).'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->tpl_vars = array(
            'fields_value' => $this->getConfigFieldsValues(),
        );

        $this->fields_form = array();

        return $helper->generateForm(array($gateway_form, $widget_form));
    }

    private function _postValidation()
    {
        if (Tools::isSubmit('btnSubmit')) {
            if (!Tools::getValue('PARTIALLY_API_KEY')) {
                $this->_postErrors[] = $this->trans('The "API Key" field is required.', array(), 'Modules.Partially.Admin');
            }
        }
    }

    private function _postProcess()
    {
        if (Tools::isSubmit('btnSubmit')) {
            $postedApiKey = Tools::getValue('PARTIALLY_API_KEY');
            Configuration::updateValue('PARTIALLY_API_KEY', $postedApiKey);

            // see if apiKey changed
            if ($postedApiKey != $this->apiKey) {
                // if so we need to try to create webhook to listen for Partial.ly events
                $this->apiKey = $postedApiKey;
                $this->checkWebhook();
            }

            Configuration::updateValue('PARTIALLY_OFFER_ID', Tools::getValue('PARTIALLY_OFFER_ID'));
            Configuration::updateValue('PARTIALLY_ORDER_STATE', Tools::getValue('PARTIALLY_ORDER_STATE'));
            Configuration::updateValue('PARTIALLY_PAID_STATE', Tools::getValue('PARTIALLY_PAID_STATE'));
            Configuration::updateValue('PARTIALLY_CHECKOUT_TITLE', Tools::getValue('PARTIALLY_CHECKOUT_TITLE'));
            Configuration::updateValue('PARTIALLY_CHECKOUT_DESCRIPTION', Tools::getValue('PARTIALLY_CHECKOUT_DESCRIPTION'));
            Configuration::updateValue('PARTIALLY_WIDGET_ENABLED', Tools::getValue('PARTIALLY_WIDGET_ENABLED'));
            Configuration::updateValue('PARTIALLY_WIDGET_STYLE', Tools::getValue('PARTIALLY_WIDGET_STYLE'));
            Configuration::updateValue('PARTIALLY_WIDGET_TITLE', Tools::getValue('PARTIALLY_WIDGET_TITLE'));
            Configuration::updateValue('PARTIALLY_WIDGET_BODY', Tools::getValue('PARTIALLY_WIDGET_BODY'));
            Configuration::updateValue('PARTIALLY_WIDGET_TRIGGER_TEXT', Tools::getValue('PARTIALLY_WIDGET_TRIGGER_TEXT'));
            Configuration::updateValue('PARTIALLY_WIDGET_POPUP_DETAILS', Tools::getValue('PARTIALLY_WIDGET_POPUP_DETAILS'));
            Configuration::updateValue('PARTIALLY_WIDGET_CHECKOUT_ENABLED', Tools::getValue('PARTIALLY_WIDGET_CHECKOUT_ENABLED'));
            Configuration::updateValue('PARTIALLY_WIDGET_CHECKOUT_TEXT', Tools::getValue('PARTIALLY_WIDGET_CHECKOUT_TEXT'));
        }
        $this->_html .= $this->displayConfirmation($this->trans('Settings updated', array(), 'Admin.Notifications.Success'));
    }

    private function checkWebhook()
    {
        // contstruct webhook url
        $proto = 'http://';
        if (Configuration::get('PS_SSL_ENABLED')) {
            $proto = 'https://';
        }
        $link = new Link($proto, $proto);
        $webhookUrl = $link->getModuleLink($this->name, 'notify', array('action' => 'webhook'));
        // get webhooks
        $hooks = $this->getWebhooks();
        // search if it already exists
        $hookFound = false;
        foreach ($hooks as $hook) {
            if ($hook['url'] == $webhookUrl) {
                $hookFound = true;
                break;
            }
        }
        if (!$hookFound) {
            // create the webhook
            $this->createWebhook(array('url' => $webhookUrl));
        }
    }

    public function getConfigFieldsValues()
    {
        return array(
            'PARTIALLY_API_KEY' => Tools::getValue('PARTIALLY_API_KEY', Configuration::get('PARTIALLY_API_KEY')),
            'PARTIALLY_OFFER_ID' => Tools::getValue('PARTIALLY_OFFER_ID', Configuration::get('PARTIALLY_OFFER_ID')),
            'PARTIALLY_ORDER_STATE' => Tools::getValue('PARTIALLY_ORDER_STATE', Configuration::get('PARTIALLY_ORDER_STATE')),
            'PARTIALLY_PAID_STATE' => Tools::getValue('PARTIALLY_PAID_STATE', Configuration::get('PARTIALLY_PAID_STATE')),
            'PARTIALLY_CHECKOUT_TITLE' => Tools::getValue('PARTIALLY_CHECKOUT_TITLE', Configuration::get('PARTIALLY_CHECKOUT_TITLE')),
            'PARTIALLY_CHECKOUT_DESCRIPTION' => Tools::getValue('PARTIALLY_CHECKOUT_DESCRIPTION', Configuration::get('PARTIALLY_CHECKOUT_DESCRIPTION')),
            'PARTIALLY_WIDGET_ENABLED' => Tools::getValue('PARTIALLY_WIDGET_ENABLED', Configuration::get('PARTIALLY_WIDGET_ENABLED')),
            'PARTIALLY_WIDGET_STYLE' => Tools::getValue('PARTIALLY_WIDGET_STYLE', Configuration::get('PARTIALLY_WIDGET_STYLE')),
            'PARTIALLY_WIDGET_TITLE' => Tools::getValue('PARTIALLY_WIDGET_TITLE', Configuration::get('PARTIALLY_WIDGET_TITLE')),
            'PARTIALLY_WIDGET_BODY' => Tools::getValue('PARTIALLY_WIDGET_BODY', Configuration::get('PARTIALLY_WIDGET_BODY')),
            'PARTIALLY_WIDGET_TRIGGER_TEXT' => Tools::getValue('PARTIALLY_WIDGET_TRIGGER_TEXT', Configuration::get('PARTIALLY_WIDGET_TRIGGER_TEXT')),
            'PARTIALLY_WIDGET_POPUP_DETAILS' => Tools::getValue('PARTIALLY_WIDGET_POPUP_DETAILS', Configuration::get('PARTIALLY_WIDGET_POPUP_DETAILS')),
            'PARTIALLY_WIDGET_CHECKOUT_ENABLED' => Tools::getValue('PARTIALLY_WIDGET_CHECKOUT_ENABLED', Configuration::get('PARTIALLY_WIDGET_CHECKOUT_ENABLED')),
            'PARTIALLY_WIDGET_CHECKOUT_TEXT' => Tools::getValue('PARTIALLY_WIDGET_CHECKOUT_TEXT', Configuration::get('PARTIALLY_WIDGET_CHECKOUT_TEXT')),
        );
    }

    private function getOffers()
    {
        return $this->apiGet('/api/v1/offer');
    }

    private function getWebhooks()
    {
        return $this->apiGet('/api/v1/webhook');
    }

    public function createWebhook($params)
    {
        return $this->apiPost('/api/v1/webhook', $params);
    }

    public function createPlan($params)
    {
        return $this->apiPost('/api/v1/gateway_purchase_url', $params);
    }

    // GET from Partial.ly API
    // returns array decoded json
    private function apiGet($path)
    {
        if (empty($this->apiKey)) {
            return false;
        }

        $url = $this->endpoint.$path;

        $headers = array(
            'Content-Type: application/json',
            'Authorization: Bearer '.$this->apiKey,
        );

        $opts = array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => $headers,
        );

        $ch = curl_init();
        curl_setopt_array($ch, $opts);
        $raw_response = curl_exec($ch);

        if (curl_errno($ch)) {
            $err = curl_error($ch);
            PrestaShopLogger::addLog('Partial.ly error getting '.print_r($err, true), 2);
        }

        curl_close($ch);

        try {
            return json_decode($raw_response, true);
        } catch (Exception $ex) {
            return false;
        }
    }

    // POST to Partial.ly api
    // return object decoded json
    private function apiPost($path, $params)
    {
        if (empty($this->apiKey)) {
            return false;
        }

        $url = $this->endpoint.$path;

        PrestaShopLogger::addLog('Partial.ly posting to '.$url.' with data '.print_r($params, true));

        $json = json_encode($params);

        $headers = array(
            'Content-Type: application/json',
            'Authorization: Bearer '.$this->apiKey,
            'Content-Length: '.Tools::strlen($json),
        );

        $opts = array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $json,
        );

        $ch = curl_init();
        curl_setopt_array($ch, $opts);
        $raw_response = curl_exec($ch);

        if (curl_errno($ch)) {
            $err = curl_error($ch);
            PrestaShopLogger::addLog('Partial.ly error posting to Partial.ly '.print_r($err, true), 3);
        }

        curl_close($ch);

        try {
            return json_decode($raw_response);
        } catch (Exception $ex) {
            return false;
        }
    }

    public function validateSignature($json)
    {
        $recv_sig = isset($_SERVER['HTTP_PARTIALLY_SIGNATURE']) ? $_SERVER['HTTP_PARTIALLY_SIGNATURE'] : '';
        $calc_sig = hash_hmac('sha256', $json, $this->apiKey);

        return $recv_sig == $calc_sig;
    }
}
