<?php
/**
 * Copyright (C) 2015-2018 Brainify - All Rights Reserved
 *
 * @author    Brainify <tech@brainify.it>
 * @copyright 2015-2018 Brainify
 * @license   Proprietary License
 */

/**
 * Class BrainifyLogger
 */
class BrainifyLogger
{
    public static function addLog($message, $severity = 1, $error_code = null, $object_type = null, $object_id = null, $allow_duplicate = false, $id_employee = null)
    {
        if (strpos(_PS_VERSION_, '1.5') === 0) {
            Logger::addLog($message, $severity, $error_code, $object_type, $object_id, $allow_duplicate, $id_employee);
        } else {
            PrestaShopLogger::addLog($message, $severity, $error_code, $object_type, $object_id, $allow_duplicate, $id_employee);
        }
    }
}
