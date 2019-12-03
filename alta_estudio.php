<?php
$sucursal = $_SESSION["sucursal"];
include ("conex.php");
include ("is_selected.php");
include ("clave_doctor.php");
$link = Conectarse();
$link_activo = "alta_estudio";
?>
<!DOCTYPE HTML">
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<meta name="HandheldFriendly" content="true" />
<title>Nuevo Estudio</title>
<link rel="stylesheet" type="text/css" href="css/styles/form.css?v3.1.84"/>
<link rel="stylesheet" type="text/css" href="css/layout.css" />
<link rel="stylesheet" type="text/css" href="css/layout.css"  media="print"/>		
<link rel="stylesheet" type="text/css" href="css/redmond/jquery-ui-1.10.3.custom.css"  />
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"  />
<link rel="stylesheet" type="text/css" href="css/alertify.css"  />
<link rel="stylesheet" type="text/css" href="font_awesome/css/font-awesome.min.css"  />
<link rel="stylesheet" type="text/css" href="css/common.css"  />


<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.10.3.custom.js"></script>
<script type="text/javascript" src="js/jquery.ui.datepicker-es.js"></script>
<script type="text/javascript" src="js/alertify.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/numero_letra.js"></script>
<script type="text/javascript" src="js/calcular_total.js"></script>
<script type="text/javascript" src="js/paquetes.js"></script>
<script type="text/javascript" src="js/validar.js"></script>
<script type="text/javascript" src="js/alta_estudio.js"></script>
<script type="text/javascript" src="js/header.js"></script>
<script type="text/javascript" src="js/sync.js"></script>

</head>
<body>

<div class="container">
<?php
include("header.php");
?>


