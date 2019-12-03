<?php
header("Content-Type: application/json");
include("conexi.php");
include("conexi_remote.php");

$link_remote = conectar_remote();
$link_local = Conectarse();

$respuesta= array();
$modificados_remote = array();
$tabla = $_GET["tabla"];

$q_modificados = "SELECT * FROM $tabla 
	WHERE is_mod = 1";

$result_modificados= mysqli_query($link_remote, $q_modificados);
$count_modificados = mysqli_num_rows($result_modificados);

if($result_modificados){
	if($count_modificados > 0){
		while($row = mysqli_fetch_assoc($result_modificados)){
			$modificados_remote[] = $row;
		}
		$respuesta["mensaje_modificados_remote"] = $count_modificados. " por actualizar"; 
	}
	else{
		$respuesta["mensaje_modificados_remote"] = "No hay ordenes que sincronizar";
	}
	//$respuesta["modificados_remote"] =$modificados_remote;
	$respuesta["cant_modificadas_remote"] = sizeof($modificados_remote);
}
else{
	$respuesta["estatus_buscar_archivados"] = "error";
	$respuesta["mensaje_buscar_archivados"] = "Error en : $q_modificados ".mysqli_error($link_remote);
}
//$string_archivados = "'". implode("','", $archivados_remote)."'";

//$respuesta["string_archivados"]  = $string_archivados;

if($count_modificados > 0){
		//$campos = 0;
		$cant_modificadas_local = 0;
		foreach($modificados_remote as $index => $fila){
			
			$str_pairs = '';
			
			foreach($fila as $key => $value){
			
				$str_pairs.=  $key. " = '" . $value . "',";
				
			}
			
			$str_pairs  = trim($str_pairs, ",");

			$q_modificado_local = "UPDATE $tabla SET " .$str_pairs
				." WHERE id_orden  = '".$fila["id_orden"]."'" ;
			
			//$respuesta["campos"] = $campos;
			//$respuesta["querys"][] = addslashes($q_modificado_local);
			//$respuesta["querys"][] = $q_modificado_local;
			//$respuesta["str_pairs"][] = $str_pairs;
			//$respuesta["filas"][] = $fila;
			
			if(mysqli_query($link_local, $q_modificado_local)){
				
				$respuesta["archivar_doctor_estatus"] = "success";
				$cant_modificadas_local++;
				//$respuesta["archivar_doctor_mensaje"] = "Ordenes Actualizadas Correctamante";
				//$respuesta["archivar_doctores"] = $archivar_doctores ;
				
			}
			else{
				$respuesta["archivar_doctor_estatus"] = "error";
				$respuesta["archivar_doctor_mensaje"] = "Error en : ". $q_modificado_local. mysqli_error($link_local);

			}
		}
			$respuesta["cant_modificadas_local"] = $cant_modificadas_local;
			//$respuesta[""] = mysqli_affected_rows($link_local);
			
			
		//Modifica las filas remotas para no volver a sincronizarlas	
		if($respuesta["cant_modificadas_local"] == $respuesta["cant_modificadas_remote"]){
			$q_sincronizados = "UPDATE $tabla SET is_mod = 0 WHERE is_mod = 1";
			if(mysqli_query($link_remote, $q_sincronizados)){
				$respuesta["estatus_sync"] = "success";
				$respuesta["cant_sync"] = mysqli_affected_rows($link_remote);

			}
			else{
				$respuesta["cant_sync"] = "error";
				$respuesta["mensaje_sync"] = "Error en : ". $q_sincronizados. mysqli_error($link_remote);

			}
		}
}	 

mysqli_close($link_local);
mysqli_close($link_remote);
	
			 
echo json_encode($respuesta);
	//var_dump($respuesta);
	//echo "<br>";
	//echo $respuesta["querys"][0]
?>