<?php

include_once '../../config/connection.php';

class Area extends Database{
    
    function getAreas(){
        $query = $this->connect()->query('SELECT * FROM area');
        
        return $query;
    }
}


?>