<?php

return [
    'theme' => 'bootstrap-horizontal', // 'bootstrap'

    'themes' => [
        'bootstrap-horizontal' => '\Rutorika\Html\Theme\BootstrapHorizontal',
        'bootstrap' => '\Rutorika\Html\Theme\Bootstrap',
    ],

    'public_storage_path' => 'storage',
    'default_upload_url' => '/upload',

    // @see https://eonasdan.github.io/bootstrap-datetimepicker/Options/#showclear
    'datetime' => [
//        'sideBySide' => true,
//        'showTodayButton' => true,
//        'showClear' => true,
    ],
];