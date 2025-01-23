<?php
$servername = "sql308.thsite.top";
$username = "thsi_38097486";
$password = "!uH!cRwa";
$dbname = "thsi_38097486_bdtonyiaw";


//Crear la conexión
$conn = mysqli_connect($servername, $username, $password, $dbname);

//Comprobar la conexión
if (!$conn) {
    die ("Connection failed: " . mysqli_connect_error());

}

$sql = "SELECT username, password FROM usuarios";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // datos salientes de cada fila

    while($row = mysqli_fetch_assoc($result)) {
        echo "username:" .$row["username"]. "password". $row["password"]. "<br>";

    } else {
        echo "0 results";
    }
}
?>