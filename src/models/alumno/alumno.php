<?php
include_once 'src/bd/condb.php';
include_once 'src/utils/utils.php';

class Alumno extends ConDB {

  private $BASEQUERY = '
  SELECT
  a.id_alumno,
  p.id_persona,
  persona_primer_nombre,
  persona_primer_apellido,
  persona_segundo_nombre,
  persona_segundo_apellido,
  persona_identificacion,
  persona_correo,
  persona_celular,
  persona_telefono
  FROM
  public."Alumnos" a, public."Personas" p
  WHERE
  p.id_persona = a.id_persona

  ';
  private $ENDQUERY = '
  AND persona_activa = true
  AND alumno_activo = true
  ORDER BY
  persona_primer_apellido,
  persona_segundo_apellido
  ';

  public function __construct() {
    $this->con = new ConDB();
  }

  function cargarTodos() {
    $query = $this->BASEQUERY . ' ' . $this->ENDQUERY;

    return $this->sql($query);
  }

  function buscar($id_alumno){
    $query = $this->BASEQUERY . "
    AND a.id_alumno = $id_alumno
    " . $this->ENDQUERY;

    return $this->sql($query);
  }

  function buscarAlumno($aguja){
    $query = $this->BASEQUERY . '
    AND (
      '.BDUQuerys::buscarPersona($aguja).'
    )
    ' . $this->ENDQUERY;
    return $this->sql($query);
  }

  function buscarPorCurso($id_curso) {
    $query = $this->BASEQUERY . '
    AND id_alumno IN (
      SELECT id_alumno
      FROM public."AlumnoCurso"
      WHERE id_curso = '.$id_curso.'
      AND almn_curso_activo = true
    )
    ' . $this->ENDQUERY;

    return $this->sql($query);
  }

}

?>
