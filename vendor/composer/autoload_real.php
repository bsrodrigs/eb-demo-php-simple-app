<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit53517fca6e07a78ac6f2a076cf35d8ba
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        require __DIR__ . '/platform_check.php';

        spl_autoload_register(array('ComposerAutoloaderInit53517fca6e07a78ac6f2a076cf35d8ba', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit53517fca6e07a78ac6f2a076cf35d8ba', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit53517fca6e07a78ac6f2a076cf35d8ba::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}