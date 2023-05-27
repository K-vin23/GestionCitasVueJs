<?php
  
//   include_once 'apicitas.php';
  include_once 'apiuserrol.php';
  require_once 'config/cors.php';
  $method = $_SERVER['REQUEST_METHOD'];

  $apiroles = new ApiRoles();

  if($method == "GET"){
    if(isset($_GET['id'])){
      $idrol = $_GET['id'];
  
      if (is_numeric($idrol)) {
          $apiroles->error('parametros incorrectos');
      }else {
          $apiroles->getById($idrol);
      }
      
    }else {
      $roles = array();
      $roles = $apiroles->getUserRol();
      $json = json_encode($roles);
      echo $json;
    }
  }

//   $apicitas = new ApiCitas();

//   $apicitas->getAll();

  

  
  

?>