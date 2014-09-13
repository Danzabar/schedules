<?php

/**
 * Docs Controller, handles pages for documentation.
 *
 * @package Framework
 * @subpackage Controller
 * @author Dan Cox
 */
class DocsController
{
	public function docs()
	{
		return Template::make('docs/landing');
	}

	/**
	 * Shows a list of conbtributes using markdown and a list of what packages we use with links to documentation
	 *
	 * @return Template
	 * @author Dan Cox
	 */
	public function contributors()
	{
		$md = file_get_contents(dirname(__DIR__) . '/contributors.md');
		$html = \Michelf\Markdown::defaultTransform($md);
		
		return Template::make('docs/what-we-use', ['contributors' => $html]);
	}

	/**
	 * Returns a specific page from the documentation
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function docPage($page)
	{
		return Template::make('docs/'.$page);
	}


} // END class DocsController