<div class="row"> 
<form class="jotform-form"  action="imprimir_ticket.php" method="post" name="form_32817226128857" id="form_alta_estudio" accept-charset="utf-8">
  <input type="hidden" name="nombre_usuario" value="<?php echo $_SESSION["nombre_usuario"];?>" />
  <input type="hidden" name="sucursal" value="<?php echo $_SESSION["sucursal"];?>" />

  <div class="form-all">
    <ul class="form-section">
      <li class="form-line" id="id_1">
        <label class="form-label-left" id="label_1" for="txt_nombre_paciente"> Nombre *</label>
        <div id="cid_1" class="form-input">
          <input type="text" class=" form-textbox" data-type="input-textbox" id="txt_nombre_paciente" name="nombre_paciente" size="60" value="" />
        </div>
      </li>
      <li class="form-line form-line-column" id="id_6">
        <label class="form-label-top" id="label_6" for="input_6"> Fecha de nacimiento </label>
        <div id="cid_6" class="form-input-wide"><span class="form-sub-label-container">
		<select class="form-dropdown" name="fecha_nac_pac[0]" id="input_6_day">
              <option>  </option>
              <option value="1"> 1 </option>
              <option value="2"> 2 </option>
              <option value="3"> 3 </option>
              <option value="4"> 4 </option>
              <option value="5"> 5 </option>
              <option value="6"> 6 </option>
              <option value="7"> 7 </option>
              <option value="8"> 8 </option>
              <option value="9"> 9 </option>
              <option value="10"> 10 </option>
              <option value="11"> 11 </option>
              <option value="12"> 12 </option>
              <option value="13"> 13 </option>
              <option value="14"> 14 </option>
              <option value="15"> 15 </option>
              <option value="16"> 16 </option>
              <option value="17"> 17 </option>
              <option value="18"> 18 </option>
              <option value="19"> 19 </option>
              <option value="20"> 20 </option>
              <option value="21"> 21 </option>
              <option value="22"> 22 </option>
              <option value="23"> 23 </option>
              <option value="24"> 24 </option>
              <option value="25"> 25 </option>
              <option value="26"> 26 </option>
              <option value="27"> 27 </option>
              <option value="28"> 28 </option>
              <option value="29"> 29 </option>
              <option value="30"> 30 </option>
              <option value="31"> 31 </option>
            </select>
            <label class="form-sub-label" for="input_6_day" id="sublabel_day"> Día </label></span><span class="form-sub-label-container">
			<select class="form-dropdown" name="fecha_nac_pac[1]" id="input_6_month">
              <option>  </option>
              <option value="Enero"> Enero </option>
              <option value="Febrero"> Febrero </option>
              <option value="Marzo"> Marzo </option>
              <option value="Abril"> Abril </option>
              <option value="Mayo"> Mayo </option>
              <option value="Junio"> Junio </option>
              <option value="Julio"> Julio </option>
              <option value="Agosto"> Agosto </option>
              <option value="Septiembre"> Septiembre </option>
              <option value="Octubre"> Octubre </option>
              <option value="Noviembre"> Noviembre </option>
              <option value="Diciembre"> Diciembre </option>
            </select>
            <label class="form-sub-label" for="input_6_month" id="sublabel_month"> Mes </label></span>
			<span class="form-sub-label-container">
			<select class="form-dropdown" name="fecha_nac_pac[2]"  id="input_6_year">
              <option>  </option>
              <option value="2009"> 2014</option>
              <option value="2009"> 2013 </option>
              <option value="2009"> 2012 </option>
              <option value="2009"> 2011 </option>
              <option value="2009"> 2010 </option>
              <option value="2009"> 2009 </option>
              <option value="2008"> 2008 </option>
              <option value="2007"> 2007 </option>
              <option value="2006"> 2006 </option>
              <option value="2005"> 2005 </option>
              <option value="2004"> 2004 </option>
              <option value="2003"> 2003 </option>
              <option value="2002"> 2002 </option>
              <option value="2001"> 2001 </option>
              <option value="2000"> 2000 </option>
              <option value="1999"> 1999 </option>
              <option value="1998"> 1998 </option>
              <option value="1997"> 1997 </option>
              <option value="1996"> 1996 </option>
              <option value="1995"> 1995 </option>
              <option value="1994"> 1994 </option>
              <option value="1993"> 1993 </option>
              <option value="1992"> 1992 </option>
              <option value="1991"> 1991 </option>
              <option value="1990"> 1990 </option>
              <option value="1989"> 1989 </option>
              <option value="1988"> 1988 </option>
              <option value="1987"> 1987 </option>
              <option value="1986"> 1986 </option>
              <option value="1985"> 1985 </option>
              <option value="1984"> 1984 </option>
              <option value="1983"> 1983 </option>
              <option value="1982"> 1982 </option>
              <option value="1981"> 1981 </option>
              <option value="1980"> 1980 </option>
              <option value="1979"> 1979 </option>
              <option value="1978"> 1978 </option>
              <option value="1977"> 1977 </option>
              <option value="1976"> 1976 </option>
              <option value="1975"> 1975 </option>
              <option value="1974"> 1974 </option>
              <option value="1973"> 1973 </option>
              <option value="1972"> 1972 </option>
              <option value="1971"> 1971 </option>
              <option value="1970"> 1970 </option>
              <option value="1969"> 1969 </option>
              <option value="1968"> 1968 </option>
              <option value="1967"> 1967 </option>
              <option value="1966"> 1966 </option>
              <option value="1965"> 1965 </option>
              <option value="1964"> 1964 </option>
              <option value="1963"> 1963 </option>
              <option value="1962"> 1962 </option>
              <option value="1961"> 1961 </option>
              <option value="1960"> 1960 </option>
              <option value="1959"> 1959 </option>
              <option value="1958"> 1958 </option>
              <option value="1957"> 1957 </option>
              <option value="1956"> 1956 </option>
              <option value="1955"> 1955 </option>
              <option value="1954"> 1954 </option>
              <option value="1953"> 1953 </option>
              <option value="1952"> 1952 </option>
              <option value="1951"> 1951 </option>
              <option value="1950"> 1950 </option>
              <option value="1949"> 1949 </option>
              <option value="1948"> 1948 </option>
              <option value="1947"> 1947 </option>
              <option value="1946"> 1946 </option>
              <option value="1945"> 1945 </option>
              <option value="1944"> 1944 </option>
              <option value="1943"> 1943 </option>
              <option value="1942"> 1942 </option>
              <option value="1941"> 1941 </option>
              <option value="1940"> 1940 </option>
              <option value="1939"> 1939 </option>
              <option value="1938"> 1938 </option>
              <option value="1937"> 1937 </option>
              <option value="1936"> 1936 </option>
              <option value="1935"> 1935 </option>
              <option value="1934"> 1934 </option>
              <option value="1933"> 1933 </option>
              <option value="1932"> 1932 </option>
              <option value="1931"> 1931 </option>
              <option value="1930"> 1930 </option>
              <option value="1929"> 1929 </option>
              <option value="1928"> 1928 </option>
              <option value="1927"> 1927 </option>
              <option value="1926"> 1926 </option>
              <option value="1925"> 1925 </option>
              <option value="1924"> 1924 </option>
              <option value="1923"> 1923 </option>
              <option value="1922"> 1922 </option>
              <option value="1921"> 1921 </option>
              <option value="1920"> 1920 </option>
              <option value="1919"> 1919 </option>
              <option value="1918"> 1918 </option>
              <option value="1917"> 1917 </option>
              <option value="1916"> 1916 </option>
              <option value="1915"> 1915 </option>
              <option value="1914"> 1914 </option>
              <option value="1913"> 1913 </option>
              <option value="1912"> 1912 </option>
              <option value="1911"> 1911 </option>
              <option value="1910"> 1910 </option>
            </select>
            <label class="form-sub-label" for="input_6_year" id="sublabel_year"> Año </label></span>
        </div>
      </li>
      <li class="form-line form-line-column" id="id_8">
        <label class="form-label-top" id="label_8" for="input_8"> Sexo </label>
        <div id="cid_8" class="form-input-wide">
          <div >
			<span class="form-radio-item" style="clear:left;">
				<input type="radio" class="form-radio" id="rad_masculino" name="sexo" value="Masculino" />
				<label for="rad_masculino"> Masculino </label>
			</span>
			 <span class="form-radio-item" style="clear:left;">
				<input type="radio" class="form-radio" id="rad_femenino" name="sexo" value="Femenino" />
				<label for="rad_femenino"> Femenino </label>
			 </span>
          </div>
        </div>
      </li>
	  <div id="datos_estudio">
      <li class="form-line" id="id_13">
        <label class="form-label-left" for="tel_paciente"> Teléfono </label>
        <div id="cid_13" class="form-input">
          <input type="text" class=" form-textbox" data-type="input-textbox" id="tel_paciente" name="tel_paciente" size="20"  />
        </div>
      </li>
      <li class="form-line" id="id_5">
        <label class="form-label-left" id="label_5" for="input_5"> Dirección </label>
        <div id="cid_5" class="form-input">
          <table summary="" class="form-address-table" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td colspan="2"><span class="form-sub-label-container"><input class="form-textbox form-address-line" type="text" name="dir_paciente" id="input_5_addr_line1" />
                  <label class="form-sub-label" for="input_5_addr_line1" id="sublabel_5_addr_line1"> Calle y Numero, Colonia, Municipio, Estado </label></span>
              </td>
            </tr>
          </table>
        </div>
      </li>
      <li class="form-line" id="id_4">
        <label class="form-label-left" id="label_4" for="txt_nombre_doctor"> Dr(a) Remitente </label>
        <div id="cid_4" class="form-input">
          <input type="text" class=" form-textbox" data-type="input-textbox" id="txt_nombre_doctor" name="nombre_doctor" size="60" value="" />
        </div>
		<button id="btn_get_clave" type="button" class="btn btn-primary">
			Generar Clave <i class="fa fa-spin fa-spinner hide" id="load_get_clave"></i>
		</button>
      </li>
      <li class="form-line" id="id_4">
        <label class="form-label-left" id="label_4" for=""> Clave </label>
        <div id="cid_4" class="form-input">
          <input type="text" class="form-textbox requerido" data-type="input-textbox" id="clave_doctor" name="id_doctor" />
        </div>
      </li>
	  <li class="form-line" id="id_4">
        <label class="form-label-left" id="label_4" for="txt_nombre_doctor">   Zona Origen:</label>
        <div id="cid_4" class="form-input">
			<select name="zona_origen" id="select_zona">
				<option value="" selected="selected">Selecciona Zona	</option>
				<option value="TECAMAC" >TECAMAC	</option>
				<option value="ZUMPANGO">ZUMPANGO </option >
				<option value="TIZAYUCA">TIZAYUCA</option>
				<option value="TEOTIHUACAN">TEOTIHUACAN</option>
				<option value="REYES">REYES</option>
				<option value="OTRO">OTRO</option>
			</select>
		</div>
      </li>
      <li class="form-line" id="id_18">
        <label class="form-label-left"  for="tel_doctor"> Teléfono </label>
        <div id="cid_18" class="form-input">
          <input type="text" class=" form-textbox" data-type="input-textbox" id="tel_doctor" name="tel_doc" size="20" value="" />
        </div>
      </li>
      <li class="form-line" id="id_19">
        <label class="form-label-left" id="label_19" for="input_19"> Dirección </label>
        <div id="cid_19" class="form-input">
			<table summary="" class="form-address-table" border="0" cellpadding="0" cellspacing="0">
				<tr>
				  <td colspan="2"><span class="form-sub-label-container">
					<input class="form-textbox form-address-line" type="text" name="direccion_doctor" id="direccion_doctor" />
					  <label class="form-sub-label" for="direccion_doctor" id="sublabel_19_addr_line1"> Calle y Numero, Colonia, Municipio, Estado  </label></span>
				  </td>
				</tr>
			</table>
        </div>
      </li>
    </div>
