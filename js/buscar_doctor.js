$( document ).ready(function() {
	
	$("#btn_filtrar").click(function(){
		$("#load_filtro").toggleClass("hide");
		
		$("#div_tabla").load("get_ordenes_doctor.php", 
			 $("#form_ordenes_doctor").serialize(),
			function(){
				$("#load_filtro").toggleClass("hide");
			});
			
	});
	
	$( "#btn_get_clave" ).click(function(){
		spinner = $(this).find(".fa-spin");
		spinner.toggleClass("hide");
		generar_clave(spinner);
	});
	
	function generar_clave(){
		if($("#txt_nombre_doctor").val() == ''){
			alertify.error("Escriba un Nombre");
			spinner.toggleClass("hide");
		}
		else{
			$.get("clave_doctor.php", {"get_clave" : "true" , "nombre_doctor" : $("#txt_nombre_doctor").val(), "otro" : "val"},
			function(response, status){
				$('#clave_doctor').val(response.clave_doctor);
				spinner.toggleClass("hide");
			});
		}
	}
	
	//evita enviar el formulario el presionar enter
	$('#btn_add').click(function(e){   
		$("#modal_doctor").modal("show");
	});
	 
	$("#txt_anticipo").keyup(function(){
		//console.log("capturando anticipo");
		var anticipo = Number($("#txt_anticipo").val());
		var medio_pago = $(":checked.medio_pago").val();
		//console.log("medio de pago ln14" + medio_pago);
		
		if(medio_pago == "Efectivo"){
			$("#efectivo").val(anticipo);
			$("#tarjeta").val(0);
		}
		
		if(medio_pago == "Tarjeta"){
			$("#efectivo").val(0);
			$("#tarjeta").val(anticipo);
		}
		
		var importe_total = Number($("#val_importe_total").val());
		var restante = importe_total - anticipo;
		if(restante < 0) {
			alertify.error("El anticipo no puede ser mayor al monto total");
			$(this).css("backgroundColor" ,  "#d43f3a");
			return false;
		}
		
		//console.log("restante" + restante);
		$("#val_restante").val(restante);
		$("#span_restante").html(restante);
	}); 
	
	
	$("#radio_efectivo").click(function(){
		var anticipo = $("#txt_anticipo").val();
		$("#efectivo").val(anticipo);
		$("#tarjeta").val(0)
		
	});
	$("#radio_tarjeta").click(function(){
		var anticipo = $("#txt_anticipo").val();
		$("#efectivo").val(0);
		$("#tarjeta").val(anticipo)
		
	});
	
	$("#efectivo").keyup(function(){
		//console.log();
		var anticipo = $("#txt_anticipo").val();
		console.log(anticipo);
		var tarjeta = anticipo - $(this).val();
		console.log(typeof(tarjeta) + "tarjeta" +tarjeta);
		$("#tarjeta").val(anticipo - $(this).val());
		//alert(tarjeta);
		/* if(tarjeta < 0)   bfyhkiuj6uj7j6opñl.-{
			alertify.error("La cantidad pagada no puede ser mayor al anticipo");
			$(this).css("backgroundColor" ,  "#d43f3a");
			return false;
		} */
	});
	
	
	$("#btn_adicionales").click(function(){
		$("#modal_adicional").toggle();
	});
		
	$( "#estudio_adicional" ).autocomplete({
		source: "search_extras.php?tabla=estudios&campo=nombre_completo_estudio &valor=nombre_completo_estudio&etiqueta=nombre_completo_estudio&extra1=precio_tecamac&extra2=id_estudio",
		minLength : 2,
		select: function( event, ui ) {
			$('#precio_adicional').val( ui.item.extra1);
			$('#id_estudio_adicional').val( ui.item.extra2);
			$('#subtotal_adicional').val( ui.item.extra1 * $("#cant_adicional").val());
		}
	});
	arr_tabla = [];
	
	$( "#btn_add_adicional " ).click(function(){
		arr_tabla.push(
			{
				"id_estudio" : $('#id_estudio_adicional').val(),
				"cantidad" : $('#cant_adicional').val(),
				"estudio" : $('#estudio_adicional').val(),
				"precio" : $('#precio_adicional').val(),
				"subtotal" : $('#subtotal_adicional').val()
			});
		console.log(arr_tabla);
		$("#tabla_adicionales").load("tabla_adicionales.php",
			{"tabla_adicionales" :arr_tabla},
			function(){
			
				sumChecked();
			
		});
	});
	
	$( "#cant_adicional" ).keyup(function(){
		$('#subtotal_adicional').val( $('#precio_adicional').val() * $(this).val()); 
	});
	
	
	
	$("#boton_guardar").click(function(){
		
		 guardarLocal();
	});
	
	function guardarLocal(){
		if(validar()){
			$("#load_guardar").toggleClass("hide");
			$.post("guardar_estudio.php" , 
				$("#form_alta_estudio").serialize() + "&server=local", 
				function(response, success){
					response= JSON.parse(response);
					if(response.status_orden == "success"){
						alertify.success(response.mensaje_orden);
						window.location.href="imprimir_ticket.php?id_orden="+response.id_orden;
					}
					else{
						alertify.error(response.mensaje_orden);
						
					}
				
					console.log(response);
					$("#load_guardar").toggleClass("hide");
			});
		}
	}
	
	function guardar(){
		
		
	}
	
	
	$("#btn_filtrar" ).click();
	
	/* $( "#txt_nombre_doctor" ).autocomplete({
		source: "search.php?tabla=doctores&campo=nombre_doctor&valor=nombre_doctor&etiqueta=nombre_doctor",
		minLength : 2,
		 select: function( event, ui ) {
			$('#tel_doctor').val( ui.item.tel);
			$('#direccion_doctor').val( ui.item.dir );
			$('#select_zona').val( ui.item.zona );
		}
	}); */
}); 