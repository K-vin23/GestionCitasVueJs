<?php

//importaciones
require_once '../../config/connection.php';
include_once '../../config/crud.php';

class Medico extends Database implements CRUD{
    
    function get(){
        $query = $this->connect()->query('SELECT med.id_medico, tdoc.tipo_documento, ar.area, cl.clinica, med.nombre, med.telefono
        FROM medico med
        JOIN tipo_documento tdoc ON med.tipo_documento = tdoc.id_tipodoc
        LEFT JOIN area ar ON med.id_area = ar.id_area
        JOIN clinica cl ON med.id_clinica = cl.id_clinica');
        
        return $query;
    }

    function getOne($id){
        $query = $this->connect()->prepare('SELECT *
        FROM medico WHERE id_medico=:id');
        $query->execute(['id' => $id]);

        return $query;
    }

    function getSearch($id){
        $ids = $id."%";
        $query = $this->connect()->prepare('SELECT med.id_medico, tdoc.tipo_documento, ar.area, cl.clinica, med.nombre, med.telefono
        FROM medico med
        JOIN tipo_documento tdoc ON med.tipo_documento = tdoc.id_tipodoc
        LEFT JOIN area ar ON med.id_area = ar.id_area
        JOIN clinica cl ON med.id_clinica = cl.id_clinica WHERE med.id_medico LIKE :id');
        $query->execute(['id' => $ids]);

        return $query;
    }

    function add($medico){
        $query = $this->connect()->prepare('INSERT INTO medico VALUES (:id, :td, :area, :cli, :nomb, :tel)');
        $query->execute(['id' => $medico['id_medico'], 'td' => $medico['tipo_documento'], 'area' => $medico['id_area'], 'cli' => $medico['id_clinica'], 'nomb' => $medico['nombre'], 'tel' => $medico['telefono']]);

        return $query;  
    }

    function delete($id){
        $query = $this->connect()->prepare('DELETE FROM medico WHERE id_medico=:id');
        $query->execute(['id' => $id]);

        return $query; 
    }

    function update($medico){
        $query = $this->connect()->prepare('UPDATE medico SET tipo_documento = :td, id_area = :ida, id_clinica = :idc, nombre = :nomb, telefono = :tel WHERE id_medico = :id');
        $query->execute(['id' => $medico['id_medico'], 'td' => $medico['tipo_documento'], 'ida' => $medico['id_area'], 'idc' => $medico['id_clinica'], 'nomb' => $medico['nombre'], 'tel' => $medico['telefono']]);

        return $query;  
    }
}


?>