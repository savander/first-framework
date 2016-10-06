<?php
/**
 * Autoload classes
 */
include_once WEB_DIR . '/../bootstrap/autoload.php';

/**
 * Load settings
 * use $config variable to manage settings
 */
include_once WEB_DIR . '/../bootstrap/config.php';

/**
 * Load routes
 * use $route variable to manage routes
 */
$route = new Router();