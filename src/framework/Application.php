<?php

namespace tomasz\legacy\framework;

class Application
{
    public function __construct()
    {
        define('PROJECT_DIR', substr(dirname(__FILE__), 0, -10));
        define('DS', DIRECTORY_SEPARATOR);
        $this->initFramework();
    }

    public function handleRequest()
    {
        Routing::analyzeUrl();

        ob_start();
        $class = Routing::getClassName(Routing::getAction());
        $object = new $class();
        $object->output();
        $content = ob_get_clean();

        echo $content;
    }
    
    private function initFramework()
    {
        require_once PROJECT_DIR . DS . 'framework' . DS . 'Autoloader.php';
    }
    
}