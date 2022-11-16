<?php

    class Paradas{
        
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

    public static function listarParadas() {
        include("connection_db.php");
        
        $query = " SELECT  tbP.id as id, tbP.nombre as parada FROM tbRuta as tbR INNER JOIN tbRutaParada as tbRP ON tbR.id = tbRP.rutaID INNER JOIN tbParada as tbP ON tbRP.paradaID = tbP.id WHERE tbR.id = ?";
    
        try {
            $link=conexion();    
            $comando = $link->prepare($query);
            // Ejecutar sentencia preparada
            $comando->execute(array());
            
            $rows_array = array();
            while($result = $comando->fetch(PDO::FETCH_ASSOC))
                {
                                       
                     $array [] = array('id' => $result['id'] ,'parada' => $result['parada']);
                    
                }
                
                //array_map("utf8_encode", $array);
                  header('Content-type: application/json; charset=utf-8');
                  return print_r(json_encode($array), JSON_UNESCAPED_UNICODE);
                 
        } catch (PDOException $e) {
            return false;
        }
        
    }

    public static function listarParadasIndividual($rutaID) {
        include("connection_db.php");
        
        $query = " SELECT  tbP.nombre as parada FROM tbRuta as tbR INNER JOIN tbRutaParada as tbRP ON tbR.id = tbRP.rutaID INNER JOIN tbParada as tbP ON tbRP.paradaID = tbP.id WHERE tbR.id = ?";
    
        try {
            $link=conexion();    
            $comando = $link->prepare($query);
            // Ejecutar sentencia preparada
            $comando->execute(array($rutaID));
            
            $rows_array = array();
            while($result = $comando->fetch(PDO::FETCH_ASSOC))
                {
                                       
                     $array [] = array('parada' => $result['parada']);
                    
                }
                
                //array_map("utf8_encode", $array);
                  header('Content-type: application/json; charset=utf-8');
                  return print_r(json_encode($array), JSON_UNESCAPED_UNICODE);
                 
        } catch (PDOException $e) {
            return false;
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
      
        //Método para obtener la pregunta
        public static function getPregunta($correo){
            include ("connection_db.php");
            $query = "SELECT pregunta FROM tb_usuario WHERE correo = ?";
            try{
                $link = conexion();
                $comando = $link->prepare($query);
                $comando->execute(array($correo));
                $row = $comando->fetch(PDO::FETCH_ASSOC);
                $filasAfectadas = $comando->rowCount();
                if( $filasAfectadas > 0){
                    return $row;
                }else{
                    //No encontro ninguna pregunta asociada a ese usuario
                    return 0;
                }
            }catch(PDOException $e){
                return $e;
            }
        }
        //Metodo para verificar la respuesta 
        public static function checkRespuesta($correo, $pregunta, $respuesta){
            include ("connection_db.php");
            $query = "SELECT respuesta, usuario FROM tb_usuario WHERE correo = ? AND pregunta = ?";
            try{
                $link = conexion();
                $comando = $link->prepare($query);
                $comando->execute(array($correo, $pregunta));
                $row = $comando->fetch(PDO::FETCH_ASSOC);
                $filasAfectadas = $comando->rowCount();
                if( $filasAfectadas > 0){ //Sabemos que encontro una respuesta a la pregunta y al usuario
                    if($respuesta == $row['respuesta']){ //Corroboramos que nuestra respuesta sea igual a la respuesta del servidor
                        return $row['usuario']; //Si lo es, devolvemos el usuario
                    }else{
                        return -1;
                    }
                }else{
                    //No encontro ninguna respuesta
                    return 0;
                }
            }catch(PDOException $e){
                return $e;
            }
        }

         //Metodo para verificar la respuesta 
         public static function recuperarContrasena($correo, $pregunta, $respuesta){
            include ("connection_db.php");
            $query = "SELECT respuesta, clave FROM tb_usuario WHERE correo = ? AND pregunta = ?";
            try{
                $link = conexion();
                $comando = $link->prepare($query);
                $comando->execute(array($correo, $pregunta));
                $row = $comando->fetch(PDO::FETCH_ASSOC);
                $filasAfectadas = $comando->rowCount();
                if( $filasAfectadas > 0){ //Sabemos que encontro una respuesta a la pregunta y al usuario
                    if($respuesta == $row['respuesta']){ //Corroboramos que nuestra respuesta sea igual a la respuesta del servidor
                        return $row['clave']; //Si lo es, devolvemos la contraseña
                    }else{
                        return -1;
                    }
                }else{
                    //No encontro ninguna respuesta
                    return 0;
                }
            }catch(PDOException $e){
                return $e;
            }
        }

         //Metodo para verificar la respuesta 
         public static function eliminarCuenta($id){
            include ("connection_db.php");
            $query = "DELETE FROM tb_usuario WHERE id = ?";
            try{
                $link = conexion();
                $comando = $link->prepare($query);
                $comando->execute(array($id));
                $filasAfectadas = $comando->rowCount();
                if( $filasAfectadas > 0){ //Sabemos que elimino una cuenta
                    return 1;
                }else{
                    //No encontro ninguna cuenta que eliminar 
                    return 0;
                }
            }catch(PDOException $e){
                return $e;
            }
        }

        //Método para obtener usuarios
        public static function obtenerUsuarios() {
            include("connection_db.php");
            
            $query = "SELECT * FROM tb_usuario";
        
            try {
                $link=conexion();    
                $comando = $link->prepare($query);
                // Ejecutar sentencia preparada
                $comando->execute();
                
                $rows_array = array();
                while($result = $comando->fetch(PDO::FETCH_ASSOC))
                    {
                         $array [] = array('nombre' => $result['nombre'], 'apellido' => $result['apellido'], 'correo' => $result['correo'], 'usuario' => $result['usuario']);
                        
                    }
                    
                    //array_map("utf8_encode", $array);
                      header('Content-type: application/json; charset=utf-8');
                      return print_r(json_encode($array), JSON_UNESCAPED_UNICODE);
                     
            } catch (PDOException $e) {
                return false;
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