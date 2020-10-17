<?php
/**
 * Copyright (C) 2015-2018 Brainify - All Rights Reserved
 *
 * @author    Brainify <tech@brainify.it>
 * @copyright 2015-2018 Brainify
 * @license   Proprietary License
 */

/**
 * Class BrainifyInfosClass
 */
class BrainifyInfosClass extends ObjectModel
{
    public $id;
    public $id_order;
    public $current_state;
    public $brainify_visitck;
    public $brainify_visitorck;
    public $timestamp;
    public $date_add;
    public $date_upd;
    public static $definition = array(
        'table' => 'brainify_infos',
        'primary' => 'id',
        'multilang' => false,
        'multishop' => false,
        'fields' => array(
            'id' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedId'),
            'id_order' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedId'),
            'current_state' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedId'),
            'brainify_visitck' => array('type' => self::TYPE_STRING),
            'brainify_visitorck' => array('type' => self::TYPE_STRING),
            'timestamp_add' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedId', 'default' => '1'),
            'date_add' => array('type' => self::TYPE_DATE, 'validate' => 'isDateFormat'),
            'date_upd' => array('type' => self::TYPE_DATE, 'validate' => 'isDateFormat'),
        )
    );

    /**
     * @return array
     */
    public static function getAll()
    {
        $sSelect = ""
            . " SELECT id"
            . " FROM " . _DB_PREFIX_ . "brainify_infos"
            . " ORDER BY date_upd DESC";

        $result = Db::getInstance()->ExecuteS($sSelect);

        if (is_array($result)) {
            foreach ($result as $iUpdateId => $aBrainifyUpdate) {
                $result[$iUpdateId] = new BrainifyInfosClass($aBrainifyUpdate['id']);
            }
        }

        return $result;
    }

    /**
     * @param integer $iOrder
     * @return mixed
     */
    public static function getExist($iOrder)
    {
        $sSelect = ""
            . " SELECT id"
            . " FROM " . _DB_PREFIX_ . "brainify_infos"
            . " WHERE id_order = '" . (int) $iOrder . "'";

        return Db::getInstance()->getValue($sSelect);
    }
}
