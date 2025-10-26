<?php
$host = "localhost";
$dbname = "portfolio_db"; // your database name
$username = "root";       // default XAMPP/WAMP username
$password = "";           // default XAMPP/WAMP password

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
