<?php
/**
 * Copyright (C) 2015-2018 Brainify - All Rights Reserved
 *
 * @author    Brainify <tech@brainify.it>
 * @copyright 2015-2018 Brainify
 * @license   Proprietary License
 */

include_once(dirname(__FILE__) . '/../../classes/brainifyRest.php');
include_once(dirname(__FILE__) . '/summaryController.php');

/**
 * Class BrainifyApiSummaryModuleFrontController
 */
class BrainifyApiSummaryModuleFrontController extends ModuleFrontController
{
    /**
     *
     */
    public function init()
    {
        $this->page_name = 'brainifyapisummary';
        $this->display_column_left = false;
        $this->display_column_right = false;
    }

    /**
     *
     */
    public function postProcess()
    {
        $oServer = new RestServer('production');
        $oServer->addClass('SummaryController');
        $oServer->handle();
        die();
    }
}
