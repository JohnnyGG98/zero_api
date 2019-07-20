<?php
include_once 'silabo.php';
include_once 'src/api/api.php';

class SilaboAPI extends Api {

  private $silabo;

  function __construct(){
    $this->silabo = new Silabo();
  }

  function todos(){
    $res = $this->silabo->cargarSilabos();
    $this->muestraJSON($this->obtenerJSON($res));
  }

  function buscar($aguja){
    $res = null;
    if(ctype_digit($aguja)){
      $res = $this->silabo->buscar($aguja);
    }else{
      $res = $this->silabo->buscarPorPeriodoMateria($aguja);
    }
    $this->muestraJSON($this->obtenerJSON($res));
  }

  function periodo($aguja){
    $res = $this->silabo->buscarSilabosPorPeriodo($aguja);
    $this->muestraJSON($this->obtenerJSON($res));
  }

  function materia($aguja){
    $res = $this->silabo->buscarSilabosPorMateria($aguja);
    $this->muestraJSON($this->obtenerJSON($res));
  }

  function docente($identificacion){
    $res = $this->silabo->buscarPorDoncente($identificacion);
    $this->muestraJSON($this->obtenerJSON($res));
  }

  function curso($id_curso){
    $res = $this->silabo->buscarPorCurso($id_curso);
    $this->muestraJSON($this->obtenerJSON($res));
  }

  function pdf($id_silabo){
    $res = $this->silabo->cargarPDF($id_silabo);
    $this->muestraJSON($this->obtenerPdf($res));
  }

  function actividades($id_silabo = 0){
    if($id_silabo == 0){
      $this->error('No se especifico un silabo');
    }else{
      $res = $this->silabo->buscarActividadesSilabo($id_silabo);
      $this->muestraJSON($this->obtenerJSONActividades($res));
    }

  }

  /**
   * El 0 indica que es null y no se le pasaron parametros
   */
  function verPdf($id_silabo = 0){
    if($id_silabo == null){
      echo "<h1>NOOOO PODESSSSS</h1>";
    }else{
      $res = $this->silabo->cargarPDF($id_silabo);
      $this->mostrarPDF($res);
    }
  }

  function mostrarPDF($res){
    if($res != null){
      if($res->rowCount()) {
        $pdf = null;
        while ($r = $res->fetch(PDO::FETCH_ASSOC)) {
          $pdf = $r['pdf'];
        }
        header('Content-type: image/png');
        header("Content-type: application/pdf");
        echo base64_decode($pdf);
      }
    }
  }

  function obtenerPdf($res){
    if($res != null){
      if($res->rowCount()) {
        $pdf = array();
        $pdf['items'] = array();

        while ($r = $res->fetch(PDO::FETCH_ASSOC)) {
          $i = array(
            'pdf' => $r['pdf']
          );

          array_push($pdf['items'], $i);
        }
        return $pdf;
      }else{
        $this->error('No pudimos encontrar cursos.');
      }
    } else {
      $this->error('No pudimos consultar.');
    }
  }

  function obtenerJSON($res){
    if($res != null){
      if($res->rowCount()) {
        $silabos = array();
        $silabos['items'] = array();

        while($r = $res->fetch(PDO::FETCH_ASSOC)){
          $i = array(
            'id_silabo' => $r['id_silabo'],
            'prd_lectivo_nombre' => $r['prd_lectivo_nombre'],
            'materia_nombre' => $r['materia_nombre'],
            'estado_silabo' => $r['estado_silabo'],
            'cursos' => $r['cursos']
          );
          array_push($silabos['items'], $i);
        }
        return $silabos;
      }else{
        $this->error('No pudimos encontrar cursos.');
      }
    } else {
      $this->error('No pudimos consultar.');
    }
  }

  function obtenerJSONActividades($res){
    if($res != null){
      if($res->rowCount()) {
        $actividades = array();
        $actividades['items'] = array();

        while($r = $res->fetch(PDO::FETCH_ASSOC)){
          $i = array(
            'numero_unidad' => $r['numero_unidad'],
            'titulo_unidad' => $r['titulo_unidad'],
            'indicador' => $r['indicador'],
            'instrumento' => $r['instrumento'],
            'valoracion' => $r['valoracion'],
            'fecha_envio' => $r['fecha_envio'],
            'fecha_presentacion' => $r['fecha_presentacion']
          );
          array_push($actividades['items'], $i);
        }
        return $actividades;
      }else{
        $this->error('No pudimos encontrar cursos.');
      }
    } else {
      $this->error('No pudimos consultar.');
    }
  }

  function cara(){
    echo '<H1 style="font-size:1000px; text-align:center;">&#128518; 🥳🥳🥳🥳</H1>';
  }

}

?>
