<?php
namespace Muellbot;

use \Slim\Http\Request as Request;
use \Slim\Http\Response as Response;
use \Slim\Container as Container;


class BasicObject
{
    protected $container = null;
    protected $oDB = null;
    
    const HTTP_400 = 'Bad Request';
    const HTTP_200 = 'OK';
    
    private $aArgs = [];
    
    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->oDB = $container->db;
    }
    
    public function setArguments($args) {
        $this->aArgs = $args;
    }
    
    public function get($sArg) {
        if (isset($this->aArgs[$sArg]) && !empty($this->aArgs[$sArg])) {
            return $this->aArgs[$sArg];
        }
        return false;
    }


    
    public function forbidden()
    {
        header('HTTP/1.1 403 Forbidden');
        http_response_code(403);
        die();
    }
    
    public function returnBadArgument()
    {
        header('HTTP/1.1 400 Bad Request');
        http_response_code(400);
        die();
    }
    
    public function returnServerError()
    {
        header('HTTP/1.1 500 Internal Server Error');
        http_response_code(500);
        die();
    }
    
    public function ok() {
        header('HTTP/1.1 200 OK');
        http_response_code(200);
        die();
    }
    
    public function returnJSON(Response $response, $aData = [], $iStatus = 200, $sStatus = 'OK') {
        $aReturn = [];
        $aReturn['data'] = $aData;
        $aReturn['version'] = API_VERSION;
        $aReturn['timestamp'] = time();
        $aReturn['mapping'] = \Tools::$aTonnentyp;
        $response->getBody()->write(json_encode($aReturn));
        return $response->withHeader('Content-type', 'application/json')->withStatus($iStatus, $sStatus);
    }
}