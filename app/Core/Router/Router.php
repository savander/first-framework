<?php

/**
 * Class Router
 *
 * You can add new routes in index.php by using variable $route. F
 * For example:
 * $route->get('/','controllerClassName@functionName'):
 *
 * Also you can use anonymous function instead of 'controller@function'.
 * $route->get('/', function(){
 *      echo SOMETHING;
 *  });
 */
class Router
{

    /**
     * List of routes.
     * @var array
     */
    protected $m_Routes = [];


    /**
     * Delimiter for controller
     * @var string
     */
    protected $m_ControllerDelimiter = '@';


    protected $m_ErrorPage = 'ErrorController@index';

    /**
     * Methods supported by the router.
     * @var array
     */
    public static $m_Methods = ['GET', 'POST', 'PUT', 'DELETE', 'UPDATE'];


    /**
     * Run routes
     * @return mixed
     */
    public function execute()
    {
        $URI = $this->getRequestPath();
        $Method = Request::getMethodType();
        if($this->routeExists($URI)){
            if(array_key_exists($Method, $this->m_Routes[$URI])){
                if($this->m_Routes[$URI][$Method] instanceof Closure)
                    return $this->m_Routes[$URI][$Method]();
                else
                    return $this->getController($this->m_Routes[$URI][$Method]);
            }
        }
        return $this->getController($this->m_ErrorPage);
    }


    /**
     * return request path (e.g. /index or /index/something)
     * Also, it removes GET parameters from URI. (/index?something => /index)
     * @return string
     */
    public function getRequestPath(){
        $requestUri = explode('/', preg_replace('/\\?.*/', '', Request::getRequestURI()));
        $scriptName = explode('/', Request::getScriptURI());
        for($i = 0; $i < sizeof($scriptName); $i++){
            if($requestUri[$i] == $scriptName[$i]){
                unset($requestUri[$i]);
            }
        }
        return '/'.implode($requestUri, '/');
    }


    /**
     * Add GET type route
     * @param $pattern
     * @param $action
     */
    public function get($pattern, $action){
        $this->m_Routes[$pattern]['GET'] = $action;
    }

    /**
     * Add POST type route
     * @param $pattern
     * @param $action
     */
    public function post($pattern, $action){
        $this->m_Routes[$pattern]['POST'] = $action;
    }

    /**
     * Add PUT type route
     * @param $pattern
     * @param $action
     */
    public function put($pattern, $action){
        $this->m_Routes[$pattern]['PUT'] = $action;
    }

    /**
     * Add DELETE type route
     * @param $pattern
     * @param $action
     */
    public function delete($pattern, $action){
        $this->m_Routes[$pattern]['DELETE'] = $action;
    }

    /**
     * Add UPDATE type route
     * @param $pattern
     * @param $action
     */
    public function update($pattern, $action){
        $this->m_Routes[$pattern]['UPDATE'] = $action;
    }


    /**
     * Check if route exists
     * @param $key
     * @return bool
     */
    public function routeExists($key)
    {
        return array_key_exists($key, $this->m_Routes);
    }

    /**
     * returns list of all available routes
     * @return array
     */
    public function showRoutes()
    {
        return $this->m_Routes;
    }


    /**
     * Return function from controller.
     *
     * Using:
     *
     * controllerName@functionName
     *
     * delimiter
     *
     * @param $controller
     * @return mixed
     */
    public function getController($controller)
    {
        $controller = explode($this->m_ControllerDelimiter, $controller);
        $object = new $controller[0]; // Class name;
        $method = $controller[1]; // Function name;
        return $object->$method();
    }
}