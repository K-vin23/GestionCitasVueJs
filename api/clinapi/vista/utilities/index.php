<?php

  //importaciones
  require_once '../../controlador/apiclinica.php';
  require_once '../../controlador/apiarea.php';
  require_once '../../controlador/apitipodocumento.php';
  require_once '../../controlador/apitipocita.php';
  require_once '../../config/cors.php';  

  $method = $_SERVER['REQUEST_METHOD'];

  if($method == "GET"){
    if(isset($_GET['id'])){
      $opcion = $_GET['id'];
      switch ($opcion) {
        case 'clinica':
          $api = new ApiClinica();
            $api->getClinicas();
          break;
        case 'area':
          $api = new ApiArea();
            $api->getArea();
            break;
        case 'tipodoc':
          $api = new ApiTipoDoc();
            $api->getTipos();
            break;
        case 'tipocit':
          $api = new ApiTipoCita();
            $api->getTipCitas();
            break;                  
        default:
          # code...
          break;
      }
  }
}

?>