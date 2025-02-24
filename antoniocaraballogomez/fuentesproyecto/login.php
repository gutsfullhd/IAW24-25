<?php
session_start();
require 'connect.php';


date_default_timezone_set('Europe/Madrid');


mysqli_query($conn, "SET time_zone = '+01:00';"); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        $error = "Por favor, complete todos los campos.";
    } else {

        $stmt = mysqli_prepare($conn, "SELECT id, password, rol FROM usuarios WHERE username = ?");
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($result && $user = mysqli_fetch_assoc($result)) {

                if (password_verify($password, $user['password'])) {

                   
                    $id_usuario = $user['id'];
                    $query_update = "UPDATE usuarios SET ultima_conexion = NOW() WHERE id = ?";
                    $stmt_update = mysqli_prepare($conn, $query_update);
                    if ($stmt_update) {
                        mysqli_stmt_bind_param($stmt_update, "i", $id_usuario);
                        mysqli_stmt_execute($stmt_update);
                        mysqli_stmt_close($stmt_update);
                    }

                   
                    $_SESSION['id'] = $user['id'];
                    $_SESSION['rol'] = $user['rol'];
                    header('Location: actividades.php');
                    exit();
                } else {
                    $error = "Contraseña incorrecta.";
                }
            } else {
                $error = "Usuario no encontrado.";
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
    <title>Login</title>
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
        .login-container {
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
        input[type="password"] {
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

       
        body.dark-mode {
            background-color: #333;
        }

        body.dark-mode .login-container {
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
        body.dark-mode input[type="password"] {
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
    <div class="login-container">
        <h1>Login</h1>
        <?php if (isset($error)): ?>
            <p class="error"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
        <form method="POST" action="login.php">
            <label for="username">Usuario:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Login</button>
        </form>
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