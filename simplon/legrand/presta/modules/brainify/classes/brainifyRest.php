<?php
/**
 * Copyright (C) 2015-2018 Brainify - All Rights Reserved
 *
 * @author    Brainify <tech@brainify.it>
 * @copyright 2015-2018 Brainify
 * @license   Proprietary License
 */

include_once(dirname(__FILE__) . '/brainifyRestFormat.php');
include_once(dirname(__FILE__) . '/brainifyRestException.php');

/**
 * Description of RestServer
 *
 * @author jacob
 */
class RestServer
{
    public $url;
    public $method;
    public $params;
    public $format;
    public $cacheDir;
    public $realm;
    public $mode;
    public $root;

    protected $map = array();
    protected $errorClasses = array();
    protected $cached;

    /**
     * The constructor.
     *
     * @param string $mode The mode, either debug or production
     * @param string $realm
     */
    public function __construct($mode = 'debug', $realm = 'Rest Server')
    {
        $this->cacheDir = _PS_MODULE_DIR_ . '/brainify';
        $this->mode = $mode;
        $this->realm = $realm;
        $dir = dirname(str_replace($_SERVER['DOCUMENT_ROOT'], '', $_SERVER['SCRIPT_FILENAME']));
        if ($dir == '.') {
            $this->root = '/';
        } elseif (Tools::substr($dir, -1) != '/') {
            $this->root = $dir . '/';
        } else {
            $this->root = $dir;
        }
    }

    public function __destruct()
    {
        if ($this->mode == 'production' && !$this->cached) {
            if (function_exists('apc_store')) {
                apc_store('urlMap', $this->map);
            } else {
                file_put_contents($this->cacheDir . '/urlMap.cache', serialize($this->map));
            }
        }
    }

    /**
     *
     */
    public function refreshCache()
    {
        $this->map = array();
        $this->cached = false;
    }

    /**
     * @param bool $ask
     * @throws RestException
     */
    public function unauthorized($ask = false)
    {
        if ($ask) {
            header("WWW-Authenticate: Basic realm=\"$this->realm\"");
        }
        throw new RestException(401, "You are not authorized to access this resource.");
    }

    /**
     * @throws Exception
     */
    public function handle()
    {
        $this->url = $this->getPath();
        $this->method = $this->getMethod();
        $this->format = $this->getFormat();

        if ($this->method == 'PUT' || $this->method == 'POST') {
            $this->data = $this->getData();
        }

        if (Configuration::get('PS_REWRITING_SETTINGS')) {
            list($obj, $method, $params, $this->params, $noAuth) = $this->findUrl();
        } else {
            $obj = $this->map[$this->method]['module/' . Tools::getValue('module') . '/' . Tools::getValue('controller')][0];
            $method = Tools::getValue('module_action');
            $params = array();
            $noAuth = false;
        }

        if ($obj) {
            if (is_string($obj)) {
                if (class_exists($obj)) {
                    $obj = new $obj();
                } else {
                    throw new Exception("Class $obj does not exist");
                }
            }

            $obj->server = $this;

            try {
                if (method_exists($obj, 'init')) {
                    $obj->init();
                }

                if (!$noAuth && method_exists($obj, 'authorize')) {
                    if (!$obj->authorize()) {
                        $this->sendData($this->unauthorized(true));
                        exit;
                    }
                }

                $result = call_user_func_array(array($obj, $method), $params);

                if ($result !== null) {
                    $this->sendData($result);
                }
            } catch (RestException $e) {
                $this->handleError($e->getCode(), $e->getMessage());
            }
        } else {
            $this->handleError(404);
        }
    }

    /**
     * @param $class
     * @param string $basePath
     * @throws Exception
     */
    public function addClass($class, $basePath = '')
    {
        $this->loadCache();

        if (!$this->cached) {
            if (is_string($class) && !class_exists($class)) {
                throw new Exception('Invalid method or class');
            } elseif (!is_string($class) && !is_object($class)) {
                throw new Exception('Invalid method or class; must be a classname or object');
            }

            if (Tools::substr($basePath, 0, 1) == '/') {
                $basePath = Tools::substr($basePath, 1);
            }
            if ($basePath && Tools::substr($basePath, -1) != '/') {
                $basePath .= '/';
            }

            $this->generateMap($class, $basePath);
        }
    }

    /**
     * @param $class
     */
    public function addErrorClass($class)
    {
        $this->errorClasses[] = $class;
    }

