<?php 
include_once 'src/bd/condb.php';

class Silabo extends ConDB {

  private $BASEQUERY = '
  
  ';
  private $ENDQUERY = '
  ORDER BY prd_lectivo_nombre
  ';

  public function __construct() {
    $this->con = new ConDB();
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