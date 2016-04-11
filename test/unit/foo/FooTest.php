<?php

namespace tomasz\legacy\foo;

class FooTest extends \PHPUnit_Framework_TestCase
{
    public function testMagic_SingleWordIsGiven_ReturnUppercaseWord()
    {
        $value = 'test';
        $expected = 'TEST';

        $sut = Foo::class;
        $result = call_user_func([$sut, 'magic'], $value);

        $this->assertEquals($expected, $result);
    }
}