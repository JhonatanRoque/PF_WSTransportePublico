<?php
include("paradas.php");



    $resultado = Paradas::listarParadas();
    if ($resultado) {
        echo $resultado;
    } else {
        echo "0";
    }



   //by Tec. Francisco Abarca 
    //Modificado por: Tec. Francisco Abarca
    //Fecha modificación: 15/11/2022 09:00 pm


?>