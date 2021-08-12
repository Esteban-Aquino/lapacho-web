<?php

/**
 * Inserta cliente
 * Esteban Aquino 02/11/2020
 */
require_once './back/DAO/clubesDB.php';

$datos = "";
$mensaje = "";
$res_code = StatusCodes::HTTP_OK;
$decoded = "";
$notFound = "";

// Validaciones ???
switch ($metodo) {
    case 'POST': // INSERTAR
        # Capturar post JSON
        $json_str = file_get_contents('php://input');
        # Obtener como Array
        $json_obj = json_decode(utf8_converter_sting($json_str), true);
        $club = $json_obj;

        if (nvl($club, 'NN') != 'NN') {
            $resp = clientesDB::insertaClub($club);
            if (is_numeric($resp)) {
                $datos['id'] = $resp;
                $mensaje = 'Insertado';
            } else {
                $res_code = StatusCodes::HTTP_BAD_REQUEST;
                $mensaje = $resp;
            }
        }
        print formatea_respuesta($acceso, $datos, $mensaje, $res_code, $token);
        break;
    case 'GET': // CONSULTAR
        $BUSCAR = NVL(filter_input(INPUT_GET, 'BUSCAR', FILTER_SANITIZE_STRING), '');
        $id = NVL(filter_input(INPUT_GET, 'ID', FILTER_SANITIZE_STRING), '');

        $data = clientesDB::getClubes($id, $BUSCAR);

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
        print formatea_respuesta($acceso, $datos, $mensaje, $res_code, $token);
        break;
    case 'PUT':
        # Capturar post JSON
        $json_str = file_get_contents('php://input');
        # Obtener como Array
        $json_obj = json_decode(utf8_converter_sting($json_str), true);
        $club = $json_obj;
        $id = filter_input(INPUT_GET, 'ID', FILTER_SANITIZE_NUMBER_INT);
        // Validaciones ???

        if (nvl($club, 'NN') != 'NN') {
            $resp = clientesDB::actualizaClubes($id, $club);
            if (is_numeric($resp)) {
                $datos['id'] = $resp;
                $mensaje = 'Actualizado';
            } else {
                $res_code = StatusCodes::HTTP_BAD_REQUEST;
                $mensaje = $resp;
            }
        }

        print formatea_respuesta($acceso, $datos, $mensaje, $res_code, $token);
        break;
    case 'DELETE':
        $id = filter_input(INPUT_GET, 'ID', FILTER_SANITIZE_NUMBER_INT);

        if (nvl($id, 'NN') != 'NN') {
            $resp = clientesDB::borraClub($id);
            if (is_numeric($resp)) {
                $datos['id'] = $resp;
                $mensaje = 'BORRADO';
            } else {
                $res_code = StatusCodes::HTTP_BAD_REQUEST;
                $mensaje = $resp;
            }
        }

        print formatea_respuesta($acceso, $datos, $mensaje, $res_code, $token);
        break;
    default:
        require_once $api_path . 'metodoNoEncontrado.php';
        break;
}
