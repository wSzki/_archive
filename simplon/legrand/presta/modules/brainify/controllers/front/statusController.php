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
 * Class StatusController
 */
class StatusController extends BrainifyApi
{
    private $aStatusSend;

    /**
     *
     */
    public function __construct()
    {
        parent::__construct();
        $this->aStatusSend = array();
    }

    /**
     * @desc Returns a JSON string object to the list of status
     * @url GET /module/brainify/apiStatus
     */
    public function getStatus()
    {
        $aStates = OrderState::getOrderStates(Context::getContext()->language->id);

        foreach ($aStates as $aState) {
            $this->aStatusSend[] = array(
                'id' => $aState['id_order_state'],
                'name' => $aState['name'],
                'state_is_validation' => $aState['logable'],
                'state_is_delivery' => $aState['delivery'],
                'state_is_shipped' => $aState['shipped'],
                'state_is_paid' => $aState['paid'],
            );
        }

        return $this->aStatusSend;
    }
}
