<?php
require_once 'Route.php';
require_once MODEL_PATH.'/Response.php';
class Router {

   private static $_routes = array();
   const SERVICE_NOT_FOUND = 100;
   const METHOD_NOT_FOUND = 101;

   public static function addGet ($service, $route, $callback ) {
      $route = new Route($service, $route, 'GET', $callback);
      self::$_routes[] = $route;
   }

   public static function addPost ($service, $route, $callback ) {
      $route = new Route($service, $route, 'POST', $callback);
      self::$_routes[] = $route;
   }

   public static function addPut ($service, $route, $callback ) {
      $route = new Route($service, $route, 'PUT', $callback);
      self::$_routes[] = $route;
   }

   public static function addDelete ($service, $route, $callback ) {
      $route = new Route($service, $route, 'DELETE', $callback);
      self::$_routes[] = $route;
   }

   private static function _searchRoute($service, $method) {
      $exi = false;
      // ver si existe el servicio
      foreach (self::$_routes as $value)
      {  
         if ($value->getService() === $service) {
            $exi  = true;
            break;
         }
      }
      if ($exi) {
         foreach (self::$_routes as $value){
            if ($value->getService() === $service && $value->getMethod() === $method) {
               $route = $value;
               break;
            }
         }
         if (is_null($route)) {
            $route = self::METHOD_NOT_FOUND;
         }
      } else {
         $route = self::SERVICE_NOT_FOUND;
      }
      return $route;
   }

   public static function navigate($service, $method) {
      $response = new Response();
      $route = self::_searchRoute($service, $method);
      switch ($route) {
         case self::SERVICE_NOT_FOUND:
            $response->sendServiceNotFound();
            break;
         case self::METHOD_NOT_FOUND:
            $response->sendMethodNotFound();
            break;
         default:
            require_once CONTROLLER_PATH.$route->getRoute();
            $route->getCallback()();
            break;
      }
       
   }
}
