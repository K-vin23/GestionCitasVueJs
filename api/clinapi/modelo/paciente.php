<?php

//importaciones
require_once '../../config/connection.php';
include_once '../../config/crud.php';

class Paciente extends Database implements CRUD{
    
    function get(){
        $query = $this->connect()->query('SELECT p.id_paciente, td.tipo_documento, p.nombre, p.telefono 
        FROM paciente p
        LEFT JOIN tipo_documento td ON p.tipo_documento = td.id_tipodoc');
        
        return $query;
    }

    function getOne($id){
        $query = $this->connect()->prepare('SELECT id_paciente, tipo_documento, nombre, telefono 
        FROM paciente 
        WHERE id_paciente = :id');
        $query->execute(['id' => $id]);

        return $query;
    }

    function getSearch($id){
        $ids = $id."%";
        $query = $this->connect()->prepare('SELECT p.id_paciente, td.tipo_documento, p.nombre, p.telefono 
        FROM paciente p
        LEFT JOIN tipo_documento td ON p.tipo_documento = td.id_tipodoc WHERE p.id_paciente LIKE :id');
        $query->execute(['id' => $ids]);

        return $query;
    }

    function add($paciente){
        $query = $this->connect()->prepare('INSERT INTO paciente VALUES (:id, :td, :nomb, :tel)');
        $query->execute(['id' => $paciente['id_paciente'], 'td' => $paciente['tipo_documento'], 'nomb' => $paciente['nombre'], 'tel' => $paciente['telefono']]);

        return $query;  
    }

    function update($paciente){
        $query = $this->connect()->prepare('UPDATE paciente SET tipo_documento = :td, nombre = :nomb, telefono = :tel WHERE id_paciente = :id');
        $query->execute(['id' => $paciente['id_paciente'], 'td' => $paciente['tipo_documento'], 'nomb' => $paciente['nombre'], 'tel' => $paciente['telefono']]);

        return $query;  
    }

    function delete($id){
        $query = $this->connect()->prepare('DELETE FROM paciente WHERE id_paciente=:id');
        $query->execute(['id' => $id]);

        return $query; 
    }

}


?>