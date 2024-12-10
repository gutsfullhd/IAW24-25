<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Encuesta Personal</title>
</head>
<body>
    <h1>Encuesta Personal</h1>
    <?php
   
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      
        $nombre = htmlspecialchars(trim($_POST['nombre']));
        $edad = htmlspecialchars(trim($_POST['edad']));
        $genero = htmlspecialchars($_POST['genero'] ?? 'No especificado');
        $hobbies = $_POST['hobbies'] ?? [];
        $ciudad = htmlspecialchars($_POST['ciudad'] ?? 'No seleccionada');
        
       
        echo "<h2>Resumen de la Encuesta</h2>";
        echo "<p><strong>Nombre:</strong> $nombre</p>";
        echo "<p><strong>Edad:</strong> $edad</p>";
        echo "<p><strong>Género:</strong> $genero</p>";
        echo "<p><strong>Hobbies:</strong> " . (empty($hobbies) ? 'Ninguno' : implode(', ', array_map('htmlspecialchars', $hobbies))) . "</p>";
        echo "<p><strong>Ciudad:</strong> $ciudad</p>";
    } else {
    ?>
    
        <form method="POST" action="">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>
            <br><br>

            <label for="edad">Edad:</label>
            <input type="number" id="edad" name="edad" min="1" required>
            <br><br>

            <label>Género:</label>
            <input type="radio" id="genero_m" name="genero" value="Masculino" required>
            <label for="genero_m">Masculino</label>
            <input type="radio" id="genero_f" name="genero" value="Femenino">
            <label for="genero_f">Femenino</label>
            <input type="radio" id="genero_o" name="genero" value="Otro">
            <label for="genero_o">Otro</label>
            <br><br>

            <label>Hobbies:</label>
            <input type="checkbox" id="hobby_lectura" name="hobbies[]" value="Lectura">
            <label for="hobby_lectura">Lectura</label>
            <input type="checkbox" id="hobby_deportes" name="hobbies[]" value="Deportes">
            <label for="hobby_deportes">Deportes</label>
            <input type="checkbox" id="hobby_musica" name="hobbies[]" value="Música">
            <label for="hobby_musica">Música</label>
            <input type="checkbox" id="hobby_cocina" name="hobbies[]" value="Cocina">
            <label for="hobby_cocina">Cocina</label>
            <br><br>

            <label for="ciudad">Ciudad:</label>
            <select id="ciudad" name="ciudad" required>
                <option value="">Seleccione una ciudad</option>
                <option value="Madrid">Madrid</option>
                <option value="Barcelona">Barcelona</option>
                <option value="Valencia">Valencia</option>
                <option value="Sevilla">Sevilla</option>
            </select>
            <br><br>

            <button type="submit">Enviar Encuesta</button>
        </form>
    <?php } ?>
</body>
</html>
