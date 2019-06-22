<?php 
include_once 'carrera.php';
include_once 'src/api/api.php';

class CarreraAPI extends Api {

  private $carrera;

  function __construct(){
    $this->carrera = new Carrera(); 
  }
  
  function todos() {
    $res = $this->carrera->cargarTodos();

    $this->muestraJSON($this->obtenerJSON($res));
  } 

  function buscar($aguja){
    $res = null;
    if(ctype_digit($aguja)){
      $res = $this->carrera->buscar($aguja);
    }else{
      $res = $this->carrera->buscarCarrera($aguja);
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
            'id_carrera' => $r['id_carrera'],
            'carrera_nombre' => $r['carrera_nombre'],
            'carrera_codigo' => $r['carrera_codigo']
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