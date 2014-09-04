<?php

/**
 *  Server Environment Settings
 *
 *
 */
define('DEBUG', 		TRUE);

define('BASE_DIR',		dirname(__DIR__));

if(isset($_SERVER['HTTP_HOST']))
{
	define('BASE_URL', 		$_SERVER['HTTP_HOST']);
}
