<?php

namespace tomasz\legacy\framework;

class Routing
{
    private static $uri;
    private static $action;
    private static $method;
    private static $actionReflection;

    public static function analyzeUrl()
    {
        self::$uri = isset($_SERVER['REQUEST_URI']) ? urldecode($_SERVER['REQUEST_URI']) : '';
        $paths = explode("/", ltrim(self::$uri, "/"));
        self::$action = !empty($paths[0]) ? $paths[0] : "index";
        self::$method = !empty($paths[1]) ? $paths[1] : "index";
    }

    public static function getAction()
    {
        return self::$action;
    }

    public static function getMethod()
    {
        return self::$method;
    }

    public static function getClassName()
    {
        $baseNamespace = substr(__NAMESPACE__, 0, strpos(__NAMESPACE__, "\\framework"));
        return $baseNamespace . "\\actions\\" . ucfirst(self::$action);
    }

    public static function getActionReflection()
    {
        if (self::$actionReflection === null) {
            self::$actionReflection = new \ReflectionClass(static::getClassName(self::$action));
        }
        return self::$actionReflection;
    }
}