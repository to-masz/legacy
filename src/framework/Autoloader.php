<?php


namespace tomasz\legacy\framework;

spl_autoload_register(array(
    Autoloader::class,
    'autoload'
));
class Autoloader
{
    public static function autoload($className)
    {
        $classNameParts = explode("\\", $className);
        $pathParts = array_filter($classNameParts, function ($value){
            return !in_array($value, ["tomasz", "legacy"]);
        });

        $options = [];
        $options[] = $pathParts;
        $options[] = ['lib'] + $pathParts;
        foreach ($options as $optionPathParts) {
            $classPath = PROJECT_DIR . DS . implode(DS, $optionPathParts) . ".php";

            if (file_exists($classPath)) {
                require_once $classPath;
                return true;
            }
        }

        throw new \Exception("$className not found");
        return false;
    }
}