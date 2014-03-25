<?php

include "db.php";

$dsn = 'mysql:dbname=test;host=localhost';
$user = "root";
$password = "";

try {
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Connection failed: ' . $e->getMessage());
}

$sql = query("SELECT * FROM pages WHERE id = ?", array(1));
$sql = query("SELECT * FROM pages WHERE id = ?", array(2));
$sql = query("SELECT * FROM pages WHERE id = ?", array(4));
$sql = query("SELECT * FROM pages WHERE id = ?", array(5));

vypisDotazu();