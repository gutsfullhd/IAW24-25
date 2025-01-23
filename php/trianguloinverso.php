<!doctype html>
<html>
<head>
    <title>Examen</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        #formulario {
            margin-bottom: 20px;
        }
        .triangle {
            white-space: pre;
            font-family: monospace;
        }
    </style>
</head>
<body>
<h1>Triángulo</h1>
<form id="formulario" action="triangulo.php">
    <input type="text" name="numero" id="numero" placeholder="Introduce un número" required>
    <input type="submit" value="Enviar">
</form>

<?php
if (isset($_GET["numero"])) {
    $numero = $_GET["numero"];
    if (is_numeric($numero) && $numero > 0) {
        $numero = intval($numero); 
        echo "<div class='triangle'>";
       
        for ($i = 1; $i <= $numero; $i++) {
            for ($j = 1; $j <= $i; $j++) {
                echo "* ";
            }
            echo "<br>";
        }
        echo "</div>";
    } else {
        echo "<p style='color:red;'>Error: Introduce un número válido mayor que 0.</p>";
    }
}
?>

<script>
document.addEventListener("DOMContentLoaded", function() {
  document.getElementById("formulario").addEventListener('submit', compruebaNumero); 
});

function compruebaNumero(evento){
    evento.preventDefault();
    let numero = parseInt(document.getElementById('numero').value);
    if (numero <= 0 || isNaN(numero)){
        alert("¡Error!¡Debes escribir número positivo mayor que cero!");
        return;
    }
    this.submit();
}
</script>
</body>
</html>
