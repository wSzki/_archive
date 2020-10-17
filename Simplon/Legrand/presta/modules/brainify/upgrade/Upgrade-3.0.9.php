<?php
/**
 * Copyright (C) 2015-2018 Brainify - All Rights Reserved
 *
 * @author    Brainify <tech@brainify.it>
 * @copyright 2015-2018 Brainify
 * @license   Proprietary License
 */

function upgrade_module_3_0_9($module)
{
    $moduleTabs = Tab::getModuleTabList();
    if (!isset($moduleTabs['brainifysignup'])) {
        $tab = new Tab();
        $tab->name = array(Configuration::get('PS_LANG_DEFAULT') => 'Brainify Analytics');
        $tab->class_name = 'BrainifySignup';
        $tab->module = 'brainify';
        $tab->id_parent = -1;
        $tab->active = 0;
        return $tab->save();
    } else {
        return true;
    }
}
