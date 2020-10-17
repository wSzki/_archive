<?php
/**
 * Copyright (C) 2015-2018 Brainify - All Rights Reserved
 *
 * @author    Brainify <tech@brainify.it>
 * @copyright 2015-2018 Brainify
 * @license   Proprietary License
 */

class RestException extends Exception
{
    /**
     * @param string $code
     * @param null $message
     */
    public function __construct($code, $message = null)
    {
        parent::__construct($message, $code);
    }
}
