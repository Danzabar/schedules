<?php

/**
 * Page Controller - Handles static pages
 *
 * @package Framework
 * @subpackage Controller
 * @author Dan Cox
 */	
Class PageController
{
	
	/**
	 * Home Page
	 *
	 * @return Template
	 * @author Dan Cox
	 */		
	public function home()
	{
		/** 
		 * Get all available schedules to send here.
		 */
		$schedules = DB::count('Schedule');

		return Template::make('pages/home', ['schedules' => $schedules]);
	}	
	
	/**
	 * Schedules page
	 *
	 * @return Template
	 * @author Dan Cox
	 */
	public function schedules()
	{
		$schedules = DB::get('Schedule', ['updated_at' => 'DESC'], 10);
		
		return Template::make('pages/schedules', ['schedules' =>  $schedules]);
	}
	
	/**
	 * New Schedule page
	 *
	 * @return Template
	 * @author Dan Cox
	 */
	public function newSchedule()
	{
		return Template::make('pages/newSchedule');
	}
	
	/**
	 * Edit Schedule page
	 *
	 * @return Template
	 * @author Dan Cox
	 */
	public function editSchedule($id)
	{
		$schedule = DB::find('Schedule', $id);

		return Template::make('pages/editSchedule', ['schedule' => $schedule]);
	}
	
	/**
	 * Add Excludes
	 *
	 * @return Template
	 * @author Dan Cox
	 */
	public function addExcludes($id)
	{
		$schedule = DB::find('Schedule', $id);
		
		return Template::make('pages/addExcludes', ['schedule' => $schedule]);
	}

	/**
	 * View all excludes for given schedule
	 *
	 * @return Template
	 * @author Dan Cox
	 */
	public function excludes($id)
	{
		$schedule = DB::find('Schedule', $id);
		$excludes = $schedule->excludes()->slice(0);

		return Template::make('pages/excludes', ['schedule' => $schedule, 'excludes' => $excludes]);
	}
	
	/**
	 * Add Activities Page
	 *
	 * @return Template
	 * @author Dan Cox
	 */	
	public function addActivities($id)
	{
		$schedule = DB::find('Schedule', $id);

		return Template::make('pages/addActivities', ['schedule' => $schedule]);
	}

	/**
	 * Edits the activity given by id
	 *
	 * @return Template
	 * @author Dan Cox
	 */
	public function editActivities($id)
	{
		$activity = DB::find('Activity', $id);

		return Template::make('pages/editActivities', ['activity' => $activity]);
	}

	/**
	 * View all activities for schedule
	 *
	 * @return Template
	 * @author Dan Cox
	 */
	public function activities($id)
	{
		$schedule = DB::find('Schedule', $id);
		$activities = $schedule->activities()->slice(0);

		return Template::make('pages/activities', ['schedule' => $schedule, 'activities' => $activities]);
	}	
}
