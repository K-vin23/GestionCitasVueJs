<?php
  
  //importaciones
  require_once '../../controlador/apicita.php';
  require_once '../../config/cors.php';

  $method = $_SERVER['REQUEST_METHOD'];

  $api = new ApiCita();

  if($method == "GET"){
    if(isset($_GET['id'])){
      $idcita = $_GET['id'];
  
      if (is_numeric($idcita)) {
        $api->getCita($idcita);
      }else {
          $api->errorJSON('parametros incorrectos');
      }
      
    }else if(isset($_GET['ids'])){
      $idpac = $_GET['ids'];

      if (is_numeric($idpac)) {
        $api->srchCita($idpac);
      }else {
          $api->errorJSON('parametros incorrectos');
      }
    }else{
      $api->getCitas();
    }
  }

  if($method=="POST"){
    $data = json_decode(file_get_contents("php://input"), true);
    $num_cita = $data['numero_cita'];
    $clinica = $data['id_clinica'];
    $id_paciente = $data['id_paciente'];
    $id_medico = $data['id_medico'];
    $tipo_cita = $data['tipo_cita'];
    $fechacita = $data['fecha_cita'];
    $estado = $data['estado'];
    $usuario_log = $data['id_usuario'];
    $item = array(
      'numero_cita' => $num_cita,
      'id_clinica' => $clinica,
      'id_paciente' => $id_paciente,
      'id_medico' => $id_medico,
      'tipo_cita' => $tipo_cita,
      'fechacita' => $fechacita,
      'estado' => $estado,
      'usuario_log' => $usuario_log
    );
    $api->addCita($item);
  }

  if($method=="PUT"){
    $data = json_decode(file_get_contents("php://input"), true);
    $num_cita = $data['numero_cita'];
    $clinica = $data['id_clinica'];
    $id_paciente = $data['id_paciente'];
    $id_medico = $data['id_medico'];
    $tipo_cita = $data['tipo_cita'];
    $fecha_cita = $data['fecha_cita'];
    $estado = $data['estado'];
    $usuario_log = $data['id_usuario'];
    $item = array(
      'numero_cita' => $num_cita,
      'id_clinica' => $clinica,
      'id_paciente' => $id_paciente,
      'id_medico' => $id_medico,
      'tipo_cita' => $tipo_cita,
      'fechacita' => $fecha_cita,
      'estado' => $estado,
      'usuario_log' => $usuario_log
    );
    $api->updateCita($item);
  }

  // if($method=="DELETE"){
  //   $id_paciente = $_REQUEST['id'];
  //   $api->deletePaciente($id_paciente);
  // }