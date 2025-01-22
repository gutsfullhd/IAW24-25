<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];
$stmt = $conn->prepare("DELETE FROM actividades WHERE id = :id");
$stmt->bindParam(':id', $id);
$stmt->execute();

header("Location: veractividades.php");
exit();
?>
