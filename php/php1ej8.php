<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navegador del Usuario</title>
</head>
<body>
    <h1>Información del Navegador</h1>
    <?php
        
        $userAgent = $_SERVER['HTTP_USER_AGENT'];

        echo "<p><strong>Navegador detectado:</strong></p>";
        echo "<p>$userAgent</p>";

      
        if (strpos($userAgent, 'Chrome') !== false) {
            echo "<p>Estás utilizando <strong>Google Chrome</strong>.</p>";
        } elseif (strpos($userAgent, 'Firefox') !== false) {
            echo "<p>Estás utilizando <strong>Mozilla Firefox</strong>.</p>";
        } elseif (strpos($userAgent, 'Safari') !== false && strpos($userAgent, 'Chrome') === false) {
            echo "<p>Estás utilizando <strong>Safari</strong>.</p>";
        } elseif (strpos($userAgent, 'Edge') !== false) {
            echo "<p>Estás utilizando <strong>Microsoft Edge</strong>.</p>";
        } elseif (strpos($userAgent, 'MSIE') !== false || strpos($userAgent, 'Trident') !== false) {
            echo "<p>Estás utilizando <strong>Internet Explorer</strong>.</p>";
        } else {
            echo "<p>No se pudo determinar el navegador con precisión.</p>";
        }
    ?>
</body>
</html>
