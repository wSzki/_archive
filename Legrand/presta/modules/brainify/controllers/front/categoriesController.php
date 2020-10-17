<?php
/**
 * Copyright (C) 2015-2018 Brainify - All Rights Reserved
 *
 * @author    Brainify <tech@brainify.it>
 * @copyright 2015-2018 Brainify
 * @license   Proprietary License
 */

include_once(dirname(__FILE__) . '/../../classes/brainifyApi.php');

/**
 * Class CategoriesController
 */
class CategoriesController extends BrainifyApi
{
    private $aCategoriesSend;
    private $aCategories = array();

    /**
     *
     */
    public function __construct()
    {
        parent::__construct();
        $this->aCategoriesSend = array('timestamp' => $this->tDateTime, 'categories' => array());
    }

    /**
     * @desc Returns a JSON string object to list of all categories
     * @url GET /module/brainify/apiAllCategories
     * @return array
     */
    public function getAllCategories()
    {
        // Init data
        $this->aCategories = array();

        // Retrieve and dispatch categories
        $this->retrieveCategories(Context::getContext()->language->id);

        // Add data
        $this->aCategoriesSend['categories'] = $this->aCategories;

        // Return data
        return $this->aCategoriesSend;
    }

    /**
     * @desc Returns a JSON string object to list of categories
     * @url GET /module/brainify/apiCategories
     * @return array
     */
    public function getCategories()
    {
        if (!isset($this->sLimit)) {
            $this->sLimit = 1000000000;
        }
        if (!isset($this->sOffSet)) {
            $this->sOffSet = 0;
        }

        if (!isset($this->tGetDateTime)) {
            return array('error', 'Missing timestamp parameter');
        } elseif (!is_numeric($this->sOffSet) || !is_numeric($this->tGetDateTime) || !is_numeric($this->sLimit) || $this->sLimit == 0 || $this->sOffSet < 0) {
            return array('error', "Cart parameter(s) value is incorrect (offset, limit, timestamp)");
        }

        // Init data
        $this->aCategories = array();

        // Construct data
        $aBrainifyUpdates = BrainifyUpdateClass::getAllByType(BrainifyUpdateClass::$id_type_category, $this->tGetDateTime, $this->sOffSet, $this->sLimit);
        if (is_array($aBrainifyUpdates) && !empty($aBrainifyUpdates)) {
            foreach ($aBrainifyUpdates as $oBrainifyUpdate) {
                $iCategoryId = $oBrainifyUpdate->id_object;
                $oCategory = new Category($iCategoryId, Context::getContext()->language->id);
                if (!is_null($oCategory->name)) {
                    $this->aCategories[$iCategoryId] = array(
                        'name' => $oCategory->name,
                        'id' => $iCategoryId,
                        'id_parent' => $oCategory->id_parent,
                    );
                }
            }
        }

        // Add data into final array
        $this->aCategoriesSend['categories'] = $this->aCategories;

        // Remove old data into database
        BrainifyUpdateClass::deleteByType(BrainifyUpdateClass::$id_type_category, $this->tGetDateTime);

        // Return data
        return $this->aCategoriesSend;
    }

    /**
     * @desc Retrieve all categories
     * @param int $iLangId
     */
    private function retrieveCategories($iLangId)
    {
        $aResult = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS(
            'SELECT c.id_category, cl.name, c.id_parent, c.level_depth
			FROM ' . _DB_PREFIX_ . 'category c
			' . Shop::addSqlAssociation('category', 'c') . '
			LEFT JOIN ' . _DB_PREFIX_ . 'category_lang cl ON c.id_category = cl.id_category' . Shop::addSqlRestrictionOnLang('cl') . '
			WHERE id_lang = ' . (int)$iLangId . ' AND active = 1 AND level_depth = 1
            ORDER BY c.level_depth ASC, category_shop.position ASC'
        );

        foreach ($aResult as $aRow) {
            $this->aCategories[] = array(
                'name' => $aRow['name'],
                'iCategoryId' => $aRow['id_category'],
                'subcategories' => $this->getCategoriesChildren($aRow['id_category'], $iLangId),
            );
        }
    }

    /**
     * @param $iParentId
     * @param $iLangId
     */
    private function getCategoriesChildren($iParentId, $iLangId)
    {
        $aResult = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS(
            'SELECT c.id_category, cl.name, c.id_parent, c.level_depth
                FROM ' . _DB_PREFIX_ . 'category c
                ' . Shop::addSqlAssociation('category', 'c') . '
                LEFT JOIN ' . _DB_PREFIX_ . 'category_lang cl ON c.id_category = cl.id_category' . Shop::addSqlRestrictionOnLang('cl') . '
                WHERE id_lang = ' . (int)$iLangId . ' AND active = 1 AND id_parent = ' . $iParentId . '
                ORDER BY c.level_depth ASC, category_shop.position ASC'
        );

        $aCategories = array();
        foreach ($aResult as $aRow) {
            $aCategories[] = array(
                'name' => $aRow['name'],
                'iCategoryId' => $aRow['id_category'],
                'subcategories' => $this->getCategoriesChildren($aRow['id_category'], $iLangId),
            );
        }

        return $aCategories;
    }
}
