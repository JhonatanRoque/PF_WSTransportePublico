<?php

    class usuarios{
        
    //Metodo para consultar si existe una cuenta con dicho usuario y contraseña
    public static function getLogin($usuario, $clave){
    include("connection_db.php");
    
    // Consulta de la tabla usuarios para verificar email existentes.
    $query = "SELECT * FROM tb_usuario WHERE usuario = ? and clave = ?";
    try {    
          $link=conexion();    
          $comando = $link->prepare($query);
          $comando->execute(array($usuario,$clave));
          $row = $comando->fetch(PDO::FETCH_ASSOC);
          $filasAfectadas = $comando->rowCount();
          if( $filasAfectadas > 0){
            return $row;
          }
          $mensaje = array("mensaje" =>"Usuario o contraseña incorrectos, puede que no exista un usuario con dicas credenciales");
          return $mensaje;

        } catch (PDOException $e) {
            return -1;
        }
        
    }

    //Metodo para consultar si existe una cuenta con dicho usuario y contraseña
    public static function getDatosIndividual($usuario){
        include("connection_db.php");
        
        // Consulta de la tabla usuarios para verificar email existentes.
        $query = "SELECT * FROM tb_usuario WHERE usuario = ? ";
        try {    
              $link=conexion();    
              $comando = $link->prepare($query);
              $comando->execute(array($usuario));
              $row = $comando->fetch(PDO::FETCH_ASSOC);
              $filasAfectadas = $comando->rowCount();
              if( $filasAfectadas > 0){
                return $row;
              }
              $mensaje = array("mensaje" =>"Usuario o contraseña incorrectos, puede que no exista un usuario con dicas credenciales");
              return $mensaje;
    
            } catch (PDOException $e) {
                return -1;
            }
            
        }

    public static function getLoginCorreo($correo, $contrasena){
        include("connection_db.php");
        
        // Consulta de la tabla usuarios para verificar email existentes.
        $query = "SELECT * FROM tb_usuario WHERE correo = '$correo' and clave = ?";
        try {    
              $link=conexion();    
              $comando = $link->prepare($query);
              $comando->execute(array($contrasena));
              $row = $comando->fetch(PDO::FETCH_ASSOC);
              $filasAfectadas = $comando->rowCount();
              if( $filasAfectadas > 0){
                return $row;
              }
              $mensaje = array("mensaje" =>"Usuario o contraseña incorrectos, puede que no exista un usuario con dicas credenciales");
              return $mensaje;
    
            } catch (PDOException $e) {
                return -1;
            }
            
        }
        
    //Metodo para registrar usuarios
    public static function setUser($nombres, $Telefono, $correo, $direccion, $codigopostal){
        include ("connection_db.php");
        $query = "INSERT INTO tb_empresa (nombre, Telefono, correo, direccion, codigo postal)
        VALUES (?, ?, ?, ?, ?)";
        try{
            $CheckUser = usuarios::checkUserName($nombres);
            if($CheckUser == 1){
                $mensaje = "Nombre de Empresa no diponible, escoja otro.";
                return $mensaje;
            }
            $CheckUserEmail = usuarios::checkUserEmail($correo);
            if($CheckUserEmail == 1){
                $mensaje = "Correo electrónico en uso, utilice otro.";
                return $mensaje;
            }
            
            $link = conexion();
            $comando = $link -> prepare ($query);
            $comando -> execute (array($nombres, $Telefono, $correo, $direccion, $codigopostal));
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

    //Metodo para comprobar si ya existe un usuario con dicho nombre
    private static function checkUserName($usuario){
        $query = "SELECT usuario FROM tb_usuario WHERE usuario = ?";
        try{
            $link = conexion();
            $comando = $link -> prepare ($query);
            $comando -> execute (array($usuario));
            $row = $comando -> rowCount();
            if($row > 0){
                //significa que encontro una cuenta que ya tiene ese nombre de usuario
                //No permite crear cuenta si esto sucede
                return 1;
            }else{
                //No encontro ninguna cuenta con dicho nickname
                //puede continuar con el registro 
                return 0;
            }
        }catch(PDOException $e){
            return $e;
        }
    }
      //Metodo para comprobar si ya existe un usuario con dicho correo
      private static function checkUserEmail($correo){
        $query = "SELECT correo FROM tb_usuario WHERE correo = ?";
        try{
            $link = conexion();
            $comando = $link -> prepare ($query);
            $comando -> execute (array($correo));
            $row = $comando -> rowCount();
            if($row > 0){
                //significa que encontro una cuenta que ya tiene ese nombre de usuario
                //No permite crear cuenta si esto sucede
                return 1;
            }else{
                //No encontro ninguna cuenta con dicho nickname
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
        
    }
    //by Tec. Francisco Abarca 
    //Modificado por: Tec. Francisco Abarca
    //Fecha modificación: 20/10/2022 10:20 pm

?>