<?php
if($_SERVER['REMOTE_ADDR'] == '127.0.0.1') {
    return [
        'class' => 'yii\db\Connection',
        'dsn' => 'mysql:host=localhost;dbname=lookatthis',
        'username' => 'root',
        'password' => 'qwerty',
        'charset' => 'utf8',
    ];
}else{
    return [
        'class' => 'yii\db\Connection',
        'dsn' => 'mysql:host=localhost;dbname=lookatthis',
        'username' => 'root',
        'password' => 'qwerty123',
        'charset' => 'utf8',
    ];
}
