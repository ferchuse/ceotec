<?phpinclude "login/login_success.php";include("conex.php");$link = Conectarse();$dt_fecha_inicial= new DateTime("first day of this month");$dt_fecha_final = new DateTime("last day of this month");$fecha_inicial = $dt_fecha_inicial->format("d/m/Y");$fecha_final = $dt_fecha_final->format("d/m/Y");?><html>	<head>		<meta charset="utf-8" />		<title>			Historial Doctor		</title>		<link rel="stylesheet" type="text/css" href="css/layout.css" />		<link rel="stylesheet" type="text/css" href="css/layout.css"  media="print"/>		<link rel="stylesheet" type="text/css" href="css/redmond/jquery-ui-1.10.3.custom.css" />		<link rel="stylesheet" type="text/css" href="tablecloth/tablecloth.css" media="screen" />		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"  />		<link rel="stylesheet" type="text/css" href="css/alertify.css"  />		<link rel="stylesheet" type="text/css" href="font_awesome/css/font-awesome.min.css"  />		<link rel="stylesheet" type="text/css" href="css/common.css" media="all"  />						<script type="text/javascript" src="js/jquery-1.9.1.js"></script>		<script type="text/javascript" src="js/jquery-ui-1.10.3.custom.js"></script>		<script type="text/javascript" src="js/jquery.ui.datepicker-es.js"></script>		<script type="text/javascript" src="tablecloth/tablecloth.js"></script>		<script type="text/javascript" src="js/bootstrap.min.js"></script>		<script type="text/javascript" src="js/buscar_doctor.js"></script>		<script type="text/javascript" src="js/header.js"></script>				<script>		$(function() {			$( "#fecha_inicial" ).datepicker({				changeMonth: true,				changeYear: true,				//yearRange: '1920:2000'			});			$( "#fecha_final" ).datepicker({				changeMonth: true,				changeYear: true,				//yearRange: '1920:2000'			});		});		function validar(){		txt_f_i= $("#fecha_inicial").val();		txt_f_f= $("#fecha_final").val();			if (txt_f_i == ''){				alert("Ingresa una Fecha Inicial") ;				return false;			}			if (txt_f_f == ''){				alert("Ingresa una Fecha Final") ;				return false;			}			//return true	;			}	</script>	</head><body><?phpif($_GET["id_doctor"]){	$id_doctor = $_GET["id_doctor"];	$q_doctor="SELECT * FROM doctores 		WHERE id_doctor = '$id_doctor'";			$result_doctor = mysql_query($q_doctor, $link) or die("Error en: $q_doctor".mysql_error());		while($row = mysql_fetch_array($result_doctor)) {		$nombre_doctor = $row["nombre_doctor"];		$id_doctor = $row["id_doctor"];		$tel_doctor = $row["tel_doctor"];			}	if (mysql_num_rows($result_doctor) == 0){			echo "<div class='notfound'>";				echo "Doctor no encontrado, favor de verificar";						echo "</div>";	}}?>	<div class="container"> 	<?php			include ("header.php");	?>			<h4>			<div class="subtitulo no_imprimir" >				Doctor(a): <?php echo $nombre_doctor;?> <br><br>				Clave: <?php echo $id_doctor;?> <br>			</div>		</h4>		<hr>				<div class="row no_imprimir">			<form id="form_ordenes_doctor" class="form-inline" role="form" method="GET" 	>				<input type="hidden" name="id_doctor" id="id_doctor" value="<?php echo $id_doctor;?>">				<input type="hidden" name="nombre_doctor" id="nombre_doctor" value="<?php echo $nombre_doctor;?>">										<div class="form-group">						<label>Fecha Inicial: </label>						<input  class="form-control" name="fecha_inicial" id="fecha_inicial" value="<?php echo $fecha_inicial;?>" />					</div>												<div class="form-group">						<label>Fecha Final: </label>						<input class="form-control" name="fecha_final" id="fecha_final" value="<?php echo $fecha_final;?>" />					</div>																<div class="form-group">						<label>Zona: </label>						<select class="form-control" name="zona" id="zona">							<option value="TODAS" selected="selected">TODAS	</option>							<option value="TECAMAC" >TECAMAC	</option>							<option value="ZUMPANGO">ZUMPANGO </option >							<option value="TIZAYUCA">TIZAYUCA</option>							<option value="TEOTIHUACAN">TEOTIHUACAN</option>							<option value="REYES">REYES</option>							<option value="OTRO">OTRO</option>						</select>					</div>													<div class="form-group">						<button  class="btn btn-success " id="btn_filtrar" type="button"  >							<i class="fa fa-search"> </i> Filtrar 	<i id="load_filtro" class="fa fa-spin fa-spinner hide"> </i>						</button>					</div>							</form>		</div>		<hr>		<div class="row">			<div id="div_tabla">							</div>		</div>		<?php 	if(isset($_POST["buscar_fecha"])){		$f_inicial = $_POST["fecha_inicial"];		$f_final = $_POST["fecha_final"];		$zona = $_POST["zona"];		$q_historial = "SELECT COUNT(detalle_orden.id_estudio) AS cantidad, 				CONCAT(tipo_estudio, ' ',nombre_estudio) AS nombre_estudio				FROM detalle_orden 				LEFT JOIN estudios 				ON detalle_orden.id_estudio = estudios.id_estudio				LEFT JOIN ordenes ON ordenes.id_orden = detalle_orden.id_orden				WHERE fecha_elabora 				BETWEEN str_to_date('$f_inicial', '%d/%m/%Y') 				AND  str_to_date('$f_final', '%d/%m/%Y')				AND id_doctor = '$id_doctor' GROUP BY detalle_orden.id_estudio";			$result_historial_doctor = mysql_query($q_historial, $link) or die("Error en: $q_historial".mysql_error());			?>		<div>		<div class="subtitulo">			Reporte Acumulado de <?php echo $nombre_doctor ." del ".$f_inicial." al ".$f_final.", ZONA: ". $zona;?>		</div>		<table>			<tr>				<th>Estudio	</th>				<th>Cantidad	</th>			</tr>			<?php			while($row = mysql_fetch_array($result_historial_doctor)) {				$estudio = $row["nombre_estudio"];				$cantidad = $row["cantidad"];				?>				<tr>					<td><?php echo $estudio;?></td>					<td><?php echo $cantidad;?></td>				</tr>			<?php			} 			?>			</table>		</div>		<div class="subtitulo">		<table>			<tr>				<th>Orden	</th>				<th>Fecha	</th>				<th>Paciente	</th>				<th>Importe Total	</th>			</tr>			<?php			$q_detalle_historial ="SELECT id_orden, fecha_elabora, nombre_paciente, importe_total_orden			 FROM ordenes 			LEFT JOIN pacientes ON ordenes.id_paciente = pacientes.id_paciente			WHERE fecha_elabora 				BETWEEN str_to_date('$f_inicial', '%d/%m/%Y') 				AND  str_to_date('$f_final', '%d/%m/%Y')				AND  id_doctor = '$id_doctor'";			$result_detalle_historial = mysql_query($q_detalle_historial, $link) or die("Error en: $q_detalle_historial".mysql_error());			while($row = mysql_fetch_array($result_detalle_historial)) {				$id_orden = $row["id_orden"];				$fecha_historial = date("d/m/Y", strtotime($row["fecha_elabora"]));				$nombre_paciente = $row["nombre_paciente"];				$importe_total = $row["importe_total_orden"];				?>				<tr>					<td> <a href="detalle_orden.php?id_orden=<?php echo $id_orden;?>"> <?php  echo $id_orden;	?> </a> 	</td>					<td><?php echo $fecha_historial;?></td>					<td><?php echo $nombre_paciente;?></td>					<td><?php echo $importe_total;?></td>				</tr>			<?php			}			?>		</table>				</div>				<?php 	}?></div><?php //echo $_SERVER['SERVER_NAME'];?></body></html>