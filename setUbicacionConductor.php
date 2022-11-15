<?php
include("empleado.php");

$id = $_POST['idEmpleado'];
$lat = htmlspecialchars($_POST['latitud'], ENT_QUOTES);
$long = htmlspecialchars($_POST['longitud'], ENT_QUOTES);

if(($id != "") and ($lat != "") and ($long != "")){
    $resultado = Empleados::setUbicacion($id, $lat, $long);

    
	if ($resultado==1) {
        header('Content-type: application/json; charset=utf-8');
        $json_string = json_encode(array("estado" => 1,"mensaje" => "Ubicacion registrada con exito."));
        echo $json_string;
        //echo "Registro guardado...";
    } else {
      echo $resultado;
        

    }
}
else {
    echo "Faltan algunos datos";
}

?>