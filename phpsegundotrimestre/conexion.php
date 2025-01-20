<?php 
$servername = "sql308.thsite.top";
$username = "thsi_38097486";
$password = "!uH!cRwa";


// Crear la conexión
$conn = msqli_connect($servername, $username, $password);

// Comprobar la conexión 
 if (!$conn) {
    die("Conexión fallida: " . msqli_connect_error());

 }
 echo "Conexión exitosa";

 ?>