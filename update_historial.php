<?php



//v1.1 02-dic

	if(isset($_POST["guardar"])){

		

		$planta =$_POST["planta"];

		$planta =$_POST["planta"];

		$area =$_POST["area"];

		$movimiento = $_POST["movimiento"];

		$importe = $_POST["importe"];

		$concepto = mb_strtoupper($_POST["concepto"], 'UTF-8');

		$cajero = $_SESSION["nombre_usuario"];

		$detalles = $_POST["detalles"];

		$id_comp = $_POST["id_comp"];

		$q_saldo_actual = "SELECT SALDO_ACTUAL 

		FROM CAJA_CHICA WHERE PLANTA = '$planta'";

		

		$result_saldo_actual = mysql_query($q_saldo_actual, $link) 

		or die("Error al ejecutar consulta $q_saldo_actual ".mysql_error());

		

		while($row = mysql_fetch_assoc($result_saldo_actual)){

			$saldo_actual = $row["SALDO_ACTUAL"];

			

		}

		

		if(!isset($saldo_actual)){ 

			$saldo_actual = 0;

		}

		

		$saldo_nuevo = $saldo_actual;

		$entrega = mb_strtoupper($_POST["entrega"], 'UTF-8');

		$solicita = $entrega;

		$vale = $_POST["vale"];

		$sobrante = $_POST["sobrante"];

		$iva = $_POST["iva"];

		$comprobante = $_POST["select_comprobante"];

		$proveedor = $_POST["proveedor"];

		$concepto = $_POST["concepto"];

		$folio_comp = $_POST["txt_folio_comp"];

		if (isset($_POST["eco"])){

			$eco = $_POST["eco"];

			

		}

		else{

			

			$eco = null;

		}

		if(isset($_POST["mod_file"])){

			$nombre_archivo=$_FILES["uploadedfile"]["name"];

			//echo $nombre_archivo."<br>";

			if($nombre_archivo!=""){

				$target_path = "comprobantes/";

				$target_path = $target_path.basename($_FILES['uploadedfile']['name']); 

				

				if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {

					//echo "El archivo ".basename( $_FILES['uploadedfile']['name']). 

					//"  ha sido cargado correctamente <br>";

				} else{

					echo "Hubo un errror al cargar el Archivo, Por favor inténtelo de nuevo!";

				}

				$url=$target_path;

			}

			else{

				$url ='';

			}

			

		}else{

			$url = $_POST["url_ant"];

		}

		

			$update="UPDATE  COMPROBANTES 

			SET IMPORTE = '$importe', PLANTA = '$planta', 

			AREA = '$area', ENTREGA = '$entrega', FECHA = CURDATE(), 

			VALE = '$vale', IVA='$iva', HORA = CURTIME(), COMPROBANTE = '$comprobante',

			PROVEEDOR = '$proveedor', FOLIO_COMP = '$folio_comp', DETALLE = '$detalles', URL = '$url',CONCEPTO = '$concepto', ECO = '$eco' WHERE ID_COMP = '$id_comp'";

			

			mysql_query($update) or die("Error: $update " . mysql_error());

			

			

			$update_hist="UPDATE HISTORIAL_CAJA_CHICA 

			SET HORA = CURTIME(), FECHA = CURDATE(), PLANTA = '$planta',

			MOVIMIENTO = '$movimiento', SALDO = '$saldo_nuevo', 

			IMPORTE = '$importe', RECIBE = '$solicita',

			CONCEPTO = '$concepto', DETALLE = '$detalles' WHERE FOLIO_COMP = '$id_comp'

			AND MOVIMIENTO = 'COMPROBANTE'";

			

			mysql_query($update_hist) or die("Error: $update_hist " . mysql_error());

			

			/* if(isset($_POST["chk_sobrante"])){

				

				$deposita_sobrante = "UPDATE RETIROS SET DEPOSITA_SOBRANTE = 1 WHERE VALE = '$vale'";

				mysql_query($deposita_sobrante) or die("Error: $insert_hist " . mysql_error());				

				

				if ($sobrante > 0){// Faltante se realiza deposito

					$saldo_nuevo = $saldo_actual + $sobrante;

					$concepto_extra = "SOBRANTE COMPROBADO" ;

					

					$insert_extra="INSERT INTO DEPOSITOS 

					SET IMPORTE = '$sobrante', CONCEPTO = '$concepto_extra', PLANTA = '$planta',

					SALDO = '$saldo_nuevo', CAJERO = '$cajero', 

					ENTREGA = '$solicita', FECHA = CURDATE(), HORA_DEP = CURTIME()";

					

					mysql_query($insert_extra) or die("Error: $insert_extra " . mysql_error());

					

					//$folio_caja = mysql_insert_id();

					

					$insert_hist="INSERT INTO HISTORIAL_CAJA_CHICA 

					SET HORA = CURTIME(), FECHA = CURDATE(), PLANTA = '$planta',

					MOVIMIENTO = 'DEPOSITO', SALDO = '$saldo_nuevo', 

					FOLIO_HIST = LAST_INSERT_ID(), IMPORTE = '$sobrante', RECIBE = '$solicita',

					CONCEPTO = '$concepto_extra'";

					

					mysql_query($insert_hist) or die("Error: $insert_hist " . mysql_error());

					

					$update_saldo="UPDATE CAJA_CHICA 

					SET SALDO_ACTUAL = '$saldo_nuevo'

					WHERE PLANTA = '$planta'";

					

					mysql_query($update_saldo) or die("Error: $update_saldo " . mysql_error());

					

					$insert_mov="INSERT INTO COMPROBANTES 

					SET IMPORTE = '$sobrante', PLANTA = '$planta', 

					AREA = '$area', ENTREGA = '$entrega', FECHA = CURDATE(),

					VALE = '$vale', HORA = CURTIME(), COMPROBANTE = 'NOTA',

					FOLIO_COMP = '$folio_comp',

					CONCEPTO = '$concepto' ";

					

					mysql_query($insert_mov) or die("Error: $insert_mov " . mysql_error());

					

					$folio_caja = mysql_insert_id();

					

					$insert_hist="INSERT INTO HISTORIAL_CAJA_CHICA

					SET HORA = CURTIME(), FECHA = CURDATE(), PLANTA = '$planta',

					MOVIMIENTO = 'COMPROBANTE', SALDO = '$saldo_nuevo', 

					FOLIO_HIST = LAST_INSERT_ID(), IMPORTE = '$sobrante', RECIBE = '$solicita',

					CONCEPTO = '$concepto_extra'";

					

					mysql_query($insert_hist) or die("Error: $insert_hist " . mysql_error());

					

					

					

				}else if($sobrante < 0){ // A favor se realiza retiro

					

					$concepto_extra = "FALTANTE COMPROBADO" ;

					$saldo_nuevo = $saldo_actual - $sobrante;

					if ($saldo_nuevo < 0){

						die("Saldo insuficiente para realizar retiro");	

					}

					$sobrante = abs($sobrante);

					$insert_extra="INSERT INTO RETIROS 

					SET IMPORTE = '$sobrante', CONCEPTO = '$concepto_extra', PLANTA = '$planta',

					SALDO = '$saldo_nuevo', CAJERO = '$cajero', 

					RECIBE = '$solicita', FECHA_MOV = CURDATE(), HORA_RET = CURTIME()";

					

					mysql_query($insert_extra) or die("Error: $insert_extra " . mysql_error());

			

					$folio_caja = mysql_insert_id();

						

					$insert_hist="INSERT INTO HISTORIAL_CAJA_CHICA 

						SET HORA = CURTIME(), FECHA = CURDATE(), PLANTA = '$planta',

						MOVIMIENTO = 'RETIRO', SALDO = '$saldo_nuevo', 

						FOLIO_HIST = LAST_INSERT_ID(), IMPORTE = '$sobrante', 

						RECIBE = '$solicita', CONCEPTO = '$concepto_extra'";

						

					mysql_query($insert_hist) or die("Error: $insert_hist " . mysql_error());

					

					$update_saldo="UPDATE CAJA_CHICA 

							SET SALDO_ACTUAL = '$saldo_nuevo'

							WHERE PLANTA = '$planta'";

					

					mysql_query($update_saldo) or die("Error: $update_saldo " . mysql_error());

					

					$insert_mov="INSERT INTO COMPROBANTES 

					SET IMPORTE = '$sobrante', PLANTA = '$planta', 

					AREA = '$area', ENTREGA = '$entrega', FECHA = CURDATE(),

					VALE = '$vale', HORA = CURTIME(), COMPROBANTE = 'NOTA',

					FOLIO_COMP = '$folio_comp',

					CONCEPTO = '$concepto' ";

					

					mysql_query($insert_mov) or die("Error: $insert_mov " . mysql_error());

					

					$folio_caja = mysql_insert_id();

					

					$insert_hist="INSERT INTO HISTORIAL_CAJA_CHICA

					SET HORA = CURTIME(), FECHA = CURDATE(), PLANTA = '$planta',

					MOVIMIENTO = 'COMPROBANTE', SALDO = '$saldo_nuevo', 

					FOLIO_HIST = LAST_INSERT_ID(), IMPORTE = '$sobrante', RECIBE = '$solicita',

					CONCEPTO = '$concepto_extra'";

					

					mysql_query($insert_hist) or die("Error: $insert_hist " . mysql_error());

					

				}

			}

		

			 */  

		//$num_orden = mysql_insert_id();

		

		echo "<div class='mensaje'>";

		echo "1 Registro Modificado Correctamente";

		echo "</div>";

		

	}		

?>

	



