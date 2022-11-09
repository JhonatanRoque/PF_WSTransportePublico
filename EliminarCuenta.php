<?php
include('manto_usuarios.php'); 
$id = $_POST['id'];

if (($id !="") ) {
     	
    $resultado = usuarios::eliminarCuenta($id);

	if ($resultado==1) {
        header('Content-type: application/json; charset=utf-8');
        $json_string = json_encode(array("estado" => 1,"mensaje" => "Cuenta eliminada correctamente."));
        echo $json_string;
    } else {
        header('Content-type: application/json; charset=utf-8');
        $json_string = json_encode(array("estado" => 2,"mensaje" => "No se pudo eliminar la cuenta."));
		echo $json_string;
    }
}

//by Tec. Francisco Abarca 
//Modificado por: Tec. Francisco Abarca
//Fecha modificación: 06/10/2022 03:40 pm

?>