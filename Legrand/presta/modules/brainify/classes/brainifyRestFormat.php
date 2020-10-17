<?php
/**
 * Copyright (C) 2015-2018 Brainify - All Rights Reserved
 *
 * @author    Brainify <tech@brainify.it>
 * @copyright 2015-2018 Brainify
 * @license   Proprietary License
 */

/**
 * Constants used in RestServer Class.
 */
class RestFormat
{

    const PLAIN = 'text/plain';
    const HTML = 'text/html';
    const JSON = 'application/json';
    const XML = 'application/xml';
    static public $formats = array(
        'plain' => RestFormat::PLAIN,
        'txt' => RestFormat::PLAIN,
        'html' => RestFormat::HTML,
        'json' => RestFormat::JSON,
        'xml' => RestFormat::XML,
    );
}
