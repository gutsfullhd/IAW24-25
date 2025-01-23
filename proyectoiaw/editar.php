<?php
session_start();
require 'connect.php';


if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit();
}


$id = $_GET['id'];


$actividad = null;

if ($conn) {
    
    $query = "SELECT * FROM actividades WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
   
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

       
        $actividad = mysqli_fetch_assoc($result);

       
        mysqli_stmt_close($stmt);
    } else {
        echo "Error al preparar la consulta: " . mysqli_error($conn);
    }
} else {
    die("Error de conexión: " . mysqli_connect_error());
}


mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Actividad</title>
</head>
<body>
    <h1>Editar Actividad</h1>
    <?php if ($actividad): ?>
        <form method="POST" action="update_activity.php">
            <input type="hidden" name="id" value="<?php echo $actividad['id']; ?>">
            <label>Título:</label>
            <input type="text" name="titulo" value="<?php echo $actividad['titulo']; ?>" required><br>
            <label>Tipo:</label>
            <input type="text" name="tipo" value="<?php echo $actividad['tipo']; ?>" required><br>
            <label>Departamento:</label>
            <input type="text" name="departamento" value="<?php echo $actividad['departamento']; ?>" required><br>
            <label>Profesor Responsable:</label>
            <input type="text" name="profesor_responsable" value="<?php echo $actividad['profesor_responsable']; ?>" required><br>
            <label>Trimestre:</label>
            <input type="text" name="trimestre" value="<?php echo $actividad['trimestre']; ?>" required><br>
            <label>Fecha Inicio:</label>
            <input type="date" name="fecha_inicio" value="<?php echo $actividad['fecha_inicio']; ?>" required><br>
            <label>Hora Inicio:</label>
            <input type="time" name="hora_inicio" value="<?php echo $actividad['hora_inicio']; ?>" required><br>
            <label>Fecha Fin:</label>
            <input type="date" name="fecha_fin" value="<?php echo $actividad['fecha_fin']; ?>" required><br>
            <label>Hora Fin:</label>
            <input type="time" name="hora_fin" value="<?php echo $actividad['hora_fin']; ?>" required><br>
            <label>Organizador:</label>
            <input type="text" name="organizador" value="<?php echo $actividad['organizador']; ?>" required><br>
            <label>Acompañantes:</label>
            <input type="text" name="acompanantes" value="<?php echo $actividad['acompanantes']; ?>" required><br>
            <label>Ubicación:</label>
            <input type="text" name="ubicacion" value="<?php echo $actividad['ubicacion']; ?>" required><br>
            <label>Costo:</label>
            <input type="text" name="costo" value="<?php echo $actividad['costo']; ?>" required><br>
            <label>Total Alumnos:</label>
            <input type="number" name="total_alumnos" value="<?php echo $actividad['total_alumnos']; ?>" required><br>
            <label>Objetivo:</label>
            <input type="text" name="objetivo" value="<?php echo $actividad['objetivo']; ?>" required><br>
            <button type="submit">Actualizar</button>
        </form>
    <?php else: ?>
        <p style="color:red;">La actividad no existe o no se pudo cargar.</p>
    <?php endif; ?>
</body>
</html>

