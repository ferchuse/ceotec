<?php
header("Content-Type : application/json");
include ("conex.php");
$db = Conectarse();
$arr_json = Array();


$table = $_GET["table"];
$arr_pairs = $_GET["fields_value"];
$value = $_GET["value"];
$id_field = $_GET["id_field"];
$id_value = $_GET["id_value"];



foreach($arr_pairs as $arr_field_value){
	$str_pairs.= $arr_field_value["field"]. " = '" . $arr_field_value["value"] . "',";
	
}

$str_pairs  = trim($str_pairs, ",");

$update =
"UPDATE $table SET $str_pairs
		WHERE $id_field = '$id_value'
		";
		
$exec_query = 	mysql_query($update,$db);	

$actualizadas = mysql_affected_rows();
if( $actualizadas == 0){
	$arr_json["estatus"] = "error";
	$arr_json["mensaje"] = "$id_field no encontrada";	
}

if($exec_query){
	$arr_json["estatus"] = "success";
	$arr_json["mensaje"] = "$field Actualizado";
	$arr_json["query"] = "$update";
}	
else{
	$arr_json["estatus"] = "error";
	$arr_json["mensaje"] = "Error en update: $update  ".mysql_error();		
}

echo json_encode($arr_json);
?>