<?php namespace Schedules\Structure;

use Schedules\Structure\Session;

/**
 * Input class
 *
 * Stores form inputs and acts as a wrapper "getter" around symfonys request module.
 *
 * @package framework
 * @subpackage structure
 * @author Dan Cox
 */
Class Input
{

	/**
	 * Parameter Bag an instance of symfonys request or query. 
	 *
	 * @var object
	 */
	protected static $parameterBag;

	/**
	 * Old - Stores the old input
	 *
	 * @var array
	 */
	protected static $old;
	
	/**
	 * Init - Accepts the parameter bag, this is called in the router. 
	 *
	 * @return void
	 * @author Dan Cox
	 */		
	public static function init($parameterBag)
	{
		static::$parameterBag = $parameterBag;
	}
	
	/**
	 * Save - saves the old input to the session
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public static function save()
	{
		Session::set('Input', self::all(), true);
	}
	
	/**
	 * Load Old - loads the old input values through the session
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public static function loadOld()
	{
		if(Session::has('Input'))
		{
			static::$old = Session::decryptSession('Input');
		}
	}
	
	/**
	 * Old - looks for a key value in the old input array
	 *
	 * @param $key string
	 * @return string
	 * @author Dan Cox
	 */
	public static function old($key)
	{
		return (isset(static::$old[$key]) ? static::$old[$key] : '');
	}


	/**
	 * Helper functions that interact with the parameter Bag
	 * Interface passed by Symfonys Request Class.
	 * -----------------------------------------------------
	 *
	 *
	 */
	
	/**
	 * Get - gets a key value from the param bag
	 *
	 * @return mixed
	 * @author Dan Cox
	 */
	public static function get($key)
	{
		return static::$parameterBag->get($key);
	}
	
	/**
	 * All - gets all the values from the param bag
	 *
	 * @return array
	 * @author Dan Cox
	 */		
	public static function all()
	{
		return static::$parameterBag->all();
	}
	
	/**
	 * Has - checks if the param bag contains a key
	 *
	 * @return boolean
	 * @author Dan Cox
	 */
	public static function has($key)
	{
		return static::$parameterBag->has($key);
	}
	
	/**
	 * Keys - Returns array of keys from the param bag.
	 *
	 * @return array
	 * @author Dan Cox
	 */
	public static function keys()
	{
		return static::$parameterBag->keys();
	}
	
	/**
	 * Remove - removes a key from the param bag
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public static function remove($key)
	{
		return static::$parameterBag->remove($key);
	}
}
