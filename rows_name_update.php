<?php
header("Content-Type: application/json");
include ("conex.php");
$db = Conectarse();
$response = Array();


$table = $_POST["table"];
$arr_pairs = $_POST["fields_value"];
$value = $_POST["value"];
$id_field = $_POST["id_field"]; 
$id_value = $_POST["id_value"];
$str_pairs="";

//crea un string con los campos y sus valores
foreach($arr_pairs as $arr_field_value){
	
	$str_pairs.= $arr_field_value["name"]. " = '" . $arr_field_value["value"] . "',";
	
}

$str_pairs  = trim($str_pairs, ",");

$update ="UPDATE $table SET $str_pairs";

if($table == "doctores"){
	session_start();
	
	$update.=" , fecha_mod = NOW(), id_usuario_mod = ". $_SESSION["id_usuario"];
	
}
$update.=	" WHERE $id_field = '$id_value'		";
		
$exec_query = 	mysql_query($update,$db);	

$actualizadas = mysql_affected_rows();

$response["query"] = "$update";

if( $actualizadas == 0){
	$response["estatus"] = "error";
	$response["mensaje"] = "$id_field no encontrada";	
}

if($exec_query){
	$response["estatus"] = "success";
	$response["mensaje"] = "Actualizado";
	
}	
else{
	$response["estatus"] = "error";
	$response["mensaje"] = "Error en update:  ";		
	$response["error"] =  mysql_error();		
}
$response["query"] = "$update";

echo json_encode($response);
?>