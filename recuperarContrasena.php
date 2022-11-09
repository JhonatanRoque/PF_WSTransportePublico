<?php
include ("manto_usuarios.php");
$correo = htmlspecialchars($_POST['correo'], ENT_QUOTES);
$pregunta = htmlspecialchars($_POST['pregunta'], ENT_QUOTES);
$respuesta = htmlspecialchars($_POST['respuesta'], ENT_QUOTES);

if($correo != ""){
    $resultado = usuarios::recuperarContrasena($correo, $pregunta, $respuesta);
            
    header('Content-type: application/json; charset=utf-8');
    $json_string = json_encode(array("contrasena" => $resultado));
    echo $json_string;
}

?>