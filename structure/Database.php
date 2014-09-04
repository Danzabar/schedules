<?php namespace Schedules\Structure;

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

/**
 * Just a wrapper around Doctrine ORM package.
 *
 *
 */
Class Database
{

	/**
	 * The doctrine Entity Manager Class
	 * 
	 */	
	protected static $entityManager;
		

	/**
	 * Creates the entity Manager class which is the backbone of the database.
	 *
	 */
	public static function connect($params)
	{
			
		$config = Setup::createAnnotationMetadataConfiguration( [dirname(__DIR__). '/models/'], false);
		
		static::$entityManager = EntityManager::create(
			[
				'driver' 	=> 'pdo_mysql',
				'user'		=> $params['user'],
				'password'	=> $params['pass'],
				'dbname'	=> $params['database']			
			],
			$config
		);
	}
	
	/**
	 * Get the entire repository
	 *
	 */
	public static function get($entity, $limit = NULL, $offset = 0)
	{
		return static::$entityManager->getRepository($entity)->findBy(array(), array(), $limit, $offset);
	}

	/**
	 * Count records
	 *
	 */
	public static function count($entity, $params = Array())
	{
		$builder = static::$entityManager->createQueryBuilder();

		$builder->select($builder->expr()->count('u'))
				->from($entity, 'u');

		if(!empty($params))
		{
			$builder->where($params);
		}	

		$query = $builder->getQuery();

		return $query->getSingleScalarResult();
	}

	/**
	 * Uses the entity Manager class to find a model
	 *
	 */
	public static function find($entity, $id)
	{
		return static::$entityManager->find($entity, $id);
	}

	/**
	 * Find BY
	 *
	 */
	public static function findBy($entity, $params, $order = Array(), $limit = 100, $offset = 0)
	{
		return static::$entityManager->getRespository($entity)->findBy($params, $order, $limit, $offset);
	}

	/**
	 * Find One
	 *
	 */
	public static function findOneBy($entity, $params, $order = Array(), $limit = 100, $offset = 0)
	{
		return static::$entityManager->getRespository($entity)->findOneBy($params, $order, $limit, $offset);
	}
	
	/**
	 * Returns the instance of the entity Manager that was created
	 * during connection.
	 *
	 */
	public static function entityManager()
	{
		return static::$entityManager;
	}
}
