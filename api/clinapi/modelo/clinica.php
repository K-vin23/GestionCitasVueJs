<?php

include_once '../../config/connection.php';

class Clinica extends Database{
    
    function getClinicas(){
        $query = $this->connect()->query('SELECT * FROM clinica');
        
        return $query;
    }
}


?>