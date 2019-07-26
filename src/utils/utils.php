<?php

class BDUQuerys {

  public static function buscarPersona($aguja){
    return "
    TRANSLATE(persona_primer_nombre,'ÁÉÍÓÚáéíóú','AEIOUaeiou') ILIKE '%$aguja%' OR
    TRANSLATE(persona_segundo_nombre,'ÁÉÍÓÚáéíóú','AEIOUaeiou') ILIKE '%$aguja%' OR
    TRANSLATE(persona_primer_apellido,'ÁÉÍÓÚáéíóú','AEIOUaeiou') ILIKE '%$aguja%' OR
    TRANSLATE(persona_segundo_apellido,'ÁÉÍÓÚáéíóú','AEIOUaeiou') ILIKE '%$aguja%' OR
    TRANSLATE(persona_identificacion,'ÁÉÍÓÚáéíóú','AEIOUaeiou') ILIKE '%$aguja%' OR
    TRANSLATE(persona_primer_nombre,'ÁÉÍÓÚáéíóú','AEIOUaeiou') ||
    TRANSLATE(persona_segundo_nombre,'ÁÉÍÓÚáéíóú','AEIOUaeiou') ILIKE '%$aguja%' OR
    TRANSLATE(persona_primer_apellido,'ÁÉÍÓÚáéíóú','AEIOUaeiou') ||
    TRANSLATE(persona_segundo_apellido,'ÁÉÍÓÚáéíóú','AEIOUaeiou') ILIKE '%$aguja%' OR
    TRANSLATE(persona_primer_nombre,'ÁÉÍÓÚáéíóú','AEIOUaeiou') ||
    TRANSLATE(persona_primer_apellido,'ÁÉÍÓÚáéíóú','AEIOUaeiou') ILIKE '%$aguja%'
    ";

  }

  public static function buscarPersonaBC($aguja){
    return "
    persona_primer_nombre ILIKE '%$aguja%' OR
    persona_segundo_nombre ILIKE '%$aguja%' OR
    persona_primer_apellido ILIKE '%$aguja%' OR
    persona_segundo_apellido ILIKE '%$aguja%' OR
    persona_identificacion ILIKE '%$aguja%' OR
    persona_primer_nombre ||  persona_segundo_nombre ILIKE '%$aguja%' OR
    persona_primer_apellido ||  persona_segundo_apellido ILIKE '%$aguja%' OR
    persona_primer_nombre ||  persona_primer_apellido ILIKE '%$aguja%'
    ";
  }

}

?>
