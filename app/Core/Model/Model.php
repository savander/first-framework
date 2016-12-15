<?php

class Model extends PDO
{
    public function __construct()
    {
        global $config;
        try {
            parent::__construct($config->get('database.db.type') .
                ':host=' . $config->get('database.db.hostname') .
                ';dbname=' . $config->get('database.db.name'),
                $config->get('database.db.username'),
                $config->get('database.db.password'));
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->query("set names " . $config->get('database.db.encode'));
        }
        catch(PDOException $e){
            die('ERROR: '. $e->getMessage());
        }
    }
}