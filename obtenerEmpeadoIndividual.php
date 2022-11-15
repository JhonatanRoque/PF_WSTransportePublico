<?php
include("empleado.php.php");
$id = $_POST['codigo'];
//$id = 16272;

if($id != ""){
    $resultado = Empleados::listarEmpleadoIndividual($id);
    if ($resultado) {
        echo $resultado;
    } else {
    echo "0";
}
}


   //by Tec. Francisco Abarca 
    //Modificado por: Tec. Francisco Abarca
    //Fecha modificación: 15/11/2022 06:00 pm


?>