<?php 

//include_once 'src/models/curso/cursoapi.php';
//$curso = new CursoAPI(); 
//$curso->cargarTodos();

include_once 'src/controllers/controladorapi.php';

$ctr = new ControladorAPI();
$ctr->obtenerUrl();

?>