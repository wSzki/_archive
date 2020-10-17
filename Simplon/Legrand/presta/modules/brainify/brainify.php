<?php
/**
 * Copyright (C) 2015-2018 Brainify - All Rights Reserved
 *
 * @author    Brainify <tech@brainify.it>
 * @copyright 2015-2018 Brainify
 * @license   Proprietary License
 */

defined('_PS_VERSION_') or exit;

include_once(dirname(__FILE__) . '/classes/config.php');
include_once(dirname(__FILE__) . '/classes/brainifyUpdateClass.php');
include_once(dirname(__FILE__) . '/classes/brainifyInfosClass.php');

/**
 * Class Brainify
 */
class Brainify extends Module
{

    /**
     * @desc constructor
     */
    public function __construct()
    {
        $this->name = 'brainify';
        $this->tab = 'analytics_stats';
        $this->version = '4.5.0';
        $this->author = 'Brainify';
        $this->displayName = 'Brainify Free Dashboard';
        $this->bootstrap = true;
        $this->module_key = 'a13b0b5990b5a9fe34632df727cd9af5';
        parent::__construct();

        if ($this->id
            && !Configuration::get(BrainifyConfig::BRAINIFY_ACCOUNT_KEY)
            && !Configuration::get(BrainifyConfig::BRAINIFY_API_KEY)
        ) {
            $this->warning = $this->l('Toutes vos données ecommerce en quelques clics ! Configurez le module Brainify.');
        }
        $this->ps_versions_compliancy = array('min' => '1.5', 'max' => '1.8');
        $this->description = $this->l('Save time and make the best marketing decisions with the first Ecommerce Analytics. Take control over your data.');
        $this->confirmUninstall = $this->l('Are you sure you want to delete your details ?');
    }

    /**
     * Install module
     * @return bool
     * @throws PrestaShopException
     */
    public function install()
    {
        $sInsert = '
            CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'brainify_update` (
            `id_update` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
            `id_object` int(10) UNSIGNED NOT NULL,
            `id_shop` int(10) UNSIGNED NOT NULL,
            `id_type`  int(2) UNSIGNED NOT NULL,
            `timestamp_add` int(12) UNSIGNED NOT NULL,
            `date_add` datetime NOT NULL,
            `date_upd` datetime NOT NULL,
            `brainify_visitck` varchar(255),
            `brainify_visitorck` varchar(255),
            `ordrer_state` INT(10),
            PRIMARY KEY (`id_update`))
            ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8';
        $bInsert = Db::getInstance()->Execute($sInsert);

