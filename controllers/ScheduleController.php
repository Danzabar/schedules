<?php

Class ScheduleController
{
	
	/**
	 * Creates a new schedule
	 *
	 * @return Redirect
	 * @author Dan Cox
	 */		
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

	/**
	 * Edits the passed scheduleid
	 *
	 * @return Redirect
	 * @author Dan Cox
	 */
	public function editSchedule($id)
	{
		$schedule = DB::find('Schedule', $id);
		
		$schedule
			->setName(Input::get('name'))
			->setDescription(Input::get('description'))
			->setUpdatedAt(date('Y-m-d H:i:s'));

		$errors = Validator::make($schedule);

		if(count($errors) > 0)
		{
			return Redirect::route('page.editSchedule', ['id' => $id])
							->withErrors($errors)
							->withInput()
							->send();
		}

		DB::save($schedule);
		
		return Redirect::route('page.editSchedule', ['id' => $id])
						->with('success', 'Successfully edited schedule')
						->send();
	}
	
	/**
	 * Deletes a schedule based on id thats passed.
	 *
	 * @param {integer} $id the schedule id.
	 *
	 * @return Redirect
	 * @author Dan Cox
	 */
	public function deleteSchedule($id)
	{
		$schedule = DB::find('Schedule', $id);

		DB::delete($schedule);

		return Redirect::route('page.schedules')
						->with('success', 'Removed Schedule')
						->send();		
	}

}
