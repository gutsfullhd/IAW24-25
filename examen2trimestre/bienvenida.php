<?php
// Iniciar la sesión
session_start();

// Verificar si la variable de sesión 'visitas' está definida
if (isset($_SESSION['visitas'])) {
    // Incrementar el contador de visitas
    $_SESSION['visitas']++;
    echo "¡Bienvenido de nuevo! Esta es tu visita número " . $_SESSION['visitas'] . ".";
} else {
    // Si es la primera visita, inicializar el contador
    $_SESSION['visitas'] = 1;
    echo "¡Bienvenido, es tu primera visita!";
}
?>