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
 * Class OrdersController
 */
class OrdersController extends BrainifyApi
{

    private $aOrdersSend;

    /**
     *
     */
    public function __construct()
    {
        parent::__construct();
        $this->aOrdersSend = array('timestamp' => $this->tDateTime, 'orders' => array());
    }

    /**
     * @desc Returns a JSON string object to list of all orders
     * @url GET /module/brainify/apiAllOrders
     * @return array
     */
    public function getAllOrders()
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
            return array('error', "Cart parameter(s) value is incorrect (orderBy, limit, offset)");
        }

        // Init data
        $this->aOrdersSend['orders'] = array();

        // Select all orders
        $sSelectOrders = "
            SELECT o.id_order, o.current_state
            FROM " . _DB_PREFIX_ . "orders o
            WHERE o.id_shop = " . pSQL(Configuration::get('BRAINIFY_SHOP_ID')) . "
            ORDER BY o.id_order " . $this->sOrderBy . "
            LIMIT " . (int)$this->sOffSet . "," . (int)$this->sLimit;
        $aOrders = Db::getInstance()->ExecuteS($sSelectOrders);

        // Construct data
        foreach ($aOrders as $aOrder) {
            $iOrderId = $aOrder['id_order'];
            $bExistOrderState = BrainifyInfosClass::getExist($iOrderId);
            if ($bExistOrderState) {
                $oBrainifyOrderState = new BrainifyInfosClass($bExistOrderState);
                $iOrderState = $oBrainifyOrderState->current_state;
                $sBrainifyVisitck = $oBrainifyOrderState->brainify_visitck;
                $sBrainifyVisitorck = $oBrainifyOrderState->brainify_visitorck;
                unset($oBrainifyOrderState);
            } else {
                $sBrainifyVisitck = '';
                $sBrainifyVisitorck = '';
                $iOrderState = $aOrder['current_state'];
            }

            $this->aOrdersSend['orders'][] = $this->constructTab($iOrderId, $sBrainifyVisitck, $sBrainifyVisitorck, $iOrderState);
        }


        // Return data
        return $this->aOrdersSend;
    }

    /**
     * @desc Returns a JSON string object to list of orders
     * @url GET /module/brainify/apiOrders
     * @return array
     */
    public function getOrders()
    {
        if (!isset($this->sLimit)) {
            $this->sLimit = 1000000000;
        }
        if (!isset($this->sOffSet)) {
            $this->sOffSet = 0;
        }

        if (!isset($this->tGetDateTime)) {
            return array('error', 'Missing timestamp parameter');
        } elseif (!is_numeric($this->sOffSet) || !is_numeric($this->tGetDateTime) || !is_numeric($this->sLimit) || $this->sLimit == 0 || $this->sOffSet < 0) {
            return array('error', "Cart parameter(s) value is incorrect (limit, timestamp)");
        }

        // Init data
        $this->aOrdersSend['orders'] = array();

        // Construct data
        $aBrainifyUpdates = BrainifyUpdateClass::getAllByType(BrainifyUpdateClass::$id_type_order, $this->tGetDateTime, $this->sOffSet, $this->sLimit);
        if (is_array($aBrainifyUpdates) && !empty($aBrainifyUpdates)) {
            foreach ($aBrainifyUpdates as $oBrainifyUpdate) {
                $this->aOrdersSend['orders'][] = $this->constructTab($oBrainifyUpdate->id_object, $oBrainifyUpdate->brainify_visitck, $oBrainifyUpdate->brainify_visitorck, $oBrainifyUpdate->ordrer_state);
            }
        }

        // Remove old data into database
        BrainifyUpdateClass::deleteByType(BrainifyUpdateClass::$id_type_order, $this->tGetDateTime);

        // Return data
        return $this->aOrdersSend;
    }

    /**
     * @desc Return order infos into an array
     * @param integer $iOrderId
     * @param string $sBrainifyVisitck
     * @param string $sBrainifyVisitorck
     * @param integer $iOrderStateId
     * @return array
     */
    private function constructTab($iOrderId, $sBrainifyVisitck = '', $sBrainifyVisitorck = '', $iOrderStateId = 0)
    {
        $oOrder = new Order($iOrderId);
        $oCustomer = new Customer($oOrder->id_customer);
        $oCarrier = new Carrier($oOrder->id_carrier);
        $aStates = $oOrder->getHistory(Context::getContext()->language->id);
        $aStatesTemplate = array();
        foreach ($aStates as $aState) {
            $oState = new OrderState($aState['id_order_state'], Context::getContext()->language->id);
            if ($oState->send_email == 1) {
                $aStatesTemplate[] = $oState->template;
            }
        }
        $fConversionRate = 1;
        if ($oOrder->id_currency != Configuration::get('PS_CURRENCY_DEFAULT')) {
            $oCurrency = new Currency((int) ($oOrder->id_currency));
            $fConversionRate = (float) ($oCurrency->conversion_rate);
        }

        // Current state
        $oState = new OrderState($iOrderStateId);

        // Convert dates to utc date
        $sDateOrderAdd = date('c', strtotime('' . $oOrder->date_add . ''));
        $sDateOrderUpd = date('c', strtotime('' . $oOrder->date_upd . ''));
        $sDateCustomerAdd = date('c', strtotime('' . $oCustomer->date_add . ''));
        $sDateCustomerUpd = date('c', strtotime('' . $oCustomer->date_upd . ''));

        // Order general information
        $aPurchase = array(
            'orderId' => (int) ($oOrder->id), // order ID - required
            'cartId' => (int) ($oOrder->id_cart),
            'cartId' => (int) ($oOrder->id_cart),
            'totalIncTax' => Tools::ps_round((float) ($oOrder->total_paid_tax_incl) / (float) ($fConversionRate), 2),
            'totalExcTax' => Tools::ps_round((float) ($oOrder->total_paid_tax_excl) / (float) ($fConversionRate), 2),
            'discountAmount' => Tools::ps_round((float) ($oOrder->total_discounts) / (float) ($fConversionRate), 2),
            'shippingPrice' => Tools::ps_round((float) ($oOrder->total_shipping) / (float) ($fConversionRate), 2),
            'paymentMethod' => $oOrder->payment,
            'shippingMethod' => $oCarrier->name,
            'order_date_add' => $sDateOrderAdd,
            'order_date_upd' => $sDateOrderUpd,
            'order_template' => $aStatesTemplate,
            'brainify_visitck' => !is_null($sBrainifyVisitck) ? $sBrainifyVisitck : '',
            'brainify_visitorck' => !is_null($sBrainifyVisitorck) ? $sBrainifyVisitorck : '',
            'state_is_validation' => $oState->logable,
            'state_is_delivery' => $oState->delivery,
            'state_is_shipped' => $oState->shipped,
            'state_is_paid' => $oState->paid,
            'customer' => array(
                'id' => $oCustomer->id,
                'firstname' => $oCustomer->firstname,
                'lastname' => $oCustomer->lastname,
                'email' => $oCustomer->email,
                'date_add' => $sDateCustomerAdd,
                'date_upd' => $sDateCustomerUpd,
            ),
        );

        // Product information
        $aProducts = $oOrder->getProducts();
        foreach ($aProducts as $aProduct) {
            $aPurchase['items'][] = array(
                'id' => (int) ($aProduct['product_id']),
                'item_variation_id' => (int) ($aProduct['product_attribute_id']),
                'qty' => Tools::ps_round((float) ($aProduct['product_quantity']), 2),
                'priceIncTax' => Tools::ps_round((float) ($aProduct['product_price_wt']) / (float) ($fConversionRate), 2),
                'priceExcTax' => Tools::ps_round((float) ($aProduct['product_price']) / (float) ($fConversionRate), 2),
            );
        }

        return $aPurchase;
    }
}
