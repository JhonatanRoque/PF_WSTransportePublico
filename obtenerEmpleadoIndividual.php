<?php
include("empleado.php.php");
$correo = htmlspecialchars($_POST['correo'], ENT_QUOTES);

if($correo != ""){
    $resultado = Empleados::listarEmpleadoIndividual($correo);
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
    //Fecha modificación: 15/11/2022 06:00 pm


?>