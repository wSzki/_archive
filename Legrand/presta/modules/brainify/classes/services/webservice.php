<?php
/**
 * Copyright (C) 2015-2018 Brainify - All Rights Reserved
 *
 * @author    Brainify <tech@brainify.it>
 * @copyright 2015-2018 Brainify
 * @license   Proprietary License
 */

/**
 * Class Webservice
 * @package Brainify\Services
 */
class BrainifyServicesWebservice
{
    /**
     * @var string auth api version
     */
    private $auth_api_version = "";

    /**
     * @var string users api version
     */
    private $users_api_version = "";

    /**
     * @var string sites api version
     */
    private $sites_api_version = "";

    /**
     * token captcha for user create
     * @var string
     */
    private $captcha = BrainifyConfig::BRAINIFY_API_CAPTCHA;

    /**
     * Webservice domain
     * @var string
     */
    private $webserviceDomain;

    /**
     * Brainify Auth Token
     * @var string
     */
    private $token;

    /**
     * User id
     * @var string
     */
    private $userId;

    /**
     * @var int
     */
    private $lastHttpCode;

    /**
     * Heders of the last call
     * @var array
     */
    private $lastHeaders = array();

    /**
     * curl headers
     * @var array
     */
    private $headers = array(
        'Accept' => 'application/json',
        'Expect' => ''
    );

    /**
     * Default options used for the curl requests
     * @var array
     */
    private $curlOptions = array(
        CURLOPT_ENCODING => 'gzip',
        CURLOPT_BINARYTRANSFER => true,
        CURLOPT_FRESH_CONNECT => true,
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_REFERER => '',
        CURLOPT_CONNECTTIMEOUT => 10,
        CURLOPT_TIMEOUT => 10,
        CURLOPT_HEADER => true
    );

    /**
     * Brainify_Services_Webservice constructor.
     * @param $webserviceDomain
     * @param string $authApiVersion
     * @param string $userApiVersion
     * @param string $sitesApiVersion
     */
    public function __construct($webserviceDomain, $authApiVersion, $userApiVersion, $sitesApiVersion)
    {
        $this->users_api_version = $userApiVersion;
        $this->auth_api_version = $authApiVersion;
        $this->sites_api_version = $sitesApiVersion;
        $this->webserviceDomain = $webserviceDomain;
    }


    /**
     * Signup user in Brainify Analytics
     *
     * @param array $data
     * @return array
     */
    public function postSignup(array $data)
    {
        BrainifyLogger::addLog('in postSignup');

        $this->cleanHeaders();
        $url = $this->buildUrl(
            $this->auth_api_version . '/user/create'
        );
        $data['captcha'] = $this->captcha;
        $this->addJsonHeaders();

        $response = $this->callPOST($url, $data);

        if ($this->isLastHttpCode2xx()) {
            BrainifyLogger::addLog('in postSignup : /user/create code is 2xx');

            if (isset($response['token'])) {
                $this->token = $response['token'];
            }

            $this->userId = $response['id'];

            $updateUserArray = array(
                "company" => $data['company'],
                "language" => $data['language'],
                "timezone" => $data['timezone']
            );
            BrainifyLogger::addLog('going to update user');

            $this->postUpdateUser($updateUserArray);

            return $response;
        } else {
            BrainifyLogger::addLog('in postSignup : /user/create code is not 2xx');

            return $response;
        }
    }

    /**
     * Authenticate user in Brainify Analytics
     *
     * @param array $data
     * @return array
     */
    public function postLogin(array $data)
    {
        BrainifyLogger::addLog('in postLogin');
        $this->cleanHeaders();
        $url = $this->buildUrl(
            $this->auth_api_version . '/auth/brainify'
        );
        $this->addJsonHeaders();
        $response = $this->callPOST($url, $data);

        if (isset($response['token'])) {
            $this->token = $response['token'];
        }

        return $response;
    }

    /**
     * Update user in Brainify Analytics
     *
     * @param array $data
     * @return array
     */
    public function postUpdateUser(array $data)
    {
        $this->cleanHeaders();
        $url = $this->buildUrl(
            $this->users_api_version . '/user/' . $this->userId
        );

        $this->addAuthHeader();
        $this->addJsonHeaders();

        $response = $this->callPOST($url, $data);

        if (isset($response['token'])) {
            $this->token = $response['token'];
        }

        return $response;
    }

