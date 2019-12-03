<table class="table table-bordered">
<tr >
	<th>Cantidad	</th>
	<th>Estudio	</th>
	<th>Precio	</th>
	<th>Subtotal	</th>
</tr>
<?php

$tabla_adicionales = $_POST["tabla_adicionales"];

foreach($tabla_adicionales as $row_adicional){?>
	
	<tr>
		<input type="hidden" name="adicionales[]" value="<?php echo $row_adicional["id_estudio"];?>">
		<td><?php echo $row_adicional["cantidad"];?>		</td>
		<td><?php echo $row_adicional["estudio"];?>		</td>
		<td><?php echo $row_adicional["precio"];?>		</td>
		<td><?php echo $row_adicional["subtotal"];?>		</td>
		<input type="hidden" class="subtotal_adicional" value="<?php echo $row_adicional["subtotal"];?>	">
	</tr>
	
<?php	
}
?>

</table>