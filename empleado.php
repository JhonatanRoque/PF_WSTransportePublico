<?php
class Empleados{
    

    //Método para registrar empleados
    public static function setEmpleado($nombre, $apellido, $telefono, $correo, $direccion, $empresaID, $rutaID, $autoID){
        include("connection_db.php");
        $query = "INSERT INTO  tbEmpleado (nombre, apellido, telefono, correo, direccion, empresaID, rutaID, autoID)
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        try{    
          $link=conexion();    
          $comando = $link->prepare($query);
          $comando->execute(array($nombre, $apellido, $telefono, $correo, $direccion, $empresaID, $rutaID, $autoID));
          $count = $comando->rowCount();
        
          if($count > 0){
              return 1;
          }else{
              return 0;
          }
        } catch (PDOException $e) {
            return -1;
        }                        
    }

    //Método para configurar ubicación del conductor
    public static function setUbicacion($id, $latitud, $longitud){
        include("connection_db.php");
        $query = "UPDATE tbEmpleado SET latitud = ?, longitud = ? WHERE id = ?";

        try{
            $link = conexion();
            $comando = $link->prepare($query);
            $comando->execute(array($latitud, $longitud, $id));
            $count = $comando->rowCount(); 
            if($count>0){
                return 1;
            }else{
                return 0;   
            }
        }catch (PDOException $e){
            return -1;
        }
    }
    
    
    
    
    public static function eliminarEmpleado($empleadoID){
      include("connection_db.php");
      $query = "DELETE from tbEmpleado WHERE id = ?";
      try{
          $link=conexion();
          $comando=$link->prepare($query);
          $comando->execute(array($empleadoID));
          //return $comando;
          $count = $comando->rowCount(); 
          if($count>0){
              return 1;
          }else{
              return 0;   
          }
          
      }catch (PDOException $e){
          return -1;
      }
  }
  
  
  
  public static function listarEmpleados($empresaID) {
    include("connection_db.php");
    
    $query = "SELECT tbE.nombre, tbE.apellido, tbE.telefono, tbE.correo, tbE.direccion, tbR.nombre as ruta, tbA.Nplaca as auto FROM tbEmpleado as tbE INNER JOIN tbRuta as tbR ON tbE.rutaID = tbR.id INNER JOIN tbAuto as tbA ON tbE.autoID = tbA.id WHERE tbE.empresaID = ?";

    try {
        $link=conexion();    
        $comando = $link->prepare($query);
        // Ejecutar sentencia preparada
        $comando->execute(array($empresaID));
        
        $rows_array = array();
        while($result = $comando->fetch(PDO::FETCH_ASSOC))
            {
                                   
                 $array [] = array('nombre' => $result['nombre'], 'apellido' => $result['apellido'], 'telefono' => $result['telefono'], 'correo' => $result['correo'], 'direccion' => $result['direccion'], 'ruta' => $result['ruta'], 'bus' => $result['auto']);
                
            }
            
            //array_map("utf8_encode", $array);
              header('Content-type: application/json; charset=utf-8');
              return print_r(json_encode($array), JSON_UNESCAPED_UNICODE);
             
    } catch (PDOException $e) {
        return false;
    }
    
}

public static function listarEmpleadoIndividual($correo) {
    include("connection_db.php");
    
    $query = "SELECT tbE.nombre, tbE.apellido, tbE.telefono, tbE.correo, tbE.direccion, tbR.nombre as ruta, tbA.Nplaca as auto FROM tbEmpleado as tbE INNER JOIN tbRuta as tbR ON tbE.rutaID = tbR.id INNER JOIN tbAuto as tbA ON tbE.autoID = tbA.id WHERE tbE.correo = ?";

    try { 
        $link=conexion();    
        $comando = $link->prepare($query);
        // Ejecutar sentencia preparada
        $comando->execute(array($correo));
        
        $rows_array = array();
        while($result = $comando->fetch(PDO::FETCH_ASSOC))
            {
                                   
                 $array [] = array('nombre' => $result['nombre'], 'apellido' => $result['apellido'], 'telefono' => $result['telefono'], 'correo' => $result['correo'], 'direccion' => $result['direccion'], 'ruta' => $result['ruta'], 'bus' => $result['auto']);
                
            }
            
            //array_map("utf8_encode", $array);
              header('Content-type: application/json; charset=utf-8');
              return print_r(json_encode($array), JSON_UNESCAPED_UNICODE);
             
    } catch (PDOException $e) {
        return false;
    }
    
}
    
//Metodo para modificar producto
public static function modificar_Productos($id, $nombre, $descripcion, $stock, $precio, $unidadM, $estado, $categoriaID){
    include("connection_db.php");
    $query = "UPDATE  tb_producto 
    SET nom_producto = ?, des_producto = ?, stock = ?, precio = ?, 
    unidad_de_medida = ?, estado_producto = ?, categoria = ? 
    WHERE id_producto = ?";
    try{    
      $link=conexion();    
      $comando = $link->prepare($query);
      $comando->execute(array($nombre, $descripcion, $stock, $precio, $unidadM, $estado, $categoriaID, $id));
      $count = $comando->rowCount();
    
      if($count > 0){
          return 1;
      }else{
          return 0;
      }
    } catch (PDOException $e) {
        return -1;
    }                        
}
    
    
    
