<?php

Class PageController
{
	
	public function install()
	{
		/**
		 * Check if the migrations have been installed, if not install it
 		 *
		 */
		$migration = new Migration;

		if(!Database::installed())
		{	
			$migration->install();	
		}

		$migration->process('up');	
	}

	public function home()
	{
		/** 
		 * Get all available schedules to send here.
		 */
		$schedules = Database::sql()->fetchAssoc("SELECT * FROM schedules");

		return Template::make('pages/home', ['schedules' => $schedules]);
	}	

}
