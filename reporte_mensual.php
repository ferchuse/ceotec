<?php
include "login/login_success.php";
include ("conex.php");
include ("is_selected.php");
$link = Conectarse();
$link_activo = "reportes";

$dt_fecha_inicial= new DateTime("first day of this month");
$dt_fecha_final = new DateTime("last day of this month");

$fecha_inicial = $dt_fecha_inicial->format("d/m/Y");
$fecha_final = $dt_fecha_final->format("d/m/Y");
?>
<!DOCTYPE html>
<html lang="es">
<head> 
	
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  
	<title> Reporte Mensual</title>
	<link rel="stylesheet" type="text/css" href="css/layout.css" />
	<link rel="stylesheet" type="text/css" href="css/layout.css"  media="print"/>
	<link rel="stylesheet" type="text/css" href="css/redmond/jquery-ui-1.10.3.custom.css" />
	<link rel="stylesheet" type="text/css" href="tablecloth/tablecloth.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"  />
	<link rel="stylesheet" type="text/css" href="css/alertify.css"  />
	<link rel="stylesheet" type="text/css" href="font_awesome/css/font-awesome.min.css"  />
	<link rel="stylesheet" type="text/css" href="css/common.css" media="all" />
	
	
	<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
	<script type="text/javascript" src="js/jquery-ui-1.10.3.custom.js"></script>
	<script type="text/javascript" src="js/jquery.ui.datepicker-es.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/alertify.min.js"></script>
	<script type="text/javascript" src="js/doctores.js"></script>
	<script type="text/javascript" src="js/header.js"></script>
	
	<script type="text/javascript" src="js/reporte_mensual.js"></script>
  
</head>
<body>
<div class="container">
	<?php 	include("header.php");?>
	
	<div class="row content">
		<div class="no_imprimir"> 	
			<h4>
				<div class="row">
					<div class="col-sm-2">
						<label >
						 Reporte Mensual
						</label>
					</div>
					
				</div>
			</h4>
			<hr>
			<form id="form_entregar_orden" class="form-inline">
				<div class="row">
					<div class="col-xs-12 col-sm-1 text-right">
						<label >
							Fecha Inicial:
						</label>
					</div >
					<div class="col-sm-2">
						<input type="text" class="form-control requerido " id="fecha_inicial" name="fecha_inicial" value="<?php echo $fecha_inicial;?>" > 
					</div>
					<div class=" col-sm-1 text-right">
						<label >
							Fecha Final: 
						</label>
					</div >
					<div class=" col-sm-3 ">
						<input type="text" class="form-control requerido " id="fecha_final" name="fecha_final" value="<?php echo $fecha_final;?>" > 
					</div>
					<button  id="btn_reporte" type="button"  class="btn btn-primary">
							<i class="fa fa-search"></i> Buscar <i id="load_reporte" class="fa fa-spin fa-spinner hide"></i> 
					</button>
				</div>
			</form>
		</div>
		<hr>
		<div class="row" >
			<div class="table" id="div_tabla_reporte">
				
			</div> 
			
		</div>
		
	</div>
</div>

  
</body>
</html>
