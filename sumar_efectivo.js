function sumar_efectivo(){

	var monedas1 = $("#txt_1").val();
	var subtotal_1 = Number(monedas1) *1;
	$("#subtotal_1").html= subtotal_1;
	
	var monedas2 = $("#txt_2").val();
	var subtotal_2 = Number(monedas2) *2;
	$("#subtotal_2").html= subtotal_2;
	
	var monedas5 = $("#txt_1").val();
	var subtotal_5 = Number(monedas1) *5;
	$("#subtotal_5").html= subtotal_5;
	
	
	
	var total_efectivo = (monedas2 * 1)+(monedas2*2)+(monedas5 *5)+();
	"#total_efectivo".val(total_efectivo);
}

function imprimir_total_efectivo (){

	
}