<?php
/**
 * Copyright (C) 2015-2018 Brainify - All Rights Reserved
 *
 * @author    Brainify <tech@brainify.it>
 * @copyright 2015-2018 Brainify
 * @license   Proprietary License
 */

/**
 * Class BrainifyProduct
 */
class BrainifyProduct extends Product
{

    /**
     * Images of produtcs
     */
    protected $aImages;

    /**
     * The product cover.
     */
    protected $cover = array();

    /**
     * Default category.
     */
    protected $category_default;

    /**
     * Name of default category.
     */
    protected $category_name;

    /**
     * If product is sale.
     */
    protected $is_sale = false;

    /**
     * Array combination of product's attributes.
     */
    protected $combinations;

    /**
     * Array of product's features.
     */
    protected $features;

    /**
     * Variation.
     */
    protected $variation;

    /**
     * @var array
     */
    protected $categories;

    /**
     * @desc Load a new product.
     *
     * @param integer $iProductId The ID product to load
     * @param integer $iLangId The ID lang for product's content
     * @param object $oContext The context
     */
    public function __construct($iProductId = null, $iLangId = null)
    {
        parent::__construct($iProductId, false, $iLangId);
        $oContext = Context::getContext();
        $this->tax_name = 'deprecated'; // The applicable tax may be BOTH the product one AND the state one (moreover this variable is some deadcode)
        $this->manufacturer_name = Manufacturer::getNameById((int) $this->id_manufacturer);
        $this->supplier_name = Supplier::getNameById((int) $this->id_supplier);
        $address = null;
        if (is_object($oContext->cart) && $oContext->cart->{Configuration::get('PS_TAX_ADDRESS_TYPE')} != null) {
            $address = $oContext->cart->{Configuration::get('PS_TAX_ADDRESS_TYPE')};
        }
        if (Brainify::compareVersion()) {
            $this->tax_rate = $this->getTaxesRate(new Address($address));
        } else {
            $this->tax_rate = Tax::getProductTaxRate($this->id, null);
        }
        $this->new = $this->isNew();
        $this->base_price = $this->price;
        $this->price = BrainifyProduct::getPriceStatic((int) $this->id, false, null, 2, null, false, true, 1, false, null, null, null, $this->specificPrice);
        $this->unit_price = ($this->unit_price_ratio != 0 ? $this->price / $this->unit_price_ratio : 0);
        if (Brainify::compareVersion()) {
            $this->loadStockData();
        }
        if ($this->id_category_default) {
            $this->category_default = new Category((int) $this->id_category_default, $iLangId);
            $this->category_name = $this->category_default->name;
        }
        $aImages = $this->getImages($iLangId);
        $aImagesArray = array();
        foreach ($aImages as $aImage) {
            if ($aImage['cover']) {
                $this->cover = $aImage;
            } else {
                $aImagesArray[] = $aImage;
            }
        }
        $this->images = $aImagesArray;
        $sToday = date('Y-m-d H:i:s');
        if (isset($this->specificPrice['from']) && isset($this->specificPrice['to']) && $this->specificPrice['from'] <= $sToday && $sToday <= $this->specificPrice['to']) {
            $this->is_sale = true;
        }
        $this->_makeFeatures($oContext);
        $this->_makeAttributes($oContext);
    }

