<?php

declare(strict_types=1);

$servername = "db";
$username = "root";
$password = "password";

try {
    $conn = new PDO("mysql:host=$servername;dbname=cms", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->query('SELECT * FROM `test`');
    // var_dump($stmt->fetchAll(PDO::FETCH_ASSOC));
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
