<?phpinclude("login/login_success.php");include("conex.php");$link = Conectarse();include("is_selected.php");?><html><head>	<meta charset="utf-8" />	<title>		Detalle de Orden	</title>	<link rel="stylesheet" type="text/css" href="css/layout.css" />	<link rel="stylesheet" type="text/css" href="css/layout.css"  media="print"/>		<link rel="stylesheet" type="text/css" href="css/redmond/jquery-ui-1.10.3.custom.css"  />	<link rel="stylesheet" type="text/css" href="tablecloth/tablecloth.css" media="screen" />	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"  />	<link rel="stylesheet" type="text/css" href="css/alertify.css"  />	<link rel="stylesheet" type="text/css" href="css/common.css"  />	<link rel="stylesheet" type="text/css" href="font_awesome/css/font-awesome.min.css"  />			<script type="text/javascript" src="js/jquery-1.9.1.js"></script>	<script type="text/javascript" src="js/jquery-ui-1.10.3.custom.js"></script>	<script type="text/javascript" src="js/jquery.ui.datepicker-es.js"></script>	<script type="text/javascript" src="js/header.js"></script>	<script type="text/javascript" src="js/bootstrap.min.js"></script>	<script type="text/javascript" src="js/alertify.min.js"></script>	<script type="text/javascript" src="js/detalle_orden.js"></script>	</head>	 <body><div class="container"><?php		include ("header.php");	include ("update_detalle_orden.php");?><?phpif($_GET["id_orden"]){		$id_orden = $_GET["id_orden"];		$q_orden="SELECT * FROM ordenes 	LEFT JOIN pacientes	ON ordenes.id_paciente = pacientes.id_paciente	LEFT JOIN doctores	ON ordenes.id_doctor = doctores.id_doctor	WHERE id_orden = '$id_orden'";		$result = mysql_query($q_orden, $link) or die("Error en: $q_orden".mysql_error());			$q_detalle="SELECT * FROM detalle_orden 	LEFT JOIN estudios	ON detalle_orden.id_estudio = estudios.id_estudio	WHERE id_orden = '$id_orden'";		$result_detalle = mysql_query($q_detalle, $link) or die("Error en: $q_detalle".mysql_error());		}?>		<?php		while($row = mysql_fetch_array($result)) {			setlocale(LC_ALL,"es_ES");			$fecha_entrega = date("d/m/Y", strtotime($row["fecha_entrega"])); 			$fecha_elabora = date("d/m/Y", strtotime($row["fecha_elabora"])); 			$hora_elabora = $row["hora_elabora"]; 			$estatus_actual = $row["estatus_actual"]; 			$sucursal = $row["sucursal"]; 			$enviar_consultorio = $row["enviar_consultorio"]; 			$elabora = $row["elabora"]; 			$nombre_doctor = $row["nombre_doctor"]; 			$nombre_paciente = $row["nombre_paciente"]; 			$sexo = $row["sexo"]; 			$edad = $row["edad"]; 			$tel_paciente = $row["telefono_paciente"]; 						$anticipo = $row["anticipo"];			$restante = $row["restante"];			$descuento = $row["descuento"];			$cancelada = $row["cancelada"];			$medio_pago = $row["medio_pago"];			$efectivo = $row["efectivo"];			$tarjeta = $row["tarjeta"];			$importe_total = $row["importe_total_orden"];			$recibo_honorarios = $row["recibo_honorarios"]; 		}					?> 	<?PHP if (mysql_num_rows($result) == 0){							echo "<div class='notfound'>";			echo "Orden $id_orden no ENCONTRADA, FAVOR DE VERIFICAR";						echo "</div>"; 			exit();	}?>				<div class="subtitulo">			Detalle de Orden: <?php echo $id_orden;?>			<input type="hidden" id="id_orden" value="<?php echo $id_orden;?>" >							</div>		<div class="row">				<?PHP if ($estatus_actual == "Cancelada"){							echo "<div class='col-sm-10 alert alert-danger'>";			echo "ESTA ORDEN ESTA CANCELADA";						echo "</div>"; 						}			else{?>				<div class="col-sm-offset-8 col-sm-4 btn-group">					<button type="button" id="btn_cancelar_orden" class="btn btn-danger " >						<i class="fa fa-ban"></i> Cancelar					</button>					<button type="button" id="btn_guardar" class="btn btn-success" >						<i class="fa fa-save"></i> Guardar					</button>					<?php					if($restante != 0){					?>											<button type="button" id="btn_liquidar" class="btn btn-warning" >							<i class="fa fa-dollar"></i> Liquidar						</button>										<?php					}					?>										<a href="imprimir_ticket.php?id_orden=<?php echo $id_orden;?>" id="btn_reimprimir" class="btn btn-primary " >						<i class="fa fa-print"></i> Reimprimir					</a>								</div>											<?PHP				}			?>															</div>					<?php				$q_detalle = "SELECT * FROM detalle_orden INNER JOIN estudios		ON detalle_orden.id_estudio = estudios.id_estudio		WHERE id_orden = '$id_orden'";				$result = mysql_query($q_detalle, $link) or die("Error en: $q_detalle".mysql_error());				?>	<div id="div_detalle_orden">		<?php 				$tipo_estudio = array();				while($row = mysql_fetch_array($result)) {			$tipo_estudio[] = $row["tipo_estudio"];					} 		?>	</div>	<form id="form_orden" >	<div id="div_datos_orden">		<table>						<tr>				<td>FECHA ELABORACION</td>				<td><?php echo $fecha_elabora;?></td>			</tr>			<tr>				<td>HORA</td>				<td><?php echo $hora_elabora; ?></td>			</tr>									<?php 			if(in_array("Estudio Completo", (array) $tipo_estudio)){?>				<tr>					<td>FECHA DE ENTREGA</td>					<td><?php echo $fecha_entrega;?></td>				</tr>				<tr>					<td>ESTATUS ACTUAL</td>					<td><?php echo $estatus_actual;?></td>				</tr>				<tr>					<td>PACIENTE</td>					<td><?php echo $nombre_paciente; ?></td>				</tr>				<tr>					<td>EDAD</td>					<td><?php echo $edad;?></td>				</tr>				<tr>					<td>SEXO</td>					<td><?php echo $sexo;?></td>				</tr>				<tr>					<td>TELEFONO</td>					<td><?php echo $tel_paciente;?></td>				</tr>						<?php			}						?>																<?php				if($recibo_honorarios){			?>							<tr>					<td>RECIBO DE HONORARIOS</td>					<td><?php echo $recibo_honorarios;?></td>				</tr>						<?php			}						?>			<tr>				<td>ELABORA</td>				<td><?php echo $elabora;?></td>			</tr>			<?php				if($nombre_doctor){			?>							<tr>					<td>DOCTOR</td>					<td><?php echo $nombre_doctor;?></td>				</tr>			<?php			}						?>			<tr>				<td>DETALLES</td>				<td><?php										$q_detalle = "SELECT * FROM detalle_orden INNER JOIN estudios					ON detalle_orden.id_estudio = estudios.id_estudio					WHERE id_orden = '$id_orden'";										$result_detalle = mysql_query($q_detalle, $link) or die("Error en: $q_detalle".mysql_error());										?>					<div id="div_detalle_orden">						<?php 						while($row = mysql_fetch_array($result_detalle)) {							$nombre_estudio = $row["tipo_estudio"]." ".$row["nombre_estudio"];							echo $nombre_estudio."<br>";						}						?>										</div>				</td>			</tr>			<tr>				<td>IMPORTE TOTAL</td>				<td><?php echo "$". number_format($importe_total, 2);?></td>			</tr>			<tr>				<td>ANTICIPO</td>				<td>					<?php echo "$". number_format($anticipo, 2);?>					<input type="hidden" id="anticipo" value="<?php echo $anticipo;?>" />									</td>			</tr>			<tr>				<td>RESTANTE</td>				<td><?php echo $restante;?></td>			</tr>			<tr>				<td>MEDIO DE PAGO</td>				<td>					<select name="medio_pago" id="medio_pago">						<option value="Efectivo" <?php if($medio_pago == "Efectivo"){ echo "selected";}?>>Efectivo</option>						<option value="Tarjeta" <?php if($medio_pago == "Tarjeta"){ echo "selected";}?>>Tarjeta</option>						<option value="Mixto" <?php if($medio_pago == "Mixto"){ echo "selected";}?>>Mixto</option>										</select>				</td>			</tr>						<?php				if($medio_pago == "Mixto"){			?>				<tr>					<td>Efectivo</td>					<td><?php echo $efectivo;?></td>				</tr>				<tr>					<td>Tarjeta</td>					<td><?php echo $tarjeta;?></td>				</tr>			<?php			}			?><?php				if($descuento){			?>				<tr>					<td>DESCUENTO</td>					<td><?php echo $descuento;?></td>				</tr>			<?php			}			?>					</table>	</div>	</form>								<?php				if(in_array("Estudio Completo", $tipo_estudio)){									$q_historial = "SELECT * FROM historial_ordenes WHERE id_orden = '$id_orden'";						$result = mysql_query($q_historial, $link) or die("Error en: $q_historial".mysql_error());						?>			<div id="div_historial_orden">				<table>					<tr>						<th>Fecha</th>						<th>Hora</th>						<th>Estatus</th>						<th>Observaciones</th>					</tr>					<?php					while($row = mysql_fetch_array($result)) {						$id_historial = $row["id_historial"];						$fecha_historial = date("d/M/Y", strtotime($row["fecha_hist"])); ;						$hora_historial = $row["hora_hist"];						$estatus = $row["estatus"];						$observaciones = $row["observaciones"];						?>						<tr>							<td><?php  echo $fecha_historial;?></td>							<td><?php  echo $hora_historial ;?></td>							<td><?php  echo $estatus;?></td>							<td><?php  echo $observaciones;?></td>											</tr>				<?php				}				?>			</table>		</div>		<?php		}		?></div><div id="modal_mixto" class="modal fade" role="dialog">  <div class="modal-dialog">    <!-- Modal content-->    <div class="modal-content">      <div class="modal-header">        <button type="button" class="close" data-dismiss="modal">&times;</button>        <h4 class="modal-title">Escribe cantidades</h4>      </div>      <div class="modal-body">		  <div class="row">				<div class="col-sm-4">					<label class="form-control-label">Restante</label>					<input type="text" name="restante" id="restante" class="form-control" readonly value="<?php echo $restante;?>"> 				</div>				<div class="col-sm-4">					<label class="form-control-label">Efectivo</label>					<input type="text" name="efectivo" id="efectivo" class="form-control">								</div>				<div class="col-sm-4">					<label for="tarjeta" class="form-control-label">Tarjeta</label>					<input type="text" name="tarjeta" id="tarjeta" class="form-control">				</div>		  </div>      </div>      <div class="modal-footer">        <button type="button" id="btn_guardar_pago"  class="btn btn-success" >			OK <i class="fa fa-spin fa-spinner"></i>		</button>        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>      </div>    </div>  </div></div></body></html>  