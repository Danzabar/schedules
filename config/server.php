<?php

/**
 *  Server Environment Settings
 *
 *
 */
define('DEBUG', 		TRUE);

define('BASE_DIR',		dirname(__DIR__));

define('SECRET_KEY', 	'');

if(isset($_SERVER['HTTP_HOST']))
{
	define('BASE_URL', 		$_SERVER['HTTP_HOST']);
}
