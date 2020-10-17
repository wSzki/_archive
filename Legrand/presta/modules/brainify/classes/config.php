<?php
/**
 * Copyright (C) 2015-2018 Brainify - All Rights Reserved
 *
 * @author    Brainify <tech@brainify.it>
 * @copyright 2015-2018 Brainify
 * @license   Proprietary License
 */

class BrainifyConfig
{

    /**
     * Brainify plugin version
     */
    const BRAINIFY_PLUGIN_VERSION = "3.0.16";

    /**
     * Brainify keys that are used in configuration table
     */
    const BRAINIFY_USER_ID = 'BRAINIFY_USER_ID';
    const BRAINIFY_USER_STATUS = 'BRAINIFY_USER_STATUS';
    const BRAINIFY_USER_EMAIL = 'BRAINIFY_USER_EMAIL';
    const BRAINIFY_SITE_ID = 'BRAINIFY_SITE_ID';
    const BRAINIFY_ACCOUNT_KEY = 'BRAINIFY_KEY';
    const BRAINIFY_API_KEY = 'BRAINIFY_KEY_API';
    const BRAINIFY_SHOP_ID = 'BRAINIFY_SHOP_ID';

    /**
     * Brainify API endpoints
     */
    const BRAINIFY_API_URL = "https://api.brainify.it";
    const BRAINIFY_API_USERS = "/users/v1";
    const BRAINIFY_API_SITES = "/sites/v2";
    const BRAINIFY_API_AUTH = "/auth/v1.2";

    /**
     * Brainify captcha token used when user is created and send reset password
     */
    const BRAINIFY_API_CAPTCHA = 'S?ou+POuzlES=iegL*+I6P$1_98OuxL7';
}
