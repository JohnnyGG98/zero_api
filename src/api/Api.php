<?php

class Api {

  function muestraJSON($array) {
    if($array != null){
      echo '<code>'.json_encode($array).'</code>';
    }
  }

  function error($mensaje) {
    echo'<code>'.json_encode(array('mensaje' => $mensaje)).'</code>';
  }
}

?>