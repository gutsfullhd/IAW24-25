<?php
// Definir variables y establecer valores vacíos
$nombreErr = $apellidoErr = $dniErr = $emailErr = $passwordErr = $passwordConfirmErr = $provinciaErr = $ciudadErr = "";
$nombre = $apellido = $dni = $email = $password = $passwordConfirm = $provincia = $ciudad = "";
$esValido = true;

// Validación cuando el formulario es enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar nombre
    if (empty($_POST["nombre"])) {
        $nombreErr = "Debes rellenar este campo";
        $esValido = false;
    } else {
        $nombre = test_input($_POST["nombre"]);
    }

    // Validar apellido
    if (empty($_POST["apellido"])) {
        $apellidoErr = "Debes rellenar este campo";
        $esValido = false;
    } else {
        $apellido = test_input($_POST["apellido"]);
    }

    // Validar DNI
    if (empty($_POST["dni"])) {
        $dniErr = "Debes rellenar este campo";
        $esValido = false;
    } else {
        $dni = test_input($_POST["dni"]);
        if (!preg_match("/^[0-9]{8}[A-Za-z]$/", $dni)) {
            $dniErr = "El DNI no es válido";
            $esValido = false;
        }
    }

    // Validar correo electrónico
    if (empty($_POST["email"])) {
        $emailErr = "Debes rellenar este campo";
        $esValido = false;
    } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "El formato del correo electrónico no es válido";
            $esValido = false;
        }
    }

    // Validar contraseñas
    if (empty($_POST["password"])) {
        $passwordErr = "Debes rellenar este campo";
        $esValido = false;
    } else {
        $password = test_input($_POST["password"]);
        if (strlen($password) < 8) {
            $passwordErr = "La contraseña debe tener al menos 8 caracteres";
            $esValido = false;
        }
    }

    // Validar confirmación de la contraseña
    if (empty($_POST["password-confirm"])) {
        $passwordConfirmErr = "Debes rellenar este campo";
        $esValido = false;
    } else {
        $passwordConfirm = test_input($_POST["password-confirm"]);
        if ($password !== $passwordConfirm) {
            $passwordConfirmErr = "Las contraseñas no coinciden";
            $esValido = false;
        }
    }

    // Validar provincia
    if (empty($_POST["provincia"])) {
        $provinciaErr = "Debes rellenar este campo";
        $esValido = false;
    } else {
        $provincia = test_input($_POST["provincia"]);
    }

    // Validar ciudad
    if (empty($_POST["ciudad"])) {
        $ciudadErr = "Debes rellenar este campo";
        $esValido = false;
    } else {
        $ciudad = test_input($_POST["ciudad"]);
    }

    // Si todo es válido, mostrar mensaje de éxito
    if ($esValido) {
        // Puedes realizar el procesamiento del formulario (guardar en base de datos, enviar un correo, etc.)
        echo "<h3>Usuario creado exitosamente</h3>";
        echo "<p><strong>Nombre:</strong> " . $nombre . "</p>";
        echo "<p><strong>Apellido:</strong> " . $apellido . "</p>";
        echo "<p><strong>DNI:</strong> " . $dni . "</p>";
        echo "<p><strong>Email:</strong> " . $email . "</p>";
        echo "<p><strong>Provincia:</strong> " . $provincia . "</p>";
        echo "<p><strong>Ciudad:</strong> " . $ciudad . "</p>";

        // Limpiar los campos del formulario
        $nombre = $apellido = $dni = $email = $password = $passwordConfirm = $provincia = $ciudad = "";
    }
}

// Función para sanitizar entradas
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro</title>
    <style>
        .error {
            color: red;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <h2>Formulario de Registro</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <!-- Campo Nombre -->
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo $nombre; ?>">
        <div class="error"><?php echo $nombreErr; ?></div>

        <!-- Campo Apellido -->
        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido" value="<?php echo $apellido; ?>">
        <div class="error"><?php echo $apellidoErr; ?></div>

        <!-- Campo DNI -->
        <label for="dni">DNI:</label>
        <input type="text" id="dni" name="dni" value="<?php echo $dni; ?>">
        <div class="error"><?php echo $dniErr; ?></div>

        <!-- Campo Email -->
        <label for="email">Correo Electrónico:</label>
        <input type="email" id="email" name="email" value="<?php echo $email; ?>">
        <div class="error"><?php echo $emailErr; ?></div>

        <!-- Campo Contraseña -->
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password">
        <div class="error"><?php echo $passwordErr; ?></div>

        <!-- Campo Confirmación Contraseña -->
        <label for="password-confirm">Repetir Contraseña:</label>
        <input type="password" id="password-confirm" name="password-confirm">
        <div class="error"><?php echo $passwordConfirmErr; ?></div>

        <!-- Campo Provincia -->
        <label for="provincia">Provincia:</label>
        <input type="text" id="provincia" name="provincia" value="<?php echo $provincia; ?>">
        <div class="error"><?php echo $provinciaErr; ?></div>

        <!-- Campo Ciudad -->
        <label for="ciudad">Ciudad:</label>
        <input type="text" id="ciudad" name="ciudad" value="<?php echo $ciudad; ?>">
        <div class="error"><?php echo $ciudadErr; ?></div>

        <button type="submit">Enviar</button>
    </form>
</body>
</html>
