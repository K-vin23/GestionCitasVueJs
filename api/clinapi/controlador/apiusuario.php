<?php

//importaciones
require_once '../../modelo/usuario.php';
include_once '../../config/jsonconv.php';

class ApiUsuarios extends JSONConverter{
    
    
    //Obtener todos los Usuarios 
    function getUsers(){ 
        $usuario = new Usuario();
        $usuarios = array();

        $res = $usuario->get();
        
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                $item = array(
                    'id_usuario' => $row['id_usuario'],
                    'rol' => $row['id_rol'],
                    'identificacion' => $row['identificacion'],
                    'pass' => $row['psswd']
                );
                array_push($usuarios, $item);
            }

            // echo json_encode($roles);
            $this->printJSON($usuarios);
        }else {
            // echo json_encode(array('mensaje' => 'No hay elementos registrados'));
            $this->errorJSON('No hay elementos registrados');
        }
    }
     
    //Obtener Usuario por Identificacion
    function getByIdentifify($identify){
        $usuario = new Usuario();
        $usuarios = array();

        $res = $usuario->getUsuByIdent($identify);
        
        if($res->rowCount() == 1){
            $row = $res->fetch();
            
                $item = array(
                    'id' => $row['id_usuario'],
                    'id_rol' => $row['id_rol'],
                    'identificacion' => $row['identificacion']
                );
                array_push($usuarios, $item);
            
            // echo json_encode($roles);
            $this->printJSON($usuarios);
        }else {
            // echo json_encode(array('mensaje' => 'No hay elementos registrados'));
            $this->errorJSON('No hay elementos registrados');
        }
    }

    //Verificación de Usuario
    function userVerify($identify, $pssword){
        $usuario = new Usuario();
        $usuarios = array();

        $res = $usuario->pssVerify($identify, $pssword);

        if($res->rowCount() == 1){
            $row = $res->fetch();
            
                $item = array(
                    'id' => $row['id_usuario'],
                    'id_rol' => $row['id_rol'],
                    'error' => false
                );
                array_push($usuarios, $item);
            
            // echo json_encode($roles);
            $this->printJSON($usuarios[0]);
        }else {
            // echo json_encode(array('mensaje' => 'No hay elementos registrados'));
            $this->errorJSON(true);
        }

    }

    //Agregar un Usuario
    function add($item){
        $usuario = new Usuario();

        $res = $usuario->add($item);
        $this->successJSON('Nuevo rol registrado');
    }

    //Eliminar un Usuario
    function delete($id){
        $rol = new UserRol();

        $res = $rol->deleteRol($id);
        $this->successJSON('Rol eliminado');
        
    }

}
?>