    /**
     * @desc Get data of current product.
     * @param string $sName the data name
     * @param integer $iProductIdAttribute the id product attribute
     * @return varchar The data.
     */
    public function getData($sName, $iProductIdAttribute = null)
    {
        switch ($sName) {
            case 'id':
                if ($iProductIdAttribute) {
                    return $this->id . '_' . $iProductIdAttribute;
                }
                return $this->id;
            case 'name':
                if ($iProductIdAttribute) {
                    if (isset($this->combinations[$iProductIdAttribute]['attribute_name'])) {
                        return $this->name . ' - ' . $this->combinations[$iProductIdAttribute]['attribute_name'];
                    } else {
                        return $this->name;
                    }
                }
                if (trim($iProductIdAttribute) != '' && Tools::getIsset($this->combinations[$iProductIdAttribute]['attribute_name'])) {
                    return $this->name . ' - ' . $this->combinations[$iProductIdAttribute]['attribute_name'];
                }
                return $this->name;
            case 'reference':
                if ($iProductIdAttribute > 1 && $this->combinations[$iProductIdAttribute]['reference']) {
                    return $this->combinations[$iProductIdAttribute]['reference'];
                }
                return $this->reference;
            case 'supplier_reference':
                if ($iProductIdAttribute > 1 && $this->combinations[$iProductIdAttribute]['supplier_reference']) {
                    return $this->combinations[$iProductIdAttribute]['supplier_reference'];
                }
                return $this->supplier_reference;
            case 'manufacturer':
                return $this->manufacturer_name;
            case 'category':
                $aCategories = Product::getProductCategoriesFull($this->id, Context::getContext()->language->id);
                $aCategoriesSend = array();
                foreach ($aCategories as $aCategory) {
                    $aCategoriesSend[$aCategory['id_category']] = $aCategory['name'];
                }
                return $aCategoriesSend;
            case 'category_default':
                return array($this->id_category_default, $this->category_name);
            case 'breadcrumb':
                if ($this->category_default) {
                    $breadcrumb = '';
                    $categories = $this->category_default->getParentsCategories();
                    foreach ($categories as $category) {
                        $breadcrumb = $category['name'] . ' - ' . $breadcrumb;
                    }
                    return rtrim($breadcrumb, ' - ');
                }
                return $this->category_name;
            case 'description':
                return Brainify::cleanHtml($this->description_short);
            case 'price':
                if ($iProductIdAttribute) {
                    return $this->getPrice(true, $iProductIdAttribute, 2, null, false, false, 1);
                }
                return $this->getPrice(true, null, 2, null, false, false, 1);
            case 'wholesale_price':
                if ($iProductIdAttribute > 1 && $this->combinations[$iProductIdAttribute]['wholesale_price']) {
                    return Brainify::formatNumber($this->combinations[$iProductIdAttribute]['wholesale_price']);
                }
                return Brainify::formatNumber($this->wholesale_price, 2);
            case 'price_duty_free':
                if ($iProductIdAttribute) {
                    return $this->getPrice(false, $iProductIdAttribute, 2, null, false, false, 1);
                }
                return $this->getPrice(false, null, 2, null, false, false, 1);
            case 'price_sale':
                if ($iProductIdAttribute) {
                    return $this->getPrice(true, $iProductIdAttribute, 2, null, false, true, 1);
                }
                return $this->getPrice(true, null, 2, null, false, true, 1);
            case 'price_sale_percent':
                if ($iProductIdAttribute) {
                    $fPrice = $this->getPrice(true, $iProductIdAttribute, 2, null, false, false, 1);
                    $fPriceSale = $this->getPrice(true, $iProductIdAttribute, 2, null, false, true, 1);
                } else {
                    $fPrice = $this->getPrice(true, null, 2, null, false, false, 1);
                    $fPriceSale = $this->getPrice(true, null, 2, null, false, true, 1);
                }
                if ($fPriceSale && $fPrice) {
                    return Brainify::formatNumber(100 - (($fPriceSale * 100) / $fPrice));
                }
                return 0;
            case 'quantity':
                return $this->quantity;
            case 'weight':
                if ($iProductIdAttribute && $this->combinations[$iProductIdAttribute]['weight']) {
                    $weight = (float)preg_replace("/[a-zA-z]/", "", $this->combinations[$iProductIdAttribute]['weight']);
                    return number_format($weight, 6);
                }
                return $this->weight;
            case 'upc':
                if ($iProductIdAttribute > 1 && $this->combinations[$iProductIdAttribute]['upc']) {
                    return $this->combinations[$iProductIdAttribute]['upc'];
                }
                return $this->upc;
            case 'ecotax':
                if ($iProductIdAttribute > 1 && $this->combinations[$iProductIdAttribute]['ecotax']) {
                    return Brainify::formatNumber($this->combinations[$iProductIdAttribute]['ecotax']);
                }
                return property_exists($this, 'ecotaxinfos') && Tools::getIsset($this->ecotaxinfos) && $this->ecotaxinfos > 0 ? Brainify::formatNumber($this->ecotaxinfos) : Brainify::formatNumber($this->ecotax);
            case 'available':
                return $this->active ? 'yes' : 'no';
            case 'url':
                return Context::getContext()->link->getProductLink($this);
            case 'image_1':
                return !empty($this->cover) ? Context::getContext()->link->getImageLink($this->link_rewrite, $this->id . '-' . $this->cover['id_image']) : '';
            case 'id_parent':
                return $this->id;
            case 'image_2':
                return isset($this->images[0]) ? Context::getContext()->link->getImageLink($this->link_rewrite, $this->id . '-' . $this->images[0]['id_image']) : '';
            case 'image_3':
                return isset($this->images[1]) ? Context::getContext()->link->getImageLink($this->link_rewrite, $this->id . '-' . $this->images[1]['id_image']) : '';
            case 'sale_from':
                return $this->is_sale ? date('c', strtotime('' . $this->specificPrice['from'] . '')) : '0000-00-00 00:00:00';
            case 'sale_to':
                return $this->is_sale ? date('c', strtotime('' . $this->specificPrice['to'] . '')) : '0000-00-00 00:00:00';
            case 'meta_keywords':
                return $this->meta_keywords;
            case 'meta_description':
                return $this->meta_description;
            case 'url_rewrite':
                return Context::getContext()->link->getProductLink($this, $this->link_rewrite);
            case 'type':
                if ($iProductIdAttribute) {
                    return 'child';
                } elseif (empty($this->combinations)) {
                    return 'simple';
                }
                return 'parent';
            case 'variation':
                return $this->variation;
            case 'currency':
                return Context::getContext()->currency->iso_code;
            case 'condition':
                return $this->condition;
            case 'supplier':
                return $this->supplier_name;
            case 'perso':
                return ($this->getCustomizationFields()) ? 'Oui' : 'Non';
            case 'age_group':
                return 'adult';
            case 'keyword1':
                $meta_keywords = explode(',', $this->meta_keywords);
                return (Tools::getIsset($meta_keywords[0])) ? $meta_keywords[0] : "";
            case 'keyword2':
                $meta_keywords = explode(',', $this->meta_keywords);
                return (Tools::getIsset($meta_keywords[1])) ? $meta_keywords[1] : "";
            case 'keyword3':
                $meta_keywords = explode(',', $this->meta_keywords);
                return (Tools::getIsset($meta_keywords[2])) ? $meta_keywords[2] : "";
            case 'keyword4':
                $meta_keywords = explode(',', $this->meta_keywords);
                return (Tools::getIsset($meta_keywords[3])) ? $meta_keywords[3] : "";
            case 'keyword5':
                $meta_keywords = explode(',', $this->meta_keywords);
                return (Tools::getIsset($meta_keywords[4])) ? $meta_keywords[4] : "";
            case 'frais_port':
                return 5.9;
            case 'date_add':
                return date('c', strtotime('' . $this->date_add . ''));
        }
        if (preg_match('`image_([0-3])+`', $sName, $out)) {
            return Tools::getIsset($this->images[$out[1]]) ? Context::getContext()->link->getImageLink($this->link_rewrite, $this->id . '-' . $this->images[$out[1]]['id_image']) : '';
        }
    }

