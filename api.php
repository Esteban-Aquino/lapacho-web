<?php


error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
require 'parametros.php';
require CONFIG_PATH . 'myconnect.php';
require SHARED_PATH . 'php-jwt-master/src/JWT.php';
require SHARED_PATH . 'util.php';
require SHARED_PATH . 'http_response_code.php';
require SHARED_PATH . 'sharedFunctions.php';
require MODEL_PATH  . 'Response.php';
require MODEL_PATH  . 'Token.php';
require SYSTEM_PATH . 'Router/Router.php';
require_once 'routes.php';


$metodo = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_STRING);
$serv = filter_input(INPUT_GET, 'SERV', FILTER_SANITIZE_STRING);

Router::navigate($serv, $metodo);