    /**
     * @param $statusCode
     * @param null $errorMessage
     */
    public function handleError($statusCode, $errorMessage = null)
    {
        $method = "handle$statusCode";
        foreach ($this->errorClasses as $class) {
            if (is_object($class)) {
                $reflection = new ReflectionObject($class);
            } elseif (class_exists($class)) {
                $reflection = new ReflectionClass($class);
            }

            if (Tools::getIsset($reflection)) {
                if ($reflection->hasMethod($method)) {
                    $obj = is_string($class) ? new $class() : $class;
                    $obj->$method();
                    return;
                }
            }
        }

        $message = $this->codes[$statusCode] . ($errorMessage && $this->mode == 'debug' ? ': ' . $errorMessage : '');

        $this->setStatus($statusCode);
        $this->sendData(array('error' => array('code' => $statusCode, 'message' => $message)));
    }

    /**
     *
     */
    protected function loadCache()
    {
        if ($this->cached !== null) {
            return;
        }

        $this->cached = false;

        if ($this->mode == 'production') {
            if (function_exists('apc_fetch')) {
                $map = apc_fetch('urlMap');
            } elseif (file_exists($this->cacheDir . '/urlMap.cache')) {
                $map = unserialize(Tools::file_get_contents($this->cacheDir . '/urlMap.cache'));
            }
            if (Tools::getIsset($map) && is_array($map)) {
                $this->map = $map;
                $this->cached = true;
            }
        } else {
            if (function_exists('apc_delete')) {
                apc_delete('urlMap');
            } else {
                @unlink($this->cacheDir . '/urlMap.cache');
            }
        }
    }

    /**
     * @return null
     */
    protected function findUrl()
    {
        $urlCarts = Tools::substr($this->url, -8);
        if ($urlCarts == "apiCarts") {
            $urls = array(
                "module/brainify/apiCarts" => array(
                    0 => "CartsController",
                    1 => "getCarts",
                    2 => array(),
                    3 => null,
                    4 => false
                )
            );
        } else {
            $urls = $this->map[$this->method];
        }

        if (!$urls) {
            return null;
        }

        foreach ($urls as $url => $call) {
            $args = $call[2];
            if (!strstr($url, '$')) {
                if ($url == $this->url) {
                    if (isset($args['data'])) {
                        $params = array_fill(0, $args['data'] + 1, null);
                        $params[$args['data']] = $this->data;
                        $call[2] = $params;
                    }
                    return $call;
                }
            } else {
                $regex = preg_replace('/\\\\\$([\w\d]+)\.\.\./', '(?P<$1>.+)', str_replace('\.\.\.', '...', preg_quote($url)));
                $regex = preg_replace('/\\\\\$([\w\d]+)/', '(?P<$1>[^\/]+)', $regex);
                if (preg_match(":^$regex$:", urldecode($this->url), $matches)) {
                    $params = array();
                    $paramMap = array();
                    if (Tools::getIsset($args['data'])) {
                        $params[$args['data']] = $this->data;
                    }

                    foreach ($matches as $arg => $match) {
                        if (is_numeric($arg)) {
                            continue;
                        }
                        $paramMap[$arg] = $match;

                        if (Tools::getIsset($args[$arg])) {
                            $params[$args[$arg]] = $match;
                        }
                    }
                    ksort($params);
                    // make sure we have all the params we need
                    end($params);
                    $max = key($params);
                    for ($i = 0; $i < $max; $i++) {
                        if (!array_key_exists($i, $params)) {
                            $params[$i] = null;
                        }
                    }
                    ksort($params);
                    $call[2] = $params;
                    $call[3] = $paramMap;
                    return $call;
                }
            }
        }
    }

