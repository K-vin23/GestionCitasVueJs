<?php

class JSONConverter {

    function printJSON($array){
        echo json_encode($array);
    }

    function errorJSON($mensaje){
        echo  json_encode(array('error' => $mensaje));
    }

    function successJSON($bool){
        echo json_encode($bool);
    }
}
?>