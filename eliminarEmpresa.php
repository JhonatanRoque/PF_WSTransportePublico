<?php
include('empresacrud.php'); 
$id = $_POST['id'];

if (($id !="") ) {
     	
    $resultado = empresaCRUD::eliminarEmpresa($id);

	if ($resultado==1) {
        header('Content-type: application/json; charset=utf-8');
        $json_string = json_encode(array("estado" => 1,"mensaje" => "Empresa eliminada correctamente."));
        echo $json_string;
    } else {
        header('Content-type: application/json; charset=utf-8');
        $json_string = json_encode(array("estado" => 2,"mensaje" => "No se pudo eliminar la Empresa."));
		echo $json_string;
    }
}

//by Tec. Francisco Abarca 
//Modificado por: Tec. Francisco Abarca
//Fecha modificación: 06/10/2022 03:40 pm

?>