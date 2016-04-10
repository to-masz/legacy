<?php

namespace tomasz\legacy\framework;

class Action
{
    public function output()
    {
        $methodName = 'pre' . ucfirst(Routing::getMethod());
        if (Routing::getActionReflection()->hasMethod($methodName))
        {
            $this->$methodName();
        }
        $methodName = 'handle' . ucfirst(Routing::getMethod());
        $res = $this->$methodName();
        echo $res;
    }
}