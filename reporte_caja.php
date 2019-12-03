<?php
	include "login/login_success.php";
	
	$fecha_hoy = date("d/m/Y");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Reporte de Caja</title>
	<meta charset="utf-8" />

	
	<link rel="stylesheet" type="text/css" href="css/layout.css" />
	<link rel="stylesheet" type="text/css" href="css/layout.css"  media="print"/>
	<link rel="stylesheet" type="text/css" href="css/redmond/jquery-ui-1.10.3.custom.css" />
	<link rel="stylesheet" type="text/css" href="tablecloth/tablecloth.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"  />
	<link rel="stylesheet" type="text/css" href="css/alertify.css"  />
	<link rel="stylesheet" type="text/css" href="font_awesome/css/font-awesome.min.css"  />
	<link rel="stylesheet" type="text/css" href="css/common.css"  />
	
	
	<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
	<script type="text/javascript" src="js/jquery-ui-1.10.3.custom.js"></script>
	<script type="text/javascript" src="js/jquery.ui.datepicker-es.js"></script>
	<script type="text/javascript" src="js/sumar_efectivo.js"></script>
	<script type="text/javascript" src="tablecloth/tablecloth.js"></script>
	

	<script type="text/javascript" >
	$(document).ready(function() {
		$("#btn_reporte").click(function(){
			$("#load_reporte").toggleClass("hide");
			
			$("#reporte_caja").load("get_reporte_caja.php", 
				$("#form_rep_mes").serialize(),
				function(){
					
					$("#txt_vales").keyup(function(){
						var total_efectivo = $("#total_efectivo").val() + $("#efectivo_inicial").val() ;
						var vales = $(this).val();
						efectivo_final = total_efectivo -vales;
						console.log("total_efectivo"+ total_efectivo);
						console.log("vales"+ vales);
						console.log("efectivo_final"+ efectivo_final);
						$("#span_efectivo_final").html(efectivo_final);
						$("#efectivo_final").val(efectivo_final);
						
					});
					$("#load_reporte").toggleClass("hide");
				});
		});
		
		$( "#fecha_inicial" ).datepicker({
			changeMonth: true,
			changeYear: true,
			//yearRange: '1920:2000'
		});
		
		$("#btn_reporte").click();
	});
	</script>
	
</head>
<body>
<div class="container">
	<?php
		include("header.php");
		//include("menu_busqueda.php");
	?>
	
		<div class="subtitulo no_imprimir" >
			Reporte de Caja
		</div>
		<hr class="hidden-print">
		
		<div class="row no_imprimir">
			<div class=" col-sm-7">
				<form id="form_rep_mes" class="form-inline"  method="GET" 	>
					<span class="form-group">
						<label>FECHA: </label>
						<input size="10" class="form-control" type="text" name="fecha_inicial" id="fecha_inicial" value="<?php echo $fecha_hoy;?>" />
					</span>
					<span class="form-group">
						<label>SUCURSAL: </label>
						<select name="sucursal" id="sucursal" class="form-control">
							<option value="TECAMAC">	TECAMAC	</option>
						</select>
					</span>
					<span class="form-group">
						<label>SERIE: </label>
						<select name="serie" id="serie" class="form-control">
							<?php if($_SESSION["permisos"] == "Administrador"){
								?>
								<option value="">	TODAS	</option>
								<?php
								}?>
							
							<option value="A">A</option>
							<option value="B">B</option>
						</select>
					</span>
					<div class="form-group">
						<button  class="btn btn-success " id="btn_reporte" type="button"  >
							<i class="fa fa-search"> </i> Generar 	<i id="load_reporte" class="fa fa-spin fa-spinner hide"> </i>
						</button>
					</div>
				</form>
			</div>
			
			<div class="col-sm-2">
			
			</div>
		
		</div>
		
	
		<div id="reporte_caja">
			
		</div>
	</div>
</body>
</html>