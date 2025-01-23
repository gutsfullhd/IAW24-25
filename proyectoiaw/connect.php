<?php
$servername = "sql308.thsite.top";
$username = "thsi_38097486";
$password = "!uH!cRwa";
$dbname = "thsi_38097486_bdiesantoniomachadotonycg";


$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>
