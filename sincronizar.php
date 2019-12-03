<?php
include "login/login_success.php";
?>
<html>
	<head>
		<meta charset="utf-8" />
		<title>
			Sincronizar
		</title>
		
		<link rel="stylesheet" type="text/css" href="css/layout.css" />
		<link rel="stylesheet" type="text/css" href="css/layout.css"  media="print"/>	
		<link rel="stylesheet" type="text/css" href="css/redmond/jquery-ui-1.10.3.custom.css"  />
		<link rel="stylesheet" type="text/css" href="tablecloth/tablecloth.css" media="screen" />
		
		<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
		<script type="text/javascript" src="js/jquery-ui-1.10.3.custom.js"></script>
		<script type="text/javascript" src="js/jquery.ui.datepicker-es.js"></script>
		<script type="text/javascript" src="js/validar.js"></script>
		
	</head>
<body>
<?php	
	include ("header.php");
?>
<?php

?>	
<div class="contenido"> 
		<div class="subtitulo">
			Sincronizar de Datos
		</div>
		
		<?php 
		
		if($_SERVER['SERVER_NAME'] == "localhost"){

			//echo "Servidor Local"; 

		}

		include ("sync_db.php");
		echo "Pacientes <br>";
		include ("sync_pacientes.php");
		echo "<br>";
		echo "Ordenes<br>";
		include ("sync_ordenes.php");
		echo "<br>";
		echo "Detalles de Orden <br>";
		include ("sync_detalle_orden.php");
		echo "<br>";
		echo "Doctores <br>";
		include ("sync_doctores.php");
		echo "<br>";
		?>
</div>


</body>
</html>





