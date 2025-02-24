<?php
session_start();
require 'connect.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit();
}

$id_usuario = $_SESSION['id'];
$query_usuario = "SELECT username, ultima_conexion FROM usuarios WHERE id = $id_usuario";
$result_usuario = mysqli_query($conn, $query_usuario);

if (!$result_usuario) {
    die("Error al obtener la información del usuario: " . mysqli_error($conn));
}

$usuario = mysqli_fetch_assoc($result_usuario);

if ($usuario['ultima_conexion'] === null) {
    $ultima_conexion = "Nunca se ha conectado";
} else {
    $ultima_conexion = "se conectó por última vez el " . date('d \d\e F \a \l\a\s H:i', strtotime($usuario['ultima_conexion']));
}


$query_total = "SELECT COUNT(*) as total FROM actividades";
$result_total = mysqli_query($conn, $query_total);
$total_actividades = mysqli_fetch_assoc($result_total)['total'];


$query_aprobadas = "SELECT COUNT(*) as aprobadas FROM actividades WHERE aprobada = 1";
$result_aprobadas = mysqli_query($conn, $query_aprobadas);
$total_aprobadas = mysqli_fetch_assoc($result_aprobadas)['aprobadas'];

$query_pendientes = "SELECT COUNT(*) as pendientes FROM actividades WHERE aprobada = 0";
$result_pendientes = mysqli_query($conn, $query_pendientes);
$total_pendientes = mysqli_fetch_assoc($result_pendientes)['pendientes'];

$order_by = isset($_GET['order_by']) ? mysqli_real_escape_string($conn, $_GET['order_by']) : 'id';
$order_dir = isset($_GET['order_dir']) ? mysqli_real_escape_string($conn, $_GET['order_dir']) : 'ASC';

$query = "SELECT * FROM actividades ORDER BY $order_by $order_dir";
$result = mysqli_query($conn, $query);
$actividades = mysqli_fetch_all($result, MYSQLI_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add'])) {
    $titulo = mysqli_real_escape_string($conn, $_POST['titulo']);
    $tipo = mysqli_real_escape_string($conn, $_POST['tipo']);
    $departamento = mysqli_real_escape_string($conn, $_POST['departamento']);
    $profesor_responsable = mysqli_real_escape_string($conn, $_POST['profesor_responsable']);
    $trimestre = mysqli_real_escape_string($conn, $_POST['trimestre']);
    $fecha_inicio = mysqli_real_escape_string($conn, $_POST['fecha_inicio']);
    $hora_inicio = mysqli_real_escape_string($conn, $_POST['hora_inicio']);
    $fecha_fin = mysqli_real_escape_string($conn, $_POST['fecha_fin']);
    $hora_fin = mysqli_real_escape_string($conn, $_POST['hora_fin']);
    $organizador = mysqli_real_escape_string($conn, $_POST['organizador']);
    $acompanantes = mysqli_real_escape_string($conn, $_POST['acompanante']);
    $ubicacion = mysqli_real_escape_string($conn, $_POST['ubicacion']);
    $costo = mysqli_real_escape_string($conn, $_POST['costo']);
    $total_alumnos = mysqli_real_escape_string($conn, $_POST['total_alumnos']);
    $objetivo = mysqli_real_escape_string($conn, $_POST['objetivo']);

    $query = "INSERT INTO actividades (titulo, tipo, departamento, profesor_responsable, trimestre, fecha_inicio, hora_inicio, fecha_fin, hora_fin, organizador, acompanantes, ubicacion, costo, total_alumnos, objetivo)
              VALUES ('$titulo', '$tipo', '$departamento', '$profesor_responsable', '$trimestre', '$fecha_inicio', '$hora_inicio', '$fecha_fin', '$hora_fin', '$organizador', '$acompanantes', '$ubicacion', '$costo', '$total_alumnos', '$objetivo')";

    if (mysqli_query($conn, $query)) {
        header('Location: actividades.php');
        exit();
    } else {
        echo "Error al añadir la actividad: " . mysqli_error($conn);
    }
}

