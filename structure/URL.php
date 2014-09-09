<?php namespace Schedules\Structure;

/**
 * Class that adds a level of security by return FULL urls for certain situations
 *
 * @package Framework
 * @subpackage Structure
 * @author Dan Cox
 */
Class URL
{			
		

	/**
	 * Asset, returns the full url for an asset
	 *
	 *	@param {string} $path the asset path	
	 *
	 * @return string
	 * @author Dan Cox
	 */		
	public static function asset($path)
	{
		return "//".BASE_URL."/assets/".$path;
	}

	/**
	 * Returns a FULL url to a direct link
	 *
	 * @param {string} $to url path ie "book/view"
	 *
	 * @return string
	 * @author Dan Cox
	 */
	public static function to($path)
	{
		return "//".BASE_URL."/".$path;
	}

	/**
	 * Gets a full url from the route name
	 *
	 * @param {string} $name the name of the route
	 * @param {array} $params the route parameters.
	 *
	 * @return string
	 * @author Dan Cox
	 */
	public static function route($name, Array $params = array())
	{
		return "//".BASE_URL.Route::router()->generate($name, $params);
	}
}
