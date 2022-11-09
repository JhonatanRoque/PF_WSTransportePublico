<?php
include("manto_usuarios.php");
$resultado = usuarios::obtenerUsuarios();
if ($resultado) {
    echo $resultado;
} else {
    echo "0";
}

   //by Tec. Francisco Abarca 
    //Modificado por: Tec. Francisco Abarca
    //Fecha modificación: 20/10/2022 01:20 pm


?>