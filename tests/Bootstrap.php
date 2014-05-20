<?php

namespace Zrt\Tests;
use Zend_Loader_Autoloader;

error_reporting(E_ALL | E_STRICT);
chdir(__DIR__);

class Bootstrap
{
    protected static $config;
    protected static $bootstrap;

    public static function init()
    {
        set_include_path(
            dirname(__FILE__)."/../library" . PATH_SEPARATOR .
            get_include_path()
        );

        $loader = static::initAutoloader();
        $loader = Zend_Loader_Autoloader::getInstance();
        $loader->registerNamespace('Zrt');

    }

    protected static function initAutoloader()
    {
        $vendorPath = static::findParentPath('vendor');

        if (is_readable($vendorPath . '/autoload.php')) {
            $loader = include $vendorPath . '/autoload.php';
            return $loader;
        }

        throw new RuntimeException('Unable to load composer Run `php composer.phar install`.');
    }

    protected static function findParentPath($path)
    {
        $dir = __DIR__;
        $previousDir = '.';
        while (!is_dir($dir . '/' . $path)) {
            $dir = dirname($dir);
            if ($previousDir === $dir) return false;
            $previousDir = $dir;
        }

        return $dir . '/' . $path;
    }
}

Bootstrap::init();
