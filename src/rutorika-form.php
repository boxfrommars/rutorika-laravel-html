<?php

return [
    'theme' => 'bootstrap-horizontal', // 'bootstrap'

    'themes' => [
        'bootstrap-horizontal' => '\Rutorika\Html\Theme\BootstrapHorizontal',
        'bootstrap-vertical' => '\Rutorika\Html\Theme\Bootstrap',
    ],

    'public_storage_path' => 'storage',
    'default_upload_url' => '/upload',

    // upload configuration. used in UploadController only, so if you don't use UploadController,
    // you may not rely on this config and implement your own validation
    'upload' => [
        'types' => [
            'default' => [
                'rules' => 'required|image'
            ],
            'image' => [
                'rules' => 'required|image'
            ],
            'doc' => [
                'rules' => 'required|mimes:mp3,wav,ogg'
            ],
            'audio' => [
                'rules' => 'required|mimes:mp3,wav,ogg'
            ],
            'video' => [
                'rules' => 'mimes:m4v,avi,flv,mp4,mov,wmv,3gp'
            ]
        ]
    ],

    // @see https://eonasdan.github.io/bootstrap-datetimepicker/Options/#showclear
    'datetime' => [
//        'sideBySide' => true,
//        'showTodayButton' => true,
//        'showClear' => true,
    ],
];