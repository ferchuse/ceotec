<?phpinclude("conex.php");$link = Conectarse();?><?php$q_detalle = "SELECT * FROM ordenes WHERE sync <> 1";						$result = mysql_query($q_detalle, $link) or die("Error en: $q_detalle".mysql_error());				?>		<div id="div_detalle_orden">			<form name="form_rep_mes" method="POST" enctype="multipart/form-data" 			action="http://www.sync-sistemas.com/ceotec/syncronizar.php"	>														<?php 			while($row = mysql_fetch_array($result)) {				$id_orden = $row["id_orden"];				$id_paciente = $row["id_paciente"];				?>						</br>					</br>								<input type="text" name="ordenes[<?php echo $id_orden;?>]" value="<?php echo $id_orden;?>	" />				<input type="text" name="pacientes[<?php echo $id_orden;?>]" value="<?php echo $id_paciente;?>	" />							<?php 			}?>						<input class="boton" type="submit" name="sync" value="Sincronizar" />			</form>					</div>