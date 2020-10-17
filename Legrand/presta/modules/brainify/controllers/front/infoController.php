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
 * Class StatusController
 */
class InfoController extends BrainifyApi
{
    /**
     *
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @desc Returns a JSON string object to the list of status
     * @url GET /module/brainify/apiInfo
     */
    public function getInfo()
    {
        $context = Context::getContext();

        $defaultLang = Language::getLanguage(Configuration::get('PS_LANG_DEFAULT'));
        $defaultCurrency = Currency::getDefaultCurrency();

        $allLang = Language::getLanguages();
        $languages = array();
        foreach ($allLang as $lang) {
            $languages[] = $lang['iso_code'];
        }

        $allCurrency = Currency::getCurrencies();
        $currencies = array();
        foreach ($allCurrency as $currency) {
            $currencies[] = $currency['iso_code'];
        }

        $aInfoSend = array(
            "timestamp" => time(),
            "summary" => array(
                "CMS" => array(
                    "name" => "prestashop",
                    "version" => _PS_VERSION_
                ),
                "url_is_simplified" => (bool)Configuration::get('PS_REWRITING_SETTINGS'),
                "cart_is_persistent" => (bool)Configuration::get('PS_CART_FOLLOWING'),
                "defaultLanguage" => $defaultLang['iso_code'],
                "languages" => $languages,
                "defaultCurrency" => $defaultCurrency->iso_code,
                "currencies" => $currencies,
                "timezone" => Configuration::get('PS_TIMEZONE'),
                "PHP" => phpversion(),
                "HTTPserver" => $_SERVER['SERVER_SOFTWARE']
            )
        );

        return $aInfoSend;
    }
}
