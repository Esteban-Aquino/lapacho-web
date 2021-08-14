<?php
class Route {
    private $_service;
    private $_route;
    private $_method;
    private $_callback;
    private $_checkToken;


    /**
    * Crear objeto Route, para ser utilizado por el Router
    * @author Esteban Aquino <esteban.aquino@leaderit.com.py>
    * @param string $service Nombre del servicio
    * @param string $route Nombre del archivo de servicio
    * @param string $method Metodo de peticion HTTP
    * @param string $callback Nombre del metodo callback a ejecutar
    * @param boolean $_checkToken Verifica Token de autenticacion
    * @return VOID
    */
    function __construct($service, $route, $method ,$callback, $checkToken )
    {
        $this->_service = $service;
        $this->_route = $route;
        $this->_callback = $callback;
        $this->_method = $method;
        $this->_checkToken = $checkToken;
    }

    /**
    * Modificar servicio
    * @author Esteban Aquino <esteban.aquino@leaderit.com.py>
    * @param string $service Nombre del servicio
    * @return VOID
    */
    public function setService($service) {
        $this->_service = $service;
    }

    /**
    * Modificar servicio
    * @author Esteban Aquino <esteban.aquino@leaderit.com.py>
    * @param string $route Nombre del archivo de servicio
    * @return VOID
    */
    public function setRoute($route) {
        $this->_route = $route;
    }

    /**
    * Modificar metodo HTTP
    * @author Esteban Aquino <esteban.aquino@leaderit.com.py>
    * @param string $method Metodo de peticion HTTP
    * @return VOID
    */
    public function setMethod($method) {
        $this->_method = $method;
    }

    /**
    * Modificar Callback
    * @author Esteban Aquino <esteban.aquino@leaderit.com.py>
    * @param string $callback Nombre del metodo callback a ejecutar
    * @return VOID
    */
    public function setCallback($callback) {
        $this->_callback = $callback;
    }

    /**
    * Modificar Verificacion de Token
    * @author Esteban Aquino <esteban.aquino@leaderit.com.py>
    * @param boolean Verificar token para otorgar acceso
    * @return VOID
    */
    public function setCheckToken($checkToken) {
        $this->_checkToken = $checkToken;
    }

    /**
    * Obtener servicio
    * @author Esteban Aquino <esteban.aquino@leaderit.com.py>
    * @param string $route Nombre del archivo de servicio
    * @return string
    */
    public function getService() {
        return  $this->_service;
    }

    /**
    * Obtener servicio
    * @author Esteban Aquino <esteban.aquino@leaderit.com.py>
    * @param string $route Nombre del archivo de servicio
    * @return string
    */
    public function getRoute() {
        return  $this->_route;
    }

    /**
    * Obtener metodo HTTP
    * @author Esteban Aquino <esteban.aquino@leaderit.com.py>
    * @param string $method Metodo de peticion HTTP
    * @return string
    */
    public function getMethod() {
        return  $this->_method;
    }

    /**
    * Obtener Callback
    * @author Esteban Aquino <esteban.aquino@leaderit.com.py>
    * @param string $callback Nombre del metodo callback a ejecutar
    * @return string
    */
    public function getCallback() {
        return  $this->_callback;
    }

    /**
    * Obtener Verificacion de Token
    * @author Esteban Aquino <esteban.aquino@leaderit.com.py>
    * @param boolean $checkToken Verificar token para otorgar acceso
    * @return boolean
    */
    public function getCheckToken() {
        return $this->_checkToken;
    }



}