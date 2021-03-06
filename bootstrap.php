<?php require_once __DIR__.'/vendor/autoload.php';

use Symfony\Component\Debug\Debug;
use Symfony\Component\Finder\Finder;



/**
 * Server Envrionment Settings
 *
 */
require_once __DIR__.'/config/server.php';


if(DEBUG)
{
	Debug::enable();
}


/**
 * Load the Model Classes.
 *
 */
$finder = new Finder();

$finder->files()->in( __DIR__ .'/models');

foreach($finder as $file)
{
	require_once($file->getRealPath());
}

/**
 *  Date time settings.
 */
date_default_timezone_set('Europe/London');


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

DB::connect($connection);


/**
 * Some useful constants
 *
 *
 */
define('TEMPLATES_DIRECTORY',		__DIR__.'/views/');
