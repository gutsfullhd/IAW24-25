<?php

 $numero = 1; //Empezamos por numero
 $total = 10; // Llegaos hasta diez
 echo "<table border='1'>";
 while ($numero < $total){
         echo "<tr><td>" . $numero . "</tr></td>\n";
         $numero += 1;
  }
echo "</table>";
?>
