<?php
  
  //importaciones
  require_once '../../controlador/apiagenda.php';
  require_once '../../config/cors.php';

  $method = $_SERVER['REQUEST_METHOD'];

  $api = new ApiAgenda();

  if($method == "GET"){
    if(isset($_GET['id'])){
      $id = $_GET['id'];
  
      if (is_numeric($id)) {
        $api->getAgenda($id);

      }else {
          $api->errorJSON('parametros incorrectos');
      }
      
    }else if(isset($_GET['ids'])){
      $idag = $_GET['ids'];

      if (is_numeric($idag)) {
        $api->srchAgenda($idag);
      }else {
          $api->errorJSON('parametros incorrectos');
      }
    }else {
        $api->getAgendas();
    }
  }

  if($method=="POST"){
    $data = json_decode(file_get_contents("php://input"), true);
    $id_medico = $data['id_medico'];
    $id_dia = $data['id_dia'];
    $hora_in = $data['hora_in'];
    $hora_fn = $data['hora_fn'];
    $usuario_log = $data['id_usuario'];

    $item = array(
      'id_medico' => $id_medico,
      'id_dia' => $id_dia,
      'hora_inicio' => $hora_in,
      'hora_fin' => $hora_fn,
      'id_usuario' => $usuario_log
    );
    $api->addAgenda($item);
  }

  if($method=="PUT"){
    $data = json_decode(file_get_contents("php://input"), true);
    $id_medico = $data['id_medico'];
    $id_dia = $data['id_dia'];
    $hora_in = $data['hora_in'];
    $hora_fn = $data['hora_fn'];
    $usuario_log = $data['id_usuario'];
    $id_agenda = $data['id_agenda'];

    $item = array(
      'id_medico' => $id_medico,
      'id_dia' => $id_dia,
      'hora_inicio' => $hora_in,
      'hora_fin' => $hora_fn,
      'id_usuario' => $usuario_log,
      'id_agenda' => $id_agenda
    );
    $api->updateAgenda($item);
  }