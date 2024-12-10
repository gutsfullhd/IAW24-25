<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Formulario de Login</h1>
    <?php
   
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
       
        $usuario = htmlspecialchars(trim($_POST['usuario']));
        $password = htmlspecialchars(trim($_POST['password']));

        
        if ($usuario === 'admin' && $password === 'H4CK3R4$1R') {
            echo "<p style='color: green;'>Acceso concedido</p>";
        } else {
            echo "<p style='color: red;'>Acceso denegado</p>";
        }
    }
    ?>

  
    <form method="POST" action="">
        <label for="usuario">Usuario:</label>
        <input type="text" id="usuario" name="usuario" required>
        <br><br>
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>
        <br><br>
        <button type="submit">Ingresar</button>
    </form>
</body>
</html>
