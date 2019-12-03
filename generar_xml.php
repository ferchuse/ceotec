    <?php
    header(‘Content-Type: text/xml’);
    include (‘conexion.php’);
    //con esta consulta ordenamos las mesas por su numero
    $result = mysql_query(" SELECT mesa,actividad,id_orden FROM orden order by mesa");
    //mandamos a imprimir con las caracteristicas de un xml , será lo que veremos en pantalla
    echo "<Actividad>";
    echo"\n";
    echo"<contenido>\n";
    $mesa="";
    while($row = mysql_fetch_array($result))
    {
		if($row['actividad']==’V’ & $row['mesa']!=$mesa)
		{
			$mesa=$row['mesa'];
			echo "<mesa";
			echo $row['mesa'];
			echo">";
			echo $row['actividad'];
			echo"</mesa";
			echo $row['mesa'];
			echo">\n";
		}
		else if($row['actividad']=='F' & $row['mesa']!=$mesa)
		{
			$mesa=$row['mesa'];
			echo "<mesa";
			echo $row['mesa'];
			echo">";
			echo"f";
			echo"</mesa";
			echo $row['mesa'];
			echo">\n";
		}
    }
    echo"</contenido>\n";
    echo "</Actividad>";
    ?>


<?php

/* El resultado seria el siguiente:
Si queremos generar un documento .xml solo agregamos las siguientes lineas :
$ar=fopen("Datos.xml","a") or die("Problemas en la creacion");
Y en vez de poner echo, lo sustitumos por un fputs($ar,"<mesa");
ejemplo: */
    $ar=fopen("Datos.xml","a") or die("Problemas en la creacion");
    fputs($ar,"<mesa");
    fputs($ar, $row['mesa']);
    fputs($ar,">");
    fputs($ar, $row['actividad']);
    fputs($ar,"</mesa");
    fputs($ar,$row['mesa']);
    fputs($ar,">\n");
    fclose($ar);
    echo "Los datos se cargaron correctamente.";
?>
