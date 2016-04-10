<?php

include dirname(__FILE__)
    . DIRECTORY_SEPARATOR . '..'
    . DIRECTORY_SEPARATOR . 'vendor'
    . DIRECTORY_SEPARATOR . 'Autoload.php';

$routingTable = include dirname(__FILE__)
    . DIRECTORY_SEPARATOR . '..'
    . DIRECTORY_SEPARATOR . 'resources'
    . DIRECTORY_SEPARATOR . 'routing.php';

$application = new \tomasz\legacy\framework\Application(['routing' => $routingTable]);
$application->handleRequest();