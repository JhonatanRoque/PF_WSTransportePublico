<?php
include("main_class.php");
$id = $_POST['codigo'];
//$id = 16272;

if($id != ""){
    $resultado = MantenimientoProductos::obtenerProductosIndividual($id);
    if ($resultado) {
        echo $resultado;
    } else {
    echo "0";
}
}


   //by Tec. Francisco Abarca 
    //Modificado por: Tec. Francisco Abarca
    //Fecha modificación: 16/10/2022 02:20 pm


?>