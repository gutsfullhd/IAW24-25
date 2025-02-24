<?php
session_start();
require 'connect.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = trim($_POST['username']);
    $apellidos = trim($_POST['apellidos']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);
    $departamento = trim($_POST['departamento']);
    $rol = 'normie';

    if (empty($username) || empty($apellidos) || empty($email) || empty($password) || empty($confirm_password) || empty($departamento)) {
        $error = "Por favor, complete todos los campos.";
    }
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) || !preg_match('/@iesamachado\.org$/', $email)) {
        $error = "El correo electrónico debe pertenecer al dominio @iesamachado.org.";
    }
    elseif ($password !== $confirm_password) {
        $error = "Las contraseñas no coinciden.";
    }
    elseif (strlen($password) < 8) {
        $error = "La contraseña debe tener al menos 8 caracteres.";
    }
    else {

        $stmt = mysqli_prepare($conn, "SELECT id FROM usuarios WHERE email = ?");
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);

            if (mysqli_stmt_num_rows($stmt) > 0) {
                $error = "El correo electrónico ya está registrado.";
            } else {

                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                $stmt = mysqli_prepare($conn, "INSERT INTO usuarios (username, apellidos, email, password, departamento, rol) VALUES (?, ?, ?, ?, ?, ?)");
                if ($stmt) {
                    mysqli_stmt_bind_param($stmt, "ssssss", $username, $apellidos, $email, $hashed_password, $departamento, $rol);
                    if (mysqli_stmt_execute($stmt)) {

                        header('Location: login.php');
                        exit();
                    } else {
                        $error = "Error al registrar el usuario. Inténtelo de nuevo.";
                    }
                    mysqli_stmt_close($stmt);
                } else {
                    $error = "Error en la preparación de la consulta.";
                }
            }
            mysqli_stmt_close($stmt);
        } else {
            $error = "Error en la preparación de la consulta.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Profesores</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            transition: background-color 0.3s, color 0.3s;
        }
        .registro-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
            transition: background-color 0.3s, color 0.3s;
        }
        h1 {
            margin-bottom: 20px;
            color: #333;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            transition: background-color 0.3s, color 0.3s;
        }
        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #0056b3;
        }
        .error {
            color: #dc3545;
            margin-bottom: 15px;
        }
        .success {
            color: #28a745;
            margin-bottom: 15px;
        }
        .login-link {
            margin-top: 15px;
            font-size: 14px;
        }
        .login-link a {
            color: #007bff;
            text-decoration: none;
            transition: color 0.3s;
        }
        .login-link a:hover {
            text-decoration: underline;
        }

        
        body.dark-mode {
            background-color: #333;
            color: #e0e0e0;
        }

        body.dark-mode .registro-container {
            background-color: #444;
            color: #e0e0e0;
        }

        body.dark-mode h1 {
            color: #3AB3BC;
        }

        body.dark-mode label {
            color: #3AB3BC;
        }

        body.dark-mode input[type="text"],
        body.dark-mode input[type="email"],
        body.dark-mode input[type="password"],
        body.dark-mode select {
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

        body.dark-mode .error {
            color: #ff6b6b;
        }

        body.dark-mode .success {
            color: #32cd32;
        }

        body.dark-mode .login-link a {
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
    <div class="registro-container">
        <h1>Registro de Profesores</h1>
        <?php if (isset($error)): ?>
            <p class="error"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
        <?php if (isset($success)): ?>
            <p class="success"><?php echo htmlspecialchars($success); ?></p>
        <?php endif; ?>
        <form method="POST" action="registro.php">
            <label for="username">Nombre de usuario:</label>
            <input type="text" id="username" name="username" required>
            <label for="apellidos">Apellidos:</label>
            <input type="text" id="apellidos" name="apellidos" required>
            <label for="email">Correo electrónico (@iesamachado.org):</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Contraseña (mínimo 8 caracteres):</label>
            <input type="password" id="password" name="password" required>
            <label for="confirm_password">Confirmar Contraseña:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
            <label for="departamento">Departamento:</label>
            <select id="departamento" name="departamento" required>
                <option value="">Seleccione un departamento</option>
                <option value="matematicas">Matemáticas</option>
                <option value="lengua y literatura">Lengua y Literatura</option>
                <option value="biologia y quimica">Biología y Química</option>
                <option value="informatica">Informática</option>
                <option value="historia y geografia">Historia y Geografía</option>
                <option value="arte">Arte</option>
                <option value="idiomas">Idiomas</option>
                <option value="educacion fisica">Educación Física</option>
                <option value="sociales">Sociales</option>
            </select>
            <button type="submit">Registrarse</button>
        </form>
        <div class="login-link">
            ¿Tienes una cuenta? <a href="login.php">Inicia sesión</a>
        </div>
    </div>

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