    /**
     * @desc Clear data cache.
     */
    public static function clear()
    {
        self::$_taxCalculationMethod = null;
        self::$_prices = array();
        self::$_pricesLevel2 = array();
        self::$_incat = array();
        self::$_cart_quantity = array();
        self::$_tax_rules_group = array();
        self::$_cacheFeatures = array();
        self::$_frontFeaturesCache = array();
        self::$producPropertiesCache = array();
        if (_PS_VERSION_ >= '1.5') {
            self::$cacheStock = array();
        }
    }

    /**
     * @desc Get data attribute of current product.
     * @param integer $iProductIdAttribute the id product atrribute
     * @param string $sName the data name attribute
     * @return varchar The data.
     */
    public function getDataAttribute($iProductIdAttribute, $sName)
    {
        return
            (Tools::getIsset($this->combinations[$iProductIdAttribute]['attributes'][$sName][1]))
                ? $this->combinations[$iProductIdAttribute]['attributes'][$sName][1] :
                ((Tools::getIsset($this->features[$sName]['value'])) ? $this->features[$sName]['value'] : '');
    }

    /**
     * @desc Get data feature of current product.
     * @param string $sName the data name feature
     * @return varchar The data.
     */
    public function getDataFeature($sName)
    {
        if (Tools::strtolower($sName) == "genre" && Tools::getIsset($this->features[$sName]['value'])) {
            switch (Tools::strtolower($this->features[$sName]['value'])) {
                case 'femme':
                    return 'female';

                case 'homme':
                    return 'male';
                default:
                    return 'unisex';
            }
        }
        return Tools::getIsset($this->features[$sName]['value']) ? $this->features[$sName]['value'] : '';
    }

