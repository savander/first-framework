<?php


class Router
{

    /**
     * List of routes.
     * @var array
     */
    protected $m_Routes = [];

    /**
     * Methods supported by the router.
     * @var array
     */
    public static $m_Methods = ['GET', 'POST', 'PUT', 'DELETE', 'UPDATE'];

    public function explodeUrl($uri){
        $requestUri = explode('/', $uri);
        $scriptName = explode('/', $_SERVER['SCRIPT_NAME']);
        for($i = 0; $i < sizeof($scriptName); $i++){
            if($requestUri[$i] == $scriptName[$i]){
                unset($requestUri[$i]);
            }
        }
        return $requestUri;
    }

    public function get($pattern, $action){}

    public function post($pattern, $action){}

    public function put($pattern, $action){}

    public function delete($pattern, $action){}

    public function update($pattern, $action){}
}