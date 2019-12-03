<?php
header("Content-Type: application/json");
include("conexi.php");
include("conexi_remote.php");

$link_remote = conectar_remote();
$link_local = Conectarse();

$respuesta= array();
$modificados_remote = array();
$modificados_local = array();
$tabla = $_GET["tabla"];
$id_field = $_GET["id_field"];

$q_modificados = "SELECT * FROM $tabla 
	WHERE is_mod = 1";

$respuesta["q_modificados"] = $q_modificados; 
	
	
	
//Busca los que se modificarlos remotamente y actualiza local
	
$result_modificados_remote= mysqli_query($link_remote, $q_modificados);
$count_modificados_remote = mysqli_num_rows($result_modificados_remote);

if($result_modificados_remote){
	if($count_modificados_remote > 0){
		while($row = mysqli_fetch_assoc($result_modificados_remote)){
			$modificados_remote[] = $row;
		}
		$respuesta["mensaje_modificados_remote"] = $count_modificados_remote. " por actualizar"; 
	}
	else{
		$respuesta["mensaje_modificados_remote"] = "No hay $tabla que sincronizar";
	}
	$respuesta["cant_modificadas_remote"] = sizeof($modificados_remote);
}
else{
	$respuesta["estatus_buscar_archivados"] = "error";
	$respuesta["mensaje_buscar_archivados"] = "Error en : $q_modificados ".mysqli_error($link_remote);
}


if($count_modificados_remote > 0){
		//$campos = 0;
		$cant_modificadas_local = 0;
		foreach($modificados_remote as $index => $fila){
			
			$str_pairs = '';
			
			foreach($fila as $key => $value){
				if($key != "is_mod"){
					$str_pairs.=  $key. " = '" . $value . "',";
				
				}
			}
			 
			$str_pairs  = trim($str_pairs, ",");

			$q_modificado_local = "UPDATE $tabla SET " .$str_pairs
				." WHERE $id_field  = '".$fila[$id_field]."'" ;
			
		
			if(mysqli_query($link_local, $q_modificado_local)){
				
				$respuesta["archivar_doctor_estatus"] = "success";
				$cant_modificadas_local++;
				
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
///////////////////////////////////LOCAL TO SERVER
 
//Busca los que se modificarlos localmente y los sube al servidor remoto

$result_modificados_local= mysqli_query($link_local, $q_modificados);
$count_modificados_local = mysqli_num_rows($result_modificados_local);

if($result_modificados_local){
	if($count_modificados_local > 0){
		while($row = mysqli_fetch_assoc($result_modificados_local)){
			$modificados_local[] = $row;
		}
		$respuesta["mensaje_modificados_local"] = $count_modificados_local. " por actualizar"; 
	}
	else{
		$respuesta["mensaje_modificados_local"] = "No hay $tabla que sincronizar";
	}
	$respuesta["cant_modificadas_local"] = sizeof($modificados_local);
}
else{
	$respuesta["estatus_buscar_local"] = "error";
	$respuesta["mensaje_buscar_local"] = "Error en : $q_modificados ".mysqli_error($link_local);
}




//Si hay modificados localmente los actualiza remotamente

if($count_modificados_local > 0){
		
		$cant_modificadas_remote = 0;
		foreach($modificados_local as $index => $fila){
			
			$str_pairs = '';
			
			foreach($fila as $key => $value){
				if($key != "is_mod"){
					$str_pairs.=  $key. " = '" . $value . "',";
				
				}
			}
			 
			$str_pairs  = trim($str_pairs, ",");

			$update_remote = "UPDATE $tabla SET " .$str_pairs
				." WHERE $id_field  = '".$fila[$id_field]."'" ;
		
			if(mysqli_query($link_remote, $update_remote)){
				
				$respuesta["archivar_doctor_estatus"] = "success";
				$cant_modificadas_remote++;
							
			}
			else{
				$respuesta["archivar_doctor_estatus"] = "error";
				$respuesta["archivar_doctor_mensaje"] = "Error en : ". $update_remote. mysqli_error($link_remote);
 
			}
		}
			$respuesta["cant_modificadas_remote"] = $cant_modificadas_remote;
		
			
		//Modifica las filas locales para no volver a sincronizarlas	
		if($respuesta["cant_modificadas_local"] == $respuesta["cant_modificadas_remote"]){
			$update_correctas = "UPDATE $tabla SET is_mod = 0 WHERE is_mod = 1";
			
			if(mysqli_query($link_local, $update_correctas)){
				$respuesta["estatus_update_correctas"] = "success";
				$respuesta["cant_update_correctas"] = mysqli_affected_rows($link_local);
				$respuesta["mensaje_update_correctas"] = mysqli_affected_rows($link_local);

			}
			else{
				$respuesta["estatus_update_correctas"] = "error";
				$respuesta["mensaje_update_correctas"] = "Error en : ". $update_correctas. mysqli_error($link_local);

			}
		}
} 
	
mysqli_close($link_local);
mysqli_close($link_remote);

	
echo json_encode($respuesta);

?>