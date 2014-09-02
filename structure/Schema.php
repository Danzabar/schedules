<?php namespace Schedules\Structure;

use Robbo\SchemaBuilder\Connection\MySqlConnection;


/**
 *  Wrapper class around Robbo's Schema Class,
 *  Allows it to be used statically.
 *
 *
 */
Class Schema
{
	protected static $builder;
	
	/**
	 * Set up the connection and get the builder
	 *
	 */
	public function __construct()
	{

		$connection = new MysqlConnection(Database::sql()->getPDO(), 'schedules');

		static::$builder = $connection->getSchemaBuilder();
	}
	
	/**
	 * Return the builder, can be chained then, eg Schema::builder()->create;
	 *
	 */
	public static function builder()
	{
		return static::$builder;
	}
}
