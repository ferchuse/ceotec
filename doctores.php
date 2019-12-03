<?php
	include "login/login_success.php";
	include ("conexi.php");
	$link= Conectarse();
	$q_zonas= "SELECT * FROM zonas ORDER BY zona";
	
	$result_zonas = mysqli_query($link, $q_zonas );
	
	 
?>
<!DOCTYPE html>
<html>
<head>
	<title>Doctores</title>
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
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/alertify.min.js"></script>
	<script type="text/javascript" src="js/doctores.js"></script>
	<script type="text/javascript" src="js/header.js"></script>
	
	
	
</head>
<body>
<div class="container">
	<?php
		include("header.php");
	?>
	
		
		
		<h4>
			<div class="subtitulo no_imprimir" >
				Doctores
			</div>
		</h4>
		<hr>
		
	
	<div id="row">
			<div id="col-sm-12">
				<div class=" text-center">
					 <ul class="pagination"> 
						<li class="active page" data-offset="0"><a href="#">1</a></li>
						<li  class="page" data-offset="100"><a href="#">2</a></li>
						<li  class="page" data-offset="200"><a href="#">3</a></li>
						<li  class="page" data-offset="300"><a href="#">4</a></li>
						<li  class="page" data-offset="400"><a href="#">5</a></li>
						<li  class="page" data-offset="500"><a href="#">6</a></li>
						<li  class="page" data-offset="600"><a href="#">7</a></li>
						<li  class="page " data-offset="700"><a href="#">8</a></li>
						<li  class="page " data-offset="800"><a href="#">9</a></li>
						<li  class="page " data-offset="900"><a href="#">10</a></li>
					</ul> 
				</div>
			</div>
		</div>
		<div id="row">
			<div id="col-sm-12">
				<table border="1" id="tabla_reporte">
					<thead>
						<tr>
							<th>N°</th>
							<th>CLAVE</th>
							<th>NOMBRE</th>
							<th >TEL</th>
							<th>ZONA</th>
							<th>ORDENES</th>
							<th>Acciones</th>
						</tr> 
						<tr>
							<th></th>
							<th>
								<input type="search" class="filtro_buscar form-control" data-indice="0" data-campo_filtro="id_doctor" data-operador_filtro="LIKE">
							</th>
							<th>
								<input type="search" class="filtro_buscar form-control" data-indice="1" data-campo_filtro="nombre_doctor" data-operador_filtro="LIKE">
							</th>
							<th></th>
							<th>
							<?php
							if($result_zonas){ ?>
								<select class="form-control filtro_select" data-indice="4" data-campo_filtro="doctores.zona" data-operador_filtro="=">
									<option value="" selected="selected">TODAS	</option>
									<?php
									while($fila_zonas = mysqli_fetch_assoc($result_zonas)){ 	
									?>		
											<option value="<?php echo $fila_zonas["id_zona"];?>"> 
													<?php echo $fila_zonas["zona"];?>	
											</option>
									
									<?php
									}
									?>
								</select>
							
							
							<?php		
							}	
								
							?>
								
							</th>
							<th></th>
							<th></th>
						</tr>
						
					</thead>
					<tbody id="div_tabla">
					
					</tbody>
				</table>
			</div>
		</div>
	</div>

	
<div class="modal fade" id="modal_fusion">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <div class="modal-title">Mezclar Doctores</div>
        
      </div>
      <div class="modal-body">
        <form id="form_fusionar">
				
					<div class="form-group">
						<label>Nombre Doctor a Conservar:</label>
						<input readonly type="text" id="fusion_master" name="fusion_master" class="form-control">
					</div>
					<div class="form-group">
						<label>Clave Doctor:</label>
						<input readonly type="text" id="id_master" name="id_master" class="form-control">
					</div>
					<hr>
					<div class="text-center">
						
						<div class="alert alert-warning">
							<i class="fa fa-arrow-up fa-2x"></i>
							<br>
							¡Importante! Todas las Ordenes se traspasarán al doctor de arriba. 
						</div>
					</div>
					<div class="form-group">
						<label>Doctor a Eliminar:</label>
						<input required type="search" id="fusion_slave" placeholder="Escriba para buscar" name="fusion_slave" class="form-control">
					</div>
					<div class="form-group">
						<label>Clave Doctor 2:</label>
						<input required type="text" id="id_slave" name="id_slave" class="form-control">
					</div>
        </form>
      </div>
      <div class="modal-footer">
				
        <button type="button" class="btn btn-danger" data-dismiss="modal"> 
					<i class="fa fa-times"></i>
					Cancelar
				</button>
        <button type="submit" form="form_fusionar" class="btn btn-success">
						<i class="fa fa-save"></i> Guardar
				</button>
      </div>
    </div>
  </div>
</div>


<div id="modal_doctor" class="modal fade" role="dialog">
			<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Nuevo Doctor</h4>
			  </div>
			  <div class="modal-body">
				<form id="form_doctor">
					<input type="" class="action" value="insert" hidden>
					<input type="" name="is_mod" value="1" hidden>
					
					  <div class="form-group " >
						<label class="form-label-left" id="label_4" for="txt_nombre_doctor">Nombre </label>
						<div class="input-group">
							 <input type="text" class="form-control" id="txt_nombre_doctor" name="nombre_doctor" size="60" value="" />
							 <span class="input-group-btn">
								<button id="btn_get_clave" type="button" class="btn btn-primary ">
									Generar Clave <i class="fa fa-spin fa-spinner hide" id="load_get_clave"></i>
								</button>
							</span>
						</div>
					  </div>
					
					<div class="row">
						<div class="form-group col-sm-6">
							<label for="clave_doctor"> Clave </label>
							<div class="form-group">
							  <input type="text" class="form-control"  id="clave_doctor" name="id_doctor" />
							</div>
						</div>
						<div class="form-group col-sm-6" >
							<label > Teléfono </label>
							<div class="form-input">
								<input type="text" class="form-control" id="tel_doctor" name="tel_doctor" />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-6" >
							<label class="form-label-left" >   Zona Origen:</label>
							<div  class="form-group">
							<?php
							
							$q_zonas= "SELECT * FROM zonas ORDER BY zona";
	
							$result_zonas = mysqli_query($link, $q_zonas );
	
							
							if($result_zonas){ ?>
								<select class="form-control" name="zona" id="zona">
									
									<?php
									while($fila_zonas = mysqli_fetch_assoc($result_zonas)){ 	
									?>		
											<option value="<?php echo $fila_zonas["id_zona"];?>"> 
													<?php echo $fila_zonas["zona"];?>	
											</option>
									
									<?php
									}
									?>
								</select>
							<?php		
							}	
								
							?>
							</div>
						</div>
						<div class="form-group col-sm-6" >
							<label class="form-label-left" >
								<input type="checkbox" class="" id="cobra_comision" name="cobra_comision" value="1" />
							  Comisión:
							</label>
							<div  class="form-group">
								<input type="text" class="form-control" id="porc_comision" name="porc_comision"  />
							</div>
						</div>
					</div>
					
					<div class="form-group" >
						 <label > Dirección </label>
						<div class="form-group">
							  <input class="form-control" type="text" name="dir_doctor" id="dir_doctor" />
						</div>
					</div>
				</form>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">
					<i  class="fa fa-times"> </i> Cancelar
				</button>
				<button type="button" class="btn btn-success" id="btn_ok_modal">
					<i  class="fa fa-save"> </i> Guardar <i id="load_add" class="fa fa-spin fa-spinner hide"> </i>
				</button>
			  </div>
			</div>
		  </div>
		</div>
		
	
</body>
</html>