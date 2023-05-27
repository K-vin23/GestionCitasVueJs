<?php

//importaciones
require_once '../../config/connection.php';
include_once '../../config/crud.php';

class Agenda extends Database implements CRUD{
    
    function get(){
        $query = $this->connect()->query('SELECT a.id_agenda, a.id_medico,  m.nombre, ar.area, a.id_dia, d.dia, a.hora_in, a.hora_fn
        FROM agenda_medico a
        JOIN medico m ON a.id_medico = m.id_medico
        JOIN dia_semana d ON a.id_dia = d.id_dia
        JOIN area ar ON m.id_area = ar.id_area');
        
        return $query;
    }

    function getOne($idagenda){
        $query = $this->connect()->prepare('SELECT *
        FROM agenda_medico WHERE id_agenda = :id');
        $query->execute(['id' => $idagenda]);

        return $query;
    }

    function getSearch($id){
        $ids = $id."%";
        $query = $this->connect()->prepare('SELECT a.id_agenda, a.id_medico,  m.nombre, ar.area, a.id_dia, d.dia, a.hora_in, a.hora_fn
        FROM agenda_medico a
        JOIN medico m ON a.id_medico = m.id_medico
        JOIN dia_semana d ON a.id_dia = d.id_dia
        JOIN area ar ON m.id_area = ar.id_area WHERE a.id_medico LIKE :id');
        $query->execute(['id' => $ids]);

        return $query;
    }

    function add($agenda){
        $query = $this->connect()->prepare('INSERT INTO agenda VALUES (:id_medico, :dia, :hin, :hfn, :us)');
        $query->execute(['id_medico' => $agenda['id_medico'], 'dia' => $agenda['id_dia'], 'hin' => $agenda['hora_inicio'], 'hfn' => $agenda['hora_fin'], 'us' => $agenda['id_usuario']]);

        return $query;  
    }

    // function delete($id){
    //     $query = $this->connect()->prepare('DELETE FROM  WHERE id_=:id');
    //     $query->execute(['id' => $id]);

    //     return $query; 
    // }

    function update($agenda){
        $query = $this->connect()->prepare('UPDATE agenda_medico SET id_medico = :id, id_dia = :dia, hora_in = :hi, hora_fn = :hf, usuario_log = :us WHERE id_agenda = :ida');
        $query->execute(['id' => $agenda['id_medico'], 'dia' => $agenda['id_dia'], 'hi' => $agenda['hora_inicio'], 'hf' => $agenda['hora_fin'], 'us' => $agenda['id_usuario'], 'ida' => $agenda['id_agenda']]);

        return $query;  
    }
}


?>