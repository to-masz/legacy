<?php

namespace tomasz\legacy\framework;

use AspectMock\Test as test;
use FastRoute\Dispatcher;
use tomasz\legacy\actions\Foo;
use Zend\Diactoros\Request;

class ApplicationTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        test::clean();
    }

    public function testHandleRequest_notHandledByNewSystem_CallLegacyAction()
    {
        // new routing return NOT_FOUND
        $dispatcher = test::double(Dispatcher\GroupCountBased::class, ['dispatch' => [Dispatcher::NOT_FOUND]])->make();
        $request = test::spec(Request::class)->construct();
        $privateDispatcher = new \ReflectionProperty(Application::class, 'dispatcher');
        $privateDispatcher->setAccessible(true);
        $privateRequest = new \ReflectionProperty(Application::class, 'request');
        $privateRequest->setAccessible(true);
        // legacy Action output is called
        test::double(Routing::class, ['getClassName' => Foo::class]);
        $fooAction = test::double(Foo::class, ['output' => function() { echo 'test!'; }]);

        $sut = test::double(Application::class)->make();
        $privateDispatcher->setValue($sut, $dispatcher);
        $privateRequest->setValue($sut, $request);
        $sut->handleRequest();

        $fooAction->verifyInvokedOnce('output');
    }
}