    /**
     * @param $class
     * @param $basePath
     */
    protected function generateMap($class, $basePath)
    {
        if (is_object($class)) {
            $reflection = new ReflectionObject($class);
        } elseif (class_exists($class)) {
            $reflection = new ReflectionClass($class);
        }

        $methods = $reflection->getMethods(ReflectionMethod::IS_PUBLIC);

        foreach ($methods as $method) {
            $doc = $method->getDocComment();
            $noAuth = strpos($doc, '@noAuth') !== false;
            if (preg_match_all('/@url[ \t]+(GET|POST|PUT|DELETE|HEAD|OPTIONS)[ \t]+\/?(\S*)/s', $doc, $matches, PREG_SET_ORDER)) {
                $params = $method->getParameters();

                foreach ($matches as $match) {
                    $httpMethod = $match[1];
                    $url = $basePath . $match[2];
                    if ($url && $url[Tools::strlen($url) - 1] == '/') {
                        $url = Tools::substr($url, 0, -1);
                    }
                    $call = array($class, $method->getName());
                    $args = array();
                    foreach ($params as $param) {
                        $args[$param->getName()] = $param->getPosition();
                    }
                    $call[] = $args;
                    $call[] = null;
                    $call[] = $noAuth;

                    $this->map[$httpMethod][$url] = $call;
                }
            }
        }
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        $path = preg_replace('/\?.*$/', '', $_SERVER['REQUEST_URI']);
        // remove root from path
        if ($this->root) {
            $path = preg_replace('/^' . preg_quote($this->root, '/') . '/', '', $path);
        }
        // remove starting '/' that appears with some specific server config
        $path = preg_replace('/^\//', '', $path);
        // remove trailing format definition, like /controller/action.json -> /controller/action
        $path = preg_replace('/\.(\w+)$/i', '', $path);
        return $path;
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $override = isset($_SERVER['HTTP_X_HTTP_METHOD_OVERRIDE']) ? $_SERVER['HTTP_X_HTTP_METHOD_OVERRIDE'] : (Tools::getIsset(Tools::getValue('method')) ? Tools::getValue('method') : '');
        if ($method == 'POST' && Tools::strtoupper($override) == 'PUT') {
            $method = 'PUT';
        } elseif ($method == 'POST' && Tools::strtoupper($override) == 'DELETE') {
            $method = 'DELETE';
        }
        return $method;
    }

    /**
     * @return string
     */
    public function getFormat()
    {
        $format = RestFormat::PLAIN;
        $httpAccept = isset($_SERVER['HTTP_ACCEPT']) ? $_SERVER['HTTP_ACCEPT'] : "";
        $accept_mod = preg_replace('/\s+/i', '', $httpAccept); // ensures that exploding the HTTP_ACCEPT string does not get confused by whitespaces
        $accept = explode(',', $accept_mod);
        $override = '';

        if (isset($_REQUEST['format']) || isset($_SERVER['HTTP_FORMAT'])) {
            // give GET/POST precedence over HTTP request headers
            $override = isset($_SERVER['HTTP_FORMAT']) ? $_SERVER['HTTP_FORMAT'] : '';
            $override = isset($_REQUEST['format']) ? $_REQUEST['format'] : $override;
            $override = trim($override);
        }

        // Check for trailing dot-format syntax like /controller/action.format -> action.json
        if (preg_match('/\.(\w+)$/i', $_SERVER['REQUEST_URI'], $matches)) {
            $override = $matches[1];
        }

        // Give GET parameters precedence before all other options to alter the format
        $override = Tools::getIsset(Tools::getValue('format')) ? Tools::getValue('format') : $override;
        if (isset(RestFormat::$formats[$override])) {
            $format = RestFormat::$formats[$override];
        } elseif (in_array(RestFormat::JSON, $accept)) {
            $format = RestFormat::JSON;
        }
        return $format;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        $data = Tools::file_get_contents('php://input');
        return Tools::jsonDecode($data);
    }

    /**
     * @param $data
     */
    public function sendData($data)
    {
        header("Cache-Control: no-cache, must-revalidate");
        header("Expires: 0");
        header('Content-Type: ' . $this->format);
        header('X-Brainify-Analytics-Version: ' . BrainifyConfig::BRAINIFY_PLUGIN_VERSION);

        if ($this->format == RestFormat::XML) {
            if (is_object($data) && method_exists($data, '__keepOut')) {
                $data = clone $data;
                foreach ($data->__keepOut() as $prop) {
                    unset($data->$prop);
                }
            }
            $data = $this->xmlEncode($data);
            if ($data && $this->mode == 'debug') {
                $data = $this->jsonFormat($data);
            }
        } else {
            if (is_object($data) && method_exists($data, '__keepOut')) {
                $data = clone $data;
                foreach ($data->__keepOut() as $prop) {
                    unset($data->$prop);
                }
            }

            if (isset($data['products'])) {
                foreach ($data['products'] as $key => $product) {
                    if (isset($data['products'][$key]['description'])) {
                        $data['products'][$key]['description'] = utf8_encode($product['description']);
                    }
                }
            }

            $data = Tools::jsonEncode($data);

            if ($data && $this->mode == 'debug') {
                $data = $this->jsonFormat($data);
            }
        }

        echo $data;
    }

