<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DISK', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],

        'mirui-static' => [
            'driver' => 'local',
            'root' => storage_path('app/mirui/static'),
            'url' => env('APP_URL').'/src/mirui/static',
            'visibility' => 'public',
        ],

        'mirui-static-priv' => [
            'driver' => 'local',
            'root' => storage_path('app/mirui/static/priv'),
            'url' => env('APP_URL').'/src/mirui/static/priv',
            'visibility' => 'private',
        ],

        'mirui-tmp' => [
            'driver' => 'local',
            'root' => storage_path('app/mirui/playground'),
            'url' => env('APP_URL').'/src/mirui/playground',
            'visibility' => 'private',
        ],

        // 'mirui-static-movie' => [
        //     'driver' => 'local',
        //     'root' => storage_path('app/mirui/static/movie'),
        //     'url' => env('APP_URL').'/src/mirui/static/movie',
        //     'visibility' => 'public',
        // ],

        // 'mirui-static-user' => [
        //     'driver' => 'local',
        //     'root' => storage_path('app/mirui/static/user'),
        //     'url' => env('APP_URL').'/src/mirui/static/user',
        //     'visibility' => 'private',
        // ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    'links' => [
        public_path('src/mirui/static') => storage_path('app/mirui/static'),
        public_path('src/mirui/playground') => storage_path('app/mirui/playground'),
    ],

];
