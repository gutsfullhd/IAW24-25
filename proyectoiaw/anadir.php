<?php
session_start();
require 'connect.php';

if (!isset($_SESSION['id'])) {
    header('Location: login.php');
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
    $acompanantes = $_POST['acompanantes'];
    $ubicacion = $_POST['ubicacion'];
    $costo = $_POST['costo'];
    $total_alumnos = $_POST['total_alumnos'];
    $objetivo = $_POST['objetivo'];

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbuser, $dbpass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("INSERT INTO actividades (titulo, tipo, departamento, profesor_responsable, trimestre, fecha_inicio, hora_inicio, fecha_fin, hora_fin, organizador, acompanantes, ubicacion, costo, total_alumnos, objetivo) VALUES (:titulo, :tipo, :departamento, :profesor_responsable, :trimestre, :fecha_inicio, :hora_inicio, :fecha_fin, :hora_fin, :organizador, :acompanantes, :ubicacion, :costo, :total_alumnos, :objetivo)");
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
        $stmt->bindParam(':acompanantes', $acompanantes);
        $stmt->bindParam(':ubicacion', $ubicacion);
        $stmt->bindParam(':costo', $costo);
        $stmt->bindParam(':total_alumnos', $total_alumnos);
        $stmt->bindParam(':objetivo', $objetivo);
        $stmt->execute();

        header('Location: dashboard.php');
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
