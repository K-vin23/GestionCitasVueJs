<?php

//importaciones
require_once '../../modelo/area.php';
include_once '../../config/jsonconv.php';

class ApiArea extends JSONConverter{
    
    function getArea(){
        $area = new Area();
        $areas = array();

        $res = $area->getAreas();
        
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                $item = array(
                    'id_area' => $row['id_area'],
                    'area' => $row['area']
                );
                array_push($areas, $item);
            }

            $this->printJSON($areas);
        }else {
            // echo json_encode(array('mensaje' => 'No hay elementos registrados'));
            $this->errorJSON('No hay elementos registrados');
        }
    }

}
?>