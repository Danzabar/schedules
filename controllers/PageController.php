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
	 * View the schedule given
	 *
	 * @return Template
	 * @author Dan Cox
	 */
	public function viewSchedule($id)
	{
		$schedule = DB::find('Schedule', $id);

		$times = ['00:00', '01:00', '02:00', '03:00', '04:00', '05:00', '06:00', '07:00',
				  '08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00',
		  		  '16:00', '17:00', '18:00', '19:00', '20:00', '21:00', '22:00', '23:00'];

		return Template::make('pages/viewSchedule', ['schedule' => $schedule, 'times' => $times]);
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
	 * The view for editing exlusions
	 *
	 * @return Template
	 * @author Dan Cox
	 */
	public function editExcludes($id)
	{
		$exclude = DB::find('Exclusion', $id);

		return Template::make('pages/editExcludes', ['exclude' => $exclude]);
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
