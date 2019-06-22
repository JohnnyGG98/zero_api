<?php 
include_once 'src/bd/condb.php';

class Carrera extends ConDB {

  private $BASEQUERY = '
  SELECT 
  id_carrera,
  carrera_nombre, 
  carrera_codigo
  FROM public."Carreras"
  WHERE
  ';
  private $ENDQUERY = '
  carrera_activo = true
  ORDER BY carrera_codigo;
  ';

  public function __construct() {
    $this->con = new ConDB();
  }

  function cargarTodos() {
    $query = $this->BASEQUERY . ' ' . $this->ENDQUERY;
    return $this->sql($query);
  }

  function buscar($id_carrera) {
    $query = $this->BASEQUERY . "
    id_carrera = $id_carrera AND 
    " . $this->ENDQUERY;
    return $this->sql($query);
  }

  function buscarCarrera($aguja) {
    $query = $this->BASEQUERY . "
    (
      carrera_nombre ILIKE '%$aguja%' OR
      carrera_codigo ILIKE '%$aguja%'
    ) AND
    " . $this->ENDQUERY;
    return $this->sql($query);
  }

  
}

?>