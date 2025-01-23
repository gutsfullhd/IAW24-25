<?php
session_start();
require 'connect.php';

if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit();
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
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

 
    if ($conn) {
     
        $query = "UPDATE actividades 
                  SET titulo = ?, tipo = ?, departamento = ?, profesor_responsable = ?, trimestre = ?, fecha_inicio = ?, hora_inicio = ?, fecha_fin = ?, hora_fin = ?, organizador = ?, acompanantes = ?, ubicacion = ?, costo = ?, total_alumnos = ?, objetivo = ? 
                  WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);

        if ($stmt) {
          
            mysqli_stmt_bind_param($stmt, "sssssssssssssssi", $titulo, $tipo, $departamento, $profesor_responsable, $trimestre, $fecha_inicio, $hora_inicio, $fecha_fin, $hora_fin, $organizador, $acompanantes, $ubicacion, $costo, $total_alumnos, $objetivo, $id);

            if (mysqli_stmt_execute($stmt)) {
              
                header('Location: dashboard.php');
                exit();
            } else {
                echo "Error al actualizar la actividad: " . mysqli_stmt_error($stmt);
            }

        
            mysqli_stmt_close($stmt);
        } else {
            echo "Error al preparar la consulta: " . mysqli_error($conn);
        }
    } else {
        die("Error de conexión: " . mysqli_connect_error());
    }

    
    mysqli_close($conn);
}
?>
