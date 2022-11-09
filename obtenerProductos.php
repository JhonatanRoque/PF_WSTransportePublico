<?php
include("main_class.php");
$resultado = MantenimientoProductos::obtenerProductos();
if ($resultado) {
    echo $resultado;
} else {
    echo "0";
}

   //by Tec. Francisco Abarca 
    //Modificado por: Tec. Francisco Abarca
    //Fecha modificación: 15/10/2022 07:20 pm


?>