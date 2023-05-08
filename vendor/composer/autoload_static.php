<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita6f9b9e735859349e0cd73384a7aeb2a
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Symfony\\Component\\Dotenv\\' => 25,
        ),
        'P' => 
        array (
            'Psr\\Log\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Symfony\\Component\\Dotenv\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/dotenv',
        ),
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInita6f9b9e735859349e0cd73384a7aeb2a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInita6f9b9e735859349e0cd73384a7aeb2a::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInita6f9b9e735859349e0cd73384a7aeb2a::$classMap;

        }, null, ClassLoader::class);
    }
}