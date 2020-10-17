<?php
/**
 * Copyright (C) 2015-2018 Brainify - All Rights Reserved
 *
 * @author    Brainify <tech@brainify.it>
 * @copyright 2015-2018 Brainify
 * @license   Proprietary License
 */

include_once(dirname(__FILE__) . '/../../classes/brainifyRest.php');
include_once(dirname(__FILE__) . '/cartsController.php');

/**
 * Class BrainifyApiAllCartsModuleFrontController
 */
class BrainifyApiAllCartsModuleFrontController extends ModuleFrontController
{
    /**
     *
     */
    public function init()
    {
        $this->page_name = 'brainifyapiallcarts';
        $this->display_column_left = false;
        $this->display_column_right = false;
    }

    /**
     *
     */
    public function postProcess()
    {
        $oServer = new RestServer('production');
        $oServer->addClass('CartsController');
        $oServer->handle();
        die();
    }
}
