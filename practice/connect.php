<?php

// соединенение с бд
$user = 'root';
$password = '';
$host = 'localhost';
$db = 'registation';
$dbh = 'mysql:host=' . $host . ';dbname=' . $db . ';charset=utf8';

$pdo = new PDO($dbh, $user, $password);