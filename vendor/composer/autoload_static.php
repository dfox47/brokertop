<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit4f881319cdbed110d677c8050e063675
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'AmoCRM\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'AmoCRM\\' => 
        array (
            0 => __DIR__ . '/..' . '/dotzero/amocrm/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit4f881319cdbed110d677c8050e063675::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit4f881319cdbed110d677c8050e063675::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
