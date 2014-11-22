<?php

namespace Panda\Core;

/**
 * Class Autoloader
 * @package Panda\Core
 */
class Autoloader
{
    public static function register($prepend = false)
    {
        if (version_compare(phpversion(), '5.3.0', '>=')) {
            spl_autoload_register(array(__CLASS__, 'autoload'), true, $prepend);
        } else {
            spl_autoload_register(array(__CLASS__, 'autoload'));
        }
    }

    public static function autoload($class)
    {
        if (0 === strpos($class, APP_NAMESPACE)) {
            $filePath = BUNDLES_DIR . str_replace('\\', '/', str_replace(APP_NAMESPACE, '', $class));
        } else {
            return;
        }

        if (is_file($filePath . '.php')) {
            require $filePath . '.php';
        }
    }
}