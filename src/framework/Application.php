<?php

namespace tomasz\legacy\framework;

use FastRoute\Dispatcher;
use FastRoute\RouteCollector;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\ServerRequestFactory;
use function FastRoute\simpleDispatcher;

class Application
{
    private $request;
    private $dispatcher;

    public function __construct($config)
    {
        define('PROJECT_DIR', substr(dirname(__FILE__), 0, -10));
        define('DS', DIRECTORY_SEPARATOR);

        $this->request = ServerRequestFactory::fromGlobals($_SERVER, $_GET, $_POST, $_COOKIE, $_FILES);
        $this->dispatcher = simpleDispatcher(function (RouteCollector $routeCollector) use ($config) {
            foreach ($config['routing'] as $route) {
                $routeCollector->addRoute($route[0], $route[1], $route[2]);
            }
        });
    }

    public function handleRequest()
    {
        $routeInfo = $this->dispatcher->dispatch($this->request->getMethod(), $this->request->getUri()->getPath());
        switch ($routeInfo[0]) {
            case Dispatcher::FOUND:
                $handlerClass = $routeInfo[1][0];
                $handlerAction = $routeInfo[1][1];
                $pathVariables = $routeInfo[2];
                $pathVariables[] = $this->request;
                $handler = new $handlerClass();
                $response = call_user_func_array([$handler, $handlerAction], $pathVariables);
                $this->output($response ?: new EmptyResponse());
                return;
        }


        Routing::analyzeUrl();

        ob_start();
        $class = Routing::getClassName(Routing::getAction());
        $object = new $class();
        $object->output();
        $content = ob_get_clean();

        echo $content;
    }

    private function output(ResponseInterface $response)
    {
        header("HTTP/" . $response->getProtocolVersion() . ' ' . $response->getStatusCode() . ' ' . $response->getReasonPhrase());
        foreach ($response->getHeaders() as $headerName => $headerValue) {
            $headerValue = $headerValue[0];
            header("$headerName: $headerValue");
        }
        echo $response->getBody();
    }
}