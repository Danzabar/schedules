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
	public function addExclude($id)
	{
		$schedule = DB::find('Schedule', $id);
		

	}


} // END class ExcludeController
