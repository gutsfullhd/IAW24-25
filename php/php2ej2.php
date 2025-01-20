<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Día de la Semana</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 50px;
        }
        .mensaje {
            font-size: 20px;
            color: #555;
        }
    </style>
</head>
<body>
    <h1>Día de la Semana</h1>
    <div class="mensaje">
        <?php
        
        date_default_timezone_set("Europe/Madrid");

        $diaSemana = date("N");

       
        switch ($diaSemana) {
            case 1:
                echo "Hoy es lunes. ¡Comienza una nueva semana llena de oportunidades!";
                break;
            case 2:
                echo "Hoy es martes. ¡Es un buen día para avanzar en tus proyectos!";
                break;
            case 3:
                echo "Hoy es miércoles. ¡Mitad de semana, ánimo que ya queda menos!";
                break;
            case 4:
                echo "Hoy es jueves. ¡El fin de semana está a la vuelta de la esquina!";
                break;
            case 5:
                echo "Hoy es viernes. ¡Por fin es viernes, disfruta del día!";
                break;
            case 6:
                echo "Hoy es sábado. ¡Relájate y disfruta del fin de semana!";
                break;
            case 7:
                echo "Hoy es domingo. ¡Tiempo de descanso y recarga para la semana!";
                break;
            default:
                echo "Error al determinar el día de la semana.";
                break;
        }
        ?>
    </div>
</body>
</html>
