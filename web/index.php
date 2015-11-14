<?php
/**
 * Time of framework start.
 */
define('FRAMEWORK_START', microtime(true));

/**
 * Constant WEB_DIR contains path used to localize main directory.
 */
define('WEB_DIR', __DIR__);

/**
 * Autoload classes
 */
include_once __DIR__ . '/../autoload/autoload.php';

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
            error_reporting(E_ALL);
            break;
        case 'production':
            error_reporting(0);
            break;
        default:
            exit('The application environment is not set correctly.');
    }
}


/**
 * Load settings
 * use $config variable to manage settings
 */
include_once __DIR__ . '/../config/config.php';

//var_dump(
//    $config->m_Paths
//);
//var_dump(
//    $config->m_ConfigItems
//);

echo "<pre>";
var_dump($config);
var_dump($config->get('app.egerg'));
echo $config->get('appe.egerg');