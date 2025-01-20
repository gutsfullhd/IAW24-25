<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Operadores con Cadenas</title>
</head>
<body>
    <h1>Operadores con Cadenas en PHP</h1>
    <?php
    
        $cadena1 = "Hola";
        $cadena2 = "Mundo";

       
        $resultadoConcatenacion = $cadena1 . " " . $cadena2 . "!";
        echo "<p><strong>Concatenación:</strong> $resultadoConcatenacion</p>";

      
        $cadena1 .= " a todos";
        echo "<p><strong>Asignación combinada:</strong> $cadena1</p>";

        
        $cadena3 = "Hola";
        $resultadoIgual = $cadena1 == $cadena3 ? "Son iguales" : "No son iguales";
        echo "<p><strong>Comparación (==):</strong> $resultadoIgual</p>";

        $resultadoIdentico = $cadena1 === $cadena3 ? "Son idénticos" : "No son idénticos";
        echo "<p><strong>Comparación (===):</strong> $resultadoIdentico</p>";

       
        $resultadoOrden = $cadena1 > $cadena2 ? "$cadena1 es mayor que $cadena2" : "$cadena1 no es mayor que $cadena2";
        echo "<p><strong>Comparación alfabética (>):</strong> $resultadoOrden</p>";

        $resultadoLogico = $cadena1 && $cadena2 ? "Ambas cadenas tienen contenido" : "Alguna cadena está vacía";
        echo "<p><strong>Operador lógico (&&):</strong> $resultadoLogico</p>";

       
        $lista = "";
        $palabras = ["Bienvenidos", "a", "PHP"];
        foreach ($palabras as $palabra) {
            $lista .= $palabra . " ";
        }
        echo "<p><strong>Concatenación en bucle:</strong> $lista</p>";

       
        echo "<p><strong>Longitud de cadena1:</strong> " . strlen($cadena1) . " caracteres</p>";
    ?>
</body>
</html>
