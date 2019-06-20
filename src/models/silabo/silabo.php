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

  function buscarSilabos($aguja){
    $query =  $this->BASEQUERY ."
    AND s.id_prd_lectivo = $aguja[0] 
    AND s.id_materia = $aguja[1]
    ". $this->ENDQUERY;

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

  function cargarPDF() {
    $query =  '
    SELECT encode(documento_silabo, \'base64\') as pdf  FROM public."Silabo" 
    WHERE id_silabo = 3936
    ';
    return $this->sql($query);
  }
  
}

?>