<?php
include("empleado.php");

$ruta = $_POST['rutaID'];

if($ruta != "")
{

    $resultado = Empleados::getUbicaciones($ruta);
    if ($resultado) {
        echo $resultado;
    } else {
        echo "0";
    }
}else {
    echo "Faltan valores para procesar la solictud.";
}




   //by Tec. Francisco Abarca 
    //Modificado por: Tec. Francisco Abarca
    //Fecha modificación: 15/11/2022 09:00 pm


?>