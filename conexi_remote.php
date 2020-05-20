<?php
	
	
	function conectar_remote()
	{
		
		$host="www.ceo-tec.com";
		$db="ceotec_estudios";
		$usuario="ceotec_sistemas"; 
		$pass="Glifom3dia";
		
		
		$set_local = "SET time_zone = '-05:00'";
		$set_names = "SET NAMES 'utf8'";
		date_default_timezone_set('America/Mexico_City');
		
		$db_response = array();
		
		$link = mysqli_connect($host,$usuario,$pass);
		
		if (!$link)
		{
			$db_response["status"] = "error" ;
			$db_response["errno"] = mysqli_errno($link) ;
			$db_response["err_msj"] = mysqli_error($link) ;
			$db_response["mensaje"] = "Error conectando a la base de datos" ;
			
		}
		
		elseif (!mysqli_select_db($link, $db))
		{
			$db_response["status"] = "error" ;
			$db_response["errno"] = mysqli_errno($link) ;
			$db_response["err_msj"] = mysqli_error($link) ;
			$db_response["mensaje"] = "Error seleccionando la base de datos." ;
		} 
		
		elseif (!mysqli_query($link,$set_local))	
		{
			$db_response["status"] = "error" ;
			$db_response["errno"] = mysqli_errno($link) ;
			$db_response["err_msj"] = mysqli_error($link) ;
			$db_response["mensaje"] = "Error cambiando TimeZone" ;
		}
		else{
	    $db_response["status"] = "ok";
			$db_response["mensaje"] = "Conexion Remota Exitosa";
			
		}
		
		//return json_encode($db_response);
		
		return $link;
		
		
	}
	
?>

