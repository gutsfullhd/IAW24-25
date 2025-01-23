<?php
session_start();
require 'connect.php';

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit();
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

  
    if ($conn) {
       
        $query = "DELETE FROM actividades WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);

        if ($stmt) {
            
            mysqli_stmt_bind_param($stmt, "i", $id);
            if (mysqli_stmt_execute($stmt)) {
                
                header('Location: dashboard.php');
                exit();
            } else {
                echo "Error al eliminar la actividad: " . mysqli_stmt_error($stmt);
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

