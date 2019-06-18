<?php 
echo "<h1>Hola curso</h1>";

if(isset($_GET['id_periodo'])){
  echo "<h2>".$_GET['id_periodo']."</h2>";
}


function diHola(){
  echo "HOLAAAAAAAAAAAAA";
}
?>