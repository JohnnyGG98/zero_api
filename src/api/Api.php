<?php

class Api {

  function muestraJSON($array) {
    if($array != null){

      //echo json_encode($array);
      $this->imprimeJson(json_encode($array));
    }
  }

  function error($mensaje) {
    //echo json_encode(array('mensaje' => $mensaje));
    $this->imprimeJson(json_encode(array('mensaje' => $mensaje)));
  }

  private function imprimeJson($json) {
    header("Content-Type: application/json");
    echo $json;
  }
}

?>
