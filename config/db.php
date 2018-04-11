<?php
/**
 * Данные для подключения к БД
*/

$host = 'localhost';
$db   = 'shopping';
$user = 'root';
$password = 'ghbdtn';
$charset = 'utf8';

return [
    'database' => [
        'name' => $db,
        'username' => $user,
        'password' => $password,
        'connection' => "mysql:host=$host;charset=$charset",
        'options' => [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]
    ]
];
