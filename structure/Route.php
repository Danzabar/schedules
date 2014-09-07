<?php namespace Schedules\Structure;

use Aura\Router\RouterFactory;
use Symfony\Component\HttpFoundation\Request;
use Schedules\Structure\Input;

/**
 * Route Class - A wrapper around Aura/Router.
 *
 * @package Framework
 * @subpackage Structure
 * @author Dan Cox
 */
Class Route
{
	
	/**
	 * Router - Instance of Aura Router Class
	 *
	 * @var object
	 */		
	protected static $router;

	/**
	 * Request - Instance of Symfonys HTTP Request Class
	 *
	 * @var object
	 */
	protected static $request;
	
	/**
	 * Current Routed object
	 *
	 * @var object
	 */
	protected static $current;

	/**
	 * Builds the required static objects for later use
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function __construct()
	{
		// Build Aura's Router	
		$factory = new RouterFactory;
		static::$router = $factory->newInstance();
		
		// Build the request object
		static::$request = Request::createFromGlobals();
	}
	
	/**
	 * The resolve function gets the current route object, it initializes the Input capture
	 * and triggers the required controller based on the route config file.
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public static function resolve()
	{
		$route = static::$router->match(static::$request->getPathInfo(), $_SERVER);
		
		Input::init(static::$request->request);
		
		// Load the old input if there
		Input::loadOld();	

		if($route)
		{
			$params = $route->params;
			
			// Set as the current route;
			static::$current = $route;

			$action = $params['action'];

			unset($params['action']);

			$controller = explode('@', $action);

			// Load the controller
			require_once( dirname(__DIR__) . '/controllers/'.$controller[0].'.php'  );
			
			$class = new $controller[0]();
			
			call_user_func_array(array($class, $controller[1]), $params);
		}
		else {
				
			// No matching route
			throw new \Exception('No matching routes found');

		}	
	}

	/**
	 * Get - Adds a GET route to the collection
	 *
	 * @param $name string
	 * @param $url string
	 * @param $controller string
	 *
	 * @return void
	 * @author Dan Cox	
	 */		
	public static function get($name, $url, $controller)
	{
		static::$router->addGet($name, $url)
					   ->addValues(['action' => $controller]);
	}

	/**
	 * Post - adds a POST route to the collection
	 *
	 * @param $name string
	 * @param $url string
	 * @param $controller string
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public static function post($name, $url, $controller)
	{
		static::$router->addPost($name, $url)
					   ->addValues(['action' => $controller]);
	}

	/**
	 * Put - Adds a PUT route to the collection
	 * 
	 * @param $name string
	 * @param $url string
	 * @param $controller string
	 *
	 * @return void
	 * @author Dan Cox
	 */		
	public static function put($name, $url, $controller)
	{
		static::$router->addPut($name, $url)
					   ->addValues(['action' => $controller]);
	}
	
	/**
	 * Delete - Adds a Delete route to the collection
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public static function delete($name, $url, $controller)
	{
		static::$router->addDelete($name, $url)
					   ->addValues(['action' => $controller]);
	}

	/**
	 * Gets the current route object
	 *
	 * @return object
	 * @author Dan Cox
	 */
	public static function current()
	{
		return static::$current;
	}	
	
	/**
	 * Gets the current routes name, ie "page.home"
	 *
	 * @return string
	 * @author Dan Cox
	 */
	public static function currentRouteName()
	{
		return static::$current->name;
	}

	/**
	 * Gets the router object
	 *
	 * @return object
	 * @author Dan Cox
	 */
	public static function router()
	{
		return static::$router;
	}
	
	/**
	 * Gets the request object
	 *
	 * @return object
	 * @author Dan Cox
	 */
	public static function request()
	{
		return static::$request;
	}
}
