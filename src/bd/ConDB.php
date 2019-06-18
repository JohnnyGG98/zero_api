<?php

class ConDB {

  private $hostDB = 'localhost';
  private $nameDB = 'BDInstitutoJunio2019';
  private $userDB = 'postgres';
  private $passBD = 'Holapostgres';
  private $port = '5433';

  function getCon() {
    try {
      $pdo = new PDO("pgsql:dbname=$this->nameDB;host=$this->hostDB;port=$this->port;", $this->userDB, $this->passBD);
      //inicializar
      
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $pdo;
    } catch (\Exception $e) {
      echo "Oh no: ".$e->getMessage();
      return null; 
    }
  }

  function sql($query) {
    $ct = $this->con->getCon();
    try {
      if($ct != null){
        $res = $ct->query($query);
        return $res; 
      }else{
        return null;
      }
    } catch (\Exception $e) {
      echo $e->getMessage();
      return null; 
    }
  }

}
?>