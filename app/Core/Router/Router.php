<?php

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
    
    
    public function getRequestPath(){
        $requestUri = explode('/', Request::getRequestURI());
        $scriptName = explode('/', Request::getScriptURI());
        for($i = 0; $i < sizeof($scriptName); $i++){
            if($requestUri[$i] == $scriptName[$i]){
                unset($requestUri[$i]);
            }
        }
        return '/'.implode($requestUri, '/');
    }

    public function get($pattern, $action){
        $this->m_Routes[$pattern]['GET'] = $action;
    }

    public function post($pattern, $action){
        $this->m_Routes[$pattern]['POST'] = $action;
    }

    public function put($pattern, $action){
        $this->m_Routes[$pattern]['PUT'] = $action;
    }

    public function delete($pattern, $action){
        $this->m_Routes[$pattern]['DELETE'] = $action;
    }

    public function update($pattern, $action){
        $this->m_Routes[$pattern]['UPDATE'] = $action;
    }


    public function routeExists($key)
    {
        return array_key_exists($key, $this->m_Routes);
    }
    
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
        $object = new $controller[0];
        return $object->$controller[1]();
    }
}