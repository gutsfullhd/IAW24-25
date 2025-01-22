<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h1>Dashboard</h1>
    <a href="veractividades.php">Consultar Actividades</a><br>
    <a href="anadiractividades.php">Añadir Actividad</a><br>
    <a href="salir.php">Cerrar Sesión</a>
</body>
</html>

