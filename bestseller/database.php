<?php

$server = 'localhost';
$username = 'root';
$password = 'MejorVendedor';
$database = 'bestseller';

try {
  $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
} catch (PDOException $e) {
  die('Connection Failed: ' . $e->getMessage());
}

?>