<?php
session_start();
require 'connect.php';

if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit();
}

$id = $_SESSION['id'];

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->query("SELECT * FROM actividades");
    $actividades = $stmt->fetchAll();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h1>Dashboard</h1>
    <a href="salir.php">Salir</a>
    <h2>Crear Actividad</h2>
    <form method="POST" action="anadir.php">
        <input type="hidden" name="create">
        <label>Título:</label>
        <input type="text" name="titulo" required><br>
        <label>Tipo:</label>
        <input type="text" name="tipo" required><br>
        <label>Departamento:</label>
        <input type="text" name="departamento" required><br>
        <label>Profesor Responsable:</label>
        <input type="text" name="profesor_responsable" required><br>
        <label>Trimestre:</label>
        <input type="text" name="trimestre" required><br>
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
        <input type="text" name="acompanantes" required><br>
        <label>Ubicación:</label>
        <input type="text" name="ubicacion" required><br>
        <label>Costo:</label>
        <input type="text" name="costo" required><br>
        <label>Total Alumnos:</label>
        <input type="number" name="total_alumnos" required><br>
        <label>Objetivo:</label>
        <input type="text" name="objetivo" required><br>
        <button type="submit">Crear</button>
    </form>
    <h2>Actividades</h2>
    <?php foreach ($actividades as $actividad): ?>
        <div>
            <h3><?php echo $actividad['titulo']; ?></h3>
            <p>Tipo: <?php echo $actividad['tipo']; ?></p>
            <p>Departamento: <?php echo $actividad['departamento']; ?></p>
            <p>Profesor Responsable: <?php echo $actividad['profesor_responsable']; ?></p>
            <p>Trimestre: <?php echo $actividad['trimestre']; ?></p>
            <p>Fecha Inicio: <?php echo $actividad['fecha_inicio']; ?></p>
            <p>Hora Inicio: <?php echo $actividad['hora_inicio']; ?></p>
            <p>Fecha Fin: <?php echo $actividad['fecha_fin']; ?></p>
            <p>Hora Fin: <?php echo $actividad['hora_fin']; ?></p>
            <p>Organizador: <?php echo $actividad['organizador']; ?></p>
            <p>Acompañantes: <?php echo $actividad['acompanantes']; ?></p>
            <p>Ubicación: <?php echo $actividad['ubicacion']; ?></p>
            <p>Costo: <?php echo $actividad['costo']; ?></p>
            <p>Total Alumnos: <?php echo $actividad['total_alumnos']; ?></p>
            <p>Objetivo: <?php echo $actividad['objetivo']; ?></p>
            <form method="POST" action="eliminar.php" style="display:inline;">
                <input type="hidden" name="id" value="<?php echo $actividad['id']; ?>">
                <button type="submit">Eliminar</button>
            </form>
            <form method="GET" action="editar.php" style="display:inline;">
                <input type="hidden" name="id" value="<?php echo $actividad['id']; ?>">
                <button type="submit">Editar</button>
            </form>
        </div>
    <?php endforeach; ?>
</body>
</html>
