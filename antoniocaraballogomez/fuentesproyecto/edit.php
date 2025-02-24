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

if (!isset($_GET['id'])) {
    header('Location: actividades.php');
    exit();
}

$id = mysqli_real_escape_string($conn, $_GET['id']);
$query = "SELECT * FROM actividades WHERE id='$id'";
$result = mysqli_query($conn, $query);
$actividad = mysqli_fetch_assoc($result);

if (!$actividad) {
    header('Location: actividades.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SESSION['rol'] == 'admin') {
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
    $aprobada = isset($_POST['aprobada']) ? 1 : 0;

    $query = "UPDATE actividades SET
              titulo='$titulo',
              tipo='$tipo',
              departamento='$departamento',
              profesor_responsable='$profesor_responsable',
              trimestre='$trimestre',
              fecha_inicio='$fecha_inicio',
              hora_inicio='$hora_inicio',
              fecha_fin='$fecha_fin',
              hora_fin='$hora_fin',
              organizador='$organizador',
              acompanantes='$acompanantes',
              ubicacion='$ubicacion',
              costo='$costo',
              total_alumnos='$total_alumnos',
              objetivo='$objetivo',
              aprobada='$aprobada'
              WHERE id='$id'";

    if (mysqli_query($conn, $query)) {
        header('Location: actividades.php');
        exit();
    } else {
        echo "Error al editar la actividad: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Actividad</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
            transition: background-color 0.3s, color 0.3s;
        }
        h1 {
            color: #333;
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

       
        body.dark-mode {
            background-color: #333;
            color: #e0e0e0;
        }

        body.dark-mode h1 {
            color: #3AB3BC;
        }

        body.dark-mode form {
            background-color: #444;
            color: #e0e0e0;
        }

        body.dark-mode input,
        body.dark-mode select,
        body.dark-mode textarea {
            background-color: #555;
            color: #fff;
            border-color: #666;
        }

        body.dark-mode button {
            background-color: #555;
            color: #fff;
        }

        body.dark-mode button:hover {
            background-color: #666;
        }

        body.dark-mode a {
            color: #bbb;
        }

       
        #darkModeButton {
            position: absolute;
            top: 20px;
            right: 20px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            font-size: 14px;
        }

        #darkModeButton:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <button id="darkModeButton">Cambiar a Modo Oscuro</button>
    <h1>Editar Actividad</h1>
    <form method="POST" action="edit.php?id=<?php echo htmlspecialchars($id); ?>">
        <label>Título: <input type="text" name="titulo" value="<?php echo htmlspecialchars($actividad['titulo']); ?>" required></label>
        <label>Tipo:
            <select name="tipo" required>
                <option value="extraescolar" <?php echo $actividad['tipo'] == 'extraescolar' ? 'selected' : ''; ?>>Extraescolar</option>
                <option value="complementaria" <?php echo $actividad['tipo'] == 'complementaria' ? 'selected' : ''; ?>>Complementaria</option>
            </select>
        </label>
        <label>Departamento: <input type="text" name="departamento" value="<?php echo htmlspecialchars($actividad['departamento']); ?>"></label>
        <label>Profesor Responsable: <input type="text" name="profesor_responsable" value="<?php echo htmlspecialchars($actividad['profesor_responsable']); ?>"></label>
        <label>Trimestre:
            <select name="trimestre" required>
                <option value="1" <?php echo $actividad['trimestre'] == '1' ? 'selected' : ''; ?>>1</option>
                <option value="2" <?php echo $actividad['trimestre'] == '2' ? 'selected' : ''; ?>>2</option>
                <option value="3" <?php echo $actividad['trimestre'] == '3' ? 'selected' : ''; ?>>3</option>
            </select>
        </label>
        <label>Fecha Inicio: <input type="date" name="fecha_inicio" value="<?php echo htmlspecialchars($actividad['fecha_inicio']); ?>" required></label>
        <label>Hora Inicio: <input type="time" name="hora_inicio" value="<?php echo htmlspecialchars($actividad['hora_inicio']); ?>" required></label>
        <label>Fecha Fin: <input type="date" name="fecha_fin" value="<?php echo htmlspecialchars($actividad['fecha_fin']); ?>" required></label>
        <label>Hora Fin: <input type="time" name="hora_fin" value="<?php echo htmlspecialchars($actividad['hora_fin']); ?>" required></label>
        <label>Organizador: <input type="text" name="organizador" value="<?php echo htmlspecialchars($actividad['organizador']); ?>"></label>
        <label>Acompañantes: <textarea name="acompanante"><?php echo htmlspecialchars($actividad['acompanantes']); ?></textarea></label>
        <label>Ubicación: <input type="text" name="ubicacion" value="<?php echo htmlspecialchars($actividad['ubicacion']); ?>"></label>
        <label>Costo: <input type="number" step="0.01" name="costo" value="<?php echo htmlspecialchars($actividad['costo']); ?>"></label>
        <label>Total Alumnos: <input type="number" name="total_alumnos" value="<?php echo htmlspecialchars($actividad['total_alumnos']); ?>"></label>
        <label>Objetivo: <textarea name="objetivo"><?php echo htmlspecialchars($actividad['objetivo']); ?></textarea></label>
        <label>Aprobada: <input type="checkbox" name="aprobada" <?php echo $actividad['aprobada'] ? 'checked' : ''; ?>></label>
        <button type="submit">Guardar Cambios</button>
    </form>
    <a href="actividades.php">Volver a la lista de actividades</a>

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
