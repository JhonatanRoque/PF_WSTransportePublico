<?php
function conexion(){
	$conn = null;
	$host = 'localhost';
	$db = 'u701462728_transportFast';
	$user = 'u701462728_root';
	$pwd = 'Jona1.than9';
	
try{
	$conn = new PDO('mysql:host='.$host.'; dbname='.$db,$user,$pwd,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));  //Me pase a esta conexión por problemas de acentos, letra ñ y otros.
	
    echo "Conexion hecha...";
}catch(PDOException $e){
	echo "<center><h2 style='color:green'>Error al tratar de conectar a la BD.";
	echo " consulte al soporte Técnico</h2></center>";
	exit();
}
	return $conn;
}

 conexion();
 	//by Tec. Wilson
    //Modificado por: Tec. Francisco Abarca
    //Fecha modificación: 07/11/2022 --:-- pm

?>