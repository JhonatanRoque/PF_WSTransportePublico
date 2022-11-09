<?php
    include("empresacrud.php");
    $empresa = htmlspecialchars($_POST['empresa'], ENT_QUOTES);
    $contrasena = htmlspecialchars($_POST['contrasena'], ENT_QUOTES);

    if(($empresa != "") and ($contrasena != "")){
    
        $resultado = empresaCRUD::getLogin($empresa, $contrasena);
            
        header('Content-type: application/json; charset=utf-8');
        $json_string = json_encode($resultado);
        echo $json_string;
        
            
    } else {
        header('Content-type: application/json; charset=utf-8');
        $json_string = json_encode(array("estado" => 0, "mensaje" => "Hay datos que no se han suministrado $empresa + $contrasena"));
        echo $json_string;
    }

?>