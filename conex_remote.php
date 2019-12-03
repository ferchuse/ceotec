<?php


function Conectarse()
{
	
	$host="www.ceo-tec.com";
	$db="ceotec_estudios";
	$usuario="ceotec_sistemas"; 
	$pass="Glifom3dia";

	
	$set_local = "SET time_zone = '-05:00'";
	$set_names = "SET NAMES 'utf8'";
	date_default_timezone_set('America/Mexico_City');
	
	$db_response = array();
	
   if (!($link=@mysql_connect($host,$usuario,$pass)))
   {
		$db_response["status"] = "error" ;
		$db_response["errno"] = mysql_errno() ;
		$db_response["err_msj"] = mysql_error() ;
		$db_response["mensaje"] = "Error conectando a la base de datos" ;
	  
   }
   
   elseif (!mysql_select_db($db,$link))
   {
		$db_response["status"] = "error" ;
		$db_response["errno"] = mysql_errno() ;
		$db_response["err_msj"] = mysql_error() ;
		$db_response["mensaje"] = "Error seleccionando la base de datos." ;
   } 
   
	elseif (!mysql_query($set_local, $link))	
   {
		$db_response["status"] = "error" ;
		$db_response["errno"] = mysql_errno() ;
		$db_response["err_msj"] = mysql_error() ;
		$db_response["mensaje"] = "Error cambiando TimeZone" ;
   }
   else{
	    $db_response["status"] = "ok";
		$db_response["mensaje"] = "Conexion Remota Exitosa";
	   
   }
   
   return json_encode($db_response);
   
  
  
	//mysql_query("SET NAMES 'utf8'") or die("Error Cambiando charset");
	//setlocale(LC_ALL,"es_ES");
	
	
	
	
	//mysql_query("SET CHARACTER SET utf8") or die("Error en charset UTF8".MYSQL_ERROR());
	
   
   //ACTIVAR SI LA BASE DE DATOS NO ESTA EN UTF-8
	//mysql_query($set_names, $link) or die( "Error cambiando Charset". mysql_error());
	// mysql_query ("set character_set_client='utf8'"); 
	// mysql_query ("set character_set_results='utf8'"); 
	// mysql_query ("set collation_connection='utf8_general_ci'");
	// mysql_query("SET NAMES 'utf8'");
	/* mysql_query("SET CHARACTER SET utf8") or die(MYSQL_ERROR());
	mysql_query("SET SESSION collation_connection = 'utf8_unicode_ci'");
	mysql_set_charset('utf8', $link) or die(MYSQL_ERROR());
	 */
	
}


//$link = Conectarse();
?>

<?php 
function conexion_remota(){

	$hostname='tu.servidor.remoto'; 
	$username='tu_usuario_remoto'; 
	$password='tu_password_remoto'; 
	 
	$hostname2='localhost'; //puede ser reemplazado por el nombre de tu servidor local si fuera otro nombre
	$username2='tu_usuario_local'; 
	$password2='tu_password_local'; 
	 
	$dbname='tu_base_de_datos'; 
	#Para efectos del ejemplo supondremos que es la misma base de datos en ambas bases de datos tanto la remota como la local 
	 
	$conex_remota = @mysql_connect($hostname,$username, $password); 
	#notese el @ antes del comando mysql_connect para evitar que arroje mensaje de error de PHP 
	 
	if (!($conex_remota)) { 
		$conex_local = @mysql_connect($hostname2,$username2, $password2) OR DIE ('No puedo conectarme a la base de datos local! Intentelo nuevamente.'); 
	} 
	mysql_select_db($dbname); 
}

?>