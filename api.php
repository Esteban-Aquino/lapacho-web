<?php

$config_path = 'back/config/';
$shared_path = 'back/shared/';
$api_path = 'back/controller/';
$model_path = 'back/model/';

require $config_path . 'parametros.php';
require $config_path . 'myconnect.php';
require $shared_path . 'php-jwt-master/src/JWT.php';
require $shared_path . 'util.php';
require $shared_path . 'http_response_code.php';
require $shared_path . 'sharedFunctions.php';
require $model_path .  'Response.php';
require $model_path .  'Token.php';

$response = new Response();

$metodo = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_STRING);
$SERV = filter_input(INPUT_GET, 'SERV', FILTER_SANITIZE_STRING);

if ($SERV === 'validar') {
    require_once $api_path . 'validarUsuario.php';
} else {
    $acceso = false;
    // Verificar autenticidad del token
    $head = getallheaders();
    $token = $head['token'];
    $ok = Token::validarToken($token);

    if ($ok) {
        $acceso = true;
        require_once $api_path . 'rutas.php';
    } else {
        $response->setAccess(false);
        $response->addMessage('Acceso no autorizado');
        $response->setHttpStatusCode(StatusCodes::HTTP_UNAUTHORIZED);
        $response->setData('');
        $response->setToken('');
        $response->send();
    }
}
