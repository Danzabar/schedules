<?php

Class ScheduleController
{
	
	public function newSchedule()
	{
		$schedule = new Schedule;
	
		$schedule
			->setName(Input::get('name'))
			->setDescription(Input::get('description'))
			->setUpdatedAt(date('Y-m-d H:i:s'));
		
		$errors = Validator::make($schedule);

		if(count($errors) > 0)
		{
			return Redirect::route('page.newSchedule')
							->withErrors($errors)
							->withInput()
							->send();
		}	

		DB::save($schedule);

		return Redirect::route('page.schedules')
						->with('success', 'Successfully created new schedule')
						->send();
	}

	public function deleteSchedule($id)
	{
		$schedule = DB::find('Schedule', $id);

		DB::delete($schedule);

		return Redirect::route('page.schedules')
						->with('success', 'Removed Schedule')
						->send();		
	}
	
	public function addExcludes($id)
	{
		
	}

	public function addActivities($id)
	{

	}

}
