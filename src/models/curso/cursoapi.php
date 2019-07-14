<?php
include_once 'curso.php';
include_once 'src/api/api.php';

class CursoAPI extends Api {

  private $curso;

  function __construct(){
    $this->curso = new Curso();
  }

  function todos() {
    $res = $this->curso->cargarCursos();

    $this->muestraJSON($this->obtenerJSON($res));
  }

  function periodo($id_periodo) {
    $res = $this->curso->cargarCursosPorPeriodo($id_periodo);

    $this->muestraJSON($this->obtenerJSON($res));
  }

  function docente($aguja) {
    $res = $this->curso->cargarPorDoncente($aguja);

    $this->muestraJSON($this->obtenerJSON($res));
  }

  function alumno($aguja) {
    $res = $this->curso->buscarPorAlumno($aguja);

    $this->muestraJSON($this->obtenerJSON($res));
  }

  function nombre($id_periodo){
    $res = $this->curso->cargarCursosNombrePorPeriodo($id_periodo);

    $this->muestraJSON($this->obtenerJSONNombre($res));
  }

  function materia($param){
    $res = $this->curso->cargarCursosMateriaPorNombrePeriodo($param[0], $param[1]);

    $this->muestraJSON($this->obtenerJSONMateria($res));
  }

  function buscar($aguja){
    //echo "<h2>Buscamos $aguja</h2>";
    $res = null;
    if(ctype_digit($aguja)){
      $res = $this->curso->buscar($aguja);
    }else{
      $res = $this->curso->buscarCursos($aguja);
    }

    $this->muestraJSON($this->obtenerJSON($res));
  }

  function obtenerJSONNombre($res){
    if($res != null){
      if($res->rowCount()) {
        $cursos = array();
        $cursos['items'] = array();

        while ($r = $res->fetch(PDO::FETCH_ASSOC)) {
          $i = array(
            'curso_nombre' => $r['curso_nombre']
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

  function obtenerJSONMateria($res){
    if($res != null){
      if($res->rowCount()) {
        $cursos = array();
        $cursos['items'] = array();

        while ($r = $res->fetch(PDO::FETCH_ASSOC)) {
          $i = array(
            'id_curso' => $r['id_curso'],
            'materia_nombre' => $r['materia_nombre']
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

  function obtenerJSON($res){
    if($res != null){
      if($res->rowCount()) {
        $cursos = array();
        $cursos['items'] = array();

        while ($r = $res->fetch(PDO::FETCH_ASSOC)) {
          $i = array(
            'id_prd_lectivo' => $r['id_prd_lectivo'],
            'prd_lectivo_nombre' => $r['prd_lectivo_nombre'],
            'persona_primer_nombre' => $r['persona_primer_nombre'],
            'persona_primer_apellido' => $r['persona_primer_apellido'],
            'id_curso' => $r['id_curso'],
            'curso_nombre' => $r['curso_nombre'],
            'curso_ciclo' => $r['curso_ciclo'],
            'curso_capacidad' => $r['curso_capacidad'],
            'id_materia' => $r['id_materia'],
            'materia_nombre' => $r['materia_nombre']
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
