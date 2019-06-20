<?php

class ControladorAPI {
  
  function __construct(){
    //obtenerUrl();
  }

  function obtenerUrl(){
    $url = isset($_GET['url']) ? $_GET['url']: NULL;

    if($url != null){
      $url = rtrim($url, '/');
      $url = explode('/', $url);

      if(isset($url[0])){
        $this->cargarClase($url);
      } 

    }else{
      echo "<h2>No tenemos url</h2>";
    }
  }

  function cargarClase($url){
    $nombre = $url[0];
    $dir = 'src/models/'.$nombre.'/'.$nombre.'api.php';
    if(file_exists($dir)){
      require_once $dir; 
      $nombre = $nombre . 'API';
      $modelo = new $nombre();
      if(isset($url[1])){
        $this->llamarMetodo($url, $modelo);
      }
      
    }else{
      echo "<h1>No pudimos obtener la clase</h1>";
    }
  }

  function llamarMetodo($url, $modelo){
    $metodo = $url[1];

    if(isset($url[2])){
      $this->llamarMetodoConParametro($url, $modelo);
    }else{
      try{
        $modelo->{$metodo}();
      }catch(\Exception $e){
        echo "<h1>No pudimos enontrar el metodo </h1>".$e->getMessage();
      }
    }

  }

  function llamarMetodoConParametro($url, $modelo){
    $metodo = $url[1];
    $parametro = $url[2];

    if (strpos($parametro, '-') !== false) {
      $parametro = explode('-', $parametro);
      //var_dump($parametro);
      $modelo->{$metodo}($parametro);
    }else{
      $modelo->{$metodo}($parametro);
    }
  }
}

?>