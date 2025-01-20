<?php

function generarPiramide($n) {
    // Verificar que el número es un entero positivo
    if (!is_int($n) || $n <= 0) {
        throw new Exception("Error: Ingrese un número entero positivo.");
    }

    // Usamos un bucle 'for' para crear la pirámide
    for ($i = 1; $i <= $n; $i++) {
        // Imprimir espacios y asteriscos para cada fila de la pirámide
        // Después de cada línea, usamos "\n" para un salto de línea
        echo str_repeat(" ", $n - $i) . str_repeat("*", 2 * $i - 1) . "\n";
    }
}

function main() {
    // Pedir al usuario un número
    echo "Introduce un número entero positivo: ";
    $numero = trim(fgets(STDIN));

    // Validar que la entrada es un número entero positivo
    // filter_var asegura que la entrada sea un número entero sin caracteres maliciosos
    $numero = filter_var($numero, FILTER_VALIDATE_INT);

    if ($numero === false || $numero <= 0) {
        echo "Error: Ingrese un número entero positivo.\n";
    } else {
        // Llamar a la función para generar la pirámide
        try {
            // Usamos un cast a entero para asegurarnos de que es un número entero
            generarPiramide((int)$numero);
        } catch (Exception $e) {
            echo $e->getMessage() . "\n";
        }
    }
}

// Ejecutar el script
main();

?>