if (isset($_GET['delete']) && $_SESSION['rol'] == 'admin') {
    $id = mysqli_real_escape_string($conn, $_GET['delete']);
    $query = "DELETE FROM actividades WHERE id='$id'";

    if (mysqli_query($conn, $query)) {
        header('Location: actividades.php');
        exit();
    } else {
        echo "Error al eliminar la actividad: " . mysqli_error($conn);
    }
}

if (isset($_GET['approve']) && $_SESSION['rol'] == 'admin') {
    $id = mysqli_real_escape_string($conn, $_GET['approve']);
    $query = "UPDATE actividades SET aprobada=1 WHERE id='$id'";

    if (mysqli_query($conn, $query)) {
        header('Location: actividades.php');
        exit();
    } else {
        echo "Error al aprobar la actividad: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Actividades</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
            transition: background-color 0.3s, color 0.3s;
        }
        h1, h2 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            transition: background-color 0.3s, color 0.3s;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s, color 0.3s;
        }
        label {
            display: block;
            margin-bottom: 10px;
        }
        input, select, textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            transition: background-color 0.3s, color 0.3s;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #45a049;
        }
        a {
            color: #4CAF50;
            text-decoration: none;
            transition: color 0.3s;
        }
        a:hover {
            text-decoration: underline;
        }
        th a {
            color: white;
            text-decoration: none;
        }
        th a:hover {
            text-decoration: underline;
        }

       
        body.dark-mode {
            background-color: #333;
        }

        body.dark-mode h1, body.dark-mode h2 {
            color: #3AB3BC;
        }

        body.dark-mode table {
            background-color: #444;
        }

        body.dark-mode th, body.dark-mode td {
            border-color: #555;
            color: #3AB3BC; 
        }

        body.dark-mode th {
            background-color: #555;
        }

        body.dark-mode a {
            color: #bbb;
        }

        body.dark-mode button {
            background-color: #555;
            color: #fff;
        }

        body.dark-mode button:hover {
            background-color: #666;
        }

        body.dark-mode form {
            background-color: #444;
        }

        body.dark-mode input,
        body.dark-mode select,
        body.dark-mode textarea {
            background-color: #555;
            color: #fff;
            border-color: #666;
        }

        #darkModeButton {
            position: absolute;
            bottom: -1120px;
            left: 20px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        #darkModeButton:hover {
            background-color: #45a049;
        }

      
        .totales {
            position:absolute;
            bottom: -1150px;
            right: 20px;
            background-color: #fff;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;

        }

        .totales p {
            margin: 5px 0;
            font-size: 16px;
            color: #333;
        }

        body.dark-mode .totales p {
            color: #3AB3BC;
        }

       
        .bienvenida {
            background-color: #fff;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            font-size: 16px;
            color: #333;
        }

        body.dark-mode .bienvenida {
            background-color: #444;
            color: #3AB3BC;
        }
    </style>
