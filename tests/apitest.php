<?php

/**
 * Get de clientes
 * Autor: Esteban Aquino
 * Empresa: Optima SA
 * Fecha: 02/09/2020
 */
require_once '../DAO/test.php';
require_once '../shared/sharedFunctions.php';
require_once '../shared/http_response_code.php';
require_once '../config/parametros.php';



// Verificar autenticidad del token
# Obtener headers
$head = getallheaders();
$ok = false;


// Verificar autenticidad del token

$token = $head['token'];
if ($token !== 'null' && $token !== null) {
    $ok = Token::validarToken($token)['valid'];
}


if ($ok) {
    $acceso = true;
    $datos = "";
    $mensaje = "";
    $res_code = 200;

    $data = testdataDB::test();

    if (is_array($data)) {
        $longitud = count($data);
        if ($longitud > 0) {
            $res_code = StatusCodes::HTTP_OK;
            $datos = $data;
        } else {
            $res_code = StatusCodes::HTTP_NOT_FOUND;
            $mensaje = "Sin datos";
        }
    } else {
        // error
        $res_code = StatusCodes::HTTP_INTERNAL_SERVER_ERROR;
        $mensaje = formatea_error($data);
    }
} else {
    $res_code = 401; // No autorizado
    $acceso = false;
    $mensaje = 'Token no valido';
    $datos = '';
}
$response->setAccess(false);
$response->addMessage($mensaje);
$response->setHttpStatusCode($res_code);
$response->setData($datos);
$response->setToken(Token::getToken());
$response->send();
    
