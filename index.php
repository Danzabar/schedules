<?php require_once __DIR__ . '/bootstrap.php';

/**
 * Check if the migrations have been installed, if not install it
 *
 */
if(!Database::installed())
{	
	$migration = new Migration;
	$migration->install();
	$migration->process('up');	
}


/**
 *
 * To get things started, we just call the Route classes Resolve method
 * which finds the current route and calls the nessecary method on the controller
 * assigned to this route. If it doesnt find a route, it will throw a not found exception.
 * 
 *
 */
Route::resolve();
