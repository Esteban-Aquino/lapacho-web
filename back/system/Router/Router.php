<?php
require_once 'Route.php';
require_once MODEL_PATH . '/Response.php';
class Router
{

    private static $_routes = array();
    const SERVICE_NOT_FOUND = 100;
    const METHOD_NOT_FOUND = 101;

    /**
     * Agrega un metodo GET para un servicio
     * @author Esteban Aquino <esteban.aquino@leaderit.com.py>
     * @param string $service Nombre del servicio
     * @param string $route Nombre del archivo de servicio
     * @param string $callback Nombre del metodo callback a ejecutar
     * @param boolean $checkToken Default:true, Verificar token para otorgar acceso
     * @return VOID
     */
    public static function addGet($service, $route, $callback, $checkToken = VERIFICA_TOKEN)
    {
        $route = new Route($service, $route, 'GET', $callback, $checkToken);
        self::$_routes[] = $route;
    }

    /**
     * Agrega un metodo POST para un servicio
     * @author Esteban Aquino <esteban.aquino@leaderit.com.py>
     * @param string $service Nombre del servicio
     * @param string $route Nombre del archivo de servicio
     * @param string $callback Nombre del metodo callback a ejecutar
     * @param boolean $checkToken Default:true, Verificar token para otorgar acceso
     * @return VOID
     */
    public static function addPost($service, $route, $callback, $checkToken = VERIFICA_TOKEN)
    {
        $route = new Route($service, $route, 'POST', $callback, $checkToken);
        self::$_routes[] = $route;
    }

    /**
     * Agrega un metodo PUT para un servicio
     * @author Esteban Aquino <esteban.aquino@leaderit.com.py>
     * @param string $service Nombre del servicio
     * @param string $route Nombre del archivo de servicio
     * @param string $callback Nombre del metodo callback a ejecutar
     * @param boolean $checkToken Default:true, Verificar token para otorgar acceso
     * @return VOID
     */
    public static function addPut($service, $route, $callback, $checkToken = VERIFICA_TOKEN)
    {
        $route = new Route($service, $route, 'PUT', $callback, $checkToken);
        self::$_routes[] = $route;
    }

    /**
     * Agrega un metodo DELETE para un servicio
     * @author Esteban Aquino <esteban.aquino@leaderit.com.py>
     * @param string $service Nombre del servicio
     * @param string $route Nombre del archivo de servicio
     * @param string $callback Nombre del metodo callback a ejecutar
     * @param boolean $checkToken Default:true, Verificar token para otorgar acceso
     * @return VOID
     */
    public static function addDelete($service, $route, $callback, $checkToken = VERIFICA_TOKEN)
    {
        $route = new Route($service, $route, 'DELETE', $callback, $checkToken);
        self::$_routes[] = $route;
    }

    /**
     * Metodo para buscar una ruta
     * @author Esteban Aquino <esteban.aquino@leaderit.com.py>
     * @param string $service Nombre del servicio
     * @param string $method Metodo de la peticion
     * @return ROUTE
     */
    private static function _searchRoute($service, $method)
    {
        $exi = false;
        // ver si existe el servicio
        foreach (self::$_routes as $value) {
            if ($value->getService() === $service) {
                $exi = true;
                break;
            }
        }
        if ($exi) {
            foreach (self::$_routes as $value) {
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

    /**
     * Navegar a una servicio y metodo indicados, controla el token para acceso segun como se dio de alta el servicio.
     * @author Esteban Aquino <esteban.aquino@leaderit.com.py>
     * @param string $service Nombre del servicio
     * @param string $method Metodo de la peticion
     * @return VOID
     */
    public static function navigate($service, $method)
    {
        $response = new Response();
        $route = self::_searchRoute($service, $method);
        // verificar Token
        $head = getallheaders();
        $token = $head['token'];
        $valid = Token::validarToken($token);
        if (!is_numeric($route)) {
            if (!$route->getCheckToken()) {
               $valid = true;
            }
        }
        switch ($route) {
            case self::SERVICE_NOT_FOUND:
                $response->sendServiceNotFound();
                break;
            case self::METHOD_NOT_FOUND:
                $response->sendMethodNotFound();
                break;
            default:
                if ($valid) {
                    require_once CONTROLLER_PATH . $route->getRoute();
                    $callback = $route->getCallback();
                    if (function_exists($callback)) {
                        $callback();
                    } else {
                        $response = new Response();
                        $response->setAccess(Token::getAccess());
                        $response->addMessage('Error interno: No se encuentra metodo callback');
                        $response->setHttpStatusCode(StatusCodes::HTTP_INTERNAL_SERVER_ERROR);
                        $response->setData('');
                        $response->setToken(Token::getToken());
                        $response->send();
                    }
                    break;
                } else {
                    $response->setAccess(false);
                    $response->addMessage('Acceso no autorizado');
                    $response->setHttpStatusCode(StatusCodes::HTTP_UNAUTHORIZED);
                    $response->setData('');
                    $response->setToken('');
                    $response->send();
                }
        }

    }
}