    /**
     * Send confirmation email
     *
     * @param array $data
     * @return array|mixed
     */
    public function postSendConfirmationEmail(array $data)
    {
        $this->cleanHeaders();
        $url = $this->buildUrl(
            $this->users_api_version . '/user/' . $this->userId . '/send_confirmation_email'
        );

        $this->addAuthHeader();
        $this->addJsonHeaders();
        $response = $this->callPOST($url, $data);

        if ($this->isLastHttpCode2xx()) {
            //I must call getUser to check if status changed from uninitialized -> confirmation
            $response = $this->getUser($this->userId);
        }

        return $response;
    }

    /**
     * Re Send confirmation email
     *
     * @param $userId
     * @return array|mixed
     */
    public function postResendConfirmationEmail($userId, array $data)
    {
        $this->cleanHeaders();
        $url = $this->buildUrl(
            $this->users_api_version . '/user/' . $userId . '/send_confirmation_email/resend'
        );

        $this->addAuthHeader();
        $this->addJsonHeaders();
        $this->callPOST($url, $data);

        if ($this->isLastHttpCode2xx()) {
            return array("status" => "ok");
        } else {
            return array("status" => "error", "msg" => "Cannot resend confirmation email.");
        }
    }

    /**
     * Get user info from Brainify Analytics
     *
     * @param $id
     * @return mixed
     */
    public function getUser($id)
    {
        $this->cleanHeaders();
        $url = $this->buildUrl(
            $this->users_api_version . '/user/' . $id
        );

        $this->addAuthHeader();
        $this->addJsonHeaders();
        $response = $this->callGET($url);
        return $response;
    }

    /**
     * Confirm confirmation token in Brainify Analytics
     *
     * @param array $data
     * @return mixed
     */
    public function postConfirm(array $data)
    {
        $this->cleanHeaders();
        $url = $this->buildUrl(
            $this->auth_api_version . '/confirm?token=' . $data['token']
        );
        $this->addJsonHeaders();
        $response = $this->callGET($url);

        if (isset($response['token'])) {
            $this->token = $response['token'];
        }

        return $response;
    }

    /**
     * Call forgot password action in Brainify Analytics
     *
     * @param array $data
     * @return array
     */
    public function postForgotPassword(array $data)
    {
        $this->cleanHeaders();
        $url = $this->buildUrl(
            $this->auth_api_version . '/user/password_reset'
        );
        $this->addJsonHeaders();
        $data['captcha'] = $this->captcha;
        $response = $this->callPOST($url, $data);
        return $response;
    }

    /**
     * Create site in Brainify Analytics
     *
     * @param array $data
     * @return array
     */
    public function postOnboardSite(array $data)
    {
        $this->cleanHeaders();
        $url = $this->buildUrl(
            $this->sites_api_version . '/site'
        );
        $this->addJsonHeaders();
        $this->addAuthHeader();
        $response = $this->callPOST($url, $data);
        return $response;
    }

    /**
     * Get user sites
     *
     * @return mixed
     */
    public function getUserSites()
    {
        $this->cleanHeaders();
        $url = $this->buildUrl(
            $this->sites_api_version . '/sites'
        );
        $this->addJsonHeaders();
        $this->addAuthHeader();
        $response = $this->callGET($url);
        return $response;
    }


    /**
     * Add authorization header
     */
    private function addAuthHeader()
    {
        $this->addHeader('Authorization', 'Bearer ' . $this->token);
    }

    /**
     * Add jsons headers
     */
    private function addJsonHeaders()
    {
        $this->addHeader('Content-Type', 'application/json');
        $this->addHeader('Accept', 'application/json');
        $this->addHeader('Expect', '');
    }

    /**
     * Build url using path and parameters
     * @param string $path
     * @param array $parameters
     * @return string
     */
    private function buildUrl($path, array $parameters = array())
    {
        $url = $this->webserviceDomain . $path;
        if (!empty($parameters)) {
            $url .= '?' . http_build_query($parameters);
        }
        return $url;
    }

    /**
     * Execute curl call using GET
     * @param $url
     * @return mixed
     * @throws BrainifyException
     */
    private function callGET($url)
    {
        $resource = $this->getCurlResource($url);
        return $this->curlCall($resource);
    }

    /**
     * Execute curl call using POST with given data
     * @param string $url
     * @param array $data
     * @return array
     * @throws BrainifyException
     */
    private function callPOST($url, array $data)
    {
        try {
            $resource = $this->getCurlResource($url);
            $json = Tools::jsonEncode($data);
            curl_setopt_array(
                $resource,
                array(
                    CURLOPT_POST => 1,
                    CURLOPT_POSTFIELDS => $json
                )
            );
            $this->addHeader('Content-Length', Tools::strlen($json));
            return $this->curlCall($resource);
        } catch (Exception $e) {
            BrainifyLogger::addLog('in callPOST : Exception '.$e->getMessage());

            throw $e;
        }
    }

