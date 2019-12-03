<?php
	include "login/login_success.php";
	include ("conex.php");
	include ("is_selected.php");
	$link = Conectarse();
	$cur_year = date("Y");
?>
<html>
	<head>
		<meta charset="utf-8" />
		<link rel="shortcut icon" href="favicon.ico" />
		<title>
			Seguimiento de Ordenes
		</title>
		<link rel="stylesheet" type="text/css" href="css/layout.css" />
		<link rel="stylesheet" type="text/css" href="css/layout.css"  media="print"/>	
		<link rel="stylesheet" type="text/css" href="css/redmond/jquery-ui-1.10.3.custom.css"  />
		<link rel="stylesheet" type="text/css" href="tablecloth/tablecloth.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"  />
		<link rel="stylesheet" type="text/css" href="css/alertify.css"  />
		<link rel="stylesheet" type="text/css" href="font_awesome/css/font-awesome.min.css"  />

		<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
		<script type="text/javascript" src="js/jquery-ui-1.10.3.custom.js"></script>
		<script type="text/javascript" src="js/jquery.ui.datepicker-es.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/alertify.min.js"></script>
		<script type="text/javascript" src="js/ordenes_activas.js"></script>
		
	
	</head>
	
	<body>
	<div class="container"> 
	<?php
		
		include ("header.php");
		
	?>
	
	
		<form id="frm_reporte" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" accept-charset="UTF-8"  >		
		
		<div class="row" >
			
			<h3>
			
			Ordenes Activas
			</h3>
			
		</div>
		<hr>
		<div class="row">
			<div class="col-sm-offset-10 col-sm-1">
				<button class = "btn btn-primary" onclick="javascript:window.print();" >
					<i class="fa fa-print"></i>IMPRIMIR
				</button>
					
			</div>
		</div>
		<table border=1 >
					
					<th>!</th>
					<th>FOLIO</th>
					<th>FECHA ENTREGA</th>
					<th>FECHA ELABORACION</th>
					<th>PACIENTE</th>
					<th>ESTUDIO</th>
					<th>DOCTOR</th>
					<th>SUCURSAL</th>
					<th>ESTATUS ACTUAL	<i class="fa fa-spinner fa-spin hide"></i></th>
					<th>OBSERVACIONES</th>
					
				<?php 
					$q_ordenes = "SELECT * FROM ordenes LEFT JOIN doctores 
					ON ordenes.id_doctor = doctores.id_doctor
					LEFT JOIN pacientes 
					ON ordenes.id_paciente = pacientes.id_paciente
					LEFT JOIN detalle_orden
					ON detalle_orden.id_orden = ordenes.id_orden
					LEFT JOIN estudios 
					ON detalle_orden.id_estudio = estudios.id_estudio
					WHERE estatus_actual <> 'Entregado a Paciente'
					AND detalle_orden.id_estudio IN('1','2','3')
					AND YEAR(fecha_entrega) = '$cur_year'
					ORDER BY fecha_entrega ASC";
					//WHERE estatus_actual = str_to_date('$fecha_reporte', '%d/%m/%Y') ";
					
					$result_ordenes = mysql_query($q_ordenes, $link) 
					or die("Error al ejecutar consulta $q_ordenes".mysql_error());
					
					if(mysql_num_rows($result_ordenes)==0){
						
						die("No hay ordenes activas");
						
					}
					while($row = mysql_fetch_assoc($result_ordenes 	)){
						$id_orden = $row["id_orden"];
						$fecha_elabora = date("d/m/Y", strtotime($row["fecha_elabora"]));
						$fecha_entrega =  date("d/m/Y", strtotime($row["fecha_entrega"]));
						$hora = date("h:i:s", strtotime($row["hora_elabora"]));
						$nombre_paciente = $row["nombre_paciente"];
						$nombre_doctor = $row["nombre_doctor"];
						$nombre_estudio = $row["nombre_estudio"];
						//$urgente = $row["urgente"];
						$estatus_actual = $row["estatus_actual"];
						$sucursal = $row["sucursal"];
						
						?>
					
					
						<tr>
							<td> <?php// if($urgente == 0){echo "NO";}else{echo "SI";}  	?> 	</td>
							<td> <a href="detalle_orden.php?id_orden=<?php echo $id_orden;?>"> <?php  echo $id_orden;	?> </a> 	</td>
							
							<td> <?php  echo $fecha_entrega;	?> 	</td>
							<td> <?php  echo $fecha_elabora;	?> 	</td>
							<td> <?php  echo $nombre_paciente;	?> 	</td>
							<td> <?php  echo $nombre_estudio;	?> 	</td>
							<td> <?php  echo $nombre_doctor;	?> 	</td>
							<td> <?php  echo $sucursal;	?> 	</td>
							<td> 
								<select name="estatus[<?php echo $id_orden ?>]" class="select_estatus_orden" data-id_orden="<?php echo $id_orden ;?>" >
									<option value="En gabinete" <?php echo is_selected("En gabinete", $estatus_actual);?> >
										En gabinete					
									</option>
									<option value="En Laboratorio" <?php echo is_selected("En Laboratorio", $estatus_actual);?> >	En Laboratorio					</option>
									<option value="Entregado a Gabinete" <?php echo is_selected("Entregado a Gabinete", $estatus_actual);?> >	Entregado a Gabinete					</option>
									<option value="Entregado a Paciente" <?php echo is_selected("Entregado a Paciente", $estatus_actual);?> >	Entregado a Paciente						</option>
									<option value="Pendiente" <?php echo is_selected("Pendiente", $estatus_actual);?> >	Pendiente						</option> 
								</select>
							

							</td>
							<td> <input type = "text" name="causas[<?php  echo $id_orden;	?>]"/>	</td>
							
						</tr>
					<?php 	
					}
				?>
				
				
			</table>
		</form>
							
	</div>
	<?php 	
		include ("footer.php");
	?>
	
	</body>
</html>
