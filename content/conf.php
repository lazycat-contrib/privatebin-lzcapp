<?php
// PrivateBin configuration for the LazyCat community package.
//
// Upstream defaults are kept; the changes below only adapt the instance to a
// single-container deployment behind the LazyCat HTTPS entry.
return array(
    'debug' => false,

    'bin' => array(
        // Filesystem storage under the single bound data directory.
        'ds' => 'files',
        'path' => '/srv/data',
    ),

    'formatter_options' => array(
        'template' => 'bootstrap',
    ),

    'main' => array(
        'name' => 'PrivateBin',
        'opendiscussion' => false,
        'expire' => array(
            'default' => '1day',
        ),
        'expire_options' => array(
            '5min' => 300,
            '1hour' => 3600,
            '1day' => 86400,
            '1week' => 604800,
            '1month' => 2592000,
            'never' => 0,
        ),
        'formatter' => 'syntaxhighlighting',
        'syntaxhighlightingtheme' => 'github',
        'notice' => '',
        'languageselection' => true,
        'languages' => array(
            'zh',
            'en',
        ),
        'defaultlanguage' => 'zh',
        'size' => 10485760,
    ),

    'security' => array(
        // The LazyCat entry already terminates TLS in front of this service.
        'serveoverhttps' => false,
        'hstsheader' => '',
        'create' => array(
            'enabled' => true,
            'rate' => '1',
            'time' => '5',
        ),
    ),

    'model' => array(
        'class' => 'Filesystem',
    ),

    'model_options' => array(
        'dir' => '/srv/data',
    ),
);
