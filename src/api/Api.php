<?php

class Api {

  function muestraJSON($array) {
    echo '<code>'.json_encode($array).'</code>';
  }

  function error($mensaje) {
    echo'<code>'.json_encode(array('mensaje' => $mensaje)).'</code>';
  }
}

?>