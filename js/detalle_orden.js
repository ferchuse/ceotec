$(document).ready(function(){
	
	$(".fa-spin").hide();
	$("#btn_guardar_pago").click(function(){
		var id_orden = $("#id_orden").val();
		console.log(id_orden);
		$(".fa-spin").show();
		$.get("row_update.php",
			{
				"table": "ordenes",
				"fields_value":
					[
						{"field": "restante", "value" : 0},
						{"field": "efectivo", "value" : $("#efectivo").val()},
						{"field": "tarjeta", "value" : $("#tarjeta").val()}
					],
				"id_field": "id_orden",
				"id_value": id_orden
			},
			function(response, status){
				console.log(response);
				$(".fa-spin").hide();
				$("#modal_mixto").modal("hide");
			});
	});
	
	$("#btn_guardar").click(function(){
		
		$.post("rows_name_update.php",
			{
				"table": "ordenes",
				"fields_value": $("#form_orden").serializeArray(),
				"id_field": "id_orden",
				"id_value":  $("#id_orden").val()
			},
			function(respuesta, status){
				alertify.success(respuesta.mensaje);
			});
	});
	
	
	$("#medio_pago").change(function(){
		var id_orden = $("#id_orden").val();
		var medio_pago = $("#medio_pago").val();
		if(medio_pago == "Mixto"){
			$("#modal_mixto").modal("show");
		}else{
			$.get("row_update.php",
			{
				"table": "ordenes",
				"fields_value":
					[
						{"field": "medio_pago", "value" : medio_pago}
					],
				"id_field": "id_orden",
				"id_value": id_orden
			},
			function(response){
				console.log(response);
				
					alertify.success("Guardado");
				
				
				
			});
		}
	});
	
	$("#btn_cancelar_orden").click(function(){
		alertify.prompt().setting(
			{
				"title" : "Confirmar",
				"message" : "Escribe el Motivo de la Cancelación",
				"onok" : cancelarOrden
			}
			
		).show();
		
	});
	
	function cancelarOrden(evt, value){
		var id_orden = $("#id_orden").val();
		console.log(id_orden);
		$(".fa-spin").toggleClass("hide");
		$.get("row_update.php",
			{
				"table": "ordenes",
				"fields_value":
					[
						{"field": "estatus_actual", "value" : "Cancelada"},
						
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
		$.get("row_insert.php",
			{
				"table": "historial_ordenes",
				"fields_value":
					[
						{"field": "id_orden", "value" : id_orden},
						{"field": "estatus", "value" : "Cancelada"},
						{"field": "fecha_hist", "value" : "CURDATE()"},
						{"field": "hora_hist", "value" : "CURTIME()"},
						{"field": "observaciones", "value" : "'"+value+"'"}
						
					],
				"mensaje_ok": "Historial Actualizado"
			},
			function(response, status){
				//console.log("status_request: " + status );
				if(status == "success"){
					//console.log(response);
					response_json = JSON.parse(response);
					
					if(response_json.estatus == "success"){
						$(".fa-spin").toggleClass("hide");
						alertify.success(response_json.mensaje)
						location.reload(true);
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
			
			
	}
	
	$("#btn_liquidar").click(function(){
		$("#modal_mixto").modal("show");
	});
	
	
	$("#efectivo").keyup(function(){
		
		var restante = Number($("#restante").val());
		
		var tarjeta = restante - $(this).val();
		
		$("#tarjeta").val(tarjeta);
		
		if(tarjeta < 0) {
			alertify.error("La cantidad pagada no puede ser mayor al anticipo");
			$(this).css("backgroundColor" ,  "#d43f3a");
			return false;
		}
	});
	
	
	$("#tarjeta").keyup(function(){
		
		var restante = Number($("#restante").val());
		
		var efectivo = restante - $(this).val();
		
		$("#efectivo").val(efectivo);
		
		if(efectivo < 0) {
			alertify.error("La cantidad pagada no puede ser mayor al restante");
			$(this).css("backgroundColor" ,  "#d43f3a");
			return false;
		}
	});
	
	
	
});