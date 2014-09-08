<?php namespace Schedules\Structure;

Use Schedules\Structure\Twig_Engine;
use Symfony\Component\Templating\DelegatingEngine;
use Symfony\Component\Templating\PhpEngine;
use Symfony\Component\Templating\TemplateNameParser;
use Symfony\Component\Templating\Loader\FilesystemLoader;
use Symfony\Component\Templating\Helper\AssetsHelper;
use Symfony\Component\Templating\Helper\SlotsHelper;

/**
 * Template - Uses symfony templating engine system and Twig templating language
 * to create smart useful templates
 *
 * @package Framework
 * @subpackage Structure
 * @author Dan Cox
 */
Class Template
{
	/**
	 * An Instance of the Symfony FileSystemLoader Class
	 *
	 * @var object
	 */
	protected $Php_loader;
	
	/**
	 * An Instance of the Twig FileSystemLoader Class`
	 *
	 * @var object
	 */
	protected $Twig_loader;
	
	/**
	 * The Symfony Template Delegating Engine which decides on which engine to use
	 *
	 * @var object
	 */
	protected $template;
	
	
	/**
	 * Sets up the php and twig templating systems
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function __construct()
	{
		// Set up the base symfony classes	
		$this->Php_loader = new FileSystemLoader(TEMPLATES_DIRECTORY.'%name%.php');
		$this->Twig_loader = new \Twig_Loader_Filesystem(TEMPLATES_DIRECTORY.'/');

		$this->template = new DelegatingEngine(array( 
			new PhpEngine(new TemplateNameParser, $this->Php_loader),
			new Twig_Engine($this->Twig_loader, array(dirname(__DIR__).'/storage/'))
		));
	}
	
	/**
	 * Adds a global variable into the templating environment.
	 *
	 * @param {string} $key the values key
	 * @param {mixed} $value
	 *
	 * @return object
	 * @author Dan Cox
	 */
	public function addGlobal($key, $value)
	{
		$this->template->addGlobal($key, $value);

		return $this;
	}
	
	/**
	 * Render, renders the template through the delegating engine.
	 *
	 * @param {string} $template the template name
	 * @param {array} $assocArr an associative array of variables
	 *
	 * @return string
	 * @author Dan Cox
	 */
	public function render($template, $assocArr = [])
	{	
		// If the session has errors, load these as variables
		if(Session::has('errors'))
		{
			$assocArr = array_merge($assocArr, array('errors' => Session::get('errors')));
			Session::remove('errors');
		}

		return $this->template->render($template, $assocArr);
	}

	/**
	 * Static all in one function that returns the rendered content
	 *
	 * @param {string} $template the template name
	 * @param {array} $assocArr an associative array of variables
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public static function make($template, $assocArr = [])
	{
		$temp = new Template;

		echo $temp->render($template, $assocArr);
	}
}
