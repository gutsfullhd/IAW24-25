<?php
session_start();
require 'connect.php';


error_reporting(E_ALL);
ini_set('display_errors', 1);


if (!isset($_SESSION['id'])) {
    echo "Error: No se ha iniciado sesión. Redirigiendo a login.php...";
    header('Location: login.php');
    exit();
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo "Formulario recibido.<br>";

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

    echo "Datos del formulario recogidos.<br>";

    if ($conn) {
        echo "Conexión a la base de datos establecida.<br>";

     
        $query = "INSERT INTO actividades (titulo, tipo, departamento, profesor_responsable, trimestre, fecha_inicio, hora_inicio, fecha_fin, hora_fin, organizador, acompanantes, ubicacion, costo, total_alumnos, objetivo) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);

        if ($stmt) {
            echo "Consulta preparada correctamente.<br>";

            
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

            echo "Parámetros vinculados.<br>";

            if (mysqli_stmt_execute($stmt)) {
                echo "Actividad creada correctamente.<br>";
                header('Location: actividades.php');
                exit();
            } else {
                echo "Error al ejecutar la consulta: " . mysqli_error($conn) . "<br>";
            }

           
            mysqli_stmt_close($stmt);
        } else {
            echo "Error al preparar la consulta: " . mysqli_error($conn) . "<br>";
        }
    } else {
        echo "Error de conexión: " . mysqli_connect_error() . "<br>";
    }

    mysqli_close($conn);
} else {
    echo "Error: El formulario no se envió correctamente.<br>";
}
?>