<?php namespace Schedules\Structure;

use Symfony\Component\Templating\PhpEngine;
use Symfony\Component\Templating\TemplateNameParser;
use Symfony\Component\Templating\Loader\FilesystemLoader;
use Symfony\Component\Templating\Helper\AssetsHelper;
use Symfony\Component\Templating\Helper\SlotsHelper;

/**
 * A Wrapper around symfonys templating package 
 * to make things easier.
 *
 */
Class Template
{

	/**
	 * An instance of the symfony file system loader class
	 *
	 */
	protected $loader;
	
	/**
	 * An instance of the symfony PHP template engine.
	 *
	 */
	protected $template;
	

	public function __construct()
	{
		// Set up the base symfony classes	
		$this->loader = new FileSystemLoader(TEMPLATES_DIRECTORY.'%name%.php');

		$this->template = new PhpEngine(new TemplateNameParser, $this->loader);
	
		// Set the helpers for slots and assets.
		$this->template->set(new AssetsHelper);
		$this->template->set(new SlotsHelper);	
	}	


	public function addGlobal($key, $value)
	{
		$this->template->addGlobal($key, $value);

		return $this;
	}



	public function render($template, $assocArr = [])
	{	
		return $this->template->render($template, $assocArr);
	}


	public static function make($template, $assocArr = [])
	{
		$temp = new Template;

		return $temp->render($template, $assocArr);
	}
}
