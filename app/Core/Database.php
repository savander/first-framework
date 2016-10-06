<?php

class Database {
    private static $m_instances = [];

    private function __construct() {}

    private function __clone() {}

    public static function getInstance($database) {
        if (!isset(self::$m_instances[$database])){
            $config = new Config();
            if($config->have($database)) {
                $pdoOptions = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
                self::$m_instances[$database] = new PDO(
                    'mysql:host='.$config->get($database.'.hostname').
                    ';dbname='.$config->get($database.'.database'),
                    $config->get($database.'.username'),
                    $config->get($database.'.password'),
                    $pdoOptions
                );
            }
        }
        return self::$m_instances[$database];
    }
}