<?php


$host='127.0.0.1';
$db='bootcamp';
$user=DB_USER;
$pass=DB_PASS;
$charset='utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset"; //the data source name is equal to driver:host; database name; characterset
$options = [ //standard PHP Document Object (PDO) options
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
try {// A try-catch block similar to if statement that says connection to the database is a failure or not and give an error message
     $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
     throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
