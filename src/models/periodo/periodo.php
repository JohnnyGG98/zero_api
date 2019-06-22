<?php 
include_once 'src/bd/condb.php';

class Periodo extends ConDB {

  private $BASEQUERY = '
  SELECT
  id_prd_lectivo,
  prd_lectivo_nombre
  FROM public."PeriodoLectivo"
  WHERE 
  
  ';
  private $ENDQUERY = '
  prd_lectivo_activo = true
  ORDER BY 
  prd_lectivo_nombre,
  prd_lectivo_fecha_fin DESC;
  ';

  public function __construct() {
    $this->con = new ConDB();
  }

  function cargarTodos() {
    $query = $this->BASEQUERY . ' ' . $this->ENDQUERY;
    return $this->sql($query);
  }

  function buscar($id_periodo) {
    $query = $this->BASEQUERY . "
      id_prd_lectivo = $id_periodo AND 
    " . $this->ENDQUERY;
    return $this->sql($query);
  }

  function buscarPeriodo($aguja) {
    $query = $this->BASEQUERY . "
      prd_lectivo_nombre ILIKE '%$aguja%' AND
    " . $this->ENDQUERY;
    return $this->sql($query);
  }

  function buscarPorCarrera($id_carrera) {
    $query = $this->BASEQUERY . "
      id_carrera = $id_carrera AND
    " . $this->ENDQUERY;
    return $this->sql($query);
  }

  
}

?>