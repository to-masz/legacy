<?php

include dirname(__FILE__) 
    . DIRECTORY_SEPARATOR . '..'
    . DIRECTORY_SEPARATOR . 'src'
    . DIRECTORY_SEPARATOR . 'framework'
    . DIRECTORY_SEPARATOR . 'Application.php';

$application = new \tomasz\legacy\framework\Application();
$application->handleRequest();