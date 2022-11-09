<?php
include("categoria.php");
$idCategoria = $_POST['id_categoria'];

if($idCategoria != ""){
    $resultado = Categoria::getProductsToCategoria($idCategoria);
    if ($resultado) {
        echo $resultado;
    } else {
        echo "0";
    }
}

?>