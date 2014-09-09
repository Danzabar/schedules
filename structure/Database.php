<?php namespace Schedules\Structure;

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

/**
 * Database Class - Acts as an easy to use wrapper around Doctrine/ORM
 *
 * @package Framework
 * @subpackage Structure
 * @author Dan Cox
 */
Class Database
{

	/**
	 * EntityManager - instance of Doctrine/ORM/EntityManager
	 *
	 * @var object
	 */		
	protected static $entityManager;
		

	/**
	 * Use Doctrine to create a PDO mysql connection.
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public static function connect($params)
	{
			
		$config = Setup::createAnnotationMetadataConfiguration( [dirname(__DIR__). '/models/'], true);
		
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
	 * Get entities from a repository
	 *
	 * @param $entity string
	 * @param $limit integer
	 * @param $offset integer
	 *
	 * @return object
	 * @author Dan Cox
	 */
	public static function get($entity, $orderBy = Array(), $limit = NULL, $offset = 0)
	{
		return static::$entityManager->getRepository($entity)->findBy(array(), $orderBy, $limit, $offset);
	}

	/**
	 * Count the entities from a repository
	 *
	 * @param $entity string
	 * @param $params assoc array
	 *
	 * @return integer
	 * @author Dan Cox
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
	 * Finds a single entity based on its id.
	 *
	 * @param $entity string
	 * @param $id mixed
	 *
	 * @return object
	 * @author Dan Cox
	 */
	public static function find($entity, $id)
	{
		return static::$entityManager->find($entity, $id);
	}

	/**
	 * Find By - finds entities from a repo by parameters
	 *
	 * @param $entity string
	 * @param $params assoc array
	 * @param $order array
	 * @param $limit int
	 * @param $offset int
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public static function findBy($entity, $params, $order = Array(), $limit = 100, $offset = 0)
	{
		return static::$entityManager->getRespository($entity)->findBy($params, $order, $limit, $offset);
	}

	/**
	 * Find one by, returns single entity based on parameters.
	 *
	 * @param $entity string
	 * @param $params assoc array
	 * @param $order array
	 * @param $limit int
	 * @param $offset int	
	 *
	 * @return object
	 * @author Dan Cox
	 */
	public static function findOneBy($entity, $params, $order = Array(), $limit = 100, $offset = 0)
	{
		return static::$entityManager->getRespository($entity)->findOneBy($params, $order, $limit, $offset);
	}
	
	/**
	 * Save, uses the entity manager to save the changes to an entity
	 *	
	 * @param {object} $entity the edited entity
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public static function save($entity)
	{
		static::$entityManager->persist($entity);
		static::$entityManager->flush();
	}

	/**
	 * Deletes row by entity
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public static function delete($entity)
	{
		static::$entityManager->remove($entity);
		static::$entityManager->flush();
	}

	/**
	 * Entity Manager, static function to pass around the active instance of the entity manager
	 *
	 * @return object
	 * @author Dan Cox
	 */
	public static function entityManager()
	{
		return static::$entityManager;
	}
}
