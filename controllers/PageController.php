<?php

Class PageController
{
	
	public function home()
	{
		/** 
		 * Get all available schedules to send here.
		 */
		$schedules = DB::count('Schedule');

		return Template::make('pages/home', ['schedules' => $schedules]);
	}	
	
	
	public function schedules()
	{
		$schedules = DB::get('Schedule', 10);
		
		return Template::make('pages/schedules', ['schedules' =>  $schedules]);
	}

	public function docs()
	{
		return Template::make('pages/docs');
	}	

	public function newSchedule()
	{
		return Template::make('pages/newSchedule');
	}

	public function addExcludes($id)
	{
		$schedule = DB::find('Schedule', $id);
		
		return Template::make('pages/addExcludes', ['schedule' => $schedule]);
	}

	public function addActivities($id)
	{
		$schedule = DB::find('Schedule', $id);

		return Template::make('pages/addActivities', ['schedule' => $schedule]);
	}
}
