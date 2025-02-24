<?php
// Ruta al archivo que se va a descargar
$archivo = 'archivo.txt';

// Verificar si el archivo existe
if (file_exists($archivo)) {
    // Configurar las cabeceras para forzar la descarga
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream'); // Tipo de contenido genérico para descargas
    header('Content-Disposition: attachment; filename="' . basename($archivo) . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($archivo)); // Tamaño del archivo

    // Leer el archivo y enviarlo al usuario
    readfile($archivo);
    exit; // Terminar la ejecución del script
} else {
    // Si el archivo no existe, mostrar un mensaje de error
    echo "El archivo no existe.";
}
?>