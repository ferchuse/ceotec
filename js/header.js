
$( document ).ready(function() {
	$( "#txt_buscar_paciente" ).autocomplete({
		source: "search.php?tabla=pacientes&campo=nombre_paciente&valor=nombre_paciente&etiqueta=nombre_paciente",
		minLength : 2
	});
	
	$( "#txt_buscar_doctor" ).autocomplete({
		source: "search_json.php?tabla=doctores&campo=nombre_doctor&valor=nombre_doctor&etiqueta=nombre_doctor&extra1=id_doctor",
		minLength : 2,
		select: function( event, ui ) {
			$('#id_doctor').val( ui.item.extras.id_doctor);
		
		}
		
	});
	
	$( "#form_buscar_doctor" ).submit(function(){
		if($("#txt_buscar_doctor").val() == ''){
			alertify.error("Ingrese un Nombre");
			$("#txt_buscar_doctor").css("backgroundColor", "red");
			$("#txt_buscar_doctor").focus();
			return false;
		}
	});
	$( "#form_buscar_orden" ).submit(function(){
		if($("#id_buscar_orden").val() == ''){
			alertify.error("Ingrese un Folio");
			$("#id_buscar_orden").css("backgroundColor", "red");
			$("#id_buscar_orden").focus();
			return false;
		}
	});
	$( "#form_buscar_paciente" ).submit(function(){
		if($("#txt_buscar_paciente").val() == ''){
			alertify.error("Ingrese un Nombre");
			$("#txt_buscar_paciente").css("backgroundColor", "red");
			$("#txt_buscar_paciente").focus();
			return false;
		}
	});
	
	$( "#btn_sync_menu" ).click();
	
	function sincronizar_tabla(tabla, id_field, server){
		
		$.ajax({
			url: "sync_table.php",
			method: "GET",
			data: {"tabla": tabla, "id_field": id_field, "server": server}
		}).done(function(respuesta){
			console.log(respuesta);
			
			if(respuesta.cant_modificadas > 0){
					alertify.success(respuesta.cant_modificadas + tabla +" Sincronizados");
			}
			else{
				alertify.success(respuesta.mensaje_modificados_remote);
			}
			
			
		}).fail(function(xhr, error, errno){
			alertify.error("Ocurrio un Error, Vuelve a intentar, code: "+ errno + error);
			console.error(error);
		}).always(function(){
			$("#btn_sync_menu").find(".fa").removeClass("fa-spin");
		
		});;
	}
	
	$( "#btn_sync_menu" ).click(function(){
		console.log("#btn_sync_menu");
		$icon = $(this).find(".fa");
		$icon.toggleClass("fa-spin");
		alertify.message("Sincronizando...");
		sincronizar_tabla("ordenes", "id_orden", "local");
		sincronizar_tabla("ordenes", "id_orden", "remote");
		sincronizar_tabla("doctores", "id_doctor", "local");
		sincronizar_tabla("doctores", "id_doctor", "remote");
			
	});
	
	
	$( "#btn_sync_menu" ).click();
	
}); 

