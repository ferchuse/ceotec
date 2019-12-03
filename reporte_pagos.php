<?php 
include_once("conex.php");

$link=Conectarse();
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Reportes</title>
	<meta charset="utf-8" />
	
	<?php
		
	?>
	<link type="text/css" href="css/estructura.css" rel="stylesheet" />	
	<link type="text/css" href="css/redmon/jquery-ui-1.8.20.custom.css" rel="stylesheet" />
	<link rel="stylesheet" href="css/facturas.css" type="text/css"/>	
	
	
	<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui-1.8.20.custom.min.js"></script>
	<script type="text/javascript" src="js/jquery.ui.datepicker-es.js"></script>
	<script>
		$(function() {
			$( "#fecha_inicial" ).datepicker({
				changeMonth: true,
				changeYear: true,
				//yearRange: '1920:2000'
			});
			
		});
		
		function validar(){
		txt_f_i= $("#fecha_inicial").val();
		
		
			if (txt_f_i == ''){
				
				alert("Ingresa una Fecha Inicial") ;
				return false;
			}		
		}
	</script>
</head>

<body>
	<div class="contenido">
		<div class="subtitulo" >
		</div>
		
		<div id="fechas">
			<form name="form_rep_mes" method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF'];?>" onsubmit="return validar(this.name);"	>
				Fecha: <input type="text" name="fecha_inicial" id="fecha_inicial"  value="<?php echo date("d/m/Y");?>" />
				
							
				<input type="submit" name="buscar_fecha" value="Buscar" />
			</form>
		</div>
		

	<?php
		
	if(isset($_POST["buscar_fecha"])){
		$f_inicial = $_POST["fecha_inicial"];
		
		echo "Reporte de Comidas del $f_inicial";
		
		$sql="SELECT * FROM Facturas
		WHERE Fecha
		= str_to_date('$f_inicial', '%d/%m/%Y')  ";
		
		
		
		$q_ordenes = "SELECT * FROM ordenes ORDER BY cliente";
		
		$result_ordenes=mysql_query($q_ordenes,$link) or die("Error al consultar ordenes: $q_ordenes".mysql_error());
		
		
		if(mysql_num_rows($result_ordenes)==0){

			echo "<div class='error'> No Hay Registros</div>";
			exit();
		}
		
		?>
	<table border="1" id="tabla_reporte">
		
			<th>NOMBRE</th>
			<th>ORDEN</th>
			<th>TOTAL</th>
			<th>PAGO</th>
			<th>RESTANTE</th>
			
		<?php
		
		while($row = mysql_fetch_assoc($result_ordenes)){
			$cliente = $row["cliente"];
			$total = $row["total"];
			$id_orden = $row["id_orden"];
			//$fecha = date("d/m/Y", strtotime($row["Fecha"]));
			
				?>
			<tr>
				<td>
					<?php echo "$cliente";?>
				</td>
				<td>
					<?php
						$q_detalle="SELECT * FROM detalle_orden, comidas 
						WHERE id_orden = '$id_orden'
						AND detalle_orden.id_comida = comidas.id_comida AND Fecha = str_to_date('$f_inicial', '%d/%m/%Y')";
						
						$result_orden=mysql_query($q_detalle,$link) or die("Error al consultar detalle: $q_detalle".mysql_error());
					
						while($row = mysql_fetch_assoc($result_orden)){
							$comida = $row["comida"];
							
							echo "$comida,";
						}
					?>
				</td>
				<td>
					<?php echo "$total";?>
				</td>
				<td>
					
				</td>
				<td>
					
				</td>
			
			</tr>
		<?php
		}
		?>
		
	</table>
	
	
	<table>
	
		<tr>
		<th>
			Comida
		</th>
		<th>
			Cantidad
		</th>
		
		</tr>
		<?php
		$q_totales="SELECT comida , COUNT(cantidad) as cantidad FROM detalle_orden 
			INNER JOIN comidas
			on detalle_orden.id_comida = comidas.id_comida
			GROUP BY detalle_orden.id_comida";
		
		$result_totales=mysql_query($q_totales,$link) or die("Error al consultar detalle: $q_totales".mysql_error());
					
		while($row = mysql_fetch_assoc($result_totales)){
			$comida = $row["comida"];
			$cantidad = $row["cantidad"];
			
			echo "<tr> <td>$comida</td> <td>$cantidad</td> </tr>";
		}
			
		?>

	
	</table>
	
	<div class="btn_imprimir">
		<a href="javascript:window.print();">
			Imprimir
		</a>
	</div>
		<?php
	}
	
	
		?>
	
			<?php  echo"<td> $". number_format($total_retiros,2). " </td>";	?>		
			
	</div>
</body>
</html>
	