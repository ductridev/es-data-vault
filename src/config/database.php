<?php
global $dbconfig, $dotenv, $db;

$dbconfig = array(
    'prefix' => !empty($_ENV['PREFIX']) ?? 'dv_',
    'host' => !empty($_ENV['HOST']) ?? 'localhost',
    'port' => !empty($_ENV['PORT']) ??'3306',
    'dbdriver' => !empty($_ENV['dbdriver']) ?? 'sql',
    'dbname' => !empty($_ENV['DBNAME']) ?? 'datavault',
    'username' => !empty($_ENV['USERNAME']) ?? 'root',
    'password' => !empty($_ENV['PASSWORD']) ?? '',
    'secret' => !empty($_ENV['SECRET']) ?? 'datavault@!secure',
    'secure' => !empty($_ENV['SECURE']) ?? false,
    'whitelist' => !empty($_ENV['WHITELIST']) ? explode(',', trim($_ENV['WHITELIST'])) : array(),
);