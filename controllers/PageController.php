<?php

Class PageController
{
	
	public function home()
	{
		/** 
		 * Get all available schedules to send here.
		 */
		$schedules = DB::get('Schedule', 10);


		return Template::make('pages/home', ['schedules' => $schedules]);
	}	

}