</head>
<body>

    <h1>Gestión de Actividades</h1>

    <div class="bienvenida">
        <p>Bienvenido <?php echo htmlspecialchars($usuario['username']); ?>, <?php echo $ultima_conexion; ?>.</p>
    </div>

    <div class="totales">
        <p><strong>Total de Actividades Propuestas:</strong> <?php echo $total_actividades; ?></p>
        <p><strong>Total de Actividades Aprobadas:</strong> <?php echo $total_aprobadas; ?></p>
        <p><strong>Total de Actividades Pendientes de Aprobación:</strong> <?php echo $total_pendientes; ?></p>
    </div>

    <a href="salir.php">Cerrar Sesión</a>
    <button id="darkModeButton">Cambiar a Modo Oscuro</button>

    <h2>Lista de Actividades</h2>
    <table>
        <tr>
            <th><a href="?order_by=id&order_dir=<?php echo $order_by == 'id' && $order_dir == 'ASC' ? 'DESC' : 'ASC'; ?>">ID</a></th>
            <th><a href="?order_by=titulo&order_dir=<?php echo $order_by == 'titulo' && $order_dir == 'ASC' ? 'DESC' : 'ASC'; ?>">Título</a></th>
            <th><a href="?order_by=tipo&order_dir=<?php echo $order_by == 'tipo' && $order_dir == 'ASC' ? 'DESC' : 'ASC'; ?>">Tipo</a></th>
            <th><a href="?order_by=departamento&order_dir=<?php echo $order_by == 'departamento' && $order_dir == 'ASC' ? 'DESC' : 'ASC'; ?>">Departamento</a></th>
            <th><a href="?order_by=profesor_responsable&order_dir=<?php echo $order_by == 'profesor_responsable' && $order_dir == 'ASC' ? 'DESC' : 'ASC'; ?>">Profesor Responsable</a></th>
            <th><a href="?order_by=trimestre&order_dir=<?php echo $order_by == 'trimestre' && $order_dir == 'ASC' ? 'DESC' : 'ASC'; ?>">Trimestre</a></th>
            <th><a href="?order_by=fecha_inicio&order_dir=<?php echo $order_by == 'fecha_inicio' && $order_dir == 'ASC' ? 'DESC' : 'ASC'; ?>">Fecha Inicio</a></th>
            <th><a href="?order_by=hora_inicio&order_dir=<?php echo $order_by == 'hora_inicio' && $order_dir == 'ASC' ? 'DESC' : 'ASC'; ?>">Hora Inicio</a></th>
            <th><a href="?order_by=fecha_fin&order_dir=<?php echo $order_by == 'fecha_fin' && $order_dir == 'ASC' ? 'DESC' : 'ASC'; ?>">Fecha Fin</a></th>
            <th><a href="?order_by=hora_fin&order_dir=<?php echo $order_by == 'hora_fin' && $order_dir == 'ASC' ? 'DESC' : 'ASC'; ?>">Hora Fin</a></th>
            <th><a href="?order_by=organizador&order_dir=<?php echo $order_by == 'organizador' && $order_dir == 'ASC' ? 'DESC' : 'ASC'; ?>">Organizador</a></th>
            <th><a href="?order_by=acompanantes&order_dir=<?php echo $order_by == 'acompanantes' && $order_dir == 'ASC' ? 'DESC' : 'ASC'; ?>">Acompañantes</a></th>
            <th><a href="?order_by=ubicacion&order_dir=<?php echo $order_by == 'ubicacion' && $order_dir == 'ASC' ? 'DESC' : 'ASC'; ?>">Ubicación</a></th>
            <th><a href="?order_by=costo&order_dir=<?php echo $order_by == 'costo' && $order_dir == 'ASC' ? 'DESC' : 'ASC'; ?>">Costo</a></th>
            <th><a href="?order_by=total_alumnos&order_dir=<?php echo $order_by == 'total_alumnos' && $order_dir == 'ASC' ? 'DESC' : 'ASC'; ?>">Total Alumnos</a></th>
            <th><a href="?order_by=objetivo&order_dir=<?php echo $order_by == 'objetivo' && $order_dir == 'ASC' ? 'DESC' : 'ASC'; ?>">Objetivo</a></th>
            <th><a href="?order_by=aprobada&order_dir=<?php echo $order_by == 'aprobada' && $order_dir == 'ASC' ? 'DESC' : 'ASC'; ?>">Aprobada</a></th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($actividades as $actividad): ?>
        <tr>
            <td><?php echo htmlspecialchars($actividad['id']); ?></td>
            <td><?php echo htmlspecialchars($actividad['titulo']); ?></td>
            <td><?php echo htmlspecialchars($actividad['tipo']); ?></td>
            <td><?php echo htmlspecialchars($actividad['departamento']); ?></td>
            <td><?php echo htmlspecialchars($actividad['profesor_responsable']); ?></td>
            <td><?php echo htmlspecialchars($actividad['trimestre']); ?></td>
            <td><?php echo htmlspecialchars($actividad['fecha_inicio']); ?></td>
            <td><?php echo htmlspecialchars($actividad['hora_inicio']); ?></td>
            <td><?php echo htmlspecialchars($actividad['fecha_fin']); ?></td>
            <td><?php echo htmlspecialchars($actividad['hora_fin']); ?></td>
            <td><?php echo htmlspecialchars($actividad['organizador']); ?></td>
            <td><?php echo htmlspecialchars($actividad['acompanantes']); ?></td>
            <td><?php echo htmlspecialchars($actividad['ubicacion']); ?></td>
            <td><?php echo htmlspecialchars($actividad['costo']); ?></td>
            <td><?php echo htmlspecialchars($actividad['total_alumnos']); ?></td>
            <td><?php echo htmlspecialchars($actividad['objetivo']); ?></td>
            <td><?php echo $actividad['aprobada'] ? 'Sí' : 'No'; ?></td>
            <td>
                <?php if ($_SESSION['rol'] == 'admin'): ?>
                    <a href="edit.php?id=<?php echo htmlspecialchars($actividad['id']); ?>">Editar</a>
                    <a href="actividades.php?delete=<?php echo htmlspecialchars($actividad['id']); ?>" onclick="return confirm('¿Estás seguro?')">Eliminar</a>
                    <?php if (!$actividad['aprobada']): ?>
                        <a href="actividades.php?approve=<?php echo htmlspecialchars($actividad['id']); ?>" onclick="return confirm('¿Aprobar esta actividad?')">Aprobar</a>
                    <?php endif; ?>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <h2>Añadir Nueva Actividad</h2>
    <form method="POST" action="actividades.php">
        <input type="hidden" name="add" value="1">
        <label>Título: <input type="text" name="titulo" required></label>
        <label>Tipo:
            <select name="tipo" required>
                <option value="extraescolar">Extraescolar</option>
                <option value="complementaria">Complementaria</option>
            </select>
        </label>
        <label>Departamento: <input type="text" name="departamento"></label>
        <label>Profesor Responsable: <input type="text" name="profesor_responsable"></label>
        <label>Trimestre:
            <select name="trimestre" required>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
            </select>
        </label>
        <label>Fecha Inicio: <input type="date" name="fecha_inicio" required></label>
        <label>Hora Inicio: <input type="time" name="hora_inicio" required></label>
        <label>Fecha Fin: <input type="date" name="fecha_fin" required></label>
        <label>Hora Fin: <input type="time" name="hora_fin" required></label>
        <label>Organizador: <input type="text" name="organizador"></label>
        <label>Acompañantes: <textarea name="acompanante"></textarea></label>
        <label>Ubicación: <input type="text" name="ubicacion"></label>
        <label>Costo: <input type="number" step="0.01" name="costo"></label>
        <label>Total Alumnos: <input type="number" name="total_alumnos"></label>
        <label>Objetivo: <textarea name="objetivo"></textarea></label>
        <button type="submit">Añadir Actividad</button>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggleButton = document.getElementById('darkModeButton');
            const body = document.body;

        
            if (localStorage.getItem('darkMode') === 'enabled') {
                body.classList.add('dark-mode');
                toggleButton.textContent = 'Cambiar a Modo Claro';
            }

            toggleButton.addEventListener('click', function () {
                body.classList.toggle('dark-mode');
                if (body.classList.contains('dark-mode')) {
                    localStorage.setItem('darkMode', 'enabled');
                    toggleButton.textContent = 'Cambiar a Modo Claro';
                } else {
                    localStorage.setItem('darkMode', 'disabled');
                    toggleButton.textContent = 'Cambiar a Modo Oscuro';
                }
            });
        });
    </script>
</body>
</html>