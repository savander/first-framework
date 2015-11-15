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
    WEB_DIR . '/../app/Core',
    WEB_DIR . '/../app/Core/Helpers',
    WEB_DIR . '/../app/Core/Router',
    WEB_DIR . '/../app/Core/View',

    /**
     * HTTP Classes, main application flow
     */
    WEB_DIR . '/../app/http',
    WEB_DIR . '/../app/http/controllers',
    WEB_DIR . '/../app/http/models',
    WEB_DIR . '/../app/http/views',

]);

spl_autoload_register(array($autoload, 'loadClasses'));
