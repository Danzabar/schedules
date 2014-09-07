<?php namespace Schedules\Structure;

/**
 * Session class deals with session based variables in a safe fashion.
 *
 * @package Framework
 * @subpackage Structure
 * @author Dan Cox
 */
Class Session
{

	/**
	 * Decodes a session item that was previously encrypted.
	 *
	 * @param {string} $key the session array key
	 *
	 * @return mixed
	 * @author Dan Cox
	 */		
	public static function decryptSession($key)
	{
		$value = self::decode($_SESSION['framework'][$key]);
		
		unset($_SESSION['framework'][$key]);

		return $value;
	}
	
	/**
	 * Gets a session variable from the given key
	 *
	 * @param {string} $key the array key
	 *
	 * @return mixed
	 * @author Dan Cox
	 */
	public static function get($key)
	{
		return (isset($_SESSION['framework'][$key]) ? $_SESSION['framework'][$key] : '');
	}
	
	/**
	 * Checks whether the session isset for a certain key
	 *
	 * @param {string} $key the array key
	 *
	 * @return boolean
	 * @author Dan Cox
	 */
	public static function has($key)
	{
		return isset($_SESSION['framework'][$key]);
	}
	
	/**
	 * Sets a session variable
	 *
	 * @param {string} $key the desired array key
	 * @param {mixed} $value the value of the given key
	 * @param {boolean} $encrypt optional, encrypts the session data.
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public static function set($key, $value, $encrypt = FALSE)
	{
		if($encrypt)
		{	
			$value = self::encode($value);	
		}

		$_SESSION['framework'][$key] = $value;	
	}


	/**
	 * Encodes a value
	 *
	 * @param {mixed} $data
	 *
	 * @return void
	 * @author Dan Cox
	 */
	private static function encode($data)
	{		
		return base64_encode(serialize($data));
	}
	
	/**
	 * Decodes a value
	 *
	 * @param {string} $encoded_data 
	 *
	 * @return mixed
	 * @author Dan Cox
	 */
	private static function decode($encoded_data)
	{
		return unserialize(base64_decode($encoded_data));
	}

}
