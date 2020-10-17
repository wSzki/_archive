<?php
/**
 * Copyright (C) 2015-2018 Brainify - All Rights Reserved
 *
 * @author    Brainify <tech@brainify.it>
 * @copyright 2015-2018 Brainify
 * @license   Proprietary License
 */

function upgrade_module_4_3_0($module)
{
    $module->registerHook('actionCartSave');
    $module->registerHook('actionObjectDeleteAfter');
    return true;
}
