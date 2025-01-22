<?php
require_once 'connect.php';


$stmt = $conn->query("SELECT id, password FROM usuarios");
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($usuarios as $usuario) {
 
    if (!password_verify('prueba123', $usuario['password'])) { 
        $hashedPassword = password_hash($usuario['password'], PASSWORD_DEFAULT);

        // Actualizar la contraseña en la base de datos
        $updateStmt = $conn->prepare("UPDATE usuarios SET password = :password WHERE id = :id");
        $updateStmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
        $updateStmt->bindParam(':id', $usuario['id'], PDO::PARAM_INT);
        $updateStmt->execute();
    }
}
echo "Contraseñas encriptadas correctamente.";
?>
