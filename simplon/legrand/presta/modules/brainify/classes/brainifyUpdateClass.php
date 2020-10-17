<?php
/**
 * Copyright (C) 2015-2018 Brainify - All Rights Reserved
 *
 * @author    Brainify <tech@brainify.it>
 * @copyright 2015-2018 Brainify
 * @license   Proprietary License
 */

/**
 * Class BrainifyUpdateClass
 */
class BrainifyUpdateClass extends ObjectModel
{

    public $id_update;
    public $id_object;
    public $id_type;
    public $id_shop;
    public $timestamp;
    public $date_add;
    public $date_upd;
    public $brainify_visitck;
    public $brainify_visitorck;
    public $ordrer_state;
    public static $id_type_product = 0;
    public static $id_type_order = 1;
    public static $id_type_category = 2;
    public static $definition = array(
        'table' => 'brainify_update',
        'primary' => 'id_update',
        'multilang' => false,
        'multishop' => false,
        'fields' => array(
            'id_update' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedId'),
            'id_object' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedId'),
            'id_type' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedId'),
            'id_shop' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedId', 'default' => '1'),
            'timestamp_add' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedId', 'default' => '1'),
            'date_add' => array('type' => self::TYPE_DATE, 'validate' => 'isDateFormat'),
            'date_upd' => array('type' => self::TYPE_DATE, 'validate' => 'isDateFormat'),
            'brainify_visitck' => array('type' => self::TYPE_STRING),
            'brainify_visitorck' => array('type' => self::TYPE_STRING),
            'ordrer_state' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedId'),
        )
    );

    /**
     * @param integer $iTypeId
     * @param integer $tTimestamp
     * @return array
     */
    public static function getAllByType($iTypeId, $tTimestamp, $sOffset, $sLimit)
    {
        $sSelect = ""
            . " SELECT id_update"
            . " FROM " . _DB_PREFIX_ . "brainify_update"
            . " WHERE id_shop = " . (int)Context::getContext()->shop->id
            . " AND id_type = '" . (int)$iTypeId . "'"
            . " AND timestamp_add > '" . (int)$tTimestamp . "'"
            . " ORDER BY date_upd ASC LIMIT " . (int)$sOffset . "," . (int)$sLimit;

        $result = Db::getInstance()->ExecuteS($sSelect);

        if (is_array($result)) {
            foreach ($result as $iUpdateId => $aBrainifyUpdate) {
                $result[$iUpdateId] = new BrainifyUpdateClass($aBrainifyUpdate['id_update']);
            }
        }

        return $result;
    }

    /**
     * @param integer $iObjectId
     * @param integer $iTypeId
     * @return mixed
     */
    public static function getExist($iObjectId, $iTypeId)
    {
        $sSelect = ""
            . " SELECT id_update"
            . " FROM " . _DB_PREFIX_ . "brainify_update"
            . " WHERE id_object = " . (int) $iObjectId
            . " AND id_type='" . (int) $iTypeId . "'";

        return Db::getInstance()->getValue($sSelect);
    }

    /**
     * @param integer $iTypeId
     * @param integer $tTimestamp
     * @return boolean
     */
    public static function deleteByType($iTypeId, $timestamp)
    {
        $sql = "DELETE FROM " . _DB_PREFIX_ . "brainify_update WHERE id_type = " . (int)$iTypeId . " AND timestamp_add < " . (int)$timestamp;
        return Db::getInstance()->execute($sql);
    }

    /**
     * @param integer $iObjectId
     * @param integer $iTypeId
     * @return mixed
     */
    public static function getDetail($iObjectId, $iTypeId)
    {
        $sSelect = ""
            . " SELECT id_update"
            . " FROM " . _DB_PREFIX_ . "brainify_update"
            . " WHERE id_object = " . (int) $iObjectId
            . " AND id_type='" . (int) $iTypeId . "'";

        return Db::getInstance()->getValue($sSelect);
    }
}
