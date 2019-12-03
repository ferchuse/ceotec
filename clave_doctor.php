<?php

if(isset($_GET["get_clave"])){
	header('Content-Type: application/json');
	include("conex.php");
	$link = Conectarse();
	$nombre_doctor = $_GET["nombre_doctor"];
	$response = array();
	
	$response["clave_doctor"] = clave_doctor($nombre_doctor, $link);
	
	echo json_encode($response);
}

function clave_doctor($nombre_doctor, $link){
	//include("conex.php");
	//$link = Conectarse();

	$partes = explode(" ", $nombre_doctor);
	$tamaño = sizeof($partes);

	$q_last_id = "SELECT COUNT(id_doctor) AS last_id FROM doctores";

	$result_last_id = mysql_query($q_last_id,$link) or die("Error al buscar id: $q_last_id ".mysql_error());

	while($row = mysql_fetch_assoc($result_last_id)){	
			$last_id = $row["last_id"];
			$last_id++;
			
	}

	if($tamaño == 3){
	
		$pn =  $partes[0];
		$app =  $partes[1];
		$apm =  $partes[2];
		
		$clave= $pn[0].$app[0].$apm[0].$last_id;
	}
	else{
		$pn =  $partes[0];
		$sn =  $partes[1];
		$app =  $partes[2];
		$apm =  $partes[3];
		
		$clave= $pn[0].$sn[0].$app[0].$apm[0].$last_id;
	}
	
	return $clave; 
	
}
?>