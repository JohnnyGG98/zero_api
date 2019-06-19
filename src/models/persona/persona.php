<?php 
include_once 'src/bd/condb.php';

class Persona extends ConDB {

  private $BASEQUERY = '
  
  ';
  private $ENDQUERY = '
  ORDER BY prd_lectivo_nombre
  ';

  public function __construct() {
    $this->con = new ConDB();
  }

  function cargarFoto($identificacion) {
    $query =  '
    SELECT encode(persona_foto, \'base64\') as foto FROM public."Personas"
    WHERE persona_identificacion = '."'$identificacion'".'
    ';
    return $this->sql($query);
  }
  
}

?>