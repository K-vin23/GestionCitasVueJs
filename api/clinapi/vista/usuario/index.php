<?php

  //importaciones
  require_once '../../controlador/apiusuario.php';
  require_once '../../config/cors.php';   

  $method = $_SERVER['REQUEST_METHOD'];

  $api = new ApiUsuarios();
  if($method == "GET"){
    if(isset($_GET['id_usuario'])){
      $id = $_GET['id_usuario'];
  
      if (is_numeric($idrol)) {
          $api->getByIdentifify($id);
          
      }else {
  
          $apiroles->error('parametros incorrectos');
      }
      
    }else {
      $api->getUsers();
    }
  }

  if($method=="POST"){
    $data = json_decode(file_get_contents("php://input"), true);
    $id = $data['identificacion'];
    $pwd = $data['psswd'];
    $api->userVerify($id, $pwd);
  }

  

?>