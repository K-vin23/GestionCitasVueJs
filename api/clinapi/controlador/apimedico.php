<?php

//importaciones
require_once '../../modelo/medico.php';
include_once '../../config/jsonconv.php';

class ApiMedico extends JSONConverter{
    
    // Obtener todos los medicos
    function getMedicos(){
        $medico = new Medico();
        $medicos = array();

        $res = $medico->get();
        
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                $item = array(
                    'id_medico' => $row['id_medico'],
                    'tipo_documento' => $row['tipo_documento'],
                    'area' => $row['area'],
                    'clinica' => $row['clinica'],
                    'nombre' => $row['nombre'],
                    'telefono' => $row['telefono']
                );
                array_push($medicos, $item);
            }

            // echo json_encode($roles);
            $this->printJSON($medicos);
        }else {
            // echo json_encode(array('mensaje' => 'No hay elementos registrados'));
            $this->successJSON(false);
        }
    }

    // Obtener un medico
    function getMedico($id){
        $medico = new Medico();
        $medicos = array();

        $res = $medico->getOne($id);
        
        if($res->rowCount() == 1){
            $row = $res->fetch();
            
                $item = array(
                    'id_medico' => $row['id_medico'],
                    'tipo_documento' => $row['tipo_documento'],
                    'id_area' => $row['id_area'],
                    'id_clinica' => $row['id_clinica'],
                    'nombre' => $row['nombre'],
                    'telefono' => $row['telefono']
                );
                array_push($medicos, $item);
            
            // echo json_encode($roles);
            $this->printJSON($medicos[0]);
        }else {
            // echo json_encode(array('mensaje' => 'No hay elementos registrados'));
            $this->errorJSON('No hay medicos registrados');
        }
    }

    function srchMedico($id){
        $medico = new Medico();
        $medicos = array();

        $res = $medico->getSearch($id);
        
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                $item = array(
                    'id_medico' => $row['id_medico'],
                    'tipo_documento' => $row['tipo_documento'],
                    'area' => $row['area'],
                    'clinica' => $row['clinica'],
                    'nombre' => $row['nombre'],
                    'telefono' => $row['telefono']
                );
                array_push($medicos, $item);
            }

            // echo json_encode($roles);
            $this->printJSON($medicos);
        }else {
            // echo json_encode(array('mensaje' => 'No hay elementos registrados'));
            $this->errorJSON(false);
        }
    }

    // Agregar un medico
    function addMedico($medico){
        $medico = new Medico();

        $res = $medico->add($medico);
        $this->successJSON('Nuevo medico registrado');
    }

    function updateMedico($item){
        $medico = new Medico();
        
        $medico->update($item);
        $this->successJSON('el medico ha sido editado');
    }
    
    function deleteMedico($id){
        $medico = new Medico();

        $medico->delete($id);
        $this->successJSON('Medico eliminado');
        
    }
}
?>