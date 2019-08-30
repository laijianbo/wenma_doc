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

    'default' => env('FILESYSTEM_DRIVER', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Default Cloud Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Many applications store files both locally and in the cloud. For this
    | reason, you may specify a default "cloud" driver here. This driver
    | will be bound as the Cloud disk implementation in the container.
    |
    */

    'cloud' => env('FILESYSTEM_CLOUD', 's3'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    | Supported Drivers: "local", "ftp", "s3", "rackspace"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root'   => env('DISK_ROOT', storage_path('app')),
        ],

        'public' => [
            'driver'     => 'local',
            'root'       => env('PUBLIC_DISK_ROOT', storage_path('app/public')),
            'url'        => env('APP_URL') . '/storage',
            'visibility' => 'public',
        ],

        'qiniu' => [
            'driver'                 => 'qiniu',
            'domains'                => [
                'default' => 'oss.ruirio.cn',   // 你的七牛域名
                'https'   => 'oss.ruirio.cn',   // 你的HTTPS域名
                'custom'  => '',
            ],
            'access_key'             => 'YG9G0lFIJp1cKpglRrgcUTesE_H2ckDO6QwsczB3',  // AccessKey
            'secret_key'             => 'pR9dOsTmVsMSklZd7SiM1N6NyxWFh7AaqxRi_sqG',  // SecretKey
            'bucket'                 => 'resource-bkt',  // Bucket名字
            'notify_url'             => '/',  //持久化处理回调地址
            'access'                 => 'public',  //空间访问控制 public 或 private
            'hotlink_prevention_key' => '', // CDN 时间戳防盗链的 key。 设置为 null 则不启用本功能。
        ],

        's3' => [
            'driver' => 's3',
            'key'    => env('AWS_KEY'),
            'secret' => env('AWS_SECRET'),
            'region' => env('AWS_REGION'),
            'bucket' => env('AWS_BUCKET'),
        ],

    ],

];
