<?php

namespace tomasz\legacy\functional;

class PageTest extends \PHPUnit_Framework_TestCase
{
    use SeleniumTrait;

    public function testHelloAction()
    {
        $this->openUrl('/index/hello');
        sleep(10);
        $result = strip_tags($this->getWebDriver()->getPageSource());

        $this->assertEquals("How are you?", $result);
    }

    public function testIndexAction()
    {
        $this->openUrl('/');

        $result = strip_tags($this->getWebDriver()->getPageSource());

        $this->assertEquals("Hello world!", $result);
    }

    public function testFooAction()
    {
        $this->openUrl('/foo/bar/?a=hello');

        $result = strip_tags($this->getWebDriver()->getPageSource());

        $this->assertEquals("HELLO", $result);
    }

    protected function tearDown()
    {
        $this->getWebDriver()->quit();
    }


}