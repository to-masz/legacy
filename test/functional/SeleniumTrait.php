<?php
/**
 * Created by PhpStorm.
 * User: tomasz.gramza
 * Date: 10/04/16
 * Time: 22:41
 */

namespace tomasz\legacy\functional;


use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;

trait SeleniumTrait
{
    private $driver;

    public function getWebDriver()
    {
        if ($this->driver === null) {
            $host = 'http://192.168.99.100:32772/wd/hub';
            $this->driver = RemoteWebDriver::create($host, DesiredCapabilities::chrome());
        }

        return $this->driver;
    }

    public function openUrl($url)
    {
        $this->getWebDriver()->get('http://192.168.99.1:8088' . $url);
    }
}