<?php
	$q_tipos = "SELECT DISTINCT tipo_estudio FROM estudios";
	$result_tipos=mysql_query($q_tipos,$link) or die("Error en: $q_tipos".mysql_error());
	?>
	<table class="tg-table-plain">
	<?php
	while($row = mysql_fetch_assoc($result_tipos)){
		$tipo_estudio = $row["tipo_estudio"];?>
	<tr>
		<td class="tg-bf">
			<?php echo $tipo_estudio;?>
		</td>
		<?php
		$q_estudios = "SELECT * FROM estudios WHERE tipo_estudio = '$tipo_estudio'";
		$counter = 0;
		$result_estudios=mysql_query($q_estudios,$link) or die("Error en: $q_estudios  ".mysql_error());
		while($row = mysql_fetch_assoc($result_estudios)){
			$id_estudio = $row["id_estudio"];
			$nombre_estudio = $row["nombre_estudio"];
			$precio = $row["precio_tecamac"];
			$categoria = $row["categoria"];
			if(mysql_num_rows($result_estudios) > 3){
				if($counter == 4 || $counter == 0 || $counter == 8){
					echo "<td>";
				}
				?>
				<span class="form-checkbox-item">
					<input type="checkbox" class="form-checkbox <?php echo $categoria;?>" id="input<?php echo $id_estudio;?>" name="estudios[<?php echo $id_estudio;?>]" value="<?php echo $precio;?>" />
					<label for="input<?php echo $id_estudio;?>"> <?php echo $nombre_estudio?> </label>
				</span>
				<?php 
				$counter++;
				//continue;
				if($counter == 4 || $counter == 8){
					echo "</td>";
				}
			}
			else{
				?>
				<td>	
					<span class="form-checkbox-item">
						<input type="checkbox" class="form-checkbox <?php echo $categoria;?>" id="input<?php echo $id_estudio;?>" name="estudios[<?php echo $id_estudio;?>]" value="<?php echo $precio;?>" />
						<label for="input<?php echo $id_estudio;?>"> <?php echo $nombre_estudio?> </label>
					</span>
				</td>
				<?php
				}
		}
			?>
	</tr>
		<?php
	}
	?>   
	</table>
	<table id="tabla_periapical_adulto" class="tg-table-plain">
	  <tr>
		<td class="tg-bf" rowspan="4" id="titulo_tabla_adulto">
			Periapical Adulto
		</td>
		<td><label for="periapical_adulto18">18</label></td>
		<td>17</td>
		<td>16</td>
		<td>15</td>
		<td>14</td>
		<td>13</td>
		<td>12</td>
		<td>11</td>
		<td>21</td>
		<td>22</td>
		<td>23</td>
		<td>24</td>
		<td>25</td>
		<td>26</td>
		<td>27</td>
		<td>28</td>
	  </tr>
	  <tr class="tg-even"> 
		<td><input type="checkbox"  class="periapical" name="estudios[29]" value="80" id="periapical_adulto48"/></td>
		<td><input type="checkbox"  class="periapical" name="estudios[29]" value="80" id="periapical_adulto47"/></td>
		<td><input type="checkbox"   class="periapical" name="estudios[29]" value="80" id="periapical_adulto46"/></td>
		<td><input type="checkbox"  class="periapical" name="estudios[29]" value="80" id="periapical_adulto45"/></td>
		<td><input type="checkbox"  class="periapical" name="estudios[29]" value="80" id="periapical_adulto44"/></td>
		<td><input type="checkbox"  class="periapical" name="estudios[29]" value="80" id="periapical_adulto43"/></td>
		<td><input type="checkbox"  class="periapical" name="estudios[29]" value="80" id="periapical_adulto42"/></td>
		<td><input type="checkbox"  class="periapical" name="estudios[29]" value="80" id="periapical_adulto41"/></td>
		<td><input type="checkbox"  class="periapical" name="estudios[29]" value="80" id="periapical_adulto31"/></td>
		<td><input type="checkbox"  class="periapical" name="estudios[29]" value="80" id="periapical_adulto32"/></td>
		<td><input type="checkbox"  class="periapical" name="estudios[29]" value="80" id="periapical_adulto33"/></td>
		<td><input type="checkbox" class="periapical"  name="estudios[29]" value="80" id="periapical_adulto34"/></td>
		<td><input type="checkbox"  class="periapical" name="estudios[29]" value="80" id="periapical_adulto35"/></td>
		<td><input type="checkbox"  class="periapical" name="estudios[29]" value="80" id="periapical_adulto36"/></td>
		<td><input type="checkbox"  class="periapical" name="estudios[29]" value="80" id="periapical_adulto37"/></td>
		<td><input type="checkbox"  class="periapical" name="estudios[29]" value="80" id="periapical_adulto38"/></td>
	  </tr>
	  <tr>
		<td>48</td>
		<td>47</td>
		<td>46</td>
		<td>45</td>
		<td>44</td>
		<td>43</td>
		<td>42</td>
		<td>41</td>
		<td>31</td>
		<td>32</td>
		<td>33</td>
		<td>34</td>
		<td>35</td>
		<td>36</td>
		<td>37</td>
		<td>38</td>
	  </tr>
	  <tr class="tg-even">
		<td><input type="checkbox"  class="periapical" name="estudios[29]" value="80" id="periapical_adulto48"/></td>
		<td><input type="checkbox"  class="periapical" name="estudios[29]" value="80" id="periapical_adulto47"/></td>
		<td><input type="checkbox"  class="periapical" name="estudios[29]" value="80" id="periapical_adulto46"/></td>
		<td><input type="checkbox"  class="periapical" name="estudios[29]" value="80" id="periapical_adulto45"/></td>
		<td><input type="checkbox"  class="periapical" name="estudios[29]" value="80" id="periapical_adulto44"/></td>
		<td><input type="checkbox"  class="periapical" name="estudios[29]" value="80" id="periapical_adulto43"/></td>
		<td><input type="checkbox"  class="periapical" name="estudios[29]" value="80" id="periapical_adulto42"/></td>
		<td><input type="checkbox"  class="periapical" name="estudios[29]" value="80" id="periapical_adulto41"/></td>
		<td><input type="checkbox"  class="periapical" name="estudios[29]" value="80" id="periapical_adulto31"/></td>
		<td><input type="checkbox"  class="periapical" name="estudios[29]" value="80" id="periapical_adulto32"/></td>
		<td><input type="checkbox"  class="periapical" name="estudios[29]" value="80" id="periapical_adulto33"/></td>
		<td><input type="checkbox"  class="periapical" name="estudios[29]" value="80" id="periapical_adulto34"/></td>
		<td><input type="checkbox"  class="periapical" name="estudios[29]" value="80" id="periapical_adulto35"/></td>
		<td><input type="checkbox"  class="periapical" name="estudios[29]" value="80" id="periapical_adulto36"/></td>
		<td><input type="checkbox"  class="periapical" name="estudios[29]" value="80" id="periapical_adulto37"/></td>
		<td><input type="checkbox"  class="periapical" name="estudios[29]" value="80" id="periapical_adulto38"/></td>
	  </tr>
	</table>
