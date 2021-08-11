<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

switch ($SERV) {
    case 'clubes':
        if ($metodo === 'POST' || $metodo === 'DELETE' || $metodo === 'PUT' || $metodo === 'GET'){
            require_once $api_path . 'clubes/CLUBES.php';
        }
        break;
    default:
        require_once $api_path . 'servicioNoEncontrado.php';
        break;
}