    /**
     * Get curl resource
     * @param string $url
     * @return resource
     */
    private function getCurlResource($url)
    {
        $curlResource = curl_init($url);
        curl_setopt_array($curlResource, $this->curlOptions);
        return $curlResource;
    }

    /**
     * Execute curl call
     *
     * @param $resource
     * @return array
     * @throws BrainifyException
     */
    private function curlCall($resource)
    {
        curl_setopt($resource, CURLOPT_HTTPHEADER, $this->getFormattedHeaders());
        $response = curl_exec($resource);
        $curlInfo = curl_getinfo($resource);
        if (false === $response) {
            throw new BrainifyException(
                'Bad curl response : ' . $curlInfo['http_code'] . ' --- '
                . Tools::jsonEncode($curlInfo). ' --- '.curl_error($resource)
            );
        }

        $headers = Tools::substr($response, 0, $curlInfo['header_size']);
        $response = trim(Tools::substr($response, $curlInfo['header_size'] - 1));

        $this->parseHeader($headers);
        $this->lastHttpCode = $curlInfo['http_code'];

        $json = Tools::jsonDecode($response, true);

        if ($this->lastHttpCode != 204 && (false === $json || !is_array($json))) {
            throw new BrainifyException(
                'Can\'t decode json. An error may occurred with http code ' . $curlInfo['http_code'] . ' --- '
                . Tools::jsonEncode($curlInfo)
            );
        }

        return $json;
    }

    /**
     * Parse header string
     * @param string $header
     * @return $this
     */
    protected function parseHeader($header)
    {
        $this->lastHeaders = array();
        $headerLines = explode("\n", $header);
        foreach ($headerLines as $line) {
            $headerParts = explode(':', $line, 2);
            if (!isset($headerParts[1])) {
                continue;
            }

            $value = trim($headerParts[1]);
            $key = $headerParts[0];

            if (isset($this->lastHeaders[$key])) {
                if (!is_array($this->lastHeaders[$key])) {
                    $this->lastHeaders[$key] = array($this->lastHeaders[$key]);
                }
                $this->lastHeaders[$key][] = $value;
            } else {
                $this->lastHeaders[$key] = $value;
            }
        }
        return $this;
    }

    /**
     * Get formatted headers for curl
     * @return array
     */
    private function getFormattedHeaders()
    {
        $output = array();
        foreach ($this->headers as $key => $value) {
            $output[] = $key . ': ' . $value;
        }
        return $output;
    }

    /**
     * Add curl header
     * @param string $key
     * @param mixed $value
     * @return $this
     */
    public function addHeader($key, $value)
    {
        $this->headers[$key] = (string)$value;
        return $this;
    }

    /**
     * Get last http code
     * @return int
     */
    public function getLastHttpCode()
    {
        return $this->lastHttpCode;
    }

    /**
     * Get last headers
     * @return array
     */
    public function getLastHeaders()
    {
        return $this->lastHeaders;
    }

    /**
     * Is last http code like 2xx
     * @return bool
     */
    public function isLastHttpCode2xx()
    {
        return 2 === (int)floor($this->lastHttpCode / 100);
    }

    /**
     * Is last http code like 3xx
     * @return bool
     */
    public function isLastHttpCode3xx()
    {
        return 3 === (int)floor($this->lastHttpCode / 100);
    }

    /**
     * Is last http code like 4xx
     * @return bool
     */
    public function isLastHttpCode4xx()
    {
        return 4 === (int)floor($this->lastHttpCode / 100);
    }

    /**
     * Is last http code like 5xx
     * @return bool
     */
    public function isLastHttpCode5xx()
    {
        return 5 === (int)floor($this->lastHttpCode / 100);
    }

    /**
     * Set token
     * @param string $token
     * @return $this
     */
    public function setToken($token)
    {
        $this->token = $token;
        return $this;
    }

    /**
     * Get site activities
     *
     * @return array
     */
    public function getActivities()
    {
        return array(
            "high_tech" => "High Tech",
            "beauty_health" => "Beauté / Bien-être",
            "sport" => "Sport / Équipements",
            "diy" => "Brico / DIY",
            "clothing" => "Prêt-à-porter / Mode",
            "home_appliance" => "Électroménager",
            "furniture" => "Ameublement",
            "traveling" => "Voyages",
            "entertainment" => "Loisirs",
            "food" => "Alimentaire",
            "car" => "Auto-moto / Pièces",
            "other" => "Autre"
        );
    }

    /**
     * Clean request headers
     */
    public function cleanHeaders()
    {
        $this->headers = array();
    }
}
