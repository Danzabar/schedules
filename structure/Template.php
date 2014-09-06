<?php namespace Schedules\Structure;

Use Schedules\Structure\Twig_Engine;
use Symfony\Component\Templating\DelegatingEngine;
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
	protected $Php_loader;
	protected $Twig_loader;

	/**
	 * An instance of the symfony PHP template engine.
	 *
	 */
	protected $template;
	

	public function __construct()
	{
		// Set up the base symfony classes	
		$this->Php_loader = new FileSystemLoader(TEMPLATES_DIRECTORY.'%name%.php');
		$this->Twig_loader = new \Twig_Loader_Filesystem(TEMPLATES_DIRECTORY.'/');

		$this->template = new DelegatingEngine(array( 
			new PhpEngine(new TemplateNameParser, $this->Php_loader),
			new Twig_Engine($this->Twig_loader, array(dirname(__DIR__).'/storage/'))
		));
	
		// Set the helpers for slots and assets.
		#$this->template->set(new AssetsHelper);
		#$this->template->set(new SlotsHelper);	
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

		echo $temp->render($template, $assocArr);
	}
}
