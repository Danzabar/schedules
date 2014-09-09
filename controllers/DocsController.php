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
		return Template::make('pages/docs');
	}


} // END class DocsController
