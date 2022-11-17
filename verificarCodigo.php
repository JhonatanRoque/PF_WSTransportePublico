<?php
include('empresacrud.php'); 
$codigo = $_POST['codigo'];

if (($id !="") ) {
     	
    $resultado = empresaCRUD::checkCodigoRegistro($codigo);

	if ($resultado==1) {
        header('Content-type: application/json; charset=utf-8');
        $json_string = json_encode(array("estado" => 1,"mensaje" => "Codigo valido."));
        echo $json_string;
    } else {
        header('Content-type: application/json; charset=utf-8');
        $json_string = json_encode(array("estado" => 2,"mensaje" => "Codigo erroneo, por favor introduce un codigo nuevo."));
		echo $json_string;
    }
}

//by Tec. Francisco Abarca 
//Modificado por: Tec. Francisco Abarca
//Fecha modificación: 06/10/2022 03:40 pm

?>