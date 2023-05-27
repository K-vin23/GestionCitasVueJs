<?php

include_once 'apiusuario.php';

$api = new ApiUsuarios();

if (isset($_POST['id_usuario']) && isset($_POST['id_rol']) && isset($_POST['identificacion']) && isset($_POST['psswd'])) {
    $item = array(
        'id_usuario' => $_POST['id_usuario'],
        'rol' => $_POST['id_rol'],
        'identificacion' => $_POST['identificacion'],
        'pass' => $_POST['psswd']
     );
     $api->add($item);
}else {
    $apirol->error('Error en el llamado');
}
?>