<?php
$servername = "sql308.thsite.top";
$username = "thsi_38097486";
$password = "!uH!cRwa";
$dbname = "thsi_38097486_bdiesantoniomachadotonycg";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Establecer el modo de error de PDO a excepción
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
