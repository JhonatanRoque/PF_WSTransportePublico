<?php

include('categoria.php'); 

$idCategoria = $_POST['id_categoria'];
$nomCategoria = htmlspecialchars($_POST["nom_categoria"],ENT_QUOTES);
$estadoCategoria = $_POST["estado_categoria"];

if (($idCategoria!="") and
    ($nomCategoria!="") and 
    ($estadoCategoria!="")) {
    
        $resultado = Categoria::modificarCategoria($idCategoria, $nomCategoria, $estadoCategoria);
        if($resultado == 1){
            header('Content-type: application/json; charset=utf-8');
            $json_string = json_encode(array("estado" => 1,"mensaje" => "Registro modificado correctamente."));
            echo $json_string;
        }else{
            header('Content-type: application/json; charset=utf-8');
            $json_string = json_encode(array("estado" => 2,"mensaje" => "No se pudo modificar el registro."));
            echo $json_string;
        }

}

//by Tec. Francisco Abarca 
    //Modificado por: Tec. Francisco Abarca
    //Fecha modificación: 14/10/2022 08:30 pm
?>