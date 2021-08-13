<?php

use Firebase\JWT\JWT;


class Token {
    private static $_TOKEN = null;
    private static $_USUARIO = null;
    private static $_NOMBRE = null;
    private static $_ACCESS = null;

    final function __construct()
    {
    }

    public static function getToken() {
        return self::$_TOKEN;
    }
    public static function getUsuario() {
        return self::$_USUARIO;
    }
    public static function getNombre() {
        return self::$_NOMBRE;
    }
    public static function getAccess() {
        return self::$_ACCESS;
    }



    public static function validarToken($token) {
        $valid = true;
        $decoded = '';
        if (VERIFICA_TOKEN) {
            try {
                $decoded = JWT::decode($token, LLAVE_SUPER_SECRETA, array('HS256'));
            } catch (Exception $e) {
                $valid = false;
            }
            // validar vencimiento
            if ($valid) {
                //$VENC = strtotime($decoded->VENC);
                $VENC = date_create_from_format('d/m/Y H:i:s', $decoded->VENC);
                $HOY = date_create_from_format('d/m/Y H:i:s', date("d/m/Y H:i:s",time()));
                // Para sumar 1 dia
                //$HOY = date_modify($HOY, '+1 day');

                IF ($HOY < $VENC) {
                    self::$_USUARIO = $decoded->USUARIO;
                    self::$_NOMBRE = $decoded->NOMBRE;
                    self::$_TOKEN = self::generaToken();
                } ELSE {
                    $valid = false;
                }
                
            }
            if (!$valid) {
                self::$_USUARIO = '';
                self::$_NOMBRE = '';
                self::$_TOKEN = '';
                
            }
        } else {
            $valid = true;
        }
        self::$_ACCESS = $valid;
        return $valid;
    }
    
    public static function generaToken($auth = null) {
        $time = time(); //Fecha y hora actual en segundos
        
        if (!is_null($auth)) {
            self::$_USUARIO = $auth[0]['USUARIO'];
            self::$_NOMBRE = $auth[0]['NOMBRE'];
        }
        $payload['USUARIO'] = self::$_USUARIO;
        $payload['NOMBRE'] = self::$_NOMBRE;
        $payload['EMI'] = date('d/m/Y H:i:s', $time);
        $payload['VENC'] =  date('d/m/Y H:i:s', $time + ( HORAS_VALIDEZ_TOKEN * 60 * 60));
        $token = JWT::encode($payload, LLAVE_SUPER_SECRETA); //CodificaR el Token
        return $token;
    }
    
}