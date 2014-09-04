<?php


$aliases = array(
	
	"Schedules\Structure\Database"		=> 'DB',
	"Schedules\Structure\Template"		=> 'Template',
	"Schedules\Structure\Schema"		=> 'Schema',
	"Schedules\Structure\Route"			=> 'Route',
	"Schedules\Structure\URL"			=> 'URL',

);


foreach($aliases as $ns => $map)
{
	class_alias($ns, $map);
}
