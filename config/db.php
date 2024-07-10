<?php
$host = $_ENV['MYSQL_HOST'];
$dbname = $_ENV['MYSQL_DATABASE'];
$username = $_ENV['MYSQL_USER'];
$password = $_ENV['MYSQL_PASSWORD'];

return [
    'class' => 'yii\db\Connection',
    'dsn' => "mysql:host={$host};dbname={$dbname}",
    'username' => $username,
    'password' => $password,
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
