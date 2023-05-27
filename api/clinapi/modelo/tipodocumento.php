<?php

include_once '../../config/connection.php';

class TipoDocumento extends Database{
    
    function getTiposDoc(){
        $query = $this->connect()->query('SELECT * FROM tipo_documento');
        
        return $query;
    }
}


?>