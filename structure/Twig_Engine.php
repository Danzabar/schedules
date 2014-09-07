<?php namespace Schedules\Structure;

use Symfony\Component\Templating\EngineInterface;

/**
 * Twig Engine An interfacing class that we can pass to symfonys Delegating Engine.
 *
 * @package Framework
 * @subpackage Structure
 * @author Dan Cox
 */
Class Twig_Engine implements EngineInterface
{
	/**
	 * An instance of the Twig environment
	 *
	 * @var object
	 */		
	protected $twig;
	
	/**
	 * Loads the twig environment and adds custom functionality
	 *
	 * @param {object} $loader
	 * @param {string} $cache_dir the directory for caching.  
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function __construct($loader, $cache_dir)
	{
		$this->twig = new \Twig_Environment($loader, $cache_dir);
	
		$this->addFunctionality();
	}
		
	/**
	 * Render function as is requirement to interfacing class
	 *
	 * @return string
	 * @author Dan Cox
	 */
	public function render($name, Array $parameters = Array())
	{	
		/**
		 * Some useful additions, so we are not writing out mass amounts of template directory code.
		 */
		$name = $name.'.html';

		return $this->twig->render($name, $parameters);
	}

		
	public function exists($name)
	{
		/**
		 *  When The php engine fails, we just want to treat this as true.
		 *
		 */	
		return true;
	}	
	
	public function supports($name)
	{
		/*
		 * Similar to the above, just treat this as a Twig file when all else fails. 
		 *
		 */
		return true;
	}

	/**
	 * Used to bulk load functionality into twig engine
	 *
	 * @return void
	 * @author Dan Cox
	 */
	private function addFunctionality()
	{
		$this->twig->addFunction($this->_function_App());
	}

	/**
	 * App function, adds an App function to templates that allows the use of static classes.
	 *
	 * @return mixed
	 * @author Dan Cox
	 */
	private function _function_App()
	{
		return new \Twig_SimpleFunction('App', function($class, $method, $params = Array())
		{
			if(class_exists($class) && method_exists($class, $method))
			{
				return call_user_func_array(array($class, $method), $params);
			}				

			throw new \Exception("Undefined Class called in template, Either $class doesnt exist or $method doesnt exist on the class");
		});
	}
}