<table id="tabla_periapical_nino" class="tg-table-plain">
  <tr>
	<td  class="tg-bf" rowspan="4" id="titulo_tabla_nino">
		Periapical Niño
	</td>
	<td>55</td>
    <td>54</td>
    <td>53</td>
    <td>52</td>
    <td>51</td>
    <td>61</td>
    <td>62</td>
    <td>63</td>
    <td>64</td>
    <td>65</td>
  </tr>
  <tr class="tg-even">
    <td><input type="checkbox"  class="periapical" name="estudios[29]" value="80" id="periapical_nino55"/></td>
    <td><input type="checkbox"  class="periapical" name="estudios[29]" value="80" id="periapical_nino54"/></td>
    <td><input type="checkbox"  class="periapical" name="estudios[29]" value="80" id="periapical_nino53"/></td>
    <td><input type="checkbox"  class="periapical" name="estudios[29]" value="80" id="periapical_nino52"/></td>
    <td><input type="checkbox"  class="periapical" name="estudios[29]" value="80" id="periapical_nino51"/></td>
    <td><input type="checkbox"  class="periapical" name="estudios[29]" value="80" id="periapical_nino61"/></td>
    <td><input type="checkbox"  class="periapical" name="estudios[29]" value="80" id="periapical_nino62"/></td>
    <td><input type="checkbox"  class="periapical" name="estudios[29]" value="80" id="periapical_nino63"/></td>
    <td><input type="checkbox"  class="periapical" name="estudios[29]" value="80" id="periapical_nino64"/></td>
    <td><input type="checkbox"  class="periapical" name="estudios[29]" value="80" id="periapical_nino65"/></td>
  </tr>
  <tr>
    <td>85</td>
    <td>84</td>
    <td>83</td>
    <td>82</td>
    <td>81</td>
    <td>71</td>
    <td>72</td>
    <td>73</td>
    <td>74</td>
    <td>75</td>
  </tr>
  <tr class="tg-even">
    <td><input type="checkbox"  class="periapical" name="estudios[29]" value="80" id="periapical_adulto48"/></td>
    <td><input type="checkbox"  class="periapical" name="estudios[29]" value="80" id="periapical_adulto47"/></td>
    <td><input type="checkbox"  class="periapical" name="estudios[29]" value="80" id=" periapical_adulto46"/></td>
    <td><input type="checkbox"  class="periapical" name="estudios[29]" value="80" id="periapical_adulto45"/></td>
    <td><input type="checkbox"  class="periapical" name="estudios[29]" value="80" id="periapical_adulto44"/></td>
    <td><input type="checkbox"  class="periapical" name="estudios[29]" value="80" id="periapical_adulto43"/></td>
    <td><input type="checkbox"  class="periapical" name="estudios[29]" value="80" id="periapical_adulto42"/></td>
    <td><input type="checkbox"  class="periapical" name="estudios[29]" value="80" id="periapical_adulto41"/></td>
    <td><input type="checkbox"  class="periapical" name="estudios[29]" value="80" id="periapical_adulto31"/></td>
    <td><input type="checkbox"  class="periapical" name="estudios[29]" value="80" id="periapical_adulto32"/></td>
  </tr>