        $sInsertOrderState = '
            CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'brainify_infos` (
            `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
            `id_order` int(10) UNSIGNED NOT NULL,
            `current_state` int(10) UNSIGNED NOT NULL,
            `brainify_visitck` varchar(255),
            `brainify_visitorck` varchar(255),
            `timestamp_add` int(12) UNSIGNED NOT NULL,
            `date_add` datetime NOT NULL,
            `date_upd` datetime NOT NULL,
            PRIMARY KEY (`id`))
            ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8';
        $bInsertOrderState = Db::getInstance()->Execute($sInsertOrderState);

        if (!$bInsertOrderState or
            !$bInsert or
            !parent::install() or
            !$this->registerHook('displayHeader') or
            !$this->registerHook('actionCartSave') or
            !$this->registerHook('actionObjectDeleteAfter') or
            !$this->registerHook('displayOrderConfirmation') or
            !$this->registerHook('actionProductUpdate') or
            !$this->registerHook('actionProductAdd') or
            !$this->registerHook('actionOrderStatusUpdate') or
            !$this->registerHook('actionCategoryUpdate') or
            !$this->registerHook('actionCategoryAdd') or
            !$this->installModuleTab()
        ) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Uninstall module
     * @return bool
     */
    public function uninstall()
    {
        $this->context->cookie->brainify_token = null;
        $this->context->cookie->write();

        Db::getInstance()->Execute('DROP TABLE IF EXISTS `' . _DB_PREFIX_ . 'brainify_update`');
        Db::getInstance()->Execute('DROP TABLE IF EXISTS `' . _DB_PREFIX_ . 'brainify_infos`');
        Configuration::deleteByName(BrainifyConfig::BRAINIFY_API_KEY);
        Configuration::deleteByName(BrainifyConfig::BRAINIFY_SITE_ID);
        Configuration::deleteByName(BrainifyConfig::BRAINIFY_ACCOUNT_KEY);
        Configuration::deleteByName(BrainifyConfig::BRAINIFY_USER_EMAIL);
        Configuration::deleteByName(BrainifyConfig::BRAINIFY_USER_ID);
        Configuration::deleteByName(BrainifyConfig::BRAINIFY_USER_STATUS);
        Configuration::deleteByName(BrainifyConfig::BRAINIFY_SHOP_ID);

        return
            parent::uninstall() &&
            $this->uninstallModuleTab();
    }

    /**
     * @desc Configuration
     * @return mixed
     */
    public function getContent()
    {
        if (_PS_VERSION_ >= 1.6) {
            $this->context->controller->addJS($this->getPathUri() . 'views/js/jquery-1.11.3.min.js');
            $this->context->controller->addJS($this->getPathUri() . 'views/js/jquery-noConflict-1.11.3.js');
            $this->context->controller->addJS($this->getPathUri() . 'views/js/configure.js');
        }

        if (strpos(_PS_VERSION_, '1.5') === 0) {
            $this->context->controller->addCSS($this->getPathUri() . 'views/css/bootstrap.min.css');
            $this->context->controller->addJS($this->getPathUri() . 'views/js/configure-1-5.js');
        }

        $this->context->controller->addCSS($this->getPathUri() . 'views/css/bundle.css');
        $this->context->controller->addCSS($this->getPathUri() . 'views/css/specific.css');
        $this->context->controller->addCSS($this->getPathUri() . 'views/css/forms.css');
        $this->context->controller->addCSS($this->getPathUri() . 'views/css/button.css');

        require_once _PS_MODULE_DIR_ . $this->name . '/controllers/admin/brainifysignup.php';
        $oConfigureController = new BrainifySignupController();
        return $oConfigureController->getConfigurePage();
    }

    /**
     * Install module tab to allow the use of admin controllers
     * @return bool
     */
    private function installModuleTab()
    {
        $tab = new Tab();
        $tab->name = array(Configuration::get('PS_LANG_DEFAULT') => 'Brainify Analytics');
        $tab->class_name = 'BrainifySignup';
        $tab->module = 'brainify';
        $tab->id_parent = -1;
        $tab->active = 0;
        return $tab->save();
    }

    /**
     * Uninstall module tab
     * @return bool
     */
    private function uninstallModuleTab()
    {
        if (false !== ($tab = new Tab((int) Tab::getIdFromClassName('BrainifySignup')))) {
            return $tab->delete();
        }
        return true;
    }

    /**
     * @param array $aParams
     * @return bool
     */
    public function hookActionCategoryAdd($aParams)
    {
        $this->updateSql();
        $oCategory = $aParams['category'];
        return $this->addUpdate($oCategory->id, BrainifyUpdateClass::$id_type_category);
    }

    /**
     * @param array $aParams
     * @return bool
     */
    public function hookActionCategoryUpdate($aParams)
    {
        $this->updateSql();
        $oCategory = $aParams['category'];
        return $this->addUpdate($oCategory->id, BrainifyUpdateClass::$id_type_category);
    }

    /**
     * @param array $aParams
     * @return bool
     */
    public function hookActionProductUpdate($aParams)
    {
        $this->updateSql();
        $bReturn = true;

        if (isset($aParams['product'])) {
            $oProduct = $aParams['product'];
            $bReturn = $this->addUpdate($oProduct->id, BrainifyUpdateClass::$id_type_product);
        }

        return $bReturn;
    }

    /**
     * @param array $aParams
     * @return bool
     */
    public function hookActionProductAdd($aParams)
    {
        $this->updateSql();
        $oProduct = $aParams['product'];
        return $this->addUpdate($oProduct->id, BrainifyUpdateClass::$id_type_product);
    }

    /**
     * @param array $aParams
     * @return bool
     */
    public function hookActionOrderStatusUpdate($aParams)
    {
        $this->updateSql();
        $bCanInsert = false;
        $oOrder = new Order($aParams['id_order']);
        $oState = $aParams['newOrderStatus'];

        if ($oState->logable == '1' or $oState->paid == '1') {
            $bCanInsert = true;
        } else {
            $aStates = $this->getOrderHistory($oOrder->id, Context::getContext()->language->id);
            if (isset($aStates[0])) {
                $oStateHistory = new OrderStateCore($aStates[0]['id_order_state'], Context::getContext()->language->id);
                if ($oStateHistory->logable == '1'
                    or $oStateHistory->delivery == '1'
                    or $oStateHistory->shipped == '1'
                    or $oStateHistory->paid == '1'
                ) {
                    $bCanInsert = true;
                }
            }
        }

        // Add data into brainify_infos
        $this->addInfos($oOrder->id, $oState->id);

        if ($bCanInsert) {
            // Add data into brainify_update
            return $this->addUpdate($oOrder->id, BrainifyUpdateClass::$id_type_order, $oState->id);
        } else {
            return false;
        }
    }


    public function hookActionCartSave($params)
    {
        Context::getContext()->cookie->brainifyCartUpdate = 1;
    }

    public function hookActionObjectDeleteAfter($params)
    {
        Context::getContext()->cookie->brainifyCartUpdate = 1;
    }

    /**
     * @param array $aParams
     * @return mixed
     */
    public function hookDisplayHeader($aParams)
    {
        $context = Context::getContext();

        // if we are on a product page, add product_id to smarty
        if ($context->controller->php_self == 'product') {
            if (_PS_VERSION_ >= 1.6) {
                $oProduct = $context->controller->getProduct();
            } else {
                $id_product = (int) Tools::getValue('id_product');
                $oProduct = new Product($id_product);
            }

            $iCategoryId = $this->getCategoryProvided($context);
            $productId = $oProduct->id;
            $context->smarty->assign('current_product_id', $productId);
            $context->smarty->assign('product_category_id', $iCategoryId);

            // Add variations od a product
            $aProductVariations = $this->getVariationsProduct($productId);

            foreach ($aProductVariations as $key => $apv) {
                $aProductVariations[$key] = (int)$apv;
            }

            $context->smarty->assign('product_variations_id', $aProductVariations);

            // Find all categories parents of a product
            $aCategoriesId = $this->getParentsCategories($oProduct->id_category_default, true);
        }

        // if we are on a category page, add category_id to smarty
        if ($context->controller->php_self == 'category') {
            if (_PS_VERSION_ >= 1.6 && method_exists($context->controller, 'getCategory')) {
                $categoryId = $context->controller->getCategory()->id;
            } else {
                $categoryId = (int) Tools::getValue('id_category');
            }
            $context->smarty->assign('category_id', $categoryId);

            // Find all parents of a category
            $aCategoriesId = $this->getParentsCategories($categoryId);
        }

        if (!isset($aCategoriesId)) {
            $aCategoriesId = array();
        }

        foreach ($aCategoriesId as $key => $aci) {
            $aCategoriesId[$key] = (int)$aci;
        }
        $context->smarty->assign('brainify_categories_id', array_reverse($aCategoriesId));
        $context->smarty->assign('brainify_key', Configuration::get('BRAINIFY_KEY'));
        $context->smarty->assign('flavour_key', 'prestashop_extension_brainify_' . $this->version);

        if (isset($context->cookie->brainifyCartUpdate) && $context->cookie->brainifyCartUpdate && empty($_SERVER['HTTP_X_REQUESTED_WITH'])) {
            $this->sendCartUpdate($aParams);
            $context->cookie->brainifyCartUpdate = 0;
        } else {
            $context->smarty->assign('product_in_cart_update', array());
        }

        return $this->display(__FILE__, 'header.tpl');
    }

    /**
     * @param array $aParams
     * @return mixed
     */
    public function sendCartUpdate($aParams)
    {
        $oCart = $aParams['cart'];
        $aProductIds = array();
        $aProductInCart = array();
        $aProductInCartOld = array();
        $aProductInCartUpdate = array();

        // Retrieve old cart if exist
        if (isset($this->context->cookie->cart_product_brainify)) {
            $aProductInCartOld = json_decode($this->context->cookie->cart_product_brainify, true);
        }

        // Retrieve different information to send at Brainify
        $fCartTotal = $oCart->getOrderTotal(false, Cart::ONLY_PRODUCTS);
        $fShippingPrice = $oCart->getOrderTotal(false, Cart::ONLY_SHIPPING);
        $aDiscountCodes = array();
        $fDiscountTotal = $oCart->getOrderTotal(false, Cart::ONLY_DISCOUNTS);

        // Retrieve all cart rules
        $aCartRules = $oCart->getCartRules();
        if (!empty($aCartRules)) {
            foreach ($aCartRules as $iKey => $aCartRule) {
                $aDiscountCodes[] = $aCartRule['code'];
            }
        }

        foreach ($oCart->getProducts() as $aProduct) {
            $fProductPrice = $aProduct['price'];
            $aProductInCart[$aProduct['id_product']][$aProduct['id_product_attribute']] = array(
                'quantity' => $aProduct['cart_quantity'],
                'price' => $fProductPrice,
            );
            $sAction = null;

            // If combination (product / attribute product) exist into old cart
            if (isset($aProductInCartOld[$aProduct['id_product']][$aProduct['id_product_attribute']])) {
                $iQtyOld = $aProductInCartOld[$aProduct['id_product']][$aProduct['id_product_attribute']]['quantity'];
                $iQty = $iQtyOld - $aProduct['cart_quantity'];

                if ($iQty < 0) {
                    $sAction = 'itemAdded';

                    // Transform negative number to positive number
                    $iQty = abs($iQty);
                } elseif ($iQty > 0) {
                    $sAction = 'itemRemoved';
                }
            } else {
                $sAction = 'itemAdded';
                $iQty = $aProduct['cart_quantity'];
            }

            // If an action exist for this combination
            if (!is_null($sAction)) {
                $aProductInCartUpdate[$sAction][] = array(
                    'id_product' => $aProduct['id_product'],
                    'id_product_attribute' => $aProduct['id_product_attribute'],
                    'qty' => $iQty,
                    'qnt_after_event' => $aProduct['cart_quantity'],
                    'price' => $fProductPrice,
                    'cart_total' => $fCartTotal,
                    'shipping_price' => $fShippingPrice,
                    'discount_code' => Tools::jsonEncode($aDiscountCodes),
                    'discount_amount' => $fDiscountTotal,

                );
            }
        }

        // Check if a product was had remove completely
        foreach ($aProductInCartOld as $iProductId => $aProducts) {
            foreach ($aProducts as $iProductAttributeId => $aInfos) {
                if (!isset($aProductInCart[$iProductId][$iProductAttributeId])) {
                    $aProductInCartUpdate['itemRemoved'][] = array(
                        'id_product' => $iProductId,
                        'id_product_attribute' => $iProductAttributeId,
                        'qty' => $aInfos['quantity'],
                        'qnt_after_event' => 0,
                        'price' => $aInfos['price'],
                        'cart_total' => $fCartTotal,
                        'shipping_price' => $fShippingPrice,
                        'discount_code' => Tools::jsonEncode($aDiscountCodes),
                        'discount_amount' => $fDiscountTotal,

                    );
                }
            }
        }

        // Set cart old in a cookie
        $this->context->cookie->__set('cart_product_brainify', Tools::jsonEncode($aProductInCart));

        $this->context->smarty->assign(
            array(
                'product_id' => implode(',', $aProductIds),
                'product_in_cart_update' => $aProductInCartUpdate
            )
        );
    }

    protected function addOrderToBddUdate($aParams)
    {
        $this->updateSql();
        if (_PS_VERSION_ >= 1.7) {
            $oOrderId = $aParams['order']->id;
            $oStateId = $aParams['order']->current_state;
        } else {
            $oOrderId = $aParams['objOrder']->id;
            $oStateId = $aParams['objOrder']->current_state;
        }

        // Add data into brainify_infos
        $this->addInfos($oOrderId, $oStateId);

        // Add data into brainify_update
        return $this->addUpdate($oOrderId, BrainifyUpdateClass::$id_type_order, $oStateId);
    }

    /**
     * @param array $aParams
     * @return mixed
     */
    public function hookDisplayOrderConfirmation($aParams)
    {
        $this->addOrderToBddUdate($aParams);

        if (_PS_VERSION_ >= 1.7) {
            $oOrder = $aParams['order'];
        } else {
            $oOrder = $aParams['objOrder'];
        }

        if (Validate::isLoadedObject($oOrder)) {
            $iConversionRate = 1;

            if ($oOrder->id_currency != Configuration::get('PS_CURRENCY_DEFAULT')) {
                $oCurrency = new Currency((int) $oOrder->id_currency);
                $iConversionRate = (float) $oCurrency->conversion_rate;
            }

            $oCarrier = new Carrier($oOrder->id_carrier);

            // Order general information
            $aPurchase = array(
                'orderId' => (int) ($oOrder->id), // order ID - required
                'cartId' => (int) ($oOrder->id_cart),
                'totalIncTax' => Tools::ps_round((float) ($oOrder->total_paid) / (float) ($iConversionRate), 2),
                'totalExcTax' => Tools::ps_round((float) ($oOrder->total_paid) / (float) ($iConversionRate), 2),
                'discountAmount' => Tools::ps_round((float) ($oOrder->total_discounts) / (float) ($iConversionRate), 2),
                'shippingPrice' => Tools::ps_round((float) ($oOrder->total_shipping) / (float) ($iConversionRate), 2),
                'paymentMethod' => $oOrder->payment,
                'shippingMethod' => $oCarrier->name,
            );

            // Product information
            $aProducts = $oOrder->getProducts();
            foreach ($aProducts as $aProduct) {
                $aPurchase['items'][] = array(
                    'id' => (int) ($aProduct['product_id']),
                    'id_variation' => (int) ($aProduct['product_attribute_id']),
                    'qty' => Tools::ps_round((float) ($aProduct['product_quantity']), 2),
                    'priceIncTax' =>
                        Tools::ps_round((float) ($aProduct['product_price_wt']) / (float) ($iConversionRate), 2),
                    'priceExcTax' =>
                        Tools::ps_round((float) ($aProduct['product_price']) / (float) ($iConversionRate), 2),
                );
            }

            $this->context->smarty->assign(array('purchase' => $aPurchase));
            return $this->display(__FILE__, 'order_confirmation.tpl');
        }
    }

    /**
     * @desc The Prestashop compare version with current version.
     * @param varchar $sVersion The version to compare
     * @return boolean The comparaison
     */
    public static function compareVersion($sVersion = '1.4')
    {
        $sSubVerison = Tools::substr(_PS_VERSION_, 0, 3);
        return version_compare($sSubVerison, $sVersion);
    }

    /**
     * @desc Clean html.
     * @param string $sHtml The html content
     * @return string Text cleaned.
     */
    public static function cleanHtml($sHtml)
    {
        $sString = str_replace('<br />', '', nl2br($sHtml));
        $sString = trim(strip_tags(htmlspecialchars_decode($sString)));
        $sString = preg_replace('`[\s]+`sim', ' ', $sString);
        $sString = preg_replace('`"`sim', '', $sString);
        $sString = nl2br($sString);
        $sPattern = '@<[\/\!]*?[^<>]*?>@si'; //nettoyage du code HTML
        $sString = preg_replace($sPattern, ' ', $sString);
        $sString = preg_replace('/[\s]+/', ' ', $sString); //nettoyage des espaces multiples
        $sString = trim($sString);
        $sString = str_replace('&nbsp;', ' ', $sString);
        $sString = str_replace('|', ' ', $sString);
        $sString = str_replace('"', '\'', $sString);
        $sString = str_replace('?', '\'', $sString);
        $sString = str_replace('&#39;', '\' ', $sString);
        $sString = str_replace('&#150;', '-', $sString);
        $sString = str_replace(chr(9), ' ', $sString);
        $sString = str_replace(chr(10), ' ', $sString);
        $sString = str_replace(chr(13), ' ', $sString);
        return $sString;
    }

    /**
     * @desc Format float.
     * @param float $fFloat The float to format
     * @return float Float formated
     */
    public static function formatNumber($fFloat)
    {
        return number_format(round($fFloat, 2), 2, '.', '');
    }

    /**
     * @param integer $iOrderId
     * @param integer $iOrderStateId
     * @return boolean
     */
    private function addInfos($iOrderId, $iOrderStateId)
    {
        $tData = time();

        $bExistOrderState = BrainifyInfosClass::getExist($iOrderId);
        if ($bExistOrderState) {
            $oBrainifyOrderState = new BrainifyInfosClass($bExistOrderState);
            $oBrainifyOrderState->current_state = $iOrderStateId;
            $oBrainifyOrderState->timestamp_add = $tData;
            $bReturn = $oBrainifyOrderState->update();
        } else {
            $sBrainifyVisitck = null;
            if (isset($_COOKIE['brainify.visitck'])) { // We are required to use $_COOKIE here because it's a custom cookie written by our JS tracker
                $sBrainifyVisitck = $_COOKIE['brainify.visitck'];
            }

            $sBrainifyVisitorck = null;
            if (isset($_COOKIE['brainify.visitorck'])) { // We are required to use $_COOKIE here because it's a custom cookie written by our JS tracker
                $sBrainifyVisitorck = $_COOKIE['brainify.visitorck'];
            }

            $oBrainifyOrderState = new BrainifyInfosClass();
            $oBrainifyOrderState->id_order = $iOrderId;
            $oBrainifyOrderState->current_state = $iOrderStateId;
            $oBrainifyOrderState->timestamp_add = $tData;
            $oBrainifyOrderState->brainify_visitck = $sBrainifyVisitck;
            $oBrainifyOrderState->brainify_visitorck = $sBrainifyVisitorck;
            $bReturn = $oBrainifyOrderState->add();
        }

        return $bReturn;
    }

    /**
     * @param integer $iObjectId
     * @param integer $iTypeId
     * @param integer $iOrderStateId
     * @return boolean
     */
    private function addUpdate($iObjectId, $iTypeId, $iOrderStateId = 0)
    {
        $bExist = BrainifyUpdateClass::getExist($iObjectId, $iTypeId);
        $tData = time();

        if ($bExist && $iTypeId == BrainifyUpdateClass::$id_type_product) {
            $oBrainifyUpdate = new BrainifyUpdateClass($bExist);
            $oBrainifyUpdate->id_object = $iObjectId;
            $oBrainifyUpdate->id_type = $iTypeId;
            $oBrainifyUpdate->id_shop = (int) Context::getContext()->shop->id;
            $oBrainifyUpdate->timestamp_add = $tData;
            $bReturn = $oBrainifyUpdate->update();
        } else {
            $oBrainifyUpdate = new BrainifyUpdateClass();
            $oBrainifyUpdate->id_object = $iObjectId;
            $oBrainifyUpdate->id_type = $iTypeId;
            $oBrainifyUpdate->id_shop = (int) Context::getContext()->shop->id;
            $oBrainifyUpdate->timestamp_add = $tData;

            if ($iTypeId == BrainifyUpdateClass::$id_type_order) {
                $oBrainifyUpdate->ordrer_state = $iOrderStateId;

                // We use the visitck and visitorck of the original order if we find it
                $bExistOrderState = BrainifyInfosClass::getExist($iObjectId);
                if ($bExistOrderState) {
                    $oBrainifyInfo = new BrainifyInfosClass($bExistOrderState);
                    $oBrainifyUpdate->brainify_visitck = $oBrainifyInfo->brainify_visitck;
                    $oBrainifyUpdate->brainify_visitorck = $oBrainifyInfo->brainify_visitorck;
                }
            }

            $bReturn = $oBrainifyUpdate->add();
        }

        return $bReturn;
    }

    /**
     *
     */
    private function updateSql()
    {
        $bExistBrainifyVisitck =
            Db::getInstance()
                ->Executes('SHOW COLUMNS FROM `' . _DB_PREFIX_ . 'brainify_update` LIKE "brainify_visitck"');
        if (empty($bExistBrainifyVisitck)) {
            $sAlter = "ALTER TABLE `" . _DB_PREFIX_ . "brainify_update` ADD  `brainify_visitck` varchar(255)";
            Db::getInstance()->Execute($sAlter);
        }

        $bExistBrainifyVisitorck =
            Db::getInstance()
                ->Executes('SHOW COLUMNS FROM `' . _DB_PREFIX_ . 'brainify_update` LIKE "brainify_visitorck"');
        if (empty($bExistBrainifyVisitorck)) {
            $sAlter = "ALTER TABLE `" . _DB_PREFIX_ . "brainify_update` ADD  `brainify_visitorck` varchar(255)";
            Db::getInstance()->Execute($sAlter);
        }

        $bExistOrderState =
            Db::getInstance()
                ->Executes('SHOW COLUMNS FROM `' . _DB_PREFIX_ . 'brainify_update` LIKE "ordrer_state"');
        if (empty($bExistOrderState)) {
            $sAlter = "ALTER TABLE `" . _DB_PREFIX_ . "brainify_update` ADD  `ordrer_state` INT(10)";
            Db::getInstance()->Execute($sAlter);
        }
    }

    /**
     * Get order history
     * Warning : this is a re-implementation of Order::getHistory to avoid bug related to `$_historyCache`
     *
     * @param int $id_order Order id
     * @param int $id_lang Language id
     * @param int $id_order_state Filter a specific order status
     * @param int $no_hidden Filter no hidden status
     * @param int $filters Flag to use specific field filter
     *
     * @return array History entries ordered by date DESC
     */
    protected function getOrderHistory($id_order, $id_lang, $id_order_state = false, $no_hidden = false, $filters = 0)
    {
        if (!$id_order_state) {
            $id_order_state = 0;
        }

        $logable = false;
        $delivery = false;
        $paid = false;
        $shipped = false;
        if ($filters > 0) {
            if ($filters & OrderState::FLAG_NO_HIDDEN) {
                $no_hidden = true;
            }
            if ($filters & OrderState::FLAG_DELIVERY) {
                $delivery = true;
            }
            if ($filters & OrderState::FLAG_LOGABLE) {
                $logable = true;
            }
            if ($filters & OrderState::FLAG_PAID) {
                $paid = true;
            }
            if ($filters & OrderState::FLAG_SHIPPED) {
                $shipped = true;
            }
        }

        $id_lang = $id_lang ? (int) $id_lang : 'o.`id_lang`';
        $result = Db::getInstance()->executeS('
        SELECT os.*, oh.*, e.`firstname` as employee_firstname, e.`lastname` as employee_lastname, osl.`name` as ostate_name
        FROM `' . _DB_PREFIX_ . 'orders` o
        LEFT JOIN `' . _DB_PREFIX_ . 'order_history` oh ON o.`id_order` = oh.`id_order`
        LEFT JOIN `' . _DB_PREFIX_ . 'order_state` os ON os.`id_order_state` = oh.`id_order_state`
        LEFT JOIN `' . _DB_PREFIX_ . 'order_state_lang` osl ON (os.`id_order_state` = osl.`id_order_state` AND osl.`id_lang` = ' . (int) ($id_lang) . ')
        LEFT JOIN `' . _DB_PREFIX_ . 'employee` e ON e.`id_employee` = oh.`id_employee`
        WHERE oh.id_order = ' . (int) $id_order . '
        ' . ($no_hidden ? ' AND os.hidden = 0' : '') . '
        ' . ($logable ? ' AND os.logable = 1' : '') . '
        ' . ($delivery ? ' AND os.delivery = 1' : '') . '
        ' . ($paid ? ' AND os.paid = 1' : '') . '
        ' . ($shipped ? ' AND os.shipped = 1' : '') . '
        ' . ((int) $id_order_state ? ' AND oh.`id_order_state` = ' . (int) $id_order_state : '') . '
        ORDER BY oh.date_add DESC, oh.id_order_history DESC');

        return $result;
    }

    /**
     * @param object $oContext
     * @return bool|int
     */
    private function getCategoryProvided($oContext)
    {
        $iCategoryId = false;

        // If the previous page was a category and is a parent category of the product use this category as parent category
        if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] == Tools::secureReferrer($_SERVER['HTTP_REFERER']) // Assure us the previous page was one of the shop
            && preg_match('~^.*(?<!\/content)\/([0-9]+)\-(.*[^\.])|(.*)id_(category|product)=([0-9]+)(.*)$~', $_SERVER['HTTP_REFERER'], $aRegs)
        ) {
            $iObjectId = false;

            if (isset($aRegs[1]) && is_numeric($aRegs[1])) {
                $iObjectId = (int) $aRegs[1];
            } elseif (isset($aRegs[5]) && is_numeric($aRegs[5])) {
                $iObjectId = (int) $aRegs[5];
            }

            if ($iObjectId) {
                $aReferers = array($_SERVER['HTTP_REFERER'], urldecode($_SERVER['HTTP_REFERER']));

                if (in_array($oContext->link->getCategoryLink($iObjectId), $aReferers)) {
                    $iCategoryId = (int) $iObjectId;
                } elseif (isset($oContext->cookie->last_visited_category) && (int) $oContext->cookie->last_visited_category && in_array($oContext->link->getProductLink($iObjectId), $aReferers)) {
                    $iCategoryId = (int) $oContext->cookie->last_visited_category;
                }
            }
        }

        if (_PS_VERSION_ >= 1.6) {
            $oProduct = $oContext->controller->getProduct();
        } else {
            $id_product = (int) Tools::getValue('id_product');
            $oProduct = new Product($id_product);
        }

        // If category is not found, we take id_category default
        if (!$iCategoryId || !Category::inShopStatic($iCategoryId, $oContext->shop) || !Product::idIsOnCategoryId((int) $oProduct->id, array('0' => array('id_category' => $iCategoryId)))) {
            $iCategoryId = (int) $oProduct->id_category_default;
        }

        return $iCategoryId;
    }

    /**
     * @param integer $iProductId
     * @return array
     */
    private function getVariationsProduct($iProductId)
    {
        $aAttributesId = array();

        if (Combination::isFeatureActive()) {
            $sRequest = 'SELECT pa.id_product_attribute
                FROM `' . _DB_PREFIX_ . 'product_attribute` pa
                ' . Shop::addSqlAssociation('product_attribute', 'pa') . '
                LEFT JOIN `' . _DB_PREFIX_ . 'product_attribute_combination` pac ON pac.`id_product_attribute` = pa.`id_product_attribute`
                WHERE pa.`id_product` = ' . (int) $iProductId . '
                GROUP BY pa.`id_product_attribute`
                ORDER BY pa.`id_product_attribute`';

            $aAttributes = Db::getInstance()->executeS($sRequest);

            if (!empty($aAttributes)) {
                foreach ($aAttributes as $iKey => $aAttributeId) {
                    $aAttributesId[] = $aAttributeId['id_product_attribute'];
                }
            }
        }

        return $aAttributesId;
    }

    /**
     * @param integer $iCategoryId
     * @param boolean|true $bCategoryInArray
     * @return array
     */
    private function getParentsCategories($iCategoryId, $bCategoryInArray = false)
    {
        $aCategoriesId = array();
        $oCategory = new Category($iCategoryId, Context::getContext()->language->id);
        $aParents = $oCategory->getParentsCategories();

        if (!empty($aParents)) {
            foreach ($aParents as $iKey => $aCategory) {
                if ($bCategoryInArray || (!$bCategoryInArray && $aCategory['id_category'] != $iCategoryId)) {
                    $aCategoriesId[] = $aCategory['id_category'];
                }
            }
        }

        return $aCategoriesId;
    }
}
