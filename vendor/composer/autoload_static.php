<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitcbb1d516dfec0be1ea742758c889c838
{
    public static $files = array (
        'e88992873b7765f9b5710cab95ba5dd7' => __DIR__ . '/..' . '/hoa/consistency/Prelude.php',
        '3e76f7f02b41af8cea96018933f6b7e3' => __DIR__ . '/..' . '/hoa/protocol/Wrapper.php',
    );

    public static $prefixLengthsPsr4 = array (
        'H' => 
        array (
            'Hoa\\Zformat\\' => 12,
            'Hoa\\Xyl\\' => 8,
            'Hoa\\Xml\\' => 8,
            'Hoa\\Visitor\\' => 12,
            'Hoa\\View\\' => 9,
            'Hoa\\Ustring\\' => 12,
            'Hoa\\Stringbuffer\\' => 17,
            'Hoa\\Stream\\' => 11,
            'Hoa\\Router\\' => 11,
            'Hoa\\Regex\\' => 10,
            'Hoa\\Realdom\\' => 12,
            'Hoa\\Protocol\\' => 13,
            'Hoa\\Praspel\\' => 12,
            'Hoa\\Math\\' => 9,
            'Hoa\\Locale\\' => 11,
            'Hoa\\Iterator\\' => 13,
            'Hoa\\Http\\' => 9,
            'Hoa\\File\\' => 9,
            'Hoa\\Exception\\' => 14,
            'Hoa\\Event\\' => 10,
            'Hoa\\Dispatcher\\' => 15,
            'Hoa\\Devtools\\' => 13,
            'Hoa\\Console\\' => 12,
            'Hoa\\Consistency\\' => 16,
            'Hoa\\Compiler\\' => 13,
            'Hoa\\Cli\\' => 8,
        ),
        'A' => 
        array (
            'Alfred\\Workflows\\' => 17,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Hoa\\Zformat\\' => 
        array (
            0 => __DIR__ . '/..' . '/hoa/zformat',
        ),
        'Hoa\\Xyl\\' => 
        array (
            0 => __DIR__ . '/..' . '/hoa/xyl',
        ),
        'Hoa\\Xml\\' => 
        array (
            0 => __DIR__ . '/..' . '/hoa/xml',
        ),
        'Hoa\\Visitor\\' => 
        array (
            0 => __DIR__ . '/..' . '/hoa/visitor',
        ),
        'Hoa\\View\\' => 
        array (
            0 => __DIR__ . '/..' . '/hoa/view',
        ),
        'Hoa\\Ustring\\' => 
        array (
            0 => __DIR__ . '/..' . '/hoa/ustring',
        ),
        'Hoa\\Stringbuffer\\' => 
        array (
            0 => __DIR__ . '/..' . '/hoa/stringbuffer',
        ),
        'Hoa\\Stream\\' => 
        array (
            0 => __DIR__ . '/..' . '/hoa/stream',
        ),
        'Hoa\\Router\\' => 
        array (
            0 => __DIR__ . '/..' . '/hoa/router',
        ),
        'Hoa\\Regex\\' => 
        array (
            0 => __DIR__ . '/..' . '/hoa/regex',
        ),
        'Hoa\\Realdom\\' => 
        array (
            0 => __DIR__ . '/..' . '/hoa/realdom',
        ),
        'Hoa\\Protocol\\' => 
        array (
            0 => __DIR__ . '/..' . '/hoa/protocol',
        ),
        'Hoa\\Praspel\\' => 
        array (
            0 => __DIR__ . '/..' . '/hoa/praspel',
        ),
        'Hoa\\Math\\' => 
        array (
            0 => __DIR__ . '/..' . '/hoa/math',
        ),
        'Hoa\\Locale\\' => 
        array (
            0 => __DIR__ . '/..' . '/hoa/locale',
        ),
        'Hoa\\Iterator\\' => 
        array (
            0 => __DIR__ . '/..' . '/hoa/iterator',
        ),
        'Hoa\\Http\\' => 
        array (
            0 => __DIR__ . '/..' . '/hoa/http',
        ),
        'Hoa\\File\\' => 
        array (
            0 => __DIR__ . '/..' . '/hoa/file',
        ),
        'Hoa\\Exception\\' => 
        array (
            0 => __DIR__ . '/..' . '/hoa/exception',
        ),
        'Hoa\\Event\\' => 
        array (
            0 => __DIR__ . '/..' . '/hoa/event',
        ),
        'Hoa\\Dispatcher\\' => 
        array (
            0 => __DIR__ . '/..' . '/hoa/dispatcher',
        ),
        'Hoa\\Devtools\\' => 
        array (
            0 => __DIR__ . '/..' . '/hoa/devtools',
        ),
        'Hoa\\Console\\' => 
        array (
            0 => __DIR__ . '/..' . '/hoa/console',
        ),
        'Hoa\\Consistency\\' => 
        array (
            0 => __DIR__ . '/..' . '/hoa/consistency',
        ),
        'Hoa\\Compiler\\' => 
        array (
            0 => __DIR__ . '/..' . '/hoa/compiler',
        ),
        'Hoa\\Cli\\' => 
        array (
            0 => __DIR__ . '/..' . '/hoa/cli',
        ),
        'Alfred\\Workflows\\' => 
        array (
            0 => __DIR__ . '/..' . '/joetannenbaum/alfred-workflow/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitcbb1d516dfec0be1ea742758c889c838::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitcbb1d516dfec0be1ea742758c889c838::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
