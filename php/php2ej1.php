<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fecha y Hora</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 50px;
        }
        .fecha-hora {
            font-size: 24px;
            color: #333;
        }
    </style>
</head>
<body>
    <h1>Fecha y Hora Actual</h1>
    <div class="fecha-hora">
        <?php
       
        date_default_timezone_set("Europe/Madrid");

       
        setlocale(LC_TIME, "es_ES.UTF-8", "es_ES", "Spanish_Spain.1252");

 
        $fecha = strftime("%A, %d de %B de %Y");
        $hora = date("H:i:s");

      
        echo "Hoy es $fecha y la hora actual es $hora.";
        ?>
    </div>
</body>
</html>
