<?php
include_once 'autoload/Autoload.php';

$autoload = Autoload::getInstance();

/**
 * Add directories
 */
$autoload->addDirectories([

    /**
     * APP Core classes
     */
    ROOT_DIR . 'app/Core',
    ROOT_DIR . 'app/Core/Helpers',
    ROOT_DIR . 'app/Core/Model',
    ROOT_DIR . 'app/Core/Controller',
    ROOT_DIR . 'app/Core/View',
    ROOT_DIR . 'app/Core/Router',
    ROOT_DIR . 'app/Core/Http',

    /**
     * HTTP Classes, main application flow
     */
    ROOT_DIR . 'app/http',
    ROOT_DIR . 'app/http/controllers',
    ROOT_DIR . 'app/http/models',
    ROOT_DIR . 'app/http/views',

]);

spl_autoload_register(array($autoload, 'loadClasses'));

