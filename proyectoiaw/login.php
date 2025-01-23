<?php
session_start();
require 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    
    $stmt = mysqli_prepare($conn, "SELECT id, password FROM usuarios WHERE username = ?");
    mysqli_stmt_bind_param($stmt, "s", $username); 
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

 
    if ($result && $user = mysqli_fetch_assoc($result)) {
       
        if (password_verify($password, $user['password'])) {
       
            $_SESSION['id'] = $user['id'];
            header('Location: actividades.php');
            exit();
        } else {
           
            $error = "Nombre de usuario o contraseña incorrectos";
        }
    } else {
      
        $error = "Nombre de usuario o contraseña incorrectos";
    }

   
    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
   
    <?php if (isset($error)): ?>
        <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>
    
    <form method="POST" action="login.php">
        <label for="username">Usuario:</label>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required><br>
        <button type="submit">Login</button>
    </form>
</body>
</html>



