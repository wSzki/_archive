<?php
/**
 * Copyright (C) 2015-2018 Brainify - All Rights Reserved
 *
 * @author    Brainify <tech@brainify.it>
 * @copyright 2015-2018 Brainify
 * @license   Proprietary License
 */

function upgrade_module_2_4_0($module)
{
    $sInsert = '
            CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'brainify_infos` (
            `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
            `id_order` int(10) UNSIGNED NOT NULL,
            `current_state` int(10) UNSIGNED NOT NULL,
            `brainify_visitck` varchar(255),
            `brainify_visitorck` varchar(255),
            `timestamp_add` int(12) UNSIGNED NOT NULL,
            `date_add` datetime NOT NULL,
            `date_upd` datetime NOT NULL,
            PRIMARY KEY (`id`))
            ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8';

    return Db::getInstance()->execute($sInsert);
}
