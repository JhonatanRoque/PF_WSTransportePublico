<?php
    include("empresacrud.php");

    //Recibir variables;
    $nombre = htmlspecialchars($_POST["nombres"],ENT_QUOTES);
    $telefono = $_POST['telefono'];
    $correo = htmlspecialchars($_POST["correo"],ENT_QUOTES);
    $direccion = htmlspecialchars($_POST["direccion"],ENT_QUOTES);
    $codigo_postal = htmlspecialchars($_POST["codigoPostal"],ENT_QUOTES);
    $contrasena = htmlspecialchars($_POST['contrasena'], ENT_QUOTES);

    if(($nombre != "") and ($telefono != "") and ($correo != "") and 
        ($direccion != "") and ($codigo_postal != "") and ($contrasena != "")){
            
            $resultado = empresaCRUD::setEmpresa($nombre, $telefono, $correo, $direccion, $codigo_postal, $contrasena);

            if($resultado == 1){
                header('Content-type: application/json; charset=utf-8');
                $json_string = json_encode(array("estado" => 1, "mensaje" => "¡Empresa registrada con exito!"));
                echo $json_string;
            }else if ($respuesta == 2){
                header('Content-type: application/json; charset=utf-8');
                $json_string = json_encode(array("estado" => 2, "mensaje" => "¡No se pudo registrar la Empresa!"));
                echo $json_string;
            }else { 
                header('Content-type: application/json; charset=utf-8');
                $json_string = json_encode(array("estado" => 3, "mensaje" => $resultado));
                echo $json_string;
            }

    }
?>