<?php
    include("manto_usuarios.php");
    $correo = htmlspecialchars($_POST['correo'], ENT_QUOTES);
    $usuario = htmlspecialchars($_POST['usuario'], ENT_QUOTES);
    $contrasena = htmlspecialchars($_POST['contrasena'], ENT_QUOTES);

    if((($usuario != "") or ($correo != "")) and ($contrasena != "")){
        if($usuario != ""){
            $resultado = usuarios::getLogin($usuario, $contrasena);
            
                header('Content-type: application/json; charset=utf-8');
                $json_string = json_encode($resultado);
                echo $json_string;
        }else {
            $resultado = usuarios::getLoginCorreo($correo, $contrasena);
            
            header('Content-type: application/json; charset=utf-8');
            $json_string = json_encode($resultado);
            echo $json_string;
        }
            
    }

?>