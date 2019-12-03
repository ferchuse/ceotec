<?php
header("Content-Type: application/json");
include ("conex.php");
$db = Conectarse();
$response = Array();


$table = $_GET["table"];
$id_field = $_GET["id_field"];
$id_value = $_GET["id_value"];
$mensaje_success = $_GET["mensaje_success"];

$delete_query =
"DELETE FROM $table
		WHERE $id_field = '$id_value'";


$exec_query = 	mysql_query($delete_query,$db);	



if($exec_query){
	$response["estatus"] = "success";
	$response["mensaje"] = "$mensaje_success";
}	
else{
	$response["estatus"] = "error";
	$response["mensaje"] = "Error en: $delete_query  ".mysql_error();		
}

echo json_encode($response);
?>