<?php

//This is a sample configuration file
return [
    'site' => [
        'HOST' => $_SERVER['HTTP_HOST'],
        'DOC_ROOT' => $_SERVER['DOCUMENT_ROOT'],
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
