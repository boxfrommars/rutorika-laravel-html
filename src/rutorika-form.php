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
                'rules' => 'required|image|max:3072' // in Kb
            ],
            'image' => [
                'rules' => 'required|image|max:3072'
            ],
            'document' => [
                'rules' => 'required|mimes:doc,pdf,docs,txt'
            ],
            'audio' => [
                'rules' => 'required|mimes:mpga,wav,ogg|max:3072'
            ],
            'video' => [
                'rules' => 'mimes:m4v,avi,flv,mp4,mov,wmv,3gp|max:3072'
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