<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WHILE</title>
</head>
<body>
    <h1>WHILE</h1>
    <?php
        $numero = 1; 
        $total = 10; 
        echo "<table border='1'>";

        
        while ($numero <= $total) { 
            echo "<tr><td>" . $numero . "</td></tr>\n"; 
            $numero += 1;
        }

        echo "</table>";
    ?>
</body>
</html>
