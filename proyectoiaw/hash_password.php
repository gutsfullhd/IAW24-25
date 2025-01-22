<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    echo "Contraseña original: " . $password . "<br>";
    echo "Contraseña hasheada: " . $hashed_password;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Hashear Contraseña</title>
</head>
<body>
    <h1>Hashear Contraseña</h1>
    <form method="POST" action="hash_password.php">
        <label>Contraseña:</label>
        <input type="password" name="password" required><br>
        <button type="submit">Hashear</button>
    </form>
</body>
</html>
