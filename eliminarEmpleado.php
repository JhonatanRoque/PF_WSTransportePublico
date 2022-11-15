<?php
include('empleado.php');

if (isset($_POST["idEmpleado"])){
 	$empleadoID = $_POST['idEmpleado'];
	$resultado = Empleados::eliminarEmpleado($empleadoID);
	
	if ($resultado==1) {
        header('Content-type: application/json; charset=utf-8');
        $json_string = json_encode(array("estado" => 1,"mensaje" => "Eliminado correctamente."));
        echo $json_string;
        
		
    } else if($resultado==0){
        header('Content-type: application/json; charset=utf-8');
        $json_string = json_encode(array("estado" => 2,"mensaje" => "No hay informacion que eliminar."));
		echo $json_string;
    }
}

?>