</table>
<br>
	<li class="form-line" id="id_8">
			<label class="form-label-left" id="label_8" for="chk_enviar_consultorio"> Enviar a Consultorio </label>
			<div id="cid_8" class="form-input-wide">
			  <div class="form-single-column">
				  <span class="form-radio-item" style="clear:left;">
						<input type="checkbox" class="form-radio" id="chk_enviar_consultorio" name="enviar_consultorio" value="1" />
				  </span>
			  </div>
			</div>
		</li>
      <li class="form-line" id="id_16">
        <label class="form-label-left" id="label_16" for="txt_fecha_entrega"> Fecha de Entrega *</label>
        <div id="cid_16" class="form-input">
			<span class="form-sub-label-container">
				<input class="form-textbox" id="txt_fecha_entrega" name="fecha_entrega" size="10" value="" />
				<label class="form-sub-label" for="txt_fecha_entrega" id="sublabel_fecha_entrega"> DD/MM/AAAA </label>
			</span>
        </div>
      </li>	
	  <div class="row">
		<div class="col-sm-4 col-sm-offset-4">
			<button type="button" id="btn_adicionales" class="btn btn-primary btn-block" >
				<i class="fa fa-plus"></i> Estudios Adicionales
			</button>
		</div>
		
	  </div>
	  <div class="row">
		
