<?php
$servername = "sql308.thsite.top";
$username = "thsi_38097486";
$password = "!uH!cRwa";
$dbname = "thsi_38097486_bdtonyiaw";

//Crear la conexión
$conn =  mysqli_connect($servername, $username, $password, $dbname);

//Comprobar conexión
if (!$conn){
    die("Connection failed: " .mysql_connect_error());
}

$sql = "UPDATE usuarios  SET password = 'torrente2' where id = 400";

if (mysqli_query($conn, $sql)) {
    echo "Nuevo registrado actualizado exitosamente";   
}
else{
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

?>