<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit927a6ab9cfb295c89b5f85e7bd37b2ae
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'ArielMejiaDev\\LarapexCharts\\' => 28,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'ArielMejiaDev\\LarapexCharts\\' => 
        array (
            0 => __DIR__ . '/..' . '/arielmejiadev/larapex-charts/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit927a6ab9cfb295c89b5f85e7bd37b2ae::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit927a6ab9cfb295c89b5f85e7bd37b2ae::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit927a6ab9cfb295c89b5f85e7bd37b2ae::$classMap;

        }, null, ClassLoader::class);
    }
}
