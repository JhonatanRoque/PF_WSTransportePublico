<?php
include('empleado.php');
//require 'main_class.php';
$nombre = htmlspecialchars($_POST['nombre'], ENT_QUOTES);
$apellido = htmlspecialchars($_POST["apellido"], ENT_QUOTES);
$telefono = htmlspecialchars($_POST["telefono"],ENT_QUOTES);
$correo= htmlspecialchars( $_POST["correo"], ENT_QUOTES);
$direccion = htmlspecialchars($_POST["direccion"],ENT_QUOTES);
$empresaID = $_POST['empresa'];
$rutaID = $_POST["ruta"];
$autoID = $_POST["auto"];

if (($nombre!="") and
    ($apellido != "") and
    ($telefono!="") and 
    ($correo!="") and 
    ($direccion!="") and 
    ($empresaID!="") and
    ($rutaID!="") and 
    ($autoID!="")) {
     	
    $resultado = Empleados::setEmpleado($nombre, $apellido, $telefono, $correo, $direccion, $empresaID, $rutaID, $autoID);

	if ($resultado==1) {
        header('Content-type: application/json; charset=utf-8');
        $json_string = json_encode(array("estado" => 1,"mensaje" => "Empleado registrado correctamente."));
        echo $json_string;
        //echo "Registro guardado...";
    } else {
        header('Content-type: application/json; charset=utf-8');
        $json_string = json_encode(array("estado" => 2,"mensaje" => "Ocurrio un problema, no se pudo registrar al empleado $nombre"));
		echo $json_string;
    }
}
    //by Tec. Francisco Abarca 
    //Modificado por: Tec. Francisco Abarca
    //Fecha modificación: 13/10/2022 01:42 pm
?>