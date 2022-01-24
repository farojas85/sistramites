<?php

return [
    'conexiones'  => [
        'mysql' => [
            'dsn' => 'mysql:host='. DB_HOST.';dbname='.DB_NAME.'',
            'username' => DB_USER,
            'password' => DB_PASS,
            'prefix' => null,
            'collation' => 'utf8',
            'options' => [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
                PDO::ATTR_EMULATE_PREPARES => false
            ]
        ]
    ]
];