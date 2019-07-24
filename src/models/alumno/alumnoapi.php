<?php
include_once 'alumno.php';
include_once 'src/api/api.php';

class AlumnoAPI extends Api {

  private $alumno;

  function __construct(){
    $this->alumno = new Alumno();
  }

  function todos() {
    $res = $this->alumno->cargarTodos();

    $this->muestraJSON($this->obtenerJSON($res));
  }

  function curso($id_curso){
    $res = $this->alumno->buscarPorCurso($id_curso);

    $this->muestraJSON($this->obtenerJSON($res));
  }

  function buscar($aguja){
    $res = null;
    if(ctype_digit($aguja) && substr($aguja, 0, 1) != 0){
      $res = $this->alumno->buscar($aguja);
    }else{
      $res = $this->alumno->buscarAlumno($aguja);
    }

    $this->muestraJSON($this->obtenerJSON($res));
  }

  function obtenerJSON($res){
    if($res != null){
      if($res->rowCount()) {
        $cursos = array();
        $cursos['items'] = array();

        while ($r = $res->fetch(PDO::FETCH_ASSOC)) {
          $i = array(
            'id_alumno' => $r['id_alumno'],
            'id_persona' => $r['id_persona'],
            'persona_primer_nombre' => $r['persona_primer_nombre'],
            'persona_primer_apellido' => $r['persona_primer_apellido'],
            'persona_segundo_nombre' => $r['persona_segundo_nombre'],
            'persona_segundo_apellido' => $r['persona_segundo_apellido'],
            'persona_identificacion' => $r['persona_identificacion'],
            'persona_correo' => $r['persona_correo'],
            'persona_celular' => $r['persona_celular'],
            'persona_telefono' => $r['persona_telefono']
          );

          array_push($cursos['items'], $i);
        }
        return $cursos;
      }else{
        $this->error('No pudimos encontrar cursos.');
      }
    } else {
      $this->error('No pudimos consultar.');
    }
  }

}

?>
