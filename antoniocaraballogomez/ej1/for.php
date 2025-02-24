GNU nano 7.2                                                                for.php                                                                         
<!DOCTYPE HTML PUBLIC>
<html>
    <head>
              
        <title>TABLAS</title>
    </head>
    <body>
        <h1>Tabla de multiplicar</h1>
        <form action="" method="post">
            Introduce un número: 
            <input type="text" name="numero"/><br/><br/>
            <input type="submit" value="Multiplicar"/>            
        </form>

 <?php
           $numero=intval($_POST['numero']);
           echo $numero;
  for($i=1;$i<=10;$i++){
              if ($i%2==0){ 
                echo "<li><span style='color:red'>$numero x $i = ";
                echo $numero*$i;
                echo "</span></li>";
              }    
              else{
                echo "<li>$numero x $i = ";
                echo $numero*$i;
                echo "</li>";
              } 
            } 
        ?>

    </body>
</html>

