<?php

namespace tomasz\legacy\actions;

use AspectMock\Test as test;
use tomasz\legacy\foo\Foo as FooLib;

class FooTest extends \PHPUnit_Framework_TestCase
{
    public function testHandleBar_ExistsAGetParameter_ReturnUppercaseValue()
    {
        $value = 'test';
        $expected = 'TEST';
        $_GET['a'] = $value;
        test::double(FooLib::class, ['magic' => 'TEST']);

        $sut = test::double(Foo::class)->construct();
        $result = $sut->handleBar();

        $this->assertEquals($expected, $result);
    }
}