<div id="modal_adicional" >
    <div class="modal-body">
		<div class="row">
			<div class="col-sm-1 hide">
				 <label class="form-control-label">Cant.</label>
				<input type="text" name="cant_adicional" id="cant_adicional" value="1" class="form-control">
			</div>
			<div class="col-sm-5">
				 <label class="form-control-label">Estudio</label>
				<input type="text" name="estudio_adicional" id="estudio_adicional" class="form-control">
				<input type="hidden" name="id_estudio_adicional" id="id_estudio_adicional" class="form-control">
			</div>
			<div class="col-sm-2">
				<label  class="form-control-label">Precio</label>
				<input type="text" name="precio_adicional" id="precio_adicional" class="form-control">
			</div>
			<div class="col-sm-2 ">
				<label class="form-control-label">Subtotal</label>
				<input type="text" name="subtotal_adicional" id="subtotal_adicional" class="form-control">
			</div>
			<div class="col-sm-1">
				<label  class="form-control-label">--</label>
				<button type="button" id="btn_add_adicional"  class="btn btn-success" >Agregar</button>
			</div>
		</div>
		<hr>
		<div class="table" id="tabla_adicionales">
		
		</div>
	
    </div>
     
</div>
		
	  </div>
	  <li class="form-line form-line-column" id="id_8">
			<div id="div_factura">
				<input type="checkbox" name="factura" id="chk_factura"/><label for="chk_factura"> Recibo de Honorarios</label>
				<div id="datos_cliente">
					<div id="div_cliente">
						<table class="tabla_factura">
							<tr>
								<td>Nombre* </td>
								<td><input type="text" name="txt_cliente" id="txt_cliente" size="50" />	</td>	
							</tr>
							<tr>
								<td>RFC *</td>
								<td><input type="text" name="txt_rfc" id="txt_rfc" size="20" maxlength="15"/></td>	
							</tr>	
							<tr>
								<td>Domicilio*</td>
								<td><input type="text" name="txt_domicilio" size="80" /></td>
							</tr>
							<tr>
								<td>Cuidad y Estado *</td>
								<td><input type=z"text" name="txt_ciudad" size="30" /></td>
							</tr>
							<tr>
								<td>Código Postal</td>
								<td><input type="text" name="txt_cp" size="5" maxlength="5"/></td>
							</tr>
							<tr id="tel">
								<td>Teléfono:</td>
								<td><input type="text" name="txt_tel" id="txt_tel" /></td>
							</tr>
							<tr id="mail">
								<td>Email </td>
								<td><input type="text" name="txt_mail" id="txt_mail" size="40" /></td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</li>
    <li class="form-line" id="id_2">
        <div id="cid_2" class="form-input-wide">
          <div style="margin-left:166px" class="form-buttons-wrapper">
						<div class="subtitulo" id="">
							Serie: 
							<select id="serie" name="tipo_folio"> 
								<option value="A">A</option>
								<option value="B">B</option>
							</select>
							
							Folio: <span id="span_folio_actual"><i class="fa fa-spinner fa-spin"></i></span>
							<input type="hidden" id="folio_actual" name="folio_actual">
						</div>
						<div class="subtitulo" id="div_subtotal">
							Subtotal: $ <span id="span_subtotal"></span>
						</div>
						<div class="subtitulo" id="div_descuento">
							<input class="form-textbox" id="txt_descuento" name="porc_descuento"  size="5" />%
							Descuento: $ <span id="span_descuento"> </span>
						</div>
						<div class="subtitulo" id="div_total">
							Total: $ <span id="span_importe_total" > </span>
						</div>
						<div class="subtitulo" id="div_total">
							Anticipo: $ <input class="form-textbox" id="txt_anticipo" name="anticipo" size="5"  />
							<span id="span_anticipo" > </span>
						</div>
						<div class="subtitulo" id="div_total">
							Medio de Pago: <br>
							
							<input type="radio" class="form-radio medio_pago" id="radio_efectivo" name="medio_pago" value="Efectivo" checked="checked"/>
							<label for="radio_efectivo"> Efectivo </label>
							<br>
							<input type="radio" class="form-radio medio_pago" id="radio_tarjeta" name="medio_pago" value="Tarjeta" />
								<label for="radio_tarjeta"> Tarjeta </label>
								<br>
							<input type="radio" data-toggle="modal" data-target="#modal_mixto" class="form-radio medio_pago" id="mixto" name="medio_pago" value="Mixto" />
								<label for="mixto"> Mixto </label>
								
						</div>
						<div class="subtitulo" id="div_total">
							Restante: $ <span id="span_restante" > </span>
						</div>
						<button id="boton_guardar" name="guardar" type="button" class="btn btn-success">
										<i class="fa fa-save"></i> GUARDAR <i id="load_guardar" class="fa fa-spin fa-spinner hide"></i>
									</button>
						<input type="hidden" name="subtotal" id="val_subtotal" />
						<input type="hidden" name="descuento" id="val_descuento" />
						<input type="hidden" name="importe_total" id="val_importe_total" />
						<input type="hidden" name="restante" id="val_restante" />
						<input type="hidden" name="importe_total_letra" id="val_importe_total_letra" />
        </div>
			</div>
    </li>
    </ul>
  </div>
  <!-- Modal -->
<div id="modal_mixto" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Escribe cantidades</h4>
      </div>
      <div class="modal-body">
		<div class="row">
			<div class="col-sm-6">
				 <label class="form-control-label">Efectivo</label>
				<input type="text" name="efectivo" id="efectivo" class="form-control numbers_only">
			
			</div>
			<div class="col-sm-6">
				<label for="tarjeta" class="form-control-label">Tarjeta</label>
				<input type="text" name="tarjeta" id="total_tarjeta" class="form-control ">
			</div>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" id="btn_guardar_pago" data-dismiss="modal" class="btn btn-success" >OK</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>

  </div>
</div>
  <!-- Modal -->


</form>
	


</div>


<?php include("footer_sync.php");?>
<?php include("footer.php");?>
</div>  <!-- Container -->
</body>
</html>