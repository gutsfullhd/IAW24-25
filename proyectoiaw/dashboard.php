<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

require_once 'connect.php';

$stmt = $conn->query("SELECT * FROM actividades");
$actividades = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Actividades</title>
</head>
<body>
    <h1>Bienvenido, <?= htmlspecialchars($_SESSION['user']) ?></h1>
    <a href="logout.php">Cerrar Sesión</a>
    <h2>Actividades</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Tipo</th>
            <th>Departamento</th>
            <th>Profesor Responsable</th>
            <th>Trimestre</th>
            <th>Fecha Inicio</th>
            <th>Fecha Fin</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($actividades as $actividad): ?>
            <tr>
                <td><?= $actividad['id'] ?></td>
                <td><?= htmlspecialchars($actividad['titulo']) ?></td>
                <td><?= htmlspecialchars($actividad['tipo']) ?></td>
                <td><?= htmlspecialchars($actividad['departamento']) ?></td>
                <td><?= htmlspecialchars($actividad['profesor_responsable']) ?></td>
                <td><?= htmlspecialchars($actividad['trimestre']) ?></td>
                <td><?= htmlspecialchars($actividad['fecha_inicio']) ?></td>
                <td><?= htmlspecialchars($actividad['fecha_fin']) ?></td>
                <td>
                    <a href="edit.php?id=<?= $actividad['id'] ?>">Editar</a>
                    <a href="delete.php?id=<?= $actividad['id'] ?>" onclick="return confirm('¿Estás seguro?')">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <a href="add.php">Añadir Actividad</a>
</body>
</html>
