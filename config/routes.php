<?php


/**
 *  Route Config
 * -----------------------------------------------
 * This file is just used to create routes.
 *
 *
 */
Route::get('page.home', '/', 'PageController@home');
Route::get('install', '/install', 'PageController@install');

