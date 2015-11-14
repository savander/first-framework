<?php
include_once 'autoload/Autoload.php';

$autoload = Autoload::getInstance();

/**
 * Add directories
 */
$autoload->addDirectories([
    WEB_DIR . '/../app/test'
]);

spl_autoload_register(array($autoload, 'loadClasses'));