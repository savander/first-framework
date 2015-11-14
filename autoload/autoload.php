<?php
include_once 'autoload/Autoload.php';

$autoload = Autoload::getInstance();

/**
 * Add directories
 */
$autoload->addDirectories([
    WEB_DIR . '/../app/Core'
]);

spl_autoload_register(array($autoload, 'loadClasses'));
