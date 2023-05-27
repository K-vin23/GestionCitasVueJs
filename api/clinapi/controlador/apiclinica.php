<?php

//importaciones
require_once '../../modelo/clinica.php';
include_once '../../config/jsonconv.php';

class ApiClinica extends JSONConverter{
    
    function getClinicas(){
        $clinica = new Clinica();
        $clinicas = array();

        $res = $clinica->getClinicas();
        
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                $item = array(
                    'id_clinica' => $row['id_clinica'],
                    'clinica' => $row['clinica'],
                    'direccion' => $row['direccion']
                );
                array_push($clinicas, $item);
            }

            // echo json_encode($roles);
            $this->printJSON($clinicas);;
            // $this->printJSON($roles);
        }else {
            // echo json_encode(array('mensaje' => 'No hay elementos registrados'));
            $this->errorJSON('No hay elementos registrados');
        }
    }
}
?>