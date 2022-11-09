<?php
include('categoria.php'); 
$idCategoria = $_POST['id_categoria'];
$nomCategoria = htmlspecialchars($_POST["nom_categoria"],ENT_QUOTES);
$estadoCategoria = $_POST["estado_categoria"];
//$idCategoria = 59;
//$nomCategoria = "Pagina";
//$estadoCategoria = "1";
if (($idCategoria!="") and
    ($nomCategoria!="") and 
    ($estadoCategoria!="")) {
     	
    $resultado = Categoria::guardar_Categoria($idCategoria, $nomCategoria, $estadoCategoria);

	if ($resultado==1) {
        header('Content-type: application/json; charset=utf-8');
        $json_string = json_encode(array("estado" => 1,"mensaje" => "Registro guardado correctamente."));
        echo $json_string;
        //echo "Registro guardado...";
    } else {
        header('Content-type: application/json; charset=utf-8');
        $json_string = json_encode(array("estado" => 2,"mensaje" => "No se ha guardado nada."));
		echo $json_string;
    }
}

//by Tec. Francisco Abarca 
//Modificado por: Tec. Francisco Abarca
//Fecha modificación: 06/10/2022 03:40 pm

?>