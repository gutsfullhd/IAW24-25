<?php

$diccionario = [
    "gato" => "cat",
    "perro" => "dog",
    "casa" => "house",
    "libro" => "book",
    "mesa" => "table"
];


$totalPalabras = count($diccionario);

echo "<p>Total de palabras en el diccionario: $totalPalabras</p>";


echo "<ul>";
foreach ($diccionario as $espanol => $ingles) {
    echo "<li>$espanol => $ingles</li>";
}
echo "</ul>";
?>
