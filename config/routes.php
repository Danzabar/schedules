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
Route::get('page.editSchedule', '/schedule/edit/{id}', 'PageController@editSchedule');
Route::get('page.deleteSchedule', '/schedule/delete/{id}', 'ScheduleController@deleteSchedule');
Route::get('page.schedule', '/schedule/{id}', 'PageController@viewSchedule');
Route::get('generate', '/schedule/generate/{id}', 'ScheduleController@generate');

Route::post('post.newSchedule', '/schedule/new', 'ScheduleController@newSchedule');
Route::post('post.editSchedule', '/schedule/edit/{id}', 'ScheduleController@editSchedule');

/**
 * Exclude Routes
 * -----------------------------------------------
 */
Route::get('page.excludes', '/schedule/excludes/{id}', 'PageController@excludes');
Route::get('page.addExcludes', '/schedule/excludes/{id}/new', 'PageController@addExcludes');
Route::get('page.deleteExcludes', '/schedule/excludes/{id}/delete', 'ExcludeController@delete');
Route::get('page.editExcludes', '/schedule/excludes/{id}/edit', 'PageController@editExcludes');

Route::post('post.addExcludes', '/schedule/excludes/{id}/new', 'ExcludeController@addExcludes');
Route::post('post.editExcludes', '/schedule/excludes/{id}/edit', 'ExcludeController@editExcludes');

/**
 * Activity Routes
 * -----------------------------------------------
 */
Route::get('page.addActivities', '/schedule/activities/{id}/new', 'PageController@addActivities');
Route::get('page.activities', '/schedule/activities/{id}', 'PageController@activities');
Route::get('page.deleteActivities', '/schedule/activities/{id}/delete', 'ActivityController@delete');
Route::get('page.editActivities', '/schedule/activities/{id}/edit', 'PageController@editActivities');

Route::post('post.addActivities', '/schedule/activities/{id}', 'ActivityController@addActivities');
Route::post('post.editActivities', '/schedule/activities/{id}/edit', 'ActivityController@editActivities');
