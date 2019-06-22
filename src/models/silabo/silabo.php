<?php 
include_once 'src/bd/condb.php';

class Silabo extends ConDB {

  private $BASEQUERY = '
    SELECT 
    s.id_silabo,
    prd_lectivo_nombre,
    materia_nombre, 
    estado_silabo,
      STRING_AGG(
        curso_nombre, \', \'
      ) cursos
    FROM 
    public."Silabo" s, public."Materias" m,
    public."PeriodoLectivo" pl, public."Cursos" c
    WHERE 
    pl.id_prd_lectivo = s.id_prd_lectivo AND 
    m.id_materia = s.id_materia AND 
    c.id_materia = s.id_materia AND
    c.id_prd_lectivo = s.id_prd_lectivo
    
  ';
  private $ENDQUERY = '
    GROUP BY
    id_silabo,
    prd_lectivo_nombre,
    materia_nombre,
    estado_silabo
    ORDER BY prd_lectivo_nombre
  ';

  public function __construct() {
    $this->con = new ConDB();
  }

  function cargarSilabos(){
    $query =  $this->BASEQUERY .' '. $this->ENDQUERY;

    return $this->sql($query);
  }

  function buscar($id_silabo){
    $query =  $this->BASEQUERY ."
    AND s.id_silabo = $id_silabo
    ". $this->ENDQUERY;

    return $this->sql($query);
  }

  function buscarPorPeriodoMateria($aguja){
    $query =  $this->BASEQUERY ."
    AND s.id_prd_lectivo = $aguja[0] 
    AND s.id_materia = $aguja[1]
    ". $this->ENDQUERY;

    return $this->sql($query);
  }

  function buscarPorDoncente($identificacion){
    $query =  $this->BASEQUERY .'
    AND c.id_curso IN (
      SELECT id_curso 
      FROM public."Cursos" cr,
      public."Docentes" d,
      public."Personas" p
      WHERE p.persona_identificacion = \''.$identificacion.'\'
      AND d.id_persona = p.id_persona 
      AND c.id_docente = d.id_docente
    ) 
    '. $this->ENDQUERY;

    return $this->sql($query);
  }

  function buscarPorCurso($id_curso){
    $query = $this->BASEQUERY . "
    AND c.id_curso = $id_curso
    ".$this->ENDQUERY;
    return $this->sql($query);
  }

  function buscarSilabosPorPeriodo($aguja){
    $query =  $this->BASEQUERY ."
    AND s.id_prd_lectivo = $aguja
    ". $this->ENDQUERY;

    return $this->sql($query);
  }

  function buscarSilabosPorMateria($aguja){
    $query =  $this->BASEQUERY ."
    AND s.id_materia = $aguja
    ". $this->ENDQUERY;

    return $this->sql($query);
  }

  function cargarPDF($id_silabo) {
    $query =  '
    SELECT encode(documento_silabo, \'base64\') as pdf  FROM public."Silabo" 
    WHERE id_silabo = '.$id_silabo.'
    ';
    return $this->sql($query);
  }
  
}

?>