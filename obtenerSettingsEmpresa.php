<?php
    include("empresacrud.php");
    $empresa = htmlspecialchars($_POST['empresa'], ENT_QUOTES);

        if($empresa != ""){
            $resultado = empresaCRUD::getDatosIndividual($empresa);
            
                header('Content-type: application/json; charset=utf-8');
                $json_string = json_encode($resultado);
                echo $json_string;
        } else {
            header('Content-type: application/json; charset=utf-8');
            $json_string = json_encode(array("mensaje" => "Hace falta identificar su empresa"));
            echo $json_string;
        }
            

?>