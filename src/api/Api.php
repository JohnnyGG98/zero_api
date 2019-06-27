<?php

class Api {

  function muestraJSON($array) {
    if($array != null){
      echo json_encode($array);
    }
  }

  function error($mensaje) {
    echo json_encode(array('mensaje' => $mensaje));
  }
}

?>