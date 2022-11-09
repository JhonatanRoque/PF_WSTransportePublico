<?php
include('main_class.php');
//require 'main_class.php';
$codigo = $_POST['id_prod'];
$nombre = htmlspecialchars($_POST["nom_prod"], ENT_QUOTES);
$descripcion = htmlspecialchars($_POST["des_prod"],ENT_QUOTES);
$stock = $_POST["stock"];
$precio = htmlspecialchars($_POST["precio"],ENT_QUOTES);
$unidadMedida = htmlspecialchars($_POST['uni_medida'], ENT_QUOTES);
$estado = $_POST["estado_prod"];
$categoria = $_POST["categoria"];

if (($codigo!="") and
    ($nombre != "") and
    ($descripcion!="") and 
    ($stock!="") and 
    ($precio!="") and 
    ($unidadMedida!="") and
    ($estado!="") and 
    ($categoria!="")) {
     	
    $resultado = MantenimientoProductos::guardar_Productos($codigo, $nombre, $descripcion, $stock, $precio, $unidadMedida, $estado, $categoria);

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
    //Fecha modificación: 13/10/2022 01:42 pm
?>