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

    if ($tipo !== 'complementarias' && $tipo !== 'extraescolares') {
        die("Error: El tipo de actividad no es válido.");
    }

    
    if (!in_array($trimestre, ['1', '2', '3'])) {
        die("Error: El trimestre no es válido.");
    }


    if ($conn) {

        $query = "INSERT INTO actividades (titulo, tipo, departamento, profesor_responsable, trimestre, fecha_inicio, hora_inicio, fecha_fin, hora_fin, organizador, acompanantes, ubicacion, costo, total_alumnos, objetivo) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);

        if ($stmt) {

            mysqli_stmt_bind_param(
                $stmt,
                "sssssssssssssis",
                $titulo,
                $tipo,
                $departamento,
                $profesor_responsable,
                $trimestre,
                $fecha_inicio,
                $hora_inicio,
                $fecha_fin,
                $hora_fin,
                $organizador,
                $acompanantes,
                $ubicacion,
                $costo,
                $total_alumnos,
                $objetivo
            );

            
            if (mysqli_stmt_execute($stmt)) {
               
                header('Location: actividades.php');
                exit();
            } else {
               
                echo "Error al ejecutar la consulta: " . mysqli_error($conn);
            }

         
            mysqli_stmt_close($stmt);
        } else {
            
            echo "Error al preparar la consulta: " . mysqli_error($conn);
        }
    } else {
     
        die("Error de conexión: " . mysqli_connect_error());
    }

   
    mysqli_close($conn);
} else {
   
    header('Location: actividades.php');
    exit();
}
?>