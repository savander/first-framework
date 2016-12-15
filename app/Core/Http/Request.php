<?php


class Request
{

    const ESCAPE_HTML = 0;
    const REMOVE_HTML = 1;

    /**
     * Allowed methods
     * @var array
     */
    public static $m_Methods = ['PUT', 'DELETE', 'UPDATE'];

    /**
     * Return Request URI
     * @return mixed
     */
    public static function getRequestURI()
    {
        return $_SERVER['REQUEST_URI'];
    }

    /**
     * Return ScriptName URI
     * @return mixed
     */
    public static function getScriptURI()
    {
        return $_SERVER['SCRIPT_NAME'];
    }


    /**
     * Return request method
     * (Additionally ONLY POST: PUT, UPDATE, DELETE methods -> You can use them by using <input type="hidden" name="method" value="METHODTYPE">)
     * @return mixed
     */
    public static function getMethodType()
    {
        if(isset($_POST['method'])){
            $method = $_POST['method'];
            if(in_array($method, self::$m_Methods)){
                return $method;
            }
        }
        return $_SERVER['REQUEST_METHOD'];
    }


    /**
     * Return specific data from POST
     * Removes or escape HTML special chars
     * @param $input
     * @param int $remove
     * @return bool|string
     */
    public static function post($input, $remove = self::ESCAPE_HTML){
        if(isset($_POST[$input])){
            if($remove == 1)
                return strip_tags($_POST[$input]);
            return htmlspecialchars($_POST[$input]);
        }
        return false;
    }


    /**
     * Return specific data from GET
     * Removes or escape HTML special chars
     *
     * @param $input
     * @param int $remove
     * @return bool|string
     */
    public static function get($input, $remove = self::ESCAPE_HTML){
        if(isset($_GET[$input])){
            if($remove == 1)
                return strip_tags($_GET[$input]);
            return htmlspecialchars($_GET[$input]);
        }
        return false;
    }

}