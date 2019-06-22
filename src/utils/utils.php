<?php

class BDUQuerys {

  public static function buscarPersona($aguja){
    return "
    persona_primer_nombre ILIKE '%$aguja%' OR
    persona_segundo_nombre ILIKE '%$aguja%' OR
    persona_primer_apellido ILIKE '%$aguja%' OR
    persona_segundo_apellido ILIKE '%$aguja%' OR
    persona_identificacion ILIKE '%$aguja%'
    ";
  }
  
}

?>