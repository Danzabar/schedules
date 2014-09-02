<?php namespace Schedules\Structure;

use Aura\Sql\ConnectionFactory;

/**
 * Just a wrapper around Aura SQL package.
 *
 *
 */
Class Database
{
	
	/**
	 * An instance of Aura Extended PDO class.
	 *
	 */	
	public static $sql;


	public static function connect($details)
	{
		$factory = new ConnectionFactory;
	
		static::$sql = $factory->newInstance(
			'mysql',
			array(
				'host' => $details['host'],
				'dbname' => $details['database']
			),
			$details['user'],
			$details['pass']
		);

	}

	public static function installed()
	{
		try 
		{
			Database::sql()->fetchAll("SELECT * FROM migrations");
		} catch (\PDOException $e) 
		{
			return false;
		}

		return true;
	}

	public static function sql()
	{
		return static::$sql;
	}
}
