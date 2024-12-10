<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saludo</title>
</head>
<body>
    <h1>Formulario de Saludo</h1>
    <?php
   
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['nombre'])) {
        $nombre = htmlspecialchars($_POST['nombre']); 
        $fecha = date("d/m/y"); 
        echo "<p>Hola $nombre, hoy es $fecha.</p>";
    } else {
        echo "<p>Por favor, ingresa tu nombre.</p>";
    }
    ?>

    
    <form method="POST" action="">
        <label for="nombre">Tu Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
        <button type="submit">Enviar</button>
    </form>
</body>
</html>
