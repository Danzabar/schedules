<?php


$aliases = array(
	
	"Schedules\Structure\Database"		=> 'Database',
	"Schedules\Structure\Template"		=> 'Template',
	"Schedules\Structure\Schema"		=> 'Schema',
	"Schedules\Structure\Migration"		=> 'Migration',
	"Schedules\Structure\Route"			=> 'Route',

);


foreach($aliases as $ns => $map)
{
	class_alias($ns, $map);
}
