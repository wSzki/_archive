<?php
/**
 * Copyright (C) 2015-2018 Brainify - All Rights Reserved
 *
 * @author    Brainify <tech@brainify.it>
 * @copyright 2015-2018 Brainify
 * @license   Proprietary License
 */

include_once(dirname(__FILE__) . '/brainifyUpdateClass.php');

/**
 * Class BrainifyApi
 */
class BrainifyApi extends ModuleFrontController
{
    public $tDateTime;
    public $tGetDateTime;
    public $sOffSet = null;
    public $sLimit = null;
    public $sOrderBy = 'ASC';
    public $sMode = 'total';
    public $tDateStart;
    public $tDateEnd;

    const APIKEY_HEADER = 'APIKEY';
    const TIMESTAMP_HEADER = 'TIMESTAMP';
    const OFFSET_HEADER = 'OFFSET';
    const LIMIT_HEADER = 'LIMIT';
    const ORDERBY_HEADER = 'ORDERBY';
    const START_HEADER = 'START';
    const END_HEADER = 'END';
    const MODE_HEADER = 'MODE';

    /**
     *
     */
    public function __construct()
    {
        parent::__construct();

        $this->tDateTime = time();
    }

    /**
     * @return bool
     */
    public function authorize()
    {
        $aAllHeaders = array_change_key_case($this->getAllHeader(), CASE_UPPER);

        if (isset($aAllHeaders[self::APIKEY_HEADER]) && $aAllHeaders[self::APIKEY_HEADER] == Configuration::get(BrainifyConfig::BRAINIFY_API_KEY)) {
            if (isset($aAllHeaders[self::TIMESTAMP_HEADER])) {
                $this->tGetDateTime = $aAllHeaders[self::TIMESTAMP_HEADER];
            }

            if (isset($aAllHeaders[self::OFFSET_HEADER]) && isset($aAllHeaders[self::LIMIT_HEADER])) {
                $this->sOffSet = $aAllHeaders[self::OFFSET_HEADER];
                $this->sLimit = $aAllHeaders[self::LIMIT_HEADER];
            }

            if (isset($aAllHeaders[self::ORDERBY_HEADER])) {
                $this->sOrderBy = $aAllHeaders[self::ORDERBY_HEADER];
            }

            if (isset($aAllHeaders[self::START_HEADER]) && isset($aAllHeaders[self::END_HEADER])) {
                $this->tDateStart = $aAllHeaders[self::START_HEADER];
                $this->tDateEnd = $aAllHeaders[self::END_HEADER];
            }

            if (isset($aAllHeaders[self::MODE_HEADER])) {
                $this->sMode = $aAllHeaders[self::MODE_HEADER];
            }

            return true;
        }

        return false;
    }

    /**
     * @return string
     */
    private function getAllHeader()
    {
        $sHeaders = array();
        foreach ($_SERVER as $sName => $sValue) {
            $indexUpper = str_replace('_', ' ', Tools::substr($sName, 5));
            $index = str_replace(' ', '-', ucwords(Tools::strtolower($indexUpper)));

            $sHeaders[$index] = $sValue;
        }
        return $sHeaders;
    }
}
