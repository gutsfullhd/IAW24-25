<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Días para la Feria</title>
</head>
<body>
    <h1>¿Cuántos días quedan para la Feria 2025?</h1>
    <?php
        
        $fecha_actual = new DateTime();

       
        $fecha_feria = new DateTime('2025-05-06');

        $diferencia = $fecha_actual->diff($fecha_feria);

        if ($fecha_actual > $fecha_feria) {
            echo "<p>La Feria de 2025 ya ha pasado.</p>";
        } else {
            echo "<p>Quedan " . $diferencia->days . " días para que comience la Feria de 2025.</p>";
        }
    ?>
</body>
</html>
<?php
$fechaactual = date ('Y-m-d');
$fechaferia = date_create('2025-05-06');
$fechahoy = date_create($fechaactual);
$contador = date_diff($fechaferia, $fechahoy);
$diferenciaformat = '%a';
echo "Quedan " . $contador . "para la feria";
?>