    /**
     * @desc Get the products to export.
     * @return varchar IDs product.
     */
    public static function exportIds($sOffSet, $sLimit, $sOrderWay, $all_product = false)
    {
        if (!Validate::isOrderWay($sOrderWay)) {
            throw new BrainifyException("Order parameter value is incorrect");
        }
        $oContext = Context::getContext();
        $iLangId = $oContext->language->id;
        $id_shop = Configuration::get('BRAINIFY_SHOP_ID');
        if (Brainify::compareVersion() < 0) {
            $query = 'SELECT p.`id_product` '
                . 'FROM `' . _DB_PREFIX_ . 'product` p ';
            if ($all_product == false) {
                $query .= 'WHERE pl.`id_lang` = ' . (int)$iLangId . ' ';
            } else {
                $query .= 'WHERE pl.`id_lang` = ' . (int)$iLangId . ' AND p.`active` = 1 ';
            }
            $query .= 'WHERE pl.`id_lang` = ' . (int)$iLangId . ' AND p.`active` = 1 ';
        } else { // 1.4.X & 1.5.X
            $query = 'SELECT p.id_product '
                . 'FROM ' . _DB_PREFIX_ . 'product p ';
            if (Brainify::compareVersion() == 1) { //version 1.5.X
                $query .= 'LEFT JOIN ' . _DB_PREFIX_ . 'product_shop ps ON p.id_product=ps.id_product ';
            }
            // Add Brainify selected products
            if (Brainify::compareVersion() == 1 && $id_shop != '') { //version 1.5.X
                if ($all_product == false) {
                    $query .= ' WHERE ps.id_shop = ' . (int)$id_shop . ' AND ps.active=1 '; //AND psupp.id_product_attribute=0 ';
                } else {
                    $query .= ' WHERE ps.id_shop = ' . (int)$id_shop . ' '; //AND psupp.id_product_attribute=0 ';
                }
            } else {
                if ($all_product == false) {
                    $query .= ' WHERE p.active=1 ';
                }
            }
            // Add Brainify selected products
            $query .= " ORDER BY p.date_add " . $sOrderWay;
            $query .= " LIMIT " . (int)$sOffSet . "," . (int)$sLimit;
        }
        return Db::getInstance()->executeS($query);
    }

    /**
     * @desc Make the feature of current product
     * @param object $oContext The given context
     */
    public function _makeFeatures($oContext)
    {
        $features = $this->getFrontFeatures($oContext->language->id);
        if ($features) {
            foreach ($features as $feature) {
                $this->features[$feature['name']] = $feature;
            }
        }
    }

    /**
     * @desc Get features of current product
     * @return array All features.
     */
    public function getFeatures()
    {
        return $this->features;
    }

