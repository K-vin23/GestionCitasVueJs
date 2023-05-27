<?php

//importaciones
require_once '../../modelo/agenda.php';
include_once '../../config/jsonconv.php';

class ApiAgenda extends JSONConverter{
    
    //Obtener toda la informacion de agenda
    function getAgendas(){
        $agenda = new Agenda();
        $agendas = array();

        $res = $agenda->get();
        
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                $item = array(
                    'id_medico' => $row['id_medico'],
                    'nombre' => $row['nombre'],
                    'area' => $row['area'],
                    'id_dia' => $row['id_dia'],
                    'dia' => $row['dia'],
                    'hora_in' => $row['hora_in'],
                    'hora_fn' => $row['hora_fn'],
                    'id_agenda' => $row['id_agenda']
                );
                array_push($agendas, $item);
            }

            // echo json_encode($roles);
            $this->printJSON($agendas);
        }else {
            // echo json_encode(array('mensaje' => 'No hay elementos registrados'));
            $this->successJSON(false);
        }
    }

    // Obtener una agenda especifica
    function getAgenda($id){
        $agenda = new Agenda();
        $agendas = array();

        $res = $agenda->getOne($id);
        
        if($res->rowCount() == 1){
            $row = $res->fetch();
            
                $item = array(
                    'id_medico' => $row['id_medico'],
                    'id_dia' => $row['id_dia'],
                    'hora_in' => $row['hora_in'],
                    'hora_fn' => $row['hora_fn'],
                    'id_agenda' => $row['id_agenda']
                );
                array_push($agendas, $item);
            
            // echo json_encode($roles);
            $this->printJSON($agendas[0]);
        }else {
            // echo json_encode(array('mensaje' => 'No hay elementos registrados'));
            $this->errorJSON('No hay agendas registrados');
        }
    }

    //Buscar en la agenda
    function srchAgenda($id){
        $agenda = new Agenda();
        $agendas = array();

        $res = $agenda->getSearch($id);
        
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                $item = array(
                    'id_medico' => $row['id_medico'],
                    'nombre' => $row['nombre'],
                    'area' => $row['area'],
                    'id_dia' => $row['id_dia'],
                    'dia' => $row['dia'],
                    'hora_in' => $row['hora_in'],
                    'hora_fn' => $row['hora_fn'],
                    'id_agenda' => $row['id_agenda']
                );
                array_push($agendas, $item);
            }

            // echo json_encode($roles);
            $this->printJSON($agendas);
        }else {
            // echo json_encode(array('mensaje' => 'No hay elementos registrados'));
            $this->errorJSON(false);
        }
    }
    // Agregar una agenda
    function addAgenda($item){
        $agenda = new Agenda();

        $agenda->add($item);
        $this->successJSON('Nueva agenda registrado');
    }

    //Actualizar una agenda
    function updateAgenda($item){
        $agenda = new Agenda();

        $agenda->update($item);
        $this->successJSON('agenda editada con exito');
    }

    // function delete($id){
    //     $rol = new UserRol();

    //     $res = $rol->deleteRol($id);
    //     $this->successJSON('Rol eliminado');
        
    // }
}
?>