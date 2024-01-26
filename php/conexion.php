<?php
//conexion


$server = 'localhost';
$username = 'root';
$password = '';
$database = 'bdcine';

try {
    $conexion = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
} catch (PDOException $e) {
    die('Connection Failed: ' . $e->getMessage());
}
