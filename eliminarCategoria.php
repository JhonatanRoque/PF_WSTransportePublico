<?php

include('categoria.php'); 

$idCategoria = $_POST['id_categoria'];
//$idCategoria = 57;

if ($idCategoria!="") {

    $resultado = Categoria::eliminar_Categoria($idCategoria);

    if($resultado == 1) {
        header('Content-type: application/json; charset=utf-8');
        $json_string = json_encode(array("estado" => 1,"mensaje" => "Registro eliminado correctamente."));
        echo $json_string;
    }  else {
        header('Content-type: application/json; charset=utf-8');
        $json_string = json_encode(array("estado" => 2,"mensaje" => "Error al eliminar la categoria $idCategoria."));
		echo $json_string;
    }
}

//by Tec. Francisco Abarca 
//Modificado por: Tec. Francisco Abarca
//Fecha modificación: 07/10/2022 07:40 pm
?>