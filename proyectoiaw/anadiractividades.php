<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST['titulo'];
    $tipo = $_POST['tipo'];
    $departamento = $_POST['departamento'];
    $profesor_responsable = $_POST['profesor_responsable'];
    $trimestre = $_POST['trimestre'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $hora_inicio = $_POST['hora_inicio'];
    $fecha_fin = $_POST['fecha_fin'];
    $hora_fin = $_POST['hora_fin'];
    $organizador = $_POST['organizador'];
    $acompañantes = $_POST['acompañantes'];
    $ubicacion = $_POST['ubicacion'];
    $coste = $_POST['coste'];
    $total_alumnos = $_POST['total_alumnos'];
    $objetivo = $_POST['objetivo'];

    $stmt = $conn->prepare("INSERT INTO actividades (titulo, tipo, departamento, profesor_responsable, trimestre, fecha_inicio, hora_inicio, fecha_fin, hora_fin, organizador, acompañantes, ubicacion, coste, total_alumnos, objetivo) VALUES (:titulo, :tipo, :departamento, :profesor_responsable, :trimestre, :fecha_inicio, :hora_inicio, :fecha_fin, :hora_fin, :organizador, :acompañantes, :ubicacion, :coste, :total_alumnos, :objetivo)");
    $stmt->bindParam(':titulo', $titulo);
    $stmt->bindParam(':tipo', $tipo);
    $stmt->bindParam(':departamento', $departamento);
    $stmt->bindParam(':profesor_responsable', $profesor_responsable);
    $stmt->bindParam(':trimestre', $trimestre);
    $stmt->bindParam(':fecha_inicio', $fecha_inicio);
    $stmt->bindParam(':hora_inicio', $hora_inicio);
    $stmt->bindParam(':fecha_fin', $fecha_fin);
    $stmt->bindParam(':hora_fin', $hora_fin);
    $stmt->bindParam(':organizador', $organizador);
    $stmt->bindParam(':acompañantes', $acompañantes);
    $stmt->bindParam(':ubicacion', $ubicacion);
    $stmt->bindParam(':coste', $coste);
    $stmt->bindParam(':total_alumnos', $total_alumnos);
    $stmt->bindParam(':objetivo', $objetivo);
    $stmt->execute();

    header("Location: veractividades.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Añadir Actividad</title>
</head>
<body>
    <h1>Añadir Actividad</h1>
    <form method="POST" action="anadiractividades.php">
        <label>Título:</label>
        <input type="text" name="titulo" required><br>
        <label>Tipo:</label>
        <select name="tipo" required>
            <option value="extraescolar">Extraescolar</option>
            <option value="complementaria">Complementaria</option>
        </select><br>
        <label>Departamento:</label>
        <input type="text" name="departamento" required><br>
        <label>Profesor Responsable:</label>
        <input type="text" name="profesor_responsable" required><br>
        <label>Trimestre:</label>
        <select name="trimestre" required>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
        </select><br>
        <label>Fecha Inicio:</label>
        <input type="date" name="fecha_inicio" required><br>
        <label>Hora Inicio:</label>
        <input type="time" name="hora_inicio" required><br>
        <label>Fecha Fin:</label>
        <input type="date" name="fecha_fin" required><br>
        <label>Hora Fin:</label>
        <input type="time" name="hora_fin" required><br>
        <label>Organizador:</label>
        <input type="text" name="organizador" required><br>
        <label>Acompañantes:</label>
        <textarea name="acompañantes"></textarea><br>
        <label>Ubicación:</label>
        <input type="text" name="ubicacion" required><br>
        <label>Coste:</label>
        <input type="number" step="0.01" name="coste" required><br>
        <label>Total Alumnos:</label>
        <input type="number" name="total_alumnos" required><br>
        <label>Objetivo:</label>
        <textarea name="objetivo" required></textarea><br>
        <button type="submit">Añadir Actividad</button>
    </form>
    <a href="dashboard.php">Volver al Dashboard</a>
</body>
</html>
