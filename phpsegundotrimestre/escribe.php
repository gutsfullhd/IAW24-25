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

$sql = "INSERT INTO usuarios (id, username, password)
VALUES ('400', 'Torrente', 'torrente')";

if (mysqli_query($conn, $sql)) {
    echo "Nuevo registrado creado exitosamente";   
}
else{
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

?>