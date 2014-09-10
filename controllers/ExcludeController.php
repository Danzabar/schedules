<?php 

/**
 * Exclude controller, controls all actions for excludes
 *
 * @package Controller
 * @author Dan Cox
 */
class ExcludeController
{

	/**
	 * Creates a new Exclude
	 *
	 * @param {integer} $id 
	 *
	 * @return Redirect
	 * @author Dan Cox
	 */
	public function addExcludes($id)
	{
		$schedule = DB::find('Schedule', $id);
		
		$exclude = new Exclusion;	
		$exclude
			->setLabel(Input::get('label'))
			->setDay(Input::get('day'))
			->setTimes(Input::get('times'));

		$errors = Validator::make($exclude);

		if(count($errors) > 0)
		{
			return Redirect::route('page.addExcludes', ['id' => $schedule->id])
						->withInput()
						->withErrors($errors)
						->send();
		}
		
		$exclude->setSchedule($schedule);		
	
		DB::save($exclude);
		return Redirect::route('page.excludes', ['id' => $schedule->id])
				->with('success', 'Successfully created new exclude')
				->send();
	}

	/**
	 * Delete an exclude
	 *
	 * @return Redirect
	 * @author Dan Cox
	 */
	public function delete($id)
	{
		$exclude = DB::find('Exclusion', $id);
		DB::delete($exclude);

		return Redirect::route('page.excludes', ['id' => $exclude->schedules()->id])
					->with('success', 'Removed exclude')
					->send();
	}

	/**
	 * Edits an exclusion
	 *
	 * @return Redirect
	 * @author Dan Cox
	 */
	public function editExcludes($id)
	{
		$exclude = DB::find('Exclusion', $id);

		$exclude
			->setLabel(Input::get('label'))
			->setDay(Input::get('day'))
			->setTimes(Input::get('times'));

		$errors = Validator::make($exclude);

		if(count($errors) > 0)
		{
			return Redirect::route('page.editExcludes', ['id' => $exclude->id])
						->withInput()
						->withErrors($errors)
						->send();
		}
		
		DB::save($exclude);
		return Redirect::route('page.editExcludes', ['id' => $exclude->id])
				->with('success', 'Successfully edited exclusion')
				->send();
			
	}

} // END class ExcludeController
