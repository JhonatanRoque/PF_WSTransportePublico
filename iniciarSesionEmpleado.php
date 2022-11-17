<?php
    include("empleado.php");
    $correo = htmlspecialchars($_POST['correo'], ENT_QUOTES);

    if($correo != ""){
    
        $resultado = Empleados::getLogin($correo);
            
        header('Content-type: application/json; charset=utf-8');
        $json_string = json_encode($resultado);
        echo $json_string;
        
            
    } else {
        header('Content-type: application/json; charset=utf-8');
        $json_string = json_encode(array("estado" => 0, "mensaje" => "Hay datos que no se han suministrado $empresa + $contrasena"));
        echo $json_string;
    }

?>