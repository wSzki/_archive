<?php
/**
 * Copyright (C) 2015-2018 Brainify - All Rights Reserved
 *
 * @author    Brainify <tech@brainify.it>
 * @copyright 2015-2018 Brainify
 * @license   Proprietary License
 */

include_once(dirname(__FILE__) . '/../../classes/brainifyApi.php');

/**
 * Class CartsController
 */
class CartsController extends BrainifyApi
{
    private $aCartsSend;

    /**
     *
     */
    public function __construct()
    {
        parent::__construct();
        $this->aCartsSend = array('timestamp' => $this->tDateTime, 'carts' => array());
    }

    /**
     * @desc Returns a JSON string object to list of all carts
     * @url GET /module/brainify/apiAllCarts
     * @return array
     */
    public function getAllCarts()
    {
        if (!isset($this->sLimit)) {
            $this->sLimit = 1000000000;
        }
        if (!isset($this->sOffSet)) {
            $this->sOffSet = 0;
        }

        if (!isset($this->sOrderBy)) {
            return array('error', 'Missing orderBy parameter');
        } elseif (!Validate::isOrderWay($this->sOrderBy) || !is_numeric($this->sOffSet) || !is_numeric($this->sLimit) || $this->sLimit == 0 || $this->sOffSet < 0) {
            return array('error', "Cart parameter(s) value is incorrect (orderBy, offset, limit)");
        }

        // Select all carts
        $sSelectCarts = "
              SELECT c.id_cart
              FROM " . _DB_PREFIX_ . "cart c
              WHERE c.id_shop = " . pSQL(Configuration::get('BRAINIFY_SHOP_ID')) . " 
              ORDER BY c.id_cart " . pSQL($this->sOrderBy) . "
              LIMIT " . (int)$this->sOffSet . "," . (int)$this->sLimit;

        $aCarts = Db::getInstance()->ExecuteS($sSelectCarts);
        // Construct data
        foreach ($aCarts as $aCart) {
            $iCartId = $aCart['id_cart'];
            $cart = $this->constructTab($iCartId);
            if ($cart) {
                $this->aCartsSend['carts'][] = $cart;
            }
        }

        // Return data
        return $this->aCartsSend;
    }

    public function getCarts()
    {
        if (!isset($this->sLimit)) {
            $this->sLimit = 1000000000;
        }
        if (!isset($this->sOffSet)) {
            $this->sOffSet = 0;
        }

        if (!isset($this->sOrderBy) || !isset($this->tGetDateTime)) {
            return array('error', 'Missing paramaters (orderBy or timestamp)');
        } elseif (!Validate::isOrderWay($this->sOrderBy) || !is_numeric($this->sOffSet) || !is_numeric($this->sLimit) || !is_numeric($this->tGetDateTime) || $this->sLimit == 0 || $this->sOffSet < 0) {
            return array('error', 'Cart parameter(s) value is incorrect (orderBy, offset, limit or timestamp)');
        }

        // Init data
        $this->aCartsSend['carts'] = array();

        // Select all carts
        $sSelectCarts = "
              SELECT c.id_cart
              FROM " . _DB_PREFIX_ . "cart c
              WHERE c.id_shop = " . pSQL(Configuration::get('BRAINIFY_SHOP_ID')) . "
              AND c.date_upd > '" . date('Y-m-d H:i:s', $this->tGetDateTime) . "'
              ORDER BY c.id_cart " . $this->sOrderBy . "
              LIMIT " . (int)$this->sOffSet . "," . (int)$this->sLimit;
        $aCarts = Db::getInstance()->ExecuteS($sSelectCarts);

        // Construct data
        foreach ($aCarts as $aCart) {
            $iCartId = $aCart['id_cart'];
            $this->aCartsSend['carts'][] = $this->constructTab($iCartId);
        }

        // Return data
        return $this->aCartsSend;
    }

    /**
     * @desc Return cart infos into an array
     * @param integer $iCartId
     * @param string $sDateAdd
     * @param string $sDateUpd
     * @param integer $iLangId
     * @return array
     */
    private function constructTab($iCartId)
    {
        $oCart = new Cart($iCartId);
        $oCustomer = new Customer($oCart->id_customer);
        $fConversionRate = 1;

        if ($oCart->id_currency != Configuration::get('PS_CURRENCY_DEFAULT')) {
            $oCurrency = new Currency((int) ($oCart->id_currency));
            $fConversionRate = (float) ($oCurrency->conversion_rate);
        }

        // Convert dates to utc date
        $sDateCartAdd = date('c', strtotime('' . $oCart->date_add . ''));
        $sDateCartUpd = date('c', strtotime('' . $oCart->date_upd . ''));
        $sqlGetOrderID = 'SELECT `id_order` FROM ' . _DB_PREFIX_ . 'orders WHERE `id_cart` = ' . (int)$iCartId;

        $orderId = Db::getInstance()->getValue($sqlGetOrderID);
        if ($orderId == false) {
            $orderId = null;
        }

        $currentLang = Language::getLanguage($oCart->id_lang);

        // Cart general information
        $aPurchase = array(
            'id' => (int) ($oCart->id),
            'orderId' => $orderId,
            'dateAdd' => $sDateCartAdd,
            'dateUpdate' => $sDateCartUpd,
            'lang' => $currentLang['iso_code'],
            'customer' => array(
                'id' => $oCustomer->id,
                'firstname' => $oCustomer->firstname,
                'lastname' => $oCustomer->lastname,
                'email' => $oCustomer->email
            ),
            'error' => array()
        );

        // Product information
        try {
            $aProducts = $oCart->getProducts();
        } catch (PrestaShopException $e) {
            $aPurchase['error'] = array("items");
            return $aPurchase;
        }

        foreach ($aProducts as $aProduct) {
            $aPurchase['items'][] = array(
                'id' => (int) ($aProduct['id_product']),
                'itemVariationId' => (int) ($aProduct['id_product_attribute']),
                'quantity' => Tools::ps_round((float) ($aProduct['cart_quantity']), 2),
                'priceIncTax' => Tools::ps_round((float) ($aProduct['price_wt']) / (float) ($fConversionRate), 2),
                'priceExcTax' => Tools::ps_round((float) ($aProduct['price']) / (float) ($fConversionRate), 2),
            );
        }

        return $aPurchase;
    }
}
