<?php


$aliases = array(
	
	"Schedules\Structure\Database"		=> 'DB',
	"Schedules\Structure\Template"		=> 'Template',
	"Schedules\Structure\Route"			=> 'Route',
	"Schedules\Structure\URL"			=> 'URL',
	"Schedules\Structure\Redirect"		=> 'Redirect',
	"Schedules\Structure\Session"		=> 'Session',
	"Schedules\Structure\Input"			=> 'Input',

);


foreach($aliases as $ns => $map)
{
	class_alias($ns, $map);
}
