<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM actividades WHERE id = :id");
$stmt->bindParam(':id', $id);
$stmt->execute();
$activity = $stmt->fetch(PDO::FETCH_ASSOC);

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

    $stmt = $conn->prepare("UPDATE actividades SET titulo = :titulo, tipo = :tipo, departamento = :departamento, profesor_responsable = :profesor_responsable, trimestre = :trimestre, fecha_inicio = :fecha_inicio, hora_inicio = :hora_inicio, fecha_fin = :fecha_fin, hora_fin = :hora_fin, organizador = :organizador, acompañantes = :acompañantes, ubicacion = :ubicacion, coste = :coste, total_alumnos = :total_alumnos, objetivo = :objetivo WHERE id = :id");
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
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    header("Location: veractividades.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Actividad</title>
</head>
<body>
    <h1>Editar Actividad</h1>
    <form method="POST" action="edit_activity.php?id=<?php echo $id; ?>">
        <label>Título:</label>
        <input type="text" name="titulo" value="<?php echo $activity['titulo']; ?>" required><br>
        <label>Tipo:</label>
        <select name="tipo" required>
            <option value="extraescolar" <?php if ($activity['tipo'] == 'extraescolar') echo 'selected'; ?>>Extraescolar</option>
            <option value="complementaria" <?php if ($activity['tipo'] == 'complementaria') echo 'selected'; ?>>Complementaria</option>
        </select><br>
        <label>Departamento:</label>
        <input type="text" name="departamento" value="<?php echo $activity['departamento']; ?>" required><br>
        <label>Profesor Responsable:</label>
        <input type="text" name="profesor_responsable" value="<?php echo $activity['profesor_responsable']; ?>" required><br>
        <label>Trimestre:</label>
        <select name="trimestre" required>
            <option value="1" <?php if ($activity['trimestre'] == '1') echo 'selected'; ?>>1</option>
            <option value="2" <?php if ($activity['trimestre'] == '2') echo 'selected'; ?>>2</option>
            <option value="3" <?php if ($activity['trimestre'] == '3') echo 'selected'; ?>>3</option>
        </select><br>
        <label>Fecha Inicio:</label>
        <input type="date" name="fecha_inicio" value="<?php echo $activity['fecha_inicio']; ?>" required><br>
        <label>Hora Inicio:</label>
        <input type="time" name="hora_inicio" value="<?php echo $activity['hora_inicio']; ?>" required><br>
        <label>Fecha Fin:</label>
        <input type="date" name="fecha_fin" value="<?php echo $activity['fecha_fin']; ?>" required><br>
        <label>Hora Fin:</label>
        <input type="time" name="hora_fin" value="<?php echo $activity['hora_fin']; ?>" required><br>
        <label>Organizador:</label>
        <input type="text" name="organizador" value="<?php echo $activity['organizador']; ?>" required><br>
        <label>Acompañantes:</label>
        <textarea name="acompañantes"><?php echo $activity['acompañantes']; ?></textarea><br>
        <label>Ubicación:</label>
        <input type="text" name="ubicacion" value="<?php echo $activity['ubicacion']; ?>" required><br>
        <label>Coste:</label>
        <input type="number" step="0.01" name="coste" value="<?php echo $activity['coste']; ?>" required><br>
        <label>Total Alumnos:</label>
        <input type="number" name="total_alumnos" value="<?php echo $activity['total_alumnos']; ?>" required><br>
        <label>Objetivo:</label>
        <textarea name="objetivo" required><?php echo $activity['objetivo']; ?></textarea><br>
        <button type="submit">Guardar Cambios</button>
    </form>
    <a href="dashboard.php">Volver al Dashboard</a>
</body>
</html>
