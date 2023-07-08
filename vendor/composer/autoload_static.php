<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf0a7762fa5c992c47b96ebee7e73b904
{
    public static $files = array (
        '55a24367d686f81f8f40617ef0e6ad51' => __DIR__ . '/../..' . '/src/config.php',
        '3075c3686282079ab7f01c9ffad59a18' => __DIR__ . '/../..' . '/src/helpers.php',
    );

    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitf0a7762fa5c992c47b96ebee7e73b904::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitf0a7762fa5c992c47b96ebee7e73b904::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitf0a7762fa5c992c47b96ebee7e73b904::$classMap;

        }, null, ClassLoader::class);
    }
}
