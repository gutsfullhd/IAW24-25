<?php
session_start();
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Encriptar la contraseña
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Insertar el usuario en la base de datos
    $stmt = $conn->prepare("INSERT INTO usuarios (username, password) VALUES (:username, :password)");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $hashed_password);

    try {
        $stmt->execute();
        // Redirigir al usuario a login.php
        header("Location: login.php");
        exit();
    } catch(PDOException $e) {
        echo "Error al registrar el usuario: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registro</title>
</head>
<body>
    <h1>Registro</h1>
    <form method="POST" action="register.php">
        <label>Username:</label>
        <input type="text" name="username" required><br>
        <label>Password:</label>
        <input type="password" name="password" required><br>
        <button type="submit">Registrar</button>
    </form>
    <p>¿Ya tienes una cuenta? <a href="login.php">Inicia sesión</a></p>
</body>
</html>