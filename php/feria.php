<?php
$fechaactual = date ('Y-m-d');
$fechaferia = date_create('2025-05-06');
$fechahoy = date_create($fechaactual);
$contador = date_diff($fechaferia, $fechahoy);
$diferenciaformat = '%a';
echo "Quedan " . $contador . "para la feria";
?>
