<?php

    class empresaCRUD{
        
    //Metodo para consultar si existe una empresa con dicho nombre y contraseña
    public static function getLogin($empresa, $contrasena){
    include("connection_db.php");
    
    // Consulta de la tabla empresa para verificar si existe una empresa registrada con dichos datos.
    $query = "SELECT * FROM tbEmpresa WHERE  nombre = ? and contrasena = ?"; //Sentencia SQL para consultar datos en la tabla empresa
    try {    
          $link=conexion();    
          $comando = $link->prepare($query);
          $comando->execute(array($empresa,$contrasena));
          $row = $comando->fetch(PDO::FETCH_ASSOC);
          $filasAfectadas = $comando->rowCount();
          if( $filasAfectadas > 0){
            return $row;
          }
          $mensaje = array("mensaje" =>"Nombre de empresa o contraseña incorrectos, puede que no exista una empresa con dichas credenciales");
          return $mensaje;

        } catch (PDOException $e) {
            return -1;
        }
        
    }

    public static function getDatosIndividual($empresa){
        include("connection_db.php");
        
        // Consulta de la tabla usuarios para verificar email existentes.
        $query = "SELECT * FROM tb_empresa WHERE nombre = ? ";
        try {    
              $link=conexion();    
              $comando = $link->prepare($query);
              $comando->execute(array($empresa));
              $row = $comando->fetch(PDO::FETCH_ASSOC);
              $filasAfectadas = $comando->rowCount();
              if( $filasAfectadas > 0){
                return $row;
              }
              $mensaje = array("mensaje" =>"No se encontraron los datos de dicha empresa");
              return $mensaje;
    
            } catch (PDOException $e) {
                return -1;
            }
            
        }
        
    //Metodo para registrar empresas
    public static function setEmpresa($nombre, $telefono, $correo, $direccion, $codigopostal, $contrasena){
        include ("connection_db.php");
        $query = "INSERT INTO tbEmpresa (nombre, telefono, correo, direccion, codigoPostal, contrasena)
        VALUES (?, ?, ?, ?, ?, ?)";
        try{
            $CheckUser = empresaCRUD::checkName($nombre);
            if($CheckUser == 1){
                $mensaje = "Nombre de Empresa no diponible, escoja otro.";
                return $mensaje;
            }
            $CheckEmail = empresaCRUD::checkCorreo($correo);
            if($CheckUser == 1){
                $mensaje = "Correo de Empresa no diponible, escoja otro.";
                return $mensaje;
            }
            
            $link = conexion();
            $comando = $link -> prepare ($query);
            $comando -> execute (array($nombre, $telefono, $correo, $direccion, $codigopostal, $contrasena));
            $row = $comando -> rowCount();
            if($row > 0){
                return 1;
            }else{
                return 2;
            }
        }catch(PDOException $e){
            return $e;
        }

    }

    //Metodo para comprobar si ya existe un empresa con dicho nombre
    private static function checkName($empresa){
        $query = "SELECT nombre FROM tbEmpresa WHERE nombre = ?";
        try{
            $link = conexion();
            $comando = $link -> prepare ($query);
            $comando -> execute (array($empresa));
            $row = $comando -> rowCount();
            if($row > 0){
                //significa que encontro una cuenta de empresa que ya tiene ese nombre 
                //No permite crear cuenta si esto sucede
                return 1;
            }else{
                //No encontro ninguna empresa con dicho nombre 
                //puede continuar con el registro 
                return 0;
            }
        }catch(PDOException $e){
            return $e;
        }
    }

    private static function checkCorreo($correo){
        $query = "SELECT correo FROM tbEmpresa WHERE correo = ?";
        try{
            $link = conexion();
            $comando = $link -> prepare ($query);
            $comando -> execute (array($correo));
            $row = $comando -> rowCount();
            if($row > 0){
                //significa que encontro una cuenta de empresa que ya tiene ese nombre 
                //No permite crear cuenta si esto sucede
                return 1;
            }else{
                //No encontro ninguna empresa con dicho nombre 
                //puede continuar con el registro 
                return 0;
            }
        }catch(PDOException $e){
            return $e;
        }
    }
      
    //Metodo para eliminar una empresa
    public static function eliminarEmpresa($empresa){
        $query = "DELETE tbEmpresa WHERE id = ?";
        try{
            $link = conexion();
            $comando = $link -> prepare ($query);
            $comando -> execute (array($empresa));
            $row = $comando -> rowCount();
            if($row > 0){
                //significa que elimino la cuenta satisfactoriamente
                return 1;
            }else{
                //No elimino nada
                return 0;
            }
        }catch(PDOException $e){
            return $e;
        }
    }



        
        //Metodo para generar el codigo de verificación de la base de datos
        public static function setCodigoV(){
            try{
                $codigo = rand(100000, 999999);
                $query = "UPDATE tb_codigo SET codigoValidacion = $codigo";
                $link = conexion();
                $comando = $link->prepare($query);
                $comando->execute();
                $row = $comando->fetch(PDO::FETCH_ASSOC);
                $filasAfectadas = $comando->rowCount();
                return $filasAfectadas;
               
            }catch(PDOException $e){
                return $e;
            }

        }
        //Metodo para obtener el codigo de verificación de la base de datos
        public static function getCodigoV(){
            include("connection_db.php");
            try{
                $bandera = empresaCRUD::setCodigoV();
                if(!$bandera > 0 ){
                    return array("mensaje" => "No se modifico el codigo");
                }
                $query = "SELECT codigoValidacion as codigo FROM tb_codigo";
                $link = conexion();
                $comando = $link->prepare($query);
                $comando->execute();
                $row = $comando->fetch(PDO::FETCH_ASSOC);
                $filasAfectadas = $comando->rowCount();
                if( $filasAfectadas > 0){
                    return $row['codigo'];
                }else{
                    //No se encontro ningun codigo para enviar
                    return 0;
                }
            }catch(PDOException $e){
                return $e;
            }

        }
        
    }
    //by Tec. Francisco Abarca 
    //Modificado por: Tec. Francisco Abarca
    //Fecha modificación: 20/10/2022 10:20 pm

?>