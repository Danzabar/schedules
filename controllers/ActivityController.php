<?php

/**
 * Activity Controller controls activities
 *
 * @package Framework
 * @subpackage Controller
 * @author Dan Cox
 */
class ActivityController
{

	/**
	 * Adds activities
	 *
	 * @return Redirect
	 * @author Dan Cox
	 */
	public function addActivities($id)
	{
		$schedule = DB::find('Schedule', $id);
			
		$activity = new Activity();
		$activity
			->setLabel(Input::get('label'))
			->setHours(Input::has('hours') ? Input::get('hours') : NULL)
			->setDay(Input::has('days') ? Input::get('days') : NULL)
			->setTimes(Input::has('times') ? Input::get('times') : NULL);

		$errors = Validator::make($activity);
		
		if(count($errors) > 0)
		{
			return Redirect::route('page.addActivities', ['id' => $id])
						->withInput()
						->withErrors($errors)
						->send();
		}
			
		$activity->setSchedule($schedule);
		DB::save($activity);

		return Redirect::route('page.activities', ['id' => $id])
					->with('success', 'Successfully added new activity')
					->send();
	}
	
	/**
	 * Deletes an activity
	 *
	 * @return Redirect
	 * @author Dan Cox
	 */
	public function delete($id)
	{
		$activity = DB::find('Activity', $id);
		DB::delete($activity);

		return Redirect::route('page.activities', ['id' => $activity->schedules()->id])
					->with('success', 'Removed activity from schedule')
					->send();
	}

	/**
	 * Edits an activity
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function editActivities($id)
	{
		$activity = DB::find('Activity', $id);
		
		$activity
			->setLabel(Input::get('label'))
			->setHours(Input::has('hours') ? Input::get('hours') : NULL)
			->setDay(Input::has('days') ? Input::get('days') : NULL)
			->setTimes(Input::has('times') ? Input::get('times') : NULL);

		$errors = Validator::make($activity);

		if(count($errors) > 0)
		{
			return Redirect::route('page.editActivities', ['id' => $activity->id])
						->withInput()
						->withErrors($errors)
						->send();
		}

		DB::save($activity);

		return Redirect::route('page.editActivities', ['id' => $activity->id])
					->with('success', 'Edited activity details')
					->send();
	}

} // END class ActivityController
