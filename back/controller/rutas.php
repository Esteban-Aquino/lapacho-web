<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

switch ($SERV) {
    case 'clubes':
        require_once $api_path . 'CLUBES_CONTROLLER.php';
        break;
    default:
        $response->sendServiceNotFound();
        break;
}