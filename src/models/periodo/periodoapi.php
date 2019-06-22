<?php 
include_once 'periodo.php';
include_once 'src/api/api.php';

class PeriodoAPI extends Api {

  private $periodo;

  function __construct(){
    $this->periodo = new Periodo(); 
  }
  
  function todos() {
    $res = $this->periodo->cargarTodos();

    $this->muestraJSON($this->obtenerJSON($res));
  } 

  function buscar($aguja){
    $res = null;
    if(ctype_digit($aguja)){
      $res = $this->periodo->buscar($aguja);
    }else{
      $res = $this->periodo->buscarPeriodo($aguja);
    }

    $this->muestraJSON($this->obtenerJSON($res));
  }

  function carrera($id_carrera) {
    $res = $this->periodo->buscarPorCarrera($id_carrera);

    $this->muestraJSON($this->obtenerJSON($res));
  } 

  function obtenerJSON($res){
    if($res != null){
      if($res->rowCount()) {
        $cursos = array(); 
        $cursos['items'] = array(); 

        while ($r = $res->fetch(PDO::FETCH_ASSOC)) {
          $i = array(
            'id_prd_lectivo' => $r['id_prd_lectivo'],
            'prd_lectivo_nombre' => $r['prd_lectivo_nombre']
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