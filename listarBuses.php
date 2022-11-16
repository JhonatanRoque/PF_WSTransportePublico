<?php
include("buses.php");

$empresaID = $_POST['empresaID'];

if($empresaID != ""){
    $resultado = Buses::listarBuses($empresaID);
    if ($resultado) {
        echo $resultado;
    } else {
        echo "0";
    }
}else {
    echo "Faltan datos, para procesar la solicitud.";
}



   //by Tec. Francisco Abarca 
    //Modificado por: Tec. Francisco Abarca
    //Fecha modificación: 15/11/2022 09:00 pm


?>