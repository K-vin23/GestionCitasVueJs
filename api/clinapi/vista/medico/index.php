<?php

  //importaciones
  require_once '../../controlador/apimedico.php';
  require_once '../../config/cors.php';  

  $method = $_SERVER['REQUEST_METHOD'];

  $api = new ApiMedico();

  if($method == "GET"){
    if(isset($_GET['id'])){
      $idmedico = $_GET['id'];
  
      if (is_numeric($idmedico)) {
          $api->getMedico($idmedico);
      }else {
        $api->errorJSON('parametros incorrectos');
      }
      
    }else if(isset($_GET['ids'])){
      $idmed = $_GET['ids'];

      if (is_numeric($idmed)) {
        $api->srchMedico($idmed);
      }else {
          $api->errorJSON('parametros incorrectos');
      }
    }else {
        $api->getMedicos();
    //   echo $json;
    }
  }

  if($method=="POST"){
    $data = json_decode(file_get_contents("php://input"), true);
    $id_medico = $data['id_medico'];
    $tipo_documento = $data['tipo_documento'];
    $id_area = $data['id_area'];
    $id_clinica = $data['id_clinica'];
    $nombre = $data['nombre'];
    $telefono = $data['telefono'];
    $item = array(
      'id_medico' => $id_medico,
      'tipo_documento' => $tipo_documento,
      'id_area' => $id_area,
      'id_clinica' => $id_clinica,
      'nombre' => $nombre,
      'telefono' => $telefono
    );
    $api->addMedico($item);
  }

  if($method=="PUT"){
    $data = json_decode(file_get_contents("php://input"), true);
    $id_medico = $data['id_medico'];
    $tipo_documento = $data['tipo_documento'];
    $id_area = $data['id_area'];
    $id_clinica = $data['id_clinica'];
    $nombre = $data['nombre'];
    $telefono = $data['telefono'];
    $item = array(
      'id_medico' => $id_medico,
      'tipo_documento' => $tipo_documento,
      'id_area' => $id_area,
      'id_clinica' => $id_clinica,
      'nombre' => $nombre,
      'telefono' => $telefono
    );
    $api->updateMedico($item);
  }

  if($method=="DELETE"){
    $id_medico = $_REQUEST['id'];
    $api->deleteMedico($id_medico);
  }