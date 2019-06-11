<?php 
include_once 'Curso.php';
include_once 'src/Api/Api.php';

class CursoAPI extends Api {
  
  function cargarTodos() {
    $c = new Curso(); 
    $cursos = array(); 
    $cursos['items'] = array(); 

    $res = $c->cargarCursos();

    if($res != null){
      if($res->rowCount()) {
        while ($r = $res->fetch(PDO::FETCH_ASSOC)) {
          $i = array(
            'prd_lectivo_nombre' => $r['prd_lectivo_nombre'],
            'persona_primer_nombre' => $r['persona_primer_nombre'],
            'persona_primer_apellido' => $r['persona_primer_apellido'],
            'curso_nombre' => $r['curso_nombre'],
            'curso_ciclo' => $r['curso_ciclo'],
            'curso_capacidad' => $r['curso_capacidad'],
            'materia_nombre' => $r['materia_nombre']
          );
  
          array_push($cursos['items'], $i);
        }
  
        $this->muestraJSON($cursos);
      }else{
        $this->error('No pudimos encontrar cursos.');
      }
    } else {
      $this->error('No pudimos consultar.');
    }
  }  
}

?>