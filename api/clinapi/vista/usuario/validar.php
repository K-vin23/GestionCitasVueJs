<?php

include_once 'apiusuario.php';

$api = new ApiUsuarios();

if (isset($_POST['identificacion']) && isset($_POST['psswd'])) {
   $identify = $_POST['identificacion'];
   $psswd  = $_POST['psswd'];

   $api->userVerify($identify, $psswd);
}else {
    $api->error('Error en el llamado');
}
?>