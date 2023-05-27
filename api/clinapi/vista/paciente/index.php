<?php
  //importaciones
  require_once '../../controlador/apipaciente.php';
  require_once '../../config/cors.php';

  $method = $_SERVER['REQUEST_METHOD'];

  $api = new ApiPaciente();

  if($method == "GET"){
    if(isset($_GET['id'])){
      $id = $_GET['id'];
  
      if (is_numeric($id)) {
        $api->getPaciente($id);
      }else {
          $api->errorJSON(false);
      }
      
    }else if(isset($_GET['ids'])){
      $idpac = $_GET['ids'];

      if (is_numeric($idpac)) {
        $api->srchPaciente($idpac);
      }else {
          $api->errorJSON('parametros incorrectos');
      }
    }else {
        $api->getPacientes();
    }
  }

  if($method=="POST"){
    $data = json_decode(file_get_contents("php://input"), true);
    $id_paciente = $data['id_paciente'];
    $tipo_documento = $data['tipo_documento'];
    $nombre = $data['nombre'];
    $telefono = $data['telefono'];
    $item = array(
      'id_paciente' => $id_paciente,
      'tipo_documento' => $tipo_documento,
      'nombre' => $nombre,
      'telefono' => $telefono
    );
    $api->addPaciente($item);
  }

  if($method=="PUT"){
    $data = json_decode(file_get_contents("php://input"), true);
    $id_paciente = $data['id_paciente'];
    $tipo_documento = $data['tipo_documento'];
    $nombre = $data['nombre'];
    $telefono = $data['telefono'];
    $item = array(
      'id_paciente' => $id_paciente,
      'tipo_documento' => $tipo_documento,
      'nombre' => $nombre,
      'telefono' => $telefono
    );
    $api->updatePaciente($item);
  }

  if($method=="DELETE"){
    $id_paciente = $_REQUEST['id'];
    $api->deletePaciente($id_paciente);
  }