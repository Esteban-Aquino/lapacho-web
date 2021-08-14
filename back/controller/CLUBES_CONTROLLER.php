<?php

/**
 * Controlador de clubes
 * Esteban Aquino 02/11/2020
 */
require_once DATA_PATH.'/clubesDB.php';


function post() {
    $datos = "";
    $mensaje = "";
    $res_code = StatusCodes::HTTP_OK;
    $response = new Response();
    # Capturar post JSON
    $json_str = file_get_contents('php://input');
    # Obtener como Array
    $json_obj = json_decode(utf8_converter_sting($json_str), true);
    $club = $json_obj;

    if (nvl($club, 'NN') != 'NN') {
        $resp = clubesDB::insertaClub($club);
        if (is_numeric($resp)) {
            $datos['id'] = $resp;
            $mensaje = 'Insertado';
        } else {
            $res_code = StatusCodes::HTTP_BAD_REQUEST;
            $mensaje = $resp;
        }
    }
    $response->setAccess(Token::getAccess());
    $response->addMessage($mensaje);
    $response->setHttpStatusCode($res_code);
    $response->setData($datos);
    $response->setToken(Token::getToken());
    $response->send();
}

function get(){
    $datos = "";
    $mensaje = "";
    $res_code = StatusCodes::HTTP_OK;
    $response = new Response();
    $BUSCAR = NVL(filter_input(INPUT_GET, 'BUSCAR', FILTER_SANITIZE_STRING), '');
    $id = NVL(filter_input(INPUT_GET, 'ID', FILTER_SANITIZE_STRING), '');

    $data = clubesDB::getClubes($id, $BUSCAR);

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
    $response->setAccess(Token::getAccess());
    $response->addMessage($mensaje);
    $response->setHttpStatusCode($res_code);
    $response->setData($datos);
    $response->setToken(Token::getToken());
    $response->send();
}

function put() {
    $datos = "";
    $mensaje = "";
    $res_code = StatusCodes::HTTP_OK;
    $response = new Response();
    # Capturar post JSON
    $json_str = file_get_contents('php://input');
    # Obtener como Array
    $json_obj = json_decode(utf8_converter_sting($json_str), true);
    $club = $json_obj;
    $id = filter_input(INPUT_GET, 'ID', FILTER_SANITIZE_NUMBER_INT);
    // Validaciones ???

    if (nvl($club, 'NN') != 'NN') {
        $resp = clubesDB::actualizaClubes($id, $club);
        if (is_numeric($resp)) {
            $datos['id'] = $resp;
            $mensaje = 'Actualizado';
        } else {
            $res_code = StatusCodes::HTTP_BAD_REQUEST;
            $mensaje = $resp;
        }
    }

    $response->setAccess(Token::getAccess());
    $response->addMessage($mensaje);
    $response->setHttpStatusCode($res_code);
    $response->setData($datos);
    $response->setToken(Token::getToken());
    $response->send();
}

function delete() {
    $datos = "";
    $mensaje = "";
    $res_code = StatusCodes::HTTP_OK;
    $response = new Response();
    $id = filter_input(INPUT_GET, 'ID', FILTER_SANITIZE_NUMBER_INT);

    if (nvl($id, 'NN') != 'NN') {
        $resp = clubesDB::borraClub($id);
        if (is_numeric($resp)) {
            $datos['id'] = $resp;
            $mensaje = 'BORRADO';
        } else {
            $res_code = StatusCodes::HTTP_BAD_REQUEST;
            $mensaje = $resp;
        }
    }
    $response->setAccess(Token::getAccess());
    $response->addMessage($mensaje);
    $response->setHttpStatusCode($res_code);
    $response->setData($datos);
    $response->setToken(Token::getToken());
    $response->send();
}
