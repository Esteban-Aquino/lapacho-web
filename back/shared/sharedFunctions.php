<?php

/**
 * Funciones compartidas
 * Autor: Esteban Aquino
 * Empresa: LeaderIT
 * Fecha: 27/07/2019
 */




/**
 * Formatea error de base de datos Oracle
 * @author Esteban Aquino <esteban.aquino@leaderit.com.py>
 * @param string $error Error rertornado por la BD
 * @return string Error formateado
 */
function formatea_error($error) {
    return str_replace(')', '', str_replace('(', '', str_replace(']', '', str_replace('[', '', str_replace('"', '', $error)
                            )
                    )
            )
    );
}
/**
 * Devuelve respuesta formateada JSON incluidas las cabeceras con acces control
 * @author Esteban Aquino <esteban.aquino@leaderit.com.py>
 * @param boolean $acceso Tipo de acceso otorgado
 * @param Object $datos Datos retornados
 * @param string $mensaje Algun retorno de mensaje o error
 * @param number $res_code Codigo de respuesta http- https://es.wikipedia.org/wiki/Anexo:C%C3%B3digos_de_estado_HTTP
 * @param string $newToken Nuevo token generado
 * @return JSON
 */
function formatea_respuesta($acceso, $datos, $mensaje, $res_code, $newToken) {
    $respuesta["acceso"] = $acceso;
    $respuesta["datos"] = $datos;
    $respuesta["token"] = $newToken;
    $respuesta["mensaje"] = $mensaje;
    IF (!HTTP_ERRORS) {
        $res_code = StatusCodes::HTTP_OK;
    }
    http_response_code($res_code);
    agrega_cabecera_json();
    return json_encode($respuesta);
}

function agrega_cabecera_json($to_cache = false) {

    header('Content-type: application/json; charset=utf-8');
        if ($to_cache == true) {
            header('Cache-control: max-age=15');
        } else {
            header('Cache-control: no-cache, no-store');
        }
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Headers: *');
}


