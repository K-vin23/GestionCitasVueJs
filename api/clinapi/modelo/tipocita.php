<?php

include_once '../../config/connection.php';

class TipoCita extends Database{
    
    function getTipoCitas(){
        $query = $this->connect()->query('SELECT * FROM tipo_cita');
        
        return $query;
    }
}


?>