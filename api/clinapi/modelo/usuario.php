<?php

//importaciones
require_once '../../config/connection.php';
include_once '../../config/crud.php';

class Usuario extends Database implements CRUD{
    
    function get(){
        $query = $this->connect()->query('SELECT * FROM usuario');
        
        return $query;
    }

    function getOne($iduser){
        $query = $this->connect()->prepare('SELECT * FROM usuario WHERE id_usuario=:iduser');
        $query->execute(['iduser' => $iduser]);

        return $query;
    }

    function getUsuByIdent($identify){
        $query = $this->connect()->prepare('SELECT * FROM usuario WHERE identificacion=:iduser');
        $query->execute(['iduser' => $identify]);

        return $query;
    }

    function pssVerify($identify, $pass){
        $query = $this->connect()->prepare('SELECT id_rol, id_usuario FROM usuario WHERE identificacion = :ident AND psswd = :pssword');
        $query->execute(['ident' => $identify, 'pssword' => $pass]);

        return $query;
    }


    function add($usuario){
        $query = $this->connect()->prepare('INSERT INTO usuario (id_rol, rol) VALUES (:id, :rol, :identify, :pass)');
        $query->execute(['id' => $usuario['id_usuario'], 'rol' => $usuario['rol'], 'identify' => $usuario['identificacion'], 'pass' => $usuario['pass']]);

        return $query;  
    }

    function delete($id){
        $query = $this->connect()->prepare('DELETE FROM usuario WHERE id_usuario=:idrol');
        $query->execute(['idrol' => $id]);

        return $query; 
    }

    function update($obj)
    {
        
    }
}


?>