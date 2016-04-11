<?php

require(__DIR__.'/../vendor/autoload.php');
$kernel = \AspectMock\Kernel::getInstance();
$kernel->init([
    'debug' => true,
    'cacheDir' => __DIR__.'/cache',
    'includePaths' => [__DIR__.'/../src/lib/']
]);