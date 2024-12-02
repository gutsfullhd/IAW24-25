<?php
     $imagenes = new Array("imagen1.jpg","imagen2.jpg","imagen3jpg");
     $n = rand(0, count($imagenes)-1);
     $fotoAleatoria = $imagenes[$n];
     echo "<img src='" . $fotoAleatoria . "'>"
?>
