<?php

//importaciones
require_once '../../modelo/tipodocumento.php';
include_once '../../config/jsonconv.php';

class ApiTipoDoc extends JSONConverter{
    
    function getTipos(){
        $td = new TipoDocumento();
        $tds = array();

        $res = $td->getTiposDoc();
        
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                $item= array(
                    'id_tipodoc' => $row['id_tipodoc'],
                    'tipo_documento' => $row['tipo_documento']
                );
                array_push($tds, $item);
            }

            $this->printJSON($tds);
        }else {
            $this->errorJSON('No hay elementos registrados');
        }
    }

}
?>