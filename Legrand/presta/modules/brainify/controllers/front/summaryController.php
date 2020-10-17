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
 * Class SummaryController
 */
class SummaryController extends BrainifyApi
{
    private $aSummarySend;

    /**
     *
     */
    public function __construct()
    {
        parent::__construct();
        $this->aSummarySend = array();
    }

    /**
     * @desc Returns a JSON string object to the list of products
     * @url GET /module/brainify/apiSummary
     */
    public function getSummary()
    {
        if (!isset($this->sOrderBy) || !isset($this->tDateEnd) || !isset($this->tDateStart) || !isset($this->sMode)) {
            return array('error' => 'Missing parameter(s) (orderBy, dateStart, dateEnd, mode)');
        } elseif (!Validate::isOrderWay($this->sOrderBy) || !is_numeric($this->tDateEnd) || !is_numeric($this->tDateStart) || $this->tDateStart > $this->tDateEnd) {
            return array('error', "Cart parameter(s) value is incorrect (orderBy, dateStart, dateEnd)");
        }

        return $this->retrieveOrder();
    }

    /**
     *
     */
    private function retrieveOrder()
    {
        $sDateStart = date('Y-m-d H:i:s', $this->tDateStart);
        $sDateEnd = date('Y-m-d H:i:s', $this->tDateEnd);

        $sSelectOrders = "
                SELECT o.id_order
                FROM " . _DB_PREFIX_ . "orders o
                WHERE o.id_shop = " . pSQL(Configuration::get('BRAINIFY_SHOP_ID')) . "
                AND o.date_add > '" . $sDateStart . "'
                AND o.date_add < '" . $sDateEnd . "'
                ORDER BY o.id_order " . $this->sOrderBy;
        $aOrders = Db::getInstance()->ExecuteS($sSelectOrders);

        // Construct data
        foreach ($aOrders as $aOrder) {
            $oOrder = new Order($aOrder['id_order']);
            $oState = new OrderState($oOrder->current_state);

            $fConversionRate = 1;
            if ($oOrder->id_currency != Configuration::get('PS_CURRENCY_DEFAULT')) {
                $oCurrency = new Currency((int) ($oOrder->id_currency));
                $fConversionRate = (float) ($oCurrency->conversion_rate);
                unset($oCurrency);
            }

            $fAmount = Tools::ps_round((float) ($oOrder->total_paid) / (float) ($fConversionRate), 2);

            if ($this->sMode == "total") {
                $this->dispatchTotal($oOrder->current_state, $fAmount, $oState);
            } else {
                $sDateAdd = Tools::substr($oOrder->date_add, 0, 10);
                $this->dispatchDays($oOrder->current_state, $fAmount, $oState, $sDateAdd);
            }

            unset($fConversionRate);
            unset($oOrder);
        }

        return $this->aSummarySend;
    }

    /**
     * @param integer $iCurrentState
     * @param float $fAmount
     * @param object $oState
     */
    private function dispatchTotal($iCurrentState, $fAmount, $oState)
    {
        if (!isset($this->aSummarySend[$iCurrentState])) {
            $this->aSummarySend[$iCurrentState] = array(
                'amount' => 0,
                'count' => 0
            );
        }

        $this->aSummarySend[$iCurrentState] = array(
            'state_is_validation' => $oState->logable,
            'state_is_delivery' =>  $oState->delivery,
            'state_is_shipped' =>  $oState->shipped,
            'state_is_paid' =>  $oState->paid,
            'amount' => $this->aSummarySend[$iCurrentState]['amount'] + $fAmount,
            'count' => $this->aSummarySend[$iCurrentState]['count'] + 1,
        );
    }

    /**
     * @param integer $iCurrentState
     * @param float $fAmount
     * @param object $oState
     * @param string $sDateAdd
     */
    private function dispatchDays($iCurrentState, $fAmount, $oState, $sDateAdd)
    {
        if (!isset($this->aSummarySend[$sDateAdd][$iCurrentState])) {
            $this->aSummarySend[$sDateAdd][$iCurrentState] = array(
                'amount' => 0,
                'count' => 0
            );
        }

        $this->aSummarySend[$sDateAdd][$iCurrentState] = array(
            'state_is_validation' => $oState->logable,
            'state_is_delivery' =>  $oState->delivery,
            'state_is_shipped' =>  $oState->shipped,
            'state_is_paid' =>  $oState->paid,
            'amount' => $this->aSummarySend[$sDateAdd][$iCurrentState]['amount'] + $fAmount,
            'count' => $this->aSummarySend[$sDateAdd][$iCurrentState]['count'] + 1,
        );
    }
}