    /**
     * @desc Make the attributes of current product
     * @param object $oContext The given context
     */
    public function _makeAttributes($oContext)
    {
        $color_by_default = '#BDE5F8'; // ?? WTF';
        $combinations = $this->getAttributesGroups($oContext->language->id);
        $groups = array();
        $comb_array = array();
        if (is_array($combinations)) {
            $combination_images = $this->getCombinationImages($oContext->language->id);

            foreach ($combinations as $k => $combination) {
                $fPrice_to_convert = Tools::convertPrice($combination['price'], $oContext->currency);
                $fPrice = Tools::displayPrice($fPrice_to_convert, $oContext->currency);
                $comb_array[$combination['id_product_attribute']]['id_product_attribute'] = $combination['id_product_attribute'];
                $comb_array[$combination['id_product_attribute']]['attributes'][$combination['group_name']] = array($combination['group_name'], $combination['attribute_name'], $combination['id_attribute']);
                $comb_array[$combination['id_product_attribute']]['wholesale_price'] = isset($combination['wholesale_price']) ? $combination['wholesale_price'] : '';
                $comb_array[$combination['id_product_attribute']]['price'] = $fPrice;
                $comb_array[$combination['id_product_attribute']]['ecotax'] = isset($combination['ecotax']) ? $combination['ecotax'] : '';
                $comb_array[$combination['id_product_attribute']]['weight'] = $combination['weight'] . Configuration::get('PS_WEIGHT_UNIT');
                $comb_array[$combination['id_product_attribute']]['unit_impact'] = $combination['unit_price_impact'];
                $comb_array[$combination['id_product_attribute']]['reference'] = $combination['reference'];
                $comb_array[$combination['id_product_attribute']]['ean13'] = isset($combination['ean13']) ? $combination['ean13'] : '';
                $comb_array[$combination['id_product_attribute']]['upc'] = isset($combination['upc']) ? $combination['upc'] : '';
                $comb_array[$combination['id_product_attribute']]['supplier_reference'] = isset($combination['supplier_reference']) ? $combination['supplier_reference'] : '';
                $comb_array[$combination['id_product_attribute']]['id_image'] = isset($combination_images[$combination['id_product_attribute']][0]['id_image']) ? $combination_images[$combination['id_product_attribute']][0]['id_image'] : 0;
                if (Brainify::compareVersion()) {
                    $comb_array[$combination['id_product_attribute']]['available_date'] = strftime($combination['available_date']);
                }
                $comb_array[$combination['id_product_attribute']]['default_on'] = $combination['default_on'];
                if ($combination['is_color_group']) {
                    $groups[$combination['id_attribute_group']] = $combination['group_name'];
                }
            }
        }
        if (isset($comb_array)) {
            foreach ($comb_array as $iProductIdAttribute => $product_attribute) {
                $list = '';
                $sName = '';
                /* In order to keep the same attributes order */
                asort($product_attribute['attributes']);
                foreach ($product_attribute['attributes'] as $attribute) {
                    $list .= $attribute[0] . ' - ' . $attribute[1] . ', ';
                    $sName .= $attribute[0] . ', ';
                }
                $list = rtrim($list, ', ');
                $sName = rtrim($sName, ', ');
                $comb_array[$iProductIdAttribute]['image'] = $product_attribute['id_image'] ? new Image($product_attribute['id_image']) : false;
                if (Brainify::compareVersion()) {
                    $comb_array[$iProductIdAttribute]['available_date'] = $product_attribute['available_date'] != 0 ? date('Y-m-d', strtotime($product_attribute['available_date'])) : '0000-00-00';
                }
                $comb_array[$iProductIdAttribute]['attribute_name'] = $list;
                $comb_array[$iProductIdAttribute]['name'] = $sName;
                if ($product_attribute['default_on']) {
                    $comb_array[$iProductIdAttribute]['name'] = 'is_default';
                    $comb_array[$iProductIdAttribute]['color'] = $color_by_default;
                }
                if (!$this->variation) {
                    $this->variation = $sName;
                }
            }
        }
        $this->combinations = $comb_array;
    }

    /**
     * @desc Get combinations of current product
     * @return array All combinations.
     */
    public function getCombinations()
    {
        return $this->combinations;
    }

    /**
     * @desc Get count images of current product
     * @return integer The number of images.
     */
    public function getCountImages()
    {
        return count($this->images);
    }

