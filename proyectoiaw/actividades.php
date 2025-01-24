<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        <select name="tipo" required>
            <option value="complementarias">Complementarias</option>
            <option value="extraescolares">Extraescolares</option>
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
            <h3><?php echo htmlspecialchars($actividad['titulo']); ?></h3>
            <p>Tipo: <?php echo htmlspecialchars($actividad['tipo']); ?></p>
            <p>Departamento: <?php echo htmlspecialchars($actividad['departamento']); ?></p>
            <p>Profesor Responsable: <?php echo htmlspecialchars($actividad['profesor_responsable']); ?></p>
            <p>Trimestre: <?php echo htmlspecialchars($actividad['trimestre']); ?></p>
            <p>Fecha Inicio: <?php echo htmlspecialchars($actividad['fecha_inicio']); ?></p>
            <p>Hora Inicio: <?php echo htmlspecialchars($actividad['hora_inicio']); ?></p>
            <p>Fecha Fin: <?php echo htmlspecialchars($actividad['fecha_fin']); ?></p>
            <p>Hora Fin: <?php echo htmlspecialchars($actividad['hora_fin']); ?></p>
            <p>Organizador: <?php echo htmlspecialchars($actividad['organizador']); ?></p>
            <p>Acompañantes: <?php echo htmlspecialchars($actividad['acompanantes']); ?></p>
            <p>Ubicación: <?php echo htmlspecialchars($actividad['ubicacion']); ?></p>
            <p>Costo: <?php echo htmlspecialchars($actividad['costo']); ?></p>
            <p>Total Alumnos: <?php echo htmlspecialchars($actividad['total_alumnos']); ?></p>
            <p>Objetivo: <?php echo htmlspecialchars($actividad['objetivo']); ?></p>
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