    public static function getArticulosCodigo($codigo) {
        include("connection_db1.php");
        $query = "SELECT codigo,descripcion,precio from tb_articulos where codigo = ?";
    try {    
          $link=conexion();    
          $comando = $link->prepare($query);
          $comando->execute(array($codigo));
          $row = $comando->fetch(PDO::FETCH_ASSOC);
          return $row;

        } catch (PDOException $e) {
            // Aqui puedes clasificar el error dependiendo de la excepcion
            // para presentarlo en la respuesta Json
            return -1;
        }
  }
  
  
  public static function getArticulosDescripcion($desc) {
        include("connection_db1.php");
        $query = "SELECT codigo,descripcion,precio from tb_articulos where descripcion = ?";
    try {    
          $link=conexion();    
          $comando = $link->prepare($query);
          $comando->execute(array($desc));
          $row = $comando->fetch(PDO::FETCH_ASSOC);
          return $row;

        } catch (PDOException $e) {
            // Aqui puedes clasificar el error dependiendo de la excepcion
            // para presentarlo en la respuesta Json
            return -1;
        }
  }
  
  
  
   public static function getAllArticulos() {
        include("connection_db1.php");
        
        $query = "SELECT codigo,descripcion,precio FROM tb_articulos";

        try {
            $link=conexion();    
            $comando = $link->prepare($query);
            // Ejecutar sentencia preparada
            $comando->execute();
            
            $rows_array = array();
            while($result = $comando->fetch(PDO::FETCH_ASSOC))
                {
                    //$temp = array();
                    //$temp['codigo'] = $result['codigo'];
                    //$temp['descripcion'] = $result['descripcion'];
                    //$temp['precio'] = $result['precio'];
                                            
                     $array [] = array('codigo' => $result['codigo'], 'descripcion' => $result['descripcion'], 'precio' => $result['precio']);
                    
                    /*
                    $rows_array['codigo'] = $result['codigo'];
                    $rows_array['descripcion'] = $result['descripcion'];
                    $rows_array['precio'] = $result['precio'];
                    */
                }
                
                array_map("utf8_encode", $array);
  	            header('Content-type: application/json; charset=utf-8');
  	            return print_r(json_encode($array), JSON_UNESCAPED_UNICODE);
  	            
  	            
  	            //json_encode($datos, JSON_UNESCAPED_UNICODE);
                //return (var_dump($array));
                //return print_r($array);
        } catch (PDOException $e) {
            return false;
        }
        
    }
  
  
  
      //by Prof. Gamez.
      //Modificado por: Tec. Francisco Abarca
      //Fecha modificación: 15/10/2022 08:40 pm
}
?>