<?php 
include_once 'silabo.php';
include_once 'src/api/api.php';

class SilaboAPI extends Api {

  private $silabo;

  function __construct(){
    $this->silabo = new Silabo(); 
  }

  function pdf(){
    $res = $this->silabo->cargarPDF();
    $this->muestraJSON($this->obtenerPdf($res));
  }

  /**
   * El 0 indica que es null y no se le pasaron parametros
   */
  function verPdf($id_silabo = 0){
    if($id_silabo != null){
      echo "<h1>NOOOO PODESSSSS</h1>";
    }else{
      $res = $this->silabo->cargarPDF();
      $this->mostrarPDF($res);
    }
    //$this->muestraJSON($this->obtenerJSON($res));
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