$(document).ready(function(){
	
	$("#btn_sync").click(function(){
		
		sync("local", "ordenes");
		sync("remote");
		get_rows_unsync("ordenes" , "id_orden");
		get_rows_unsync("pacientes" , "id_paciente");
		get_rows_unsync("detalle_orden" , "id_detalle_orden");
		get_rows_unsync("doctores" , "id_doctor");
	});
	
	$("#btn_sync").click();
	
	function sync(server, table){
		$(".fa-refresh").toggleClass("fa-spin");
		$.ajax({
			url:"get_row_count.php",
			data : {
				"table": table,
				"server": server
			},
			success : function(response, estatus){
				console.log("get_row_count");
				console.log(response);
				//response= JSON.parse(response);
				if(server== "local"){
					$("#ordenes_locales").html(response.cant_ordenes);
				}
				else{
					//sresponse= JSON.parse(response);
					console.log(response.db_conex);
					if(response.db_conex.status == "ok"){
						//alertify.success("Sincronización Correcta");
						$("#last_sync").html(response.last_sync);
					}
					else{
						
						alertify.error("No hay conexion, reintentar");
					}
					$("#ordenes_remotas").html(response.cant_ordenes);
				}
				$(".fa-refresh").toggleClass("fa-spin");
				
				//console.log(response);
				//console.log(response.last_sync);
				
			},
			error :  function(response, errno){
				alertify.error("ajax_error, en funcion sync");
				console.log("ajax_error" + errno);
				console.log(response);
				//response= JSON.parse(response);
				
			}
		});
	}
	
	
	
	function get_rows_unsync(table ,id_field){
		$("#btn_sync").find(".fa").toggleClass("fa-spin");
		$.ajax({	
			url:	"get_row_unsync.php",
			method:	"GET",
			data : {
				"table": table,
				"id_field": id_field,
				"server": "local"
			},
			success : function(response, estatus){
				
				//console.log("get_row_unsync 74 " + response);
				//response= JSON.parse(response);
				
				$("#btn_sync").find(".fa").toggleClass("fa-spin");
				
				//console.log("get_row_unsync 74 " + response);
				$("#ordenes_unsync").html(response.cant_ordenes_unsync);
				//console.log("Rows unsync: " + rows_unsync.size());
				if(response.cant_ordenes_unsync > 0){
					alertify.success(response.cant_ordenes_unsync +" "+ table + " Subidos" );
					//post_rows_unsync(response.rows_unsync, table, id_field);
				}
				else{
					console.log("No hay Ordenes por sincronizar");
					
				}
			},
			error :  function(response, error, errortype){
				console.log("ajax_error: " + error + errortype);
				console.log(response);
				//response= JSON.parse(response);
				
			}
		});
		
	}
	
	function post_rows_unsync(rows_unsync, table, id_field ){
		$(".fa-refresh").toggleClass("fa-spin");
		$.ajax({	
			url:"post_rows_unsync.php",
			method: 'POST',
			data : {
				"id_field" : id_field,
				"table" : table,
				rows_unsync
			},
			success : function(response, estatus){
				
				//response= JSON.parse(response);
				
				
				$(".fa-refresh").toggleClass("fa-spin");
				
				console.log(response);
				console.log(response.last_sync);
				
				
				$.post("update_synced_rows.php", 
					{
						"synced_ids" : response.synced_ids, 
						"table" : table, 
						"id_field" : id_field
					},
					function(response, status){
						//response = JSON.parse(response);
						switch(table){
							case "ordenes":
								mensaje_sync = "Ordenes Actualizadas: ";
							break;
							case "doctores":
								mensaje_sync = "Doctores Actualizados: ";
							break;
							case "pacientes":
								mensaje_sync = "Pacientes Actualizados: ";
							break;
							default :
								mensaje_sync = "Registros Actualizados: ";
							break;
						}
						alertify.success(mensaje_sync + response.ordenes_actualizadas);
						console.log(response);
					
				});
				
				
			},
			error :  function(response, error, errortype, otro){
				console.log("ajax_error");
				console.log(response);
				console.log(error);
				console.log(errortype);
				console.log(otro);
				//response= JSON.parse(response);
				
			}
		});
		
	}
	
	
	
	

	
});