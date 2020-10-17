<?php
/**
 * Copyright (C) 2015-2018 Brainify - All Rights Reserved
 *
 * @author    Brainify <tech@brainify.it>
 * @copyright 2015-2018 Brainify
 * @license   Proprietary License
 */

/**
 * @param $oModule
 * @return mixed
 */
function upgrade_module_3_0_10($oModule)
{
    Configuration::deleteByName('BRAINIFY_ACTION');
    Configuration::deleteByName('BRAINIFY_ID_ITEM');
    Configuration::deleteByName('BRAINIFY_ID_ITEM_VARIATION');
    return $oModule->unregisterHook('actionCartSave');
}
