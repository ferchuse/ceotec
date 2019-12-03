<?php
	
	$pacientes = new SyncronizeDB();
	//masterSet(dbserver,user,password,db,table,index)
	$pacientes->masterSet("localhost","root","","ceotec","pacientes","id_paciente");
	$pacientes->slaveSet("ceotec.db.8478954.hostedresource.com","ceotec","Ceotec@2014","ceotec","pacientes","id_paciente");
	//serverSet(dbserver,user,password,db,table,index)	
	
	$pacientes->slaveSyncronization();

?>
