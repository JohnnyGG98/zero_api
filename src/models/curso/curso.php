<?php 
include_once 'src/bd/condb.php';

class Curso extends ConDB {

  private $BASEQUERY = '
  SELECT
  pl.id_prd_lectivo,
  prd_lectivo_nombre,
  persona_primer_nombre, 
  persona_primer_apellido,
  c.id_curso,
  curso_nombre,
  curso_ciclo, 
  curso_capacidad,
  materia_nombre
  FROM
  public."Cursos" c, public."Personas" p,
  public."Docentes" d, public."PeriodoLectivo" pl,
  public."Materias" m
  WHERE 
  c.id_prd_lectivo = pl.id_prd_lectivo AND 
  d.id_docente = c.id_docente AND 
  p.id_persona = d.id_persona AND
  m.id_materia = c.id_materia
  ';
  private $ENDQUERY = '
  ORDER BY prd_lectivo_nombre
  ';

  public function __construct() {
    $this->con = new ConDB();
    //$this->ct = $this->con->getCon();
  }

  function cargarCursos() {
    $query =  $this->BASEQUERY .' '. $this->ENDQUERY;

    return $this->sql($query);
  }

  function cargarCursosPorPrd() {

  }

  function buscarCursos($aguja) {
    $query = $this->BASEQUERY." AND (
      curso_nombre ILIKE '%$aguja%'
    )".' '. $this->ENDQUERY;
    return $this->sql($query);
  }
  
}

?>