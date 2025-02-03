<?php
session_start();
require 'connect.php'; // Asegúrate de que este archivo maneje correctamente la conexión a la base de datos.

// Inicializar variables y mensajes de error
$error = '';
$success = '';

// Verificar si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Limpiar y validar los datos de entrada
    $username = trim($_POST['username']);
    $apellidos = trim($_POST['apellidos']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);
    $departamento = trim($_POST['departamento']);

    // Validar que todos los campos estén completos
    if (empty($username) || empty($apellidos) || empty($email) || empty($password) || empty($confirm_password) || empty($departamento)) {
        $error = "Por favor, complete todos los campos.";
    }
    // Validar que el correo electrónico pertenezca al dominio @iesamachado.org
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) || !preg_match('/@iesamachado\.org$/', $email)) {
        $error = "El correo electrónico debe pertenecer al dominio @iesamachado.org.";
    }
    // Validar que las contraseñas coincidan
    elseif ($password !== $confirm_password) {
        $error = "Las contraseñas no coinciden.";
    }
    // Validar la longitud de la contraseña
    elseif (strlen($password) < 8) {
        $error = "La contraseña debe tener al menos 8 caracteres.";
    }
    // Si todo está correcto, proceder con el registro
    else {
        // Verificar si el correo electrónico ya está registrado
        $stmt = mysqli_prepare($conn, "SELECT id FROM usuarios WHERE email = ?");
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);

            if (mysqli_stmt_num_rows($stmt) > 0) {
                $error = "El correo electrónico ya está registrado.";
            } else {
                // Hash de la contraseña
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                // Insertar el nuevo usuario en la base de datos
                $stmt = mysqli_prepare($conn, "INSERT INTO usuarios (username, apellidos, email, password, departamento) VALUES (?, ?, ?, ?, ?)");
                if ($stmt) {
                    mysqli_stmt_bind_param($stmt, "sssss", $username, $apellidos, $email, $hashed_password, $departamento);
                    if (mysqli_stmt_execute($stmt)) {
                        // Redirigir al usuario a login.php después de un registro exitoso
                        header('Location: login.php');
                        exit();
                    } else {
                        $error = "Error al registrar el usuario. Inténtelo de nuevo.";
                    }
                    mysqli_stmt_close($stmt);
                } else {
                    $error = "Error en la preparación de la consulta de inserción.";
                }
            }
            mysqli_stmt_close($stmt);
        } else {
            $error = "Error en la preparación de la consulta de verificación.";
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
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .registro-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
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
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
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
        }
        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
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
            <input type="text" id="departamento" name="departamento" required>
            <button type="submit">Registrarse</button>
        </form>
        <div class="login-link">
            ¿Tienes una cuenta? <a href="login.php">Inicia sesión</a>
        </div>
    </div>
</body>
</html>