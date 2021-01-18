<?php
require_once('./vendor/autoload.php');
require_once('config.php');
require_once('./Tools.php');

use Slim\Http\Request as Request;
use Slim\Http\Response as Response;

$oContainer = new \Slim\Container([
    'settings' => [
        'displayErrorDetails'               => DEBUG,
        'determineRouteBeforeAppMiddleware' => true
    ],
    'db' => function() {
        return new \Medoo\Medoo([
                                'database_type' => DB_TYPE,
                                'database_name' => DB_DATABASE,
                                'server' => DB_HOST,
                                'username' => DB_USER,
                                'password' => DB_PASS
                                ]);
    }
]);

$oApp = new \Slim\App($oContainer);
$oApp->any('/', \Muellbot\MuellApi::class.':help');
$oApp->get('/villages', \Muellbot\MuellApi::class.':getOrte');
$oApp->get('/{id_ort}/tommorow', \Muellbot\MuellApi::class.':tommorow');
$oApp->get('/{id_ort}/nextweek', \Muellbot\MuellApi::class.':nextweek');
$oApp->get('/{id_ort}/nexttwoweeks', \Muellbot\MuellApi::class.':nexttwoweeks');
$oApp->get('/{id_ort}/{typ}', \Muellbot\MuellApi::class.':getByOrt');
$oApp->get('/{id_ort}/{typ}/{min_timestamp}', \Muellbot\MuellApi::class.':getByOrt');
$oApp->get('/{id_ort}', \Muellbot\MuellApi::class.':getByOrt');


$oApp->run();