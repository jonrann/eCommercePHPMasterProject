<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInited92cb6f7baa4f1c91a40dc307de715d
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

        spl_autoload_register(array('ComposerAutoloaderInited92cb6f7baa4f1c91a40dc307de715d', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInited92cb6f7baa4f1c91a40dc307de715d', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInited92cb6f7baa4f1c91a40dc307de715d::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
