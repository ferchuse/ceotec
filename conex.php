<?php
function Conectarse()
{
	$host="localhost";
	$db="ceotec";
	$usuario="root";
	$pass="";
	$set_local = "SET time_zone = '-06:00'";
	$set_names = "SET NAMES 'utf8'";
	date_default_timezone_set('America/Mexico_City');
	
   if (!($link=mysql_connect($host,$usuario,$pass)))
   {
     die( "Error conectando a la base de datos.". mysql_error());
   }
   
   if (!mysql_select_db($db,$link))
   {
		die( "Error seleccionando la base de datos.". mysql_error());
   }
   
   if (!mysql_query($set_local, $link))	
   {
		die( "Error cambiando TimeZone.". mysql_error());
   }
   
	mysql_query("SET NAMES 'utf8'") or die("Error Cambiando charset").mysql_error();
	
	setlocale(LC_ALL,"es_ES");
	mysql_query("SET CHARACTER SET utf8") or die("Error en charset UTF8".MYSQL_ERROR());
	
   
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
  
   return $link;
}
?>