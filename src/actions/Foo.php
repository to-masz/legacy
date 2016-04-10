<?php

namespace tomasz\legacy\actions;

use tomasz\legacy\framework\Action;

class Foo extends Action
{
    public function handleBar()
    {
        $value = !empty($_GET['a']) ? $_GET['a'] : 'nothing';
        return \tomasz\legacy\foo\Foo::magic($value);
    }
}