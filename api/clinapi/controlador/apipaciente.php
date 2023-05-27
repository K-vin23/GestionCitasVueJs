<?php

//importaciones
require_once '../../modelo/paciente.php';
include_once '../../config/jsonconv.php';

class ApiPaciente extends JSONConverter{
    
    // Obtener todos los pacientes
    function getPacientes(){
        $paciente = new Paciente();
        $pacientes = array();

        $res = $paciente->get();
        
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                $item = array(
                    'id_paciente' => $row['id_paciente'],
                    'tipo_documento' => $row['tipo_documento'],
                    'nombre' => $row['nombre'],
                    'telefono' => $row['telefono']
                );
                array_push($pacientes, $item);
            }

            // echo json_encode($roles);
            $this->printJSON($pacientes);
        }else {
            // echo json_encode(array('mensaje' => 'No hay elementos registrados'));
            $this->successJSON(false);
        }
    }

    // Obtener un paciente
    function getPaciente($id){
        $paciente = new Paciente();
        $pacientes = array();

        $res = $paciente->getOne($id);
        
        if($res->rowCount() == 1){
            $row = $res->fetch();
            
                $item = array(
                    'id_paciente' => $row['id_paciente'],
                    'tipo_documento' => $row['tipo_documento'],
                    'nombre' => $row['nombre'],
                    'telefono' => $row['telefono']
                );
                array_push($pacientes, $item);
            
            // echo json_encode($roles);
            $this->printJSON($pacientes[0]);
        }else {
            // echo json_encode(array('mensaje' => 'No hay elementos registrados'));
            $this->errorJSON('No hay pacientes registrados');
        }
    }

    function srchPaciente($id){
        $paciente = new Paciente();
        $pacientes = array();

        $res = $paciente->getSearch($id);
        
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                $item = array(
                    'id_paciente' => $row['id_paciente'],
                    'tipo_documento' => $row['tipo_documento'],
                    'nombre' => $row['nombre'],
                    'telefono' => $row['telefono']
                );
                array_push($pacientes, $item);
            }

            // echo json_encode($roles);
            $this->printJSON($pacientes);
        }else {
            // echo json_encode(array('mensaje' => 'No hay elementos registrados'));
            $this->errorJSON(false);
        }
    }

    // Agregar un paciente
    function addPaciente($item){
        $paciente = new Paciente();

        $paciente->add($item);
        $this->successJSON('Nuevo paciente registrado');
    }

    function updatePaciente($item){
        $paciente = new Paciente();
        
        $paciente->update($item);
        $this->successJSON('el paciente ha sido editado');
    }

    function deletePaciente($id){
        $paciente = new Paciente();

        $paciente->delete($id);
        $this->successJSON('paciente eliminado');
        
    }
}
?>