<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emoticono Aleatorio</title>
    <style>
        body {
            text-align: center;
            font-family: Arial, sans-serif;
            margin-top: 50px;
        }
        .emoticono {
            font-size: 100px;
            margin: 20px;
        }
    </style>
</head>
<body>
    <h1>Emoticono Aleatorio</h1>
    <?php
   
        $unicode = rand(128512, 128586);

       
        $emoticono = mb_convert_encoding("&#{$unicode};", 'UTF-8', 'HTML-ENTITIES');

       
        echo "<div class='emoticono'>$emoticono</div>";
        echo "<p>Código Unicode: <strong>U+{$unicode}</strong></p>";
    ?>
</body>
</html>
