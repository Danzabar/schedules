<?php namespace Schedules\Structure;

use Aura\Router\RouterFactory;
use Symfony\Component\HttpFoundation\Request;

/**
 * Uses Aura/Router to do the grunt work, just acts as a wrapper around
 * it to make it easier to use and more accessible. 
 *
 */
Class Route
{
	
	/**
	 * An instance of Aura/Router
	 *
	 */	
	protected static $router;

	/**
	 * An instance of symfonys request component.
	 *
	 */
	protected static $request;


	public function __construct()
	{
		// Build Aura's Router	
		$factory = new RouterFactory;
		static::$router = $factory->newInstance();
		
		// Build the request object
		static::$request = Request::createFromGlobals();
	}
	
	/**
	 *  Resolve, uses the request object and router to
	 *  get the action involved for the current route.
	 *
	 */
	public static function resolve()
	{
		$route = static::$router->match(static::$request->getPathInfo(), $_SERVER);
	
		if($route)
		{
			$params = $route->params;

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
			throw new Exception('No matching routes found');

		}	
	}

	/**
	 * The static methods to add a route,
	 * this just adds a convience around the native functions
	 *
	 */
	public static function get($name, $url, $controller)
	{
		static::$router->addGet($name, $url)
					   ->addValues(['action' => $controller]);
	}
	
	public static function post($name, $url, $controller)
	{
		static::$router->addPost($name, $url)
					   ->addValues(['action' => $controller]);
	}

	public static function put($name, $url, $controller)
	{
		static::$router->addPut($name, $url)
					   ->addValues(['action' => $controller]);
	}

	public static function delete($name, $url, $controller)
	{
		static::$router->addDelete($name, $url)
					   ->addValues(['action' => $controller]);
	}

	/**
	 * To Always have access to the router, we put it as a static property
	 * 
	 */
	public static function router()
	{
		return static::$router;
	}

	/**
	 * Likewise with the router, we should have access to the request object.
	 *
	 */
	public static function request()
	{
		return static::$request;
	}
}
