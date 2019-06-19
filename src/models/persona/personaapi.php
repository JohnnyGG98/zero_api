<?php 
include_once 'persona.php';
include_once 'src/api/api.php';

class PersonaAPI extends Api {

  private $persona;

  function __construct(){
    $this->persona = new Persona(); 
  }

  function foto($identificacion){
    $res = $this->persona->cargarFoto($identificacion);
    $this->muestraJSON($this->obtenerFoto($res));
  }

  function verFoto($identificacion){
    $res = $this->persona->cargarFoto($identificacion);
    $this->mostrarFoto($res);  
  }

  function obtenerFoto($res){
    if($res != null){
      if($res->rowCount()) {
        $foto = array(); 
        $foto['items'] = array(); 

        while ($r = $res->fetch(PDO::FETCH_ASSOC)) {
          $i = array(
            'foto' => $r['foto']
          );

          array_push($foto['items'], $i);
        }
        return $foto;
      }else{
        $this->error('No pudimos encontrar cursos.');
      }
    } else {
      $this->error('No pudimos consultar.');
    }
  }

  function mostrarFoto($res){
    if($res != null){
      if($res->rowCount()) {
        $foto = null;
        while ($r = $res->fetch(PDO::FETCH_ASSOC)) {
          $foto = $r['foto'];
        }
        header('Content-type: image/png');
        echo base64_decode($foto);
      }
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

}

?>