<?php namespace Schedules\Structure;

/**
 *  Returns full urls in exchange for a URI
 *
 *
 */
Class URL
{

	/**
	 * Returns a full url to the assets directory
	 *
	 */
	public static function asset($path)
	{
		return "//".BASE_URL."/assets/".$path;
	}

	/** 
	 * Returns the url to a explicit path.
	 *
	 */
	public static function to($path)
	{
		return "//".BASE_URL."/".$path;
	}

	/**
	 * Gets a route url by name
	 *
	 */
	public static function route($name)
	{
		return "//".BASE_URL.Route::router()->generate($name);
	}
}
