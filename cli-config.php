<?php require_once __DIR__ .'/bootstrap.php';

use Doctrine\ORM\Tools\Console\ConsoleRunner;

$em = DB::entityManager();

return ConsoleRunner::createHelperSet($em);
