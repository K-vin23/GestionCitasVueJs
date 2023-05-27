<?php

//importaciones
require_once '../../modelo/cita.php';
include_once '../../config/jsonconv.php';

class ApiCita extends JSONConverter{
    
    // Obtener todas las citas
    function getCitas(){
        $cita = new Cita();
        $citas = array();

        $res = $cita->get();
        
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                $item = array(
                    'numero_cita' => $row['numero_cita'],
                    'clinica' => $row['clinica'],
                    'id_paciente' => $row['id_paciente'],
                    'nombre_paciente' => $row['paciente'],
                    'id_medico' => $row['id_medico'],
                    'nombre_medico' => $row['medico'],
                    'tipo_cita' => $row['tipo_cita'],
                    'fechaprogram' => $row['fechaprogram'],
                    'fechacita' => $row['fechacita'],
                    'estado' => $row['estado']
                );
                array_push($citas, $item);
            }

            // echo json_encode($roles);
            $this->printJSON($citas);
        }else {
            // echo json_encode(array('mensaje' => 'No hay elementos registrados'));
            $this->successJSON(false);
        }
    }

    // Obtener una cita especifica
    function getCita($id){
        $cita = new Cita();
        $citas = array();

        $res = $cita->getOne($id);
        
        if($res->rowCount() == 1){
            $row = $res->fetch();
            
                $item = array(
                    'numero_cita' => $row['numero_cita'],
                    'id_clinica' => $row['id_clinica'],
                    'id_paciente' => $row['id_paciente'],
                    'id_medico' => $row['id_medico'],
                    'tipo_cita' => $row['tipo_cita'],
                    'fechacita' => $row['fechacita'],
                    'estado' => $row['estado']
                );
                array_push($citas, $item);
            
            // echo json_encode($roles);
            $this->printJSON($citas[0]);
        }else {
            // echo json_encode(array('mensaje' => 'No hay elementos registrados'));
            $this->errorJSON('No hay citas registrados');
        }
    }

    function srchCita($id){
        $cita = new Cita();
        $citas = array();

        $res = $cita->getSearch($id);
        
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                $item = array(
                    'numero_cita' => $row['numero_cita'],
                    'clinica' => $row['clinica'],
                    'id_paciente' => $row['id_paciente'],
                    'nombre_paciente' => $row['paciente'],
                    'id_medico' => $row['id_medico'],
                    'nombre_medico' => $row['medico'],
                    'tipo_cita' => $row['tipo_cita'],
                    'fechaprogram' => $row['fechaprogram'],
                    'fechacita' => $row['fechacita'],
                    'estado' => $row['estado']
                );
                array_push($citas, $item);
            }

            // echo json_encode($roles);
            $this->printJSON($citas);
        }else {
            // echo json_encode(array('mensaje' => 'No hay elementos registrados'));
            $this->errorJSON(false);
        }
    }

    // Agregar una cita
    function addCita($item){
        $cita = new Cita();

        $res = $cita->add($item);
        $this->successJSON('Nueva cita registrada');
    }

    function updateCita($item){
        $cita = new Cita();

        $cita->update($item);
        $this->successJSON('Cita Actualizada');
    }

    // function delete($id){
    //     $rol = new UserRol();

    //     $res = $rol->deleteRol($id);
    //     $this->successJSON('Rol eliminado');
        
    // }
}
?>