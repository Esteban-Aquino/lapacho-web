<?php

/**
 * Provee las constantes para conectarse a la base de datos ORACLE
 * Autor: Esteban Aquino
 * Empresa: LEADERIT
 * Fecha: 07/09/2020
 */

/*require 'parametros.php';*/
 IF (DB === 'MYSQL') {
    IF (ENVIROMENT === 'PROD') {
        define("DATABASE", "lapacho"); // Nombre del db
        define("HOSTNAME", "localhost"); // Nombre del db
        define("USERNAME", "leaderit"); // Nombre del usuario
        define("PASSWORD", "leaderit"); // Nombre de la constraseña
    } ELSE {
        define("DATABASE", "lapacho"); // Nombre del db
        define("HOSTNAME", "localhost"); // Nombre del db
        define("USERNAME", "leaderit"); // Nombre del usuario
        define("PASSWORD", "leaderit"); // Nombre de la constraseña
    }
}