    /**
     * @param $code
     */
    public function setStatus($code)
    {
        $code .= ' ' . $this->codes[(string)($code)];
        header("{$_SERVER['SERVER_PROTOCOL']} $code");
    }

    /**
     * @param $mixed
     * @param null $domElement
     * @param null $DOMDocument
     */
    private function xmlEncode($mixed, $domElement = null, $DOMDocument = null)
    {
        if (is_null($DOMDocument)) {
            $DOMDocument = new DOMDocument;
            $DOMDocument->formatOutput = true;
            $this->xmlEncode($mixed, $DOMDocument, $DOMDocument);
            echo $DOMDocument->saveXML();
        } else {
            if (is_array($mixed)) {
                foreach ($mixed as $index => $mixedElement) {
                    if (is_int($index)) {
                        if ($index === 0) {
                            $node = $domElement;
                        } else {
                            $node = $DOMDocument->createElement($domElement->tagName);
                            $domElement->parentNode->appendChild($node);
                        }
                    } else {
                        $plural = $DOMDocument->createElement($index);
                        $domElement->appendChild($plural);
                        $node = $plural;
                        if (!(rtrim($index, 's') === $index)) {
                            $singular = $DOMDocument->createElement(rtrim($index, 's'));
                            $plural->appendChild($singular);
                            $node = $singular;
                        }
                    }

                    $this->xmlEncode($mixedElement, $node, $DOMDocument);
                }
            } else {
                $domElement->appendChild($DOMDocument->createTextNode($mixed));
            }
        }
    }

    /**
     * @desc Pretty print some JSON
     * @param $json
     * @return string
     */
    private function jsonFormat($json)
    {
        $tab = "  ";
        $new_json = "";
        $indent_level = 0;
        $in_string = false;
        $backslashed = -1;

        $len = Tools::strlen($json);

        for ($c = 0; $c < $len; $c++) {
            $char = $json[$c];
            switch ($char) {
                case '{':
                case '[':
                    if (!$in_string) {
                        $new_json .= $char . "\n" . str_repeat($tab, $indent_level + 1);
                        $indent_level++;
                    } else {
                        $new_json .= $char;
                    }
                    break;
                case '}':
                case ']':
                    if (!$in_string) {
                        $indent_level--;
                        $new_json .= "\n" . str_repeat($tab, $indent_level) . $char;
                    } else {
                        $new_json .= $char;
                    }
                    break;
                case ',':
                    if (!$in_string) {
                        $new_json .= ",\n" . str_repeat($tab, $indent_level);
                    } else {
                        $new_json .= $char;
                    }
                    break;
                case ':':
                    if (!$in_string) {
                        $new_json .= ": ";
                    } else {
                        $new_json .= $char;
                    }
                    break;
                case '\\':
                    if ($backslashed != $c) {
                        // next letter will be backslashed
                        $backslashed = $c + 1;
                    }
                    $new_json .= $char;
                    break;
                case '"':
                    if ($c != $backslashed) {
                        $in_string = !$in_string;
                    }
                // no break
                default:
                    $new_json .= $char;
                    break;
            }
        }

        return $new_json;
    }


    private $codes = array(
        '100' => 'Continue',
        '200' => 'OK',
        '201' => 'Created',
        '202' => 'Accepted',
        '203' => 'Non-Authoritative Information',
        '204' => 'No Content',
        '205' => 'Reset Content',
        '206' => 'Partial Content',
        '300' => 'Multiple Choices',
        '301' => 'Moved Permanently',
        '302' => 'Found',
        '303' => 'See Other',
        '304' => 'Not Modified',
        '305' => 'Use Proxy',
        '307' => 'Temporary Redirect',
        '400' => 'Bad Request',
        '401' => 'Unauthorized',
        '402' => 'Payment Required',
        '403' => 'Forbidden',
        '404' => 'Not Found',
        '405' => 'Method Not Allowed',
        '406' => 'Not Acceptable',
        '409' => 'Conflict',
        '410' => 'Gone',
        '411' => 'Length Required',
        '412' => 'Precondition Failed',
        '413' => 'Request Entity Too Large',
        '414' => 'Request-URI Too Long',
        '415' => 'Unsupported Media Type',
        '416' => 'Requested Range Not Satisfiable',
        '417' => 'Expectation Failed',
        '500' => 'Internal Server Error',
        '501' => 'Not Implemented',
        '503' => 'Service Unavailable'
    );
}
