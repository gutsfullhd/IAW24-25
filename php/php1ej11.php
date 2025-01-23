<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imagen Aleatoria</title>
    <style>
        body {
            text-align: center;
            font-family: Arial, sans-serif;
            margin-top: 50px;
        }
        img {
            max-width: 80%;
            height: auto;
            border: 2px solid black;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
    <h1>Imagen Aleatoria</h1>
    <?php
      
        $imagenes = [
            "imagenes/imagen1.jpg",
            "imagenes/imagen2.jpg",
            "imagenes/imagen3.jpg",
            "imagenes/imagen4.jpg",
            "imagenes/imagen5.jpg"
        ];

       
        $indiceAleatorio = rand(0, count($imagenes) - 1);

      
        $imagenAleatoria = $imagenes[$indiceAleatorio];

       
        echo "<img src='$imagenAleatoria' alt='Imagen aleatoria'>";
    ?>
</body>
</html>
