<?php

//importaciones
require_once '../../modelo/tipocita.php';
include_once '../../config/jsonconv.php';

class ApiTipoCita extends JSONConverter{
    
    function getTipCitas(){
        $tc = new TipoCita();
        $tcs = array();

        $res = $tc->getTipoCitas();
        
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                $item = array(
                    'id_tipo_cita' => $row['id_tipo_cita'],
                    'tipo_cita' => $row['tipo_cita']
                );
                array_push($tcs, $item);
            }

            $this->printJSON($tcs);
        }else {

            $this->errorJSON('No hay elementos registrados');
        }
    }

}
?>