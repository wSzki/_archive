<?php
/**
 * Copyright (C) 2015-2018 Brainify - All Rights Reserved
 *
 * @author    Brainify <tech@brainify.it>
 * @copyright 2015-2018 Brainify
 * @license   Proprietary License
 */

include_once(dirname(__FILE__) . '/../../classes/brainifyProduct.php');
include_once(dirname(__FILE__) . '/../../classes/brainifyApi.php');

/**
 * Class ProductsController
 */
class ProductsController extends BrainifyApi
{
    /**
     * @var string Fields to import
     */
    protected $__fields = '["id_product","name_product","reference_product","supplier_reference","manufacturer","category","category_default","description","price_product","purchasePrice","price_ht","discountPrice","pourcentage_reduction","quantity","weight","ean","upc","ecotax","available_product","url_product","image_product","id_mere","image_product_2","image_product_3","discountPriceBeginDate","discountPriceEndDate","meta_keywords","meta_description","url_rewrite","product_type","product_variation","currency","condition","supplier","date_add"]';

    /**
     * @var array Default fields
     */
    public static $DEFAULT_FIELDS = array(
        'id_product' => 'id',
        'name_product' => 'name',
        'reference_product' => 'reference',
        'supplier_reference' => 'supplier_reference',
        'manufacturer' => 'manufacturer',
        'category' => 'category',
        'category_default' => 'category_default',
        'description' => 'description',
        'price_product' => 'price',
        'purchasePrice' => 'wholesale_price',
        'price_ht' => 'price_duty_free',
        'discountPrice' => 'price_sale',
        'pourcentage_reduction' => 'price_sale_percent',
        'quantity' => 'quantity',
        'weight' => 'weight',
        'ean' => 'ean',
        'upc' => 'upc',
        'ecotax' => 'ecotax',
        'available_product' => 'available',
        'url_product' => 'url',
        'image_product' => 'image_1',
        'id_mere' => 'id_parent',
        'image_product_2' => 'image_2',
        'image_product_3' => 'image_3',
        'discountPriceBeginDate' => 'sale_from',
        'discountPriceEndDate' => 'sale_to',
        'meta_keywords' => 'meta_keywords',
        'meta_description' => 'meta_description',
        'url_rewrite' => 'url_rewrite',
        'product_type' => 'type',
        'product_variation' => 'variation',
        'currency' => 'currency',
        'condition' => 'condition',
        'supplier' => 'supplier',
        'Personnalisable' => 'perso',
        'Age from' => 'age_from',
        'Keyword1' => 'keyword1',
        'Keyword2' => 'keyword2',
        'Keyword3' => 'keyword3',
        'Keyword4' => 'keyword4',
        'Keyword5' => 'keyword5',
        'Frais de port' => 'frais_port',
        'date_add' => 'date_add',
    );

    /**
     * @var array Content list of products
     */
    private $aProductsSend;

    /**
     *
     */
    public function __construct()
    {
        parent::__construct();
        $this->aProductsSend = array('timestamp' => $this->tDateTime, 'products' => array());
    }

    /**
     * @desc Returns a JSON string object to the list of products
     * @url GET /module/brainify/apiAllProducts
     */
    public function getAllProducts()
    {
        if (!isset($this->sLimit)) {
            $this->sLimit = 1000000000;
        }
        if (!isset($this->sOffSet)) {
            $this->sOffSet = 0;
        }

        if (!isset($this->sOrderBy)) {
            return array('error', 'Missing orderBy parameter');
        } elseif (!Validate::isOrderWay($this->sOrderBy) || !is_numeric($this->sOffSet) || !is_numeric($this->sLimit) || $this->sLimit == 0 || $this->sOffSet < 0) {
            return array('error', "Cart parameter(s) value is incorrect (orderBy, limit, offset)");
        }

        // Init data
        $this->aProductsSend['products'] = array();

        // Select all products
        $aProducts = BrainifyProduct::exportIds($this->sOffSet, $this->sLimit, $this->sOrderBy);
        $iLanguageId = Context::getContext()->language->id;
        foreach ($aProducts as $aProduct) {
            $iProductId = $aProduct['id_product'];
            $this->constructTab($iProductId, $iLanguageId);
        }

        // Return data
        return $this->aProductsSend;
    }

    /**
     * @desc Returns a JSON string object to the list of products
     * @url GET /module/brainify/apiProducts
     */
    public function getProducts()
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
        $this->aProductsSend['products'] = array();

        // Init fiels
        $this->_makeFields();

        // Construct data
        $aBrainifyUpdates = BrainifyUpdateClass::getAllByType(BrainifyUpdateClass::$id_type_product, $this->tGetDateTime, $this->sOffSet, $this->sLimit);

        if (is_array($aBrainifyUpdates) && !empty($aBrainifyUpdates)) {
            foreach ($aBrainifyUpdates as $oBrainifyUpdate) {
                $iProductId = $oBrainifyUpdate->id_object;
                $iLanguageId = Context::getContext()->language->id;
                $this->constructTab($iProductId, $iLanguageId);
            }
        }

        // Remove old data into database
        BrainifyUpdateClass::deleteByType(BrainifyUpdateClass::$id_type_product, $this->tGetDateTime);

        // Return data
        return $this->aProductsSend;
    }

    /**
     * @desc Return product infos into an array
     * @param integer $iProductId
     * @param integer $iLanguageId
     */
    private function constructTab($iProductId, $iLanguageId)
    {
        $oProduct = new BrainifyProduct($iProductId, $iLanguageId);
        $aAttributeCombinations = $oProduct->getCombinations();

        // Main product
        if (!is_null($oProduct->id)) {
            $this->aProductsSend['products'][] = $this->_make($oProduct);

            // Product attributes
            if (is_array($aAttributeCombinations) && !empty($aAttributeCombinations)) {
                foreach ($aAttributeCombinations as $iProductAttributeId => $aCombination) {
                    $this->aProductsSend['products'][] = $this->_make($oProduct, $iProductAttributeId);
                }
            }
        }
    }

    /**
     * @desc Make the export for a product with current format.
     * @param object $oProduct The product to export
     * @param object $iProductAttributeId The id product attribute to export
     * @return array Product data
     */
    private function _make($oProduct, $iProductAttributeId = null)
    {
        $aProductArray = array();
        foreach (Tools::jsonDecode($this->__fields) as $sField) {
            $aProductArray[$sField] = $oProduct->getData(self::$DEFAULT_FIELDS[$sField], $iProductAttributeId);
        }

        if ((!isset($aProductArray['taille']) || (isset($aProductArray['taille']) && $aProductArray['taille'] == '')) && Tools::getIsset($aProductArray['product_variation']) && strstr($aProductArray['product_variation'], 'Taille')) {
            $aProductArray['taille'] = "M";
        }

        return $aProductArray;
    }

    /**
     * @desc Make fields to export.
     */
    private function _makeFields()
    {
        foreach (Tools::jsonDecode($this->__fields) as $sField) {
            $this->fields[] = $sField;
        }
    }
}
