<?php
header("Content-Type: application/json");
include ("conex.php");
$db = Conectarse();
$arr_json = Array();
$str_pairs = "";

$table = $_GET["table"];
$arr_pairs = $_GET["fields_value"];
if(isset( $_GET["mensaje_ok"])){
	
	$mensaje_ok = $_GET["mensaje_ok"];
}
else{
	$mensaje_ok = "Guardado Correctamente";
	
}
foreach($arr_pairs as $arr_field_value){
	$str_pairs.= $arr_field_value["field"]. " = " . $arr_field_value["value"] . ",";
	
}

$str_pairs  = trim($str_pairs, ",");

$insert =
"INSERT INTO $table SET $str_pairs		";
		
$exec_query = 	mysql_query($insert,$db);	

$actualizadas = mysql_affected_rows();
if( $actualizadas == 0){
	$arr_json["estatus"] = "error";
	$arr_json["mensaje"] = "$id_field no encontrada";	
}

if($exec_query){
	$arr_json["estatus"] = "success";
	$arr_json["mensaje"] = $mensaje_ok;
	$arr_json["query"] = "$insert";
}	
else{
	$arr_json["errno"] = mysql_errno();
	$arr_json["estatus"] = "error";
	$arr_json["mensaje"] = "Error en insert: $insert  ".mysql_error();		
}

echo json_encode($arr_json);
?>