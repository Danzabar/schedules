<?php require_once __DIR__.'/vendor/autoload.php';

error_reporting(-1);
ini_set('display_errors', 'On');

/**
 * Aliases File
 *
 *
 */
require_once __DIR__.'/config/aliases.php';


/**
 * Router
 * -----------------------------------
 * The router needs to be created, and then we should load
 * the routes config file to load any routes into Aura.
 *
 */
new Route;

require_once __DIR__.'/config/routes.php';


/**
 * Load database Configuration.
 *
 *
 */
$connection = require_once __DIR__.'/config/database.php';

Database::connect($connection);


/**
 * Some useful constants
 *
 *
 */
define('TEMPLATES_DIRECTORY',		__DIR__.'/views/');
