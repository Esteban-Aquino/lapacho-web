<?php
class Route {
    private $_service;
    private $_route;
    private $_method;
    private $_callback;

    function __construct($service, $route, $method ,$callback)
    {
        $this->_service = $service;
        $this->_route = $route;
        $this->_callback = $callback;
        $this->_method = $method;
    }

    public function setService($service) {
        $this->_service = $service;
    }

    public function setRoute($route) {
        $this->_route = $route;
    }

    public function setMethod($method) {
        $this->_method = $method;
    }

    public function setCallback($callback) {
        $this->_callback = $callback;
    }

    public function getService() {
        return  $this->_service;
    }

    public function getRoute() {
        return  $this->_route;
    }

    public function getMethod() {
        return  $this->_method;
    }

    public function getCallback() {
        return  $this->_callback;
    }



}