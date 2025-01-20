<?php

$ip = $_SERVER['REMOTE_ADDR'] ?? 'No disponible';

$navegador = $_SERVER['HTTP_USER_AGENT'] ?? 'No disponible';


$referencia = $_SERVER['HTTP_REFERER'] ?? 'No disponible';


echo "<p><strong>Dirección IP:</strong> $ip</p>";
echo "<p><strong>Navegador:</strong> $navegador</p>";
echo "<p><strong>Página de referencia:</strong> $referencia</p>";
?>
