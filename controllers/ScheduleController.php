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
	 * Searches for a schedule base on name and description
	 *
	 * @return Template
	 * @author Dan Cox
	 */
	public function search()
	{
		$search = Input::get('term');

		$schedules = DB::search('Schedule', function($builder) use ($search)
		{
			$builder->where('u.name LIKE :search');
			$builder->orWhere('u.description LIKE :search');
			$builder->setParameter('search', '%'.$search.'%');
		});
		
		return Template::make('pages/results', ['schedules' => $schedules, 'search' => $search]);
	}

	/**
	 * Generates a schedule from its attributes
	 *
	 * @return Redirect
	 * @author Dan Cox
	 */
	public function generate($id)
	{
		$schedule = DB::find('Schedule', $id);

		$sched_build = new Danzabar\Schedule\Schedule($schedule->name);

		// Add Excludes
		foreach($schedule->excludes()->slice(0) as $exclude)
		{
			$sched_build->setExcludes(array(
				$exclude->day => $exclude->times
			), $exclude->label);
		}

		// Add Activities
		foreach($schedule->activities()->slice(0) as $activity)
		{
			if(!empty($activity->times))
			{
				$sched_build->addActivity(
						$activity->label, 
						($activity->hours > 0 ? $activity->hours : NULL), 
						array(
							$activity->day => $activity->times
				));
			}
			else {
				$sched_build->addActivity($activity->label, $activity->hours);
			}
		}

		$builder = $sched_build->build();
		
		// Save to Model
		$schedule->setGenerated(json_decode($builder->toJSON(), true));
		DB::save($schedule);

		return Redirect::route('page.schedule', ['id' => $id])
				->with('success', 'Generated the '.$schedule->name.' schedule')
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
