<?php
/**
 * Parametros Generales
 * Autor: Esteban Aquino
 * Fecha: 03/09/2020
 * $_SERVER['DOCUMENT_ROOT'].
 */
/** DATOS DE LA EMPRESA **/
define("NOMBRE_EMPRESA", "LAPACHO");

/** BASE DE DATOS **/
define("DB", "MYSQL");

/** CONFIGURACIONES VARIAS **/
define("ENVIROMENT", "DESA");
define("VERIFICA_TOKEN", TRUE);
define("HORAS_VALIDEZ_TOKEN", 3);
define("HTTP_ERRORS", TRUE);
define("LLAVE_SUPER_SECRETA", "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ0eHQiOiJwdXRvX2VsX3F1ZV9kZWNvZGlmaWNhIn0.P1rjOy9uniubE2Xs3MGZ-Qo39yU3HtU7PBvRNBaJXwM");

/** PATHS DEL SISTEMA **/
define("BASE_PATH", './lapacho');
define("CONFIG_PATH", './back/system/config/');
define("SYSTEM_PATH", './back/system/');
define("SHARED_PATH", './back/shared/');
define("CONTROLLER_PATH", './back/controller/');
define("MODEL_PATH", './back/model/');
define("DATA_PATH", './back/data/');
define("UPLOADS_FOTOS", './uploads/');

