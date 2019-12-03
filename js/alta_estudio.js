function getFolioActual(tipo_folio){
	$("#span_folio_actual").html('<i class="fa fa-spinner fa-spin"></i>');
	$.get("get_row_json.php",
			{
				"table": "folios",
				"id_field": "tipo_folio",
				"id_value": tipo_folio
			},
			function (response, status){
				//response_json = JSON.parse(response);
				console.log(response);
				$("#span_folio_actual").html(response.data.folio_actual);
				$("#folio_actual").val(response.data.folio_actual);
				
				console.log("Folio Actual : " +  $("#folio_actual").val());
			}
		);
	
}


$( document ).ready(function() {
	getFolioActual("A");
	
	$("#serie").change(function(){
		getFolioActual($(this).val());
	
	});
	
	
	$("#modal_adicional").toggle();
	//evita enviar el formulario el presionar enter
	$('#form_alta_estudio').keypress(function(e){   
		if(e.which == 13){
		  return false;
		}
	 });
	 
	$("#txt_anticipo").keyup(function(){
		//console.log("capturando anticipo");
		var anticipo = Number($("#txt_anticipo").val());
		var medio_pago = $(":checked.medio_pago").val();
		//console.log("medio de pago ln14" + medio_pago);
		
		if(medio_pago == "Efectivo"){
			$("#efectivo").val(anticipo);
			$("#total_tarjeta").val(0);
		}
		
		if(medio_pago == "Tarjeta"){
			$("#efectivo").val(0);
			$("#total_tarjeta").val(anticipo);
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
		$("#serie").val("A");
		getFolioActual("A");
		var anticipo = $("#txt_anticipo").val();
		$("#efectivo").val(anticipo);
		$("#total_tarjeta").val(0)
		
	});
	$("#radio_tarjeta").click(function(){
		var anticipo = $("#txt_anticipo").val();
		$("#serie").val("B");
		getFolioActual("B");
		$("#efectivo").val(0);
		$("#total_tarjeta").val(anticipo);
		
	});
	$("#mixto").click(function(){
		var anticipo = $("#txt_anticipo").val();
		$("#serie").val("B");
		getFolioActual("B");
		$("#efectivo").val(0);
		$("#total_tarjeta").val(anticipo);
		
	});
	
	$("#efectivo").keyup(function(){
		var anticipo = Number($("#txt_anticipo").val());
		var efectivo = Number($("#efectivo").val());
		
		console.log("Efectivo " + efectivo);
		console.log("Anticipo " + anticipo);
		
		var tarjeta = anticipo - efectivo;
		
		//console.log(typeof(tarjeta) + "tarjeta" +tarjeta);
		console.log(tarjeta);
		$("#total_tarjeta").val(tarjeta);
		//alert(tarjeta);
		/* if(tarjeta < 0) {
			alertify.error("La cantidad pagada no puede ser mayor al anticipo");
			$(this).css("backgroundColor" ,  "#d43f3a");
			return false;
		} */
	});
	
	
	$("#btn_adicionales").click(function(){
		$("#modal_adicional").toggle();
	});
		
	$( "#estudio_adicional" ).autocomplete({
		source: "search_extras.php?tabla=estudios&campo=nombre_completo_estudio &valor=nombre_completo_estudio&etiqueta=nombre_completo_estudio&extra1=precio_B&extra2=id_estudio",
		minLength : 2,
		select: function( event, ui ) {
			$('#precio_adicional').val( ui.item.extra1);
			$('#id_estudio_adicional').val( ui.item.extra2);
			$('#subtotal_adicional').val( ui.item.extra1 * $("#cant_adicional").val());
		}
	});
	arr_tabla = [];
	
	$( "#btn_add_adicional" ).click(function(){
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
	
	function guardarRemote(){
		
		
	}
	
	
	
	$("#datos_cliente").hide();
	//$("#datos_estudio").hide();
	$("#chk_factura").click(function(){
		if($(this).prop("checked")){
			$("#serie").val("B");
				getFolioActual("B");
		}
		else{
			$("#serie").val("A");
			getFolioActual("A");
		}
		//$("#datos_cliente").fadeToggle(100);
	});
	
	$("#txt_fecha_entrega" ).datepicker({
		changeMonth: true,
		changeYear: true,
		inline: true
		//yearRange: '1920:2000'
	});
	
	$( "#txt_nombre_doctor" ).autocomplete({
		source: "search_json.php?tabla=doctores&campo=nombre_doctor&valor=nombre_doctor&etiqueta=nombre_doctor",
		minLength : 2,
		select: function( event, ui ) {
			console.log(ui.item.extras.id_doctor);
			console.log(ui.item.extras.tel_doctor);
			console.log(ui.item.extras.dir_doctor);
			console.log(ui.item.extras.zona);
			$('#clave_doctor').val(ui.item.extras.id_doctor);
			$('#tel_doctor').val( ui.item.extras.tel_doctor);
			$('#direccion_doctor').val(ui.item.extras.dir_doctor);
			$('#select_zona').val(ui.item.extras.zona);
			$('#txt_descuento').val(ui.item.extras.descuento_doctor);
			if(ui.item.extras.cobra_comision == 0 ){
					$('#txt_descuento').val(10);
			}
			if(ui.item.extras.descuento_doctor >  0 ){
					
			}
		}
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
}); 