<?php
/**
 * Copyright (C) 2015-2018 Brainify - All Rights Reserved
 *
 * @author    Brainify <tech@brainify.it>
 * @copyright 2015-2018 Brainify
 * @license   Proprietary License
 */

function upgrade_module_4_0_0($module)
{
    $module->unregisterHook('rightColumn');
    $module->unregisterHook('leftColumn');
    $module->unregisterHook('displayTop');
    $module->unregisterHook('footer');
    $module->unregisterHook('shoppingCart');
    $module->unregisterHook('productOutOfStock');
    $module->unregisterHook('displayHome');
    $module->unregisterHook('displayFooterProduct');
    return true;
}
