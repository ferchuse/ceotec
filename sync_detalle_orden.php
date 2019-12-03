<?php
	
	
	$doctores = new SyncronizeDB();
	
	$doctores->masterSet("localhost","root","","ceotec","detalle_orden","id_detalle_orden");
	$doctores->slaveSet("ceotec.db.8478954.hostedresource.com","ceotec","Ceotec@2014","ceotec","detalle_orden","id_detalle_orden");
	
	$doctores->slaveSyncronization();
	
	
?>
