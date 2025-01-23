<?php

$palabras = ["manzana", "pera", "plátano", "cereza", "kiwi"];


sort($palabras);

echo "<p>Palabras ordenadas lexicográficamente:</p>";
echo "<ul>";
foreach ($palabras as $palabra) {
    echo "<li>$palabra</li>";
}
echo "</ul>";
?>
