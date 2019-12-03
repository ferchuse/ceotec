<?php
	include "login/login_success.php";
	include ("conex.php");
	include ("is_selected.php");
	$link = Conectarse();
	//include_once ("cancelar_movimiento.php");
?>
<html>
	<head> 
		<meta charset="utf-8" />
		<link rel="shortcut icon" href="favicon.ico" />
		<title>
			Imprimir Etiquetas
		</title>
		
		<link rel="stylesheet" href="css/layout.css" type="text/css"/>
			<link rel="stylesheet" href="css/imprimir.css" type="text/css" media="all"/>
		
		<script type="text/javascript" src="js/validar.js" charset="utf-8"></script>
		<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
		
		<link href="tablecloth/tablecloth.css" rel="stylesheet" type="text/css" media="screen" />
		<script type="text/javascript" src="tablecloth/tablecloth.js"></script>
	</head>
	
	<body>
	
	
	<?php
		if(isset($_GET["id_orden"])){
			$id_orden= $_GET["id_orden"];
		}
		
	
				
		$q_detalle="SELECT * FROM ordenes 
		LEFT JOIN pacientes 
		ON ordenes.id_paciente = pacientes.id_paciente
		LEFT JOIN doctores
		ON ordenes.id_doctor = doctores.id_doctor
		WHERE id_orden = '$id_orden'";
		
		$result_detalle = mysql_query($q_detalle,$link) or die("Error en $q_detalle: ".mysql_error());

		while($row = mysql_fetch_assoc($result_detalle)){	
			$nombre_paciente= $row["nombre_paciente"];
			$edad= $row["edad"];
			$sexo= $row["sexo"];
			$fecha_elabora= strftime("%e/%b/%Y", strtotime($row["fecha_elabora"]));
			$nombre_doctor= $row["nombre_doctor"];
			
			
		}
				
					
	?>
	<?php
		include ("header.php");
	?>
	
	<div class="contenido"> 
		<div class="btn_imprimir">
			<button class="boton" onclick="javascript:window.print();">
				Imprimir
			</button>
		</div>
		
		
		<div class="etiqueta" id="div_etiqueta1">
			<div>
				ORDEN: 
				<?php	echo $id_orden;	?>
			</div>
			<div>
				FECHA: 
				<?php	echo $fecha_elabora;	?>
			</div>
			<div>
				NOMBRE:
				<?php	echo $nombre_paciente;	?>
			</div>
			<div>
				SEXO: 
				<?php	echo $sexo;	?>
			</div>
			<div>
				EDAD: 
				<?php	echo $edad;?>
			</div>
			<div>
				DOCTOR:  
				<?php	echo $nombre_doctor;	?>
			</div>
			<div class="logo_etiqueta">
				<img src="img/logo_zum.png" />
				<?php	//echo $logo_sucursal;	?>
			</div>			   
		</div>
		
		<div class="etiqueta" id="div_etiqueta2">
			<div>
				ORDEN: 
				<?php	echo $id_orden;	?>
			</div>
			<div>
				FECHA: 
				<?php	echo $fecha_elabora;	?>
			</div>
			<div>
				NOMBRE:
				<?php	echo $nombre_paciente;	?>
			</div>
			<div>
				SEXO: 
				<?php	echo $sexo;	?>
			</div>
			<div>
				EDAD: 
				<?php	echo $edad;?>
			</div>
			<div>
				DOCTOR:  
				<?php	echo $nombre_doctor;	?>
			</div>
			<div class="logo_etiqueta">
				<img src="img/logo_zum.png" />
				<?php	//echo $logo_sucursal;	?>
			</div>			
		</div>
							
	</div>
	<?php 	
		include ("footer.php");
	?>
	
	</body>
</html>
	
	
	