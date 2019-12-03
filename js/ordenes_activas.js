$(document).ready(function(){


$(".select_estatus_orden").change(function(){
		var id_orden = $(this).data("id_orden");
		var estatus_orden = $(this).val();
		console.log(id_orden);
		$(".fa-spin").toggleClass("hide");
		$.get("row_update.php",
			{
				"table": "ordenes",
				"fields_value":
					[
						{"field": "estatus_actual", "value" : estatus_orden},
						
					],
				"id_field": "id_orden",
				"id_value": id_orden
			},
			function(response, status){
				//console.log("status_request: " + status );
				if(status == "success"){
					//console.log(response);
					response_json = JSON.parse(response);
					
					if(response_json.estatus == "success"){
						$(".fa-spin").toggleClass("hide");
						alertify.success(response_json.mensaje)
					}
					else{
						
						$(".fa-spin").toggleClass("hide");
						alertify.error(response_json.mensaje)
					}	
				}
				else{
					$(".fa-spin").toggleClass("hide");
					alertify.error("Tiempo de Espera Agotado");
				}
				
			});
	});	

	
});