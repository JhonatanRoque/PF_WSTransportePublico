<?php
include('categoria.php'); 

$resultado = Categoria::obtenerCategorias();
if ($resultado) {
    echo $resultado;
} else {
    echo "0";
}

    //by Tec. Francisco Abarca 
    //Modificado por: Tec. Francisco Abarca
    //Fecha modificación: 08/10/2022 11:30 am

?>