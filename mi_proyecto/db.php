<?php
$servername = "localhost";
$port = 3306; // El puerto de tu servidor MySQL
$username = "root";
$password = "";
$dbname = "mi_tienda";

try {
    $conn = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
