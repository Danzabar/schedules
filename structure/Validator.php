<?php namespace Schedules\Structure;

use Symfony\Component\Validator\Validation;

/**
 * Validator a wrapper around the symfony validator allowing us to use easy static keys
 *
 * @package Framework
 * @subpackage Structure
 * @author Dan Cox
 */
class Validator
{
	
	/**
	 * Builds the validator class from factory
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public static function build()
	{
		$builder = Validation::createValidatorBuilder();
	
		$builder->addMethodMapping('rules');	

		return $builder->getValidator();
	}
	
	/**
	 * Make, Creates a validator and uses it to validate against a Doctrine entity
	 *
	 * @return mixed
	 * @author Dan Cox
	 */
	public static function make($entity)
	{
		$validator = self::build();
		
		return $validator->validate($entity);
	}

} // END class Validator