    /**
     * OVERRIDE NATIVE FONCTION : add supplier_reference, ean13, upc, wholesale_price and ecotax
     * @desc Get all available attribute groups
     * @param integer $iLangId Language id
     * @return array Attribute groups
     */
    public function getAttributesGroups($iLangId)
    {
        if (Brainify::compareVersion()) {
            if (!Combination::isFeatureActive()) {
                return array();
            }
            $sql = 'SELECT ag.`id_attribute_group`, ag.`is_color_group`, agl.`name` as group_name, agl.`public_name` as public_group_name,
                        a.`id_attribute`, al.`name` as attribute_name, a.`color` as attribute_color, pa.`id_product_attribute`,
                        IFNULL(stock.quantity, 0) as quantity, product_attribute_shop.`price`, product_attribute_shop.`ecotax`, pa.`weight`,
                        product_attribute_shop.`default_on`, pa.`reference`, product_attribute_shop.`unit_price_impact`,
                        pa.`minimal_quantity`, pa.`available_date`, ag.`group_type`, pa.`supplier_reference`, pa.`ean13`, pa.`upc`, pa.`wholesale_price`, pa.`ecotax`
                    FROM `' . _DB_PREFIX_ . 'product_attribute` pa
                    ' . Shop::addSqlAssociation('product_attribute', 'pa') . '
                    ' . Product::sqlStock('pa', 'pa') . '
                    LEFT JOIN `' . _DB_PREFIX_ . 'product_attribute_combination` pac ON pac.`id_product_attribute` = pa.`id_product_attribute`
                    LEFT JOIN `' . _DB_PREFIX_ . 'attribute` a ON a.`id_attribute` = pac.`id_attribute`
                    LEFT JOIN `' . _DB_PREFIX_ . 'attribute_group` ag ON ag.`id_attribute_group` = a.`id_attribute_group`
                    LEFT JOIN `' . _DB_PREFIX_ . 'attribute_lang` al ON a.`id_attribute` = al.`id_attribute`
                    LEFT JOIN `' . _DB_PREFIX_ . 'attribute_group_lang` agl ON ag.`id_attribute_group` = agl.`id_attribute_group`
                    ' . Shop::addSqlAssociation('attribute', 'a') . '
                    WHERE pa.`id_product` = ' . (int) $this->id . '
                        AND al.`id_lang` = ' . (int) $iLangId . '
                        AND agl.`id_lang` = ' . (int) $iLangId . '
                    GROUP BY id_attribute_group, id_product_attribute
                    ORDER BY ag.`position` asC, a.`position` asC, agl.`name` asC';
        } else {
            $sql = 'SELECT ag.`id_attribute_group`, ag.`is_color_group`, agl.`name` group_name, agl.`public_name` public_group_name, a.`id_attribute`, al.`name` attribute_name,
                    a.`color` attribute_color, pa.*
                    FROM `' . _DB_PREFIX_ . 'product_attribute` pa
                    LEFT JOIN `' . _DB_PREFIX_ . 'product_attribute_combination` pac ON (pac.`id_product_attribute` = pa.`id_product_attribute`)
                    LEFT JOIN `' . _DB_PREFIX_ . 'attribute` a ON (a.`id_attribute` = pac.`id_attribute`)
                    LEFT JOIN `' . _DB_PREFIX_ . 'attribute_group` ag ON (ag.`id_attribute_group` = a.`id_attribute_group`)
                    LEFT JOIN `' . _DB_PREFIX_ . 'attribute_lang` al ON (a.`id_attribute` = al.`id_attribute`)
                    LEFT JOIN `' . _DB_PREFIX_ . 'attribute_group_lang` agl ON (ag.`id_attribute_group` = agl.`id_attribute_group`)
                    WHERE pa.`id_product` = ' . (int) $this->id . ' AND al.`id_lang` = ' . (int) $iLangId . ' AND agl.`id_lang` = ' . (int) $iLangId . '
                    ORDER BY agl.`public_name`, al.`name`';
        }
        return Db::getInstance()->executeS($sql);
    }

    /**
     * @desc For a given product, returns its real quantity
     * @param int $iProductId
     * @param int $iProductIdAttribute
     * @param int $id_warehouse
     * @param int $id_shop
     * @return int real_quantity
     */
    public static function getRealQuantity($iProductId, $iProductIdAttribute = 0, $id_warehouse = 0, $id_shop = null)
    {
        if (version_compare(_PS_VERSION_, '1.5', '<')) {
            return Product::getQuantity($iProductId, $iProductIdAttribute);
        } else {
            return parent::getRealQuantity($iProductId, $iProductIdAttribute, $id_warehouse, $id_shop);
        }
    }

    /**
     * @desc Get max number of images
     * @return int max number of images for one product
     */
    public static function getMaxImages()
    {
        if (_PS_VERSION_ >= '1.5') {
            $sql = 'SELECT COUNT(i.`id_image`) as `total`
                    FROM `' . _DB_PREFIX_ . 'image` i
                    ' . Shop::addSqlAssociation('image', 'i') . '
                    GROUP BY i.`id_product`
                    ORDER BY `total` DESC';
            $count = Db::getInstance()->getRow($sql);
            return $count['total'];
        } else {
            $sql = 'SELECT COUNT(i.`id_image`) as `total`
                    FROM `' . _DB_PREFIX_ . 'image` i
                    GROUP BY i.`id_product`
                    ORDER BY `total` DESC';
            $count = Db::getInstance()->getRow($sql);
            return $count['total'];
        }
    }
}
