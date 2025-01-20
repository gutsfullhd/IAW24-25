<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sube tu Foto</title>
</head>
<body>
    <h1>Sube tu Foto de Perfil</h1>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Procesar nombre
        $nombre = htmlspecialchars(trim($_POST['nombre']));

        // Procesar imagen
        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
            $archivoTmp = $_FILES['imagen']['tmp_name'];
            $nombreArchivo = basename($_FILES['imagen']['name']);
            $extension = strtolower(pathinfo($nombreArchivo, PATHINFO_EXTENSION));
            $extensionesPermitidas = ['jpg', 'jpeg', 'png', 'gif'];
            
            if (in_array($extension, $extensionesPermitidas)) {
                $directorioSubida = 'uploads/';
                if (!is_dir($directorioSubida)) {
                    mkdir($directorioSubida, 0755, true);
                }

                $rutaDestino = $directorioSubida . uniqid('perfil_', true) . ".$extension";

                if (move_uploaded_file($archivoTmp, $rutaDestino)) {
                    echo "<h2>¡Hola, $nombre!</h2>";
                    echo "<p>Esta es tu foto de perfil:</p>";
                    echo "<img src='$rutaDestino' alt='Foto de $nombre' style='max-width: 200px; border-radius: 10px;'>";
                } else {
                    echo "<p style='color: red;'>Error al subir el archivo. Intenta de nuevo.</p>";
                }
            } else {
                echo "<p style='color: red;'>Solo se permiten archivos JPG, JPEG, PNG o GIF.</p>";
            }
        } else {
            echo "<p style='color: red;'>Por favor, selecciona una imagen válida.</p>";
        }
    } else {
    ?>
        <!-- Formulario de subida -->
        <form method="POST" action="" enctype="multipart/form-data">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>
            <br><br>
            
            <label for="imagen">Sube tu imagen:</label>
            <input type="file" id="imagen" name="imagen" accept="image/*" required>
            <br><br>

            <button type="submit">Subir</button>
        </form>
    <?php } ?>
</body>
</html>
