<?php namespace Schedules\Structure;

use Schedules\Structure\Session;
use Schedules\Structure\Input;

/**
 * Redirect - used to redirect to other routes while sending input and variables
 *
 * @package Framework
 * @subpackage Structure
 * @author Dan Cox
 */
Class Redirect
{
	/**
	 * Route - the url associated with the route name given.
	 *
	 * @var string
	 */	
	protected $route;
	
	/**
	 * Add Route - used to get the Url from route name, chainable.
	 *
	 * @param $name string
	 * @return object
	 * @author Dan Cox
	 */
	public function addRoute($name)
	{	
		// Save the generated url to the route;
		$this->route = URL::route($name);
		
		return $this;
	}
	
	/**
	 * With - loads a variable in the session.
	 *
	 * @param $key string
	 * @param $value mixed
	 * @return object
	 * @author Dan Cox
	 */
	public function with($key, $value)
	{
		Session::set($key, $value);
		
		return $this;
	}
	
	/**
	 * With Input - Saves old input to the session.
	 *
	 * @return object
	 * @author Dan Cox
	 */
	public function withInput()
	{
		Input::save();
		
		return $this;
	}
	
	/**
	 * Send - completes the redirect, must be called at the end of the chain to perform redirect.
	 *
	 * @return void
	 * @author Dan Cox
	 */	
	public function send()
	{
		header("Location: ". $this->route);
	}	

	/**
	 * Static Methods
	 * 
	 */

	/**
	 * Route - Creates new redirect object loads the route and sets the scene for chainable methods.
	 *
	 * @param $route string
	 * @return object
	 * @author Dan Cox
	 */
	public static function route($route)
	{
		$redirect = new Redirect;
		$redirect->addRoute($route);

		return $redirect;
	}
}
