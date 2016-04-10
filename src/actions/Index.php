<?php

namespace tomasz\legacy\actions;

use tomasz\legacy\framework\Action;

class Index extends Action
{
    public function handleIndex()
    {
        return "Hello world!";
    }

    public function handleHello()
    {
        return "How are you?";
    }
}