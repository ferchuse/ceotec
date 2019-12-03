<?php
	include "login/login_success.php";
	include ("conex.php");
	include ("is_selected.php");
	$link = Conectarse();
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Reporte de Estudios</title>
	<meta charset="utf-8" />
	
		<link rel="stylesheet" type="text/css" href="css/layout.css" />
		<link rel="stylesheet" type="text/css" href="css/layout.css"  media="print"/>	
		<link rel="stylesheet" type="text/css" href="css/redmond/jquery-ui-1.10.3.custom.css"  />
		<link rel="stylesheet" type="text/css" href="tablecloth/tablecloth.css" media="screen" />
		
		<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
		<script type="text/javascript" src="js/jquery-ui-1.10.3.custom.js"></script>
		<script type="text/javascript" src="js/jquery.ui.datepicker-es.js"></script>
		<script type="text/javascript" src="js/validar.js"></script>
	
	<script>
		$(function() {
			$( "#fecha_inicial" ).datepicker({
				changeMonth: true,
				changeYear: true,
				//yearRange: '1920:2000'
			});
			$( "#fecha_final" ).datepicker({
				changeMonth: true,
				changeYear: true,
				//yearRange: '1920:2000'
			});
		});
		
		function validar(){
			if ($("#fecha_inicial").val() == ''){
				alert("Ingresa una Fecha Inicial") ;
				return false;
			}
			if ($("#fecha_final").val() == ''){
				alert("Ingresa una Fecha Final") ;
				return false;
			}
		}
	</script>
</head>
<body>
	<?php
		include("header.php");
	?>
	
	<div class="contenido">
	
		<div class="subtitulo" >
			Reporte de Estudios
		</div>
		
		<div class="btn_imprimir">
			<button class="boton" onclick="javascript:window.print();">
				Imprimir
			</button>
		</div>
		
		<div id="fechas">
			<form name="form_rep_mes" method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF'];?>" onsubmit="return validar(this.name);"	>
				<span class="">
					Fecha Inicial: <input size="10" type="text" name="fecha_inicial" id="fecha_inicial" />
				</span>
				<span class="">
					Fecha Final:<input type="text" name="fecha_final" id="fecha_final" />
				</span>
			
				SUCURSAL:
					<select name="sucursal">
						<option value="TECAMAC">	TECAMAC	</option>
						<option value="ZUMPANGO">	ZUMPANGO </option >
					</select>
				<input class="boton" type="submit" name="buscar_fecha" value="Buscar" />
			</form>
		</div>
		
	<?php
		
	if(isset($_POST["buscar_fecha"])){
		$f_inicial = $_POST["fecha_inicial"];
		$f_final = $_POST["fecha_final"];
		$sucursal = $_POST["sucursal"]; 
			
		$q_estudios = "SELECT COUNT(detalle_orden.id_estudio) AS cantidad, 
			CONCAT(tipo_estudio, ' ',nombre_estudio) AS nombre_estudio
			FROM detalle_orden 
			INNER JOIN estudios  
			ON detalle_orden.id_estudio = estudios.id_estudio 
			INNER JOIN ordenes
			ON ordenes.id_orden = detalle_orden.id_orden
			WHERE fecha_elabora BETWEEN str_to_date('$f_inicial', '%d/%m/%Y') 
			AND  str_to_date('$f_final', '%d/%m/%Y')
			AND sucursal = '$sucursal'
			GROUP BY  detalle_orden.id_estudio";
		
		$result_totales=mysql_query($q_estudios,$link) or die("Error en: $q_estudios  ".mysql_error());
		
		if(mysql_num_rows($result_totales)==0){
			echo "<div class='error'> No Hay Registros</div>";
			//exit();
		}
		
		echo "<div class=\"subtitulo\">Reporte de Estudios del $f_inicial al $f_final  SUCURSAL $sucursal</div>";
	
		?>
	<table border="1" id="tabla_reporte">
		
			<th>ESTUDIO</th>
			<th>CANTIDAD</th>
				
			
		<?php
		
		
		while($row = mysql_fetch_assoc($result_totales)){
			$tipo_estudio = $row["cantidad"];
			$cantidad_ordenes = $row["cantidad"];
			$nombre_estudio = $row["nombre_estudio"];
			//$importe_total = $row["importe_total"];
			//$total = date("d/m/Y", strtotime($row["Fecha"]));
			
			
				?>
			<tr>
				<td>
					<?php echo "$nombre_estudio";?>
				</td>
				<td>
					<?php echo "$cantidad_ordenes";?>
				</td>
			</tr>
		<?php 
		}	
		while($row = mysql_fetch_assoc($result_totales)){
			$suma_subtotal = $row["SUMA_SUBTOTAL"];
			$suma_iva = $row["SUMA_IVA"];
			$suma_total = $row["SUMA_TOTAL"];
		}
		echo "<tr><td></td><td></td><td></td><td></td>
			<td id='celda_subtotal'>$suma_subtotal</td>
			<td id='celda_iva'>$suma_iva</td>
			<td id='celda_total'>$suma_total</td></tr>";
		?>
	</table>
	
	
		<?php
	}
		?>
	
		
			
	</div>
	
	
</body>
</html>
	