<?php



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

$response = new Response();

$metodo = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_STRING);
$SERV = filter_input(INPUT_GET, 'SERV', FILTER_SANITIZE_STRING);

if ($SERV === 'validar') {
    require_once CONTROLLER_PATH . 'validarUsuario.php';
} else {
    $acceso = false;
    // Verificar autenticidad del token
    $head = getallheaders();
    $token = $head['token'];
    $ok = Token::validarToken($token);

    if ($ok) {
        $acceso = true;
        //require_once CONTROLLER_PATH. 'rutas.php';
        Router::navigate($SERV, $metodo);
    } else {
        $response->setAccess(false);
        $response->addMessage('Acceso no autorizado');
        $response->setHttpStatusCode(StatusCodes::HTTP_UNAUTHORIZED);
        $response->setData('');
        $response->setToken('');
        $response->send();
    }
}
