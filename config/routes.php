<?php


/**
 *  Route Config
 * -----------------------------------------------
 * This file is just used to create routes.
 *
 *
 */
Route::get('page.home', '/', 'PageController@home');
Route::get('page.schedules', '/schedules', 'PageController@schedules');
Route::get('page.docs', '/documentation', 'PageController@docs');


/**
 * Schedule Interaction Routes
 *------------------------------------------------
 *
 */
Route::get('page.newSchedule', '/schedule/new', 'PageController@newSchedule');
Route::get('page.addExcludes', '/schedule/excludes/{id}', 'PageController@addExcludes');
Route::get('page.addActivities', '/schedule/activities/{id}', 'PageController@addActivities');


Route::post('post.newSchedule', '/schedule/new', 'ScheduleController@newSchedule');
Route::post('post.addExcludes', '/schedule/excludes/{id}', 'ScheduleController@addExcludes');
Route::post('post.addActivities', '/schedule/activities/{id}', 'ScheduleController@addActivities');
