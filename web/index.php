<?php

include dirname(__FILE__)
    . DIRECTORY_SEPARATOR . '..'
    . DIRECTORY_SEPARATOR . 'vendor'
    . DIRECTORY_SEPARATOR . 'Autoload.php';

$application = new \tomasz\legacy\framework\Application();
$application->handleRequest();