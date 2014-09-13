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
