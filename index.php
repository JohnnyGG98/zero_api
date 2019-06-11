<?php 

include_once 'src/Curso/CursoAPI.php';

$curso = new CursoAPI(); 

$curso->cargarTodos();

?>