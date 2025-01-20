<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuadrado de Color Aleatorio</title>
    <style>
        .cuadrado {
            width: 300px;
            height: 300px;
            margin: 20px auto;
        }
    </style>
</head>
<body>
    <h1>Cuadrado de Color Aleatorio</h1>
    <?php
       
        $rojo = rand(0, 255);
        $verde = rand(0, 255);
        $azul = rand(0, 255);

      
        $color = sprintf("#%02x%02x%02x", $rojo, $verde, $azul);

        echo "<div class='cuadrado' style='background-color: $color;'></div>";
        echo "<p>Color generado: <strong>$color</strong></p>";
    ?>
</body>
</html>
