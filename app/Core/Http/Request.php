<?php


class Request
{


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
     * @return mixed
     */
    public static function getMethodType()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

}