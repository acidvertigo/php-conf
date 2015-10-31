<?php

//This is a sample configuration file
return [
    'site' => [
        'HOST' => $_SERVER['HTTP_HOST'],
        'DOC_ROOT' => __DIR__,
        'NAME' => 'php-conf'
    ],
    'database' => [
        'HOST' => 'localhost',
        'NAME' => 'shop',
        'USERNAME' => 'root',
        'PASSWORD' => ''
    ],
    'test' => [
        'USERNAME' => 'test',
        'PASSWORD' => 'test2']
    ];
