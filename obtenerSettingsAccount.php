<?php
    include("manto_usuarios.php");
    $usuario = htmlspecialchars($_POST['usuario'], ENT_QUOTES);

        if($usuario != ""){
            $resultado = usuarios::getDatosIndividual($usuario);
            
                header('Content-type: application/json; charset=utf-8');
                $json_string = json_encode($resultado);
                echo $json_string;
        }
            

?>