<?php
/**
 * Time of framework start.
 */
define('FRAMEWORK_START', microtime(true));

/**
 * Constant WEB_DIR contains path used to localize public directory.
 */
define('WEB_DIR', __DIR__);

/**
 * Constant ROOT_DIR contains path used to localize root directory.
 */
define('ROOT_DIR', __DIR__ . '/../');

/**
 * Load bootstrap file
 */
include_once __DIR__ . '/../bootstrap/bootstrap.php';

/**
 * Setting the environment influences
 * things like logging and error reporting.
 */
define('ENVIRONMENT', 'development');

/**
 * Error reporting
 * Depends on ENVIRONMENT setting.
 */
if(defined('ENVIRONMENT'))
{
    switch (ENVIRONMENT)
    {
        case 'development':
            ini_set('display_errors', 1);
            error_reporting(E_ALL);
            break;
        case 'production':
            ini_set('display_errors', 0);
            error_reporting(0);
            break;
        default:
            exit('The application environment is not set correctly.');
    }
}
// Example routes
$route->get('/', 'controller@index');

/**
 * Enable routing.
 */
$route->execute();

