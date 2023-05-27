<?php

//importaciones
require_once '../../config/connection.php';
include_once '../../config/crud.php';

class Cita extends Database implements CRUD{
    
    function get(){
        $query = $this->connect()->query('SELECT c.numero_cita, cl.clinica, p.id_paciente, p.nombre as paciente, m.id_medico, m.nombre as medico, tc.tipo_cita, c.fechaprogram, c.fechacita, c.estado
        FROM cita c
        LEFT JOIN clinica cl ON c.id_clinica = cl.id_clinica
        JOIN paciente p ON c.id_paciente = p.id_paciente
        JOIN medico m ON c.id_medico = m.id_medico
        LEFT JOIN tipo_cita tc ON c.tipo_cita = tc.id_tipo_cita');
        
        return $query;
    }

    function getOne($id){
        $query = $this->connect()->prepare('SELECT *
        FROM cita WHERE numero_cita = :id');
        $query->execute(['id' => $id]);

        return $query;
    }

    function getSearch($id){
        $ids = $id."%";
        $query = $this->connect()->prepare('SELECT c.numero_cita, cl.clinica, p.id_paciente, p.nombre as paciente, m.id_medico, m.nombre as medico, tc.tipo_cita, c.fechaprogram, c.fechacita, c.estado
        FROM cita c
        LEFT JOIN clinica cl ON c.id_clinica = cl.id_clinica
        JOIN paciente p ON c.id_paciente = p.id_paciente
        JOIN medico m ON c.id_medico = m.id_medico
        LEFT JOIN tipo_cita tc ON c.tipo_cita = tc.id_tipo_cita WHERE c.id_paciente LIKE :id');
        $query->execute(['id' => $ids]);

        return $query;
    }

    function add($cita){
        $query = $this->connect()->prepare('INSERT INTO cita (id_clinica, id_paciente, id_medico, tipo_cita, fechacita, estado, usuario_log) VALUES (:clin, :pac, :med, :tc, :fc, :est, :us)');
        $query->execute(['clin' => $cita['id_clinica'], 'pac' => $cita['id_paciente'], 'med' => $cita['id_medico'], 'tc' => $cita['tipo_cita'], 'fc' => $cita['fechacita'], 'est' => $cita['estado'], 'us' => $cita['usuario_log']]);

        return $query;  
    }

    function update($cita){
        $query = $this->connect()->prepare('UPDATE cita SET id_clinica= :clin, id_paciente= :pac, id_medico = :med, tipo_cita = :tc, fechacita = :fc, estado = :est, usuario_log = :us WHERE numero_cita = :num');
        $query->execute(['clin' => $cita['id_clinica'], 'pac' => $cita['id_paciente'], 'med' => $cita['id_medico'], 'tc' => $cita['tipo_cita'], 'fc' => $cita['fechacita'], 'est' => $cita['estado'], 'us' => $cita['usuario_log'], 'num' => $cita['numero_cita']]);

        return $query;  
    }

    function delete($id){
        $query = $this->connect()->prepare('DELETE FROM cita WHERE numero_cita = :id');
        $query->execute(['id' => $id]);

        return $query; 
    }
}


?>