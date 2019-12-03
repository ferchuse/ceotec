$( document ).ready(function() {
	
	//Valores default de filtros
	var arr_vacio = new Array();
	var filtros = { 
		zona : "TODAS",
		offset : 0,
		filtros : arr_vacio 
		};
	
	 
	
	
	$("#btn_filtrar").click(function(){
		filtrar();
	});
	
	
	
	$(".page").click( function cargarPagina(event){
		event.preventDefault();
		var offset = ($(this).data("offset"));
		console.log(offset);
		$(".page").removeClass("active");
		$(this).addClass("active");
		filtros.offset = offset
		filtrar();
		
	});
	
	/* 
	$(".filtro_buscar").keyup( function filtro_buscar(){
		var indice = $(this).data("indice");
		var valor_filtro = $(this).val();
		buscar(valor_filtro,'tabla_reporte',indice);
	}); */
	
	$(".filtro_buscar").keyup( function filtro_buscar(){
		console.log("indice");
		var indice = $(this).data("indice");	
		var campo_filtro = $(this).data("campo_filtro");	
		var operador_filtro = $(this).data("operador_filtro");	
		var valor_filtro = $(this).val();	
		
		filtros["filtros"][indice] = { 
			"campo_filtro" : campo_filtro,
			"operador_filtro" : operador_filtro,
			"valor_filtro" : valor_filtro
		
		};
	
		filtrar();
	});
	$(".filtro_select").change( function filtro_select(){
	var indice = $(this).data("indice");	
		var campo_filtro = $(this).data("campo_filtro");	
		var operador_filtro = $(this).data("operador_filtro");	
		var valor_filtro = $(this).val();	
		
		filtros["filtros"][indice] = { 
			"campo_filtro" : campo_filtro,
			"operador_filtro" : operador_filtro,
			"valor_filtro" : valor_filtro
		
		};
	
		filtrar();
	});
	
	/* 
	$(".filtro_select").change(function filtro_buscar(){
			var indice = $(this).data("indice"),
			valor_filtro = $(this).val();
			buscar(valor_filtro,'tabla_reporte',indice);
	});
	 */
	function buscar(filtro,table_id,indice){
		console.log("buscar()");
		// Declare variables 
		var  filter, table, tr, td, i;
		filter = filtro.toUpperCase();
		table = document.getElementById(table_id);
		tr = table.getElementsByTagName("tr");
		// Loop through all table rows, and hide those who don't match the search query
		for (i = 0; i < tr.length; i++) {
			td = tr[i].getElementsByTagName("td")[indice];
			if (td) {
					if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
					tr[i].style.display = "";
					} else {
					tr[i].style.display = "none";
					}
			}
		}
		table_size(table_id);
	}
	
	function table_size(id_tabla){
		var rows = $("#"+id_tabla).find("tbody").find("tr:visible").length;
		console.log("Filas Visibles: "+ rows);
		
	}
				
				
	$( "#form_fusionar" ).submit(function submitFusionar(event){
		event.preventDefault()
		$.ajax({
			url: "doctores_fusionar.php",
			method: "post",
			data: $("#form_fusionar").serialize()
		}).done( function( respuesta) {
			$("#modal_fusion").modal("hide");
			filtrar();
		});
		
	});
	$( "#fusion_slave" ).autocomplete({
		source: "search_json.php?tabla=doctores&campo=nombre_doctor&valor=nombre_doctor&etiqueta=nombre_doctor",
		appendTo: "#modal_fusion",
		minLength : 2,
		select: function( event, ui ) {
			$('#id_slave').val( ui.item.extras.id_doctor);
		
		}
		
	});
	
	function filtrar(){
		console.log("filtros");
		console.log(filtros);
		if(!filtros.offset){
			
			filtros.offset = 0;
		}
		$("#load_filtro").toggleClass("hide");
		$("#div_tabla").html("<tr ><td colspan='7' class='text-center'><i class='fa fa-spinner fa-spin fa-4x'></i></td></tr>");
		$("#div_tabla").load("get_doctores.php", 
			filtros ,
			function(){
				
				$("#load_filtro").toggleClass("hide");
				
				$(".btn_fusion").click(function elegirFusion(){
					$("#modal_fusion").modal("show");
					$("#id_master").val($(this).data("id_doctor"));
					$("#fusion_master").val($(this).data("nombre_doctor"));
					$("#id_slave").val("");
					$("#fusion_slave").val("");
					$("#fusion_slave").focus();
					
				});
				
				
				$(".btn_delete").hover(function(){
					
					boton= $(this);
					fila = boton.closest("tr");
					fila.css("background", "#CAEAFA");
					console.log(fila);
					console.log("cambiando background")
				});
					
				$(".btn_delete").click(function(){
						// if confirm
						alertify.confirm("Confirme", "¿Está seguro que desea eliminar este doctor?", borrar, function(){});
						boton= $(this);
						
						function borrar(){
						
							$.get("row_update.php",
							{
								"table" : "doctores",
								"id_field" : "id_doctor",
								"id_value" : boton.data("id_value"),
								"fields_value" :
								[
									{"field": "archivado", "value": 1},
								
								],
								"mensaje_success" : "Eliminado Correctamente"
							},
							function(response, status){
								if(status == "success"){
									
									alertify.success(response.mensaje);
									fila = boton.closest("tr")
									fila.fadeOut(200,  function(){
										fila.remove();
									});
								}
								else{
									
									alertify.error("No hay Conexión , Reintentar");
								}
							});
						}
				});
					
				$(".btn_edit").click(function(){
						// if confirm
						$("#form_doctor").find(".action").val("update");
						$("#modal_doctor").modal("show");
						$(".modal-title").html("Editar Doctor");
						boton= $(this);
						$.get("row_get.php",
							{
								"table" : "doctores",
								"id_field" : "id_doctor",
								"id_value" : boton.data("id_value"),
							},
							function(response, status){
								if(status == "success"){
									$("#txt_nombre_doctor").val(response.data.nombre_doctor);
									$("#clave_doctor").val(response.data.id_doctor);
									$("#tel_doctor").val(response.data.tel_doctor);
									$("#dir_doctor").val(response.data.dir_doctor);
									$("#zona").val(response.data.zona);
									//$("#btn_ok_modal").data("action" , "update");
									
									
									console.log($("#btn_ok_modal").data());
								}
								else{
									
									alertify.error("No hay Conexión , Reintentar");
								}
							}
						);
					
					});
					
					
				
			});
		
	}
	
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
	
	$('#btn_add').click(function(e){   
		$("#modal-title").html("Nuevo Doctor");
		$("#form_doctor")[0].reset();
		$("#modal_doctor").modal("show");
	});
	
	
	$('#btn_ok_modal').click(function(e){ 
		$('#btn_ok_modal').prop("disabled", true);
		spinner = $(this).find(".fa-spin");
		spinner.toggleClass("hide");
		action = $("#form_doctor").find(".action").val();
		
		saveDoctor(spinner,action );
	});
	
	
	
	function saveDoctor(spinner, action){
		if(action == "insert"){
			url= "row_insert.php";
			mensaje_success= "Doctor Agregado Correctamente";
		}
		else{ 
			url= "rows_name_update.php";
			mensaje_success= "Doctor Actualizado Correctamente";
		}
		
		$.post(url, 
			{
				"table" : "doctores",
				"id_field" : "id_doctor",
				"id_value" : $("#clave_doctor").val(),
				"fields_value" : $("#form_doctor").serializeArray(),
				"mensaje_success" : mensaje_success
				
			},
			function(response, status){
				$('#btn_ok_modal').prop("disabled", false);
				if(status == "success"){
					if(response.estatus == "success"){
						alertify.success(response.mensaje);
						$("#modal_doctor").modal("hide");
						filtrar();
					}
					else{
						console.log("Erorrrr");
						if(response.errno == 1062){
							$("#clave_doctor").css("background", "#F4BAC0");
							alertify.error("Esta clave ya existe");
						}
						
					}
				}
				else{
					
					alertify.error("No hay Conexión , Reintentar");
				}
				
				spinner.toggleClass("hide");
			}
		);
		
	}
	
	
	
	
	$("#boton_guardar").click(function(){
		
		 guardarLocal();
	});
	
	
	filtrar();

}); 