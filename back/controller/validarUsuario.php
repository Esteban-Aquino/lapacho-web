<?php

/**
 * Validar Usuario
 * Esteban Aquino 30/09/2019
 */

require_once './back/DAO/auth.php';

$acceso = false;
$datos = [];
$mensaje = '';

if (!$ok) {
    
    # Capturar post JSON
    $json_str = file_get_contents('php://input');
    # Obtener como Array
    $json_obj = json_decode(utf8_converter_sting($json_str), true);
    $usuario = $json_obj['usuario'];
    $clave = $json_obj['clave'];
    //print $usuario;
    
    if (nvl($usuario,'NN') != 'NN') {
        $auth = auth::ValidarUsuario($usuario, $clave);
        //print_r($auth);
        if ($auth != null) {
            if (is_array($auth)) {
                $ok = true;
                $token = Token::generaToken($auth);
                $datos['usuario'] = Token::getUsuario();
                $datos['nombre'] = Token::getNombre();
                $acceso = true;
                //print_r($datos);
            } else {
                $token = '';
                $acceso = false;
                $mensaje = formatea_error($auth);
                $res_code = StatusCodes::HTTP_INTERNAL_SERVER_ERROR;
            }
            
        } else {
            $mensaje = 'Acceso no autorizado. Verifique que su usuario y contraseña sean correctos';
        }
    }
}
if (!$ok) {
    //$respuesta["datos_usuario"] = null;
    $token = '';
    $acceso = false;
    if ($res_code === StatusCodes::HTTP_OK) {
        $res_code = StatusCodes::HTTP_UNAUTHORIZED;
    }
} else {
    $acceso = true;
}

    $response->setAccess($acceso);
    $response->addMessage($mensaje);
    $response->setHttpStatusCode($res_code);
    $response->setData($datos);
    $response->setToken($token);
    $response->send();
?>
