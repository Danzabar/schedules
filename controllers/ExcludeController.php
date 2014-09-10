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


} // END class ExcludeController
