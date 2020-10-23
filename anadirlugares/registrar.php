<?php
include_once '../resources/dbconnect.php';									
$page_name = 'Añadir lugares';
$C=$page_name; 	

$sql = mysql_query("SELECT directory FROM Page WHERE name='$page_name'");
while($row = mysql_fetch_array($sql)) 
$pagelink = $row['0'];

$sql = mysql_query("SELECT value2 FROM Variable WHERE value1='Sitename'");
while($row = mysql_fetch_array($sql)) 
$site_name = $row['0'];

$sql = mysql_query("SELECT value2 FROM Variable WHERE value1='Description Tags'");
while($row = mysql_fetch_array($sql)) 
$description_tags = $row['0'];

$sql = mysql_query("SELECT value2 FROM Variable WHERE value1='Keywords Tags'");
while($row = mysql_fetch_array($sql)) 
$keywords_tags = $row['0'];

$sql = mysql_query("SELECT value2 FROM Variable WHERE value1='Bar color'");
while($row = mysql_fetch_array($sql)) 
$bar_color = $row['0'];

$sql = mysql_query("SELECT value2 FROM Variable WHERE value1='Search placeholder'");
while($row = mysql_fetch_array($sql)) 
$search_placeholder = $row['0'];

$conn = new mysqli('guiaaa.com','guiausuario', 'guia2016', 'Guia');
if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);} 
$N=$_POST["nombre"]; $ST=$_POST["search_tags"]; 
$C=$_POST["categoria"]; $SB1=$_POST["subcategoria1"]; 
$SB2=$_POST["subcategoria2"]; $SB3=$_POST["subcategoria3"]; 
$Alun=$_POST["abre_lun"]; $Clun=$_POST["cierra_lun"]; 
$Amar=$_POST["abre_mar"]; $Cmar=$_POST["cierra_mar"]; 
$Amie=$_POST["abre_mie"]; $Cmie=$_POST["cierra_mie"]; 
$Ajue=$_POST["abre_jue"]; $Cjue=$_POST["cierra_jue"]; 
$Avie=$_POST["abre_vie"]; $Cvie=$_POST["cierra_vie"]; 
$Asab=$_POST["abre_sab"]; $Csab=$_POST["cierra_sab"]; 
$Adom=$_POST["abre_dom"]; $Cdom=$_POST["cierra_dom"]; 
$T1=$_POST["telef_1"];$T2=$_POST["telef_2"]; 
$CD=$_POST["ciudad"]; $ZN=$_POST["zona"]; 
$Dir=$_POST["direccion"]; $SW=$_POST["sitio_web"]; 
$Dom=$_POST["domicilio"]; $PR=$_POST["rango"]; 
$T=$_POST["tarjeta"]; $W=$_POST["wifi"]; 
$A=$_POST["alcohol"]; $F=$_POST["fumador"]; 
$P=$_POST["parqueo"]; $TV=$_POST["tv"]; 
$Logo=$_POST["logo"]; $Menu=$_POST["menu"]; 
error_reporting(0); 

$sql ="INSERT INTO Establecimiento VALUES (DEFAULT,'$N','$Logo','$C','$SB1','$SB2','$SB3','$Menu','$PR','$Dir','$T1','$T2','$SW','$Dom','$T','$P','$W','$TV','$A','$F','','$ST','$Alun','$Amar','$Amie','$Ajue','$Avie','$Asab','$Adom','$Clun','$Cmar','$Cmie','$Cjue','$Cvie','$Csab','$Cdom','$ZN','$CD','Pending', DEFAULT, NOW())";
	if ($conn->query($sql) === TRUE) {print "";} 
	else {print "No se pudo registrar" . $conn->error;}
	$conn->close();
error_reporting(0);
?>
<html> 
	<head>
		<title> <?php echo"$page_name";?>  | <?php echo"$site_name";?> </title>
		<meta name="description" content="<?php echo"$description_tags";?>">
		<meta name="keywords" content="<?php echo"$keywords_tags";?>">

		<link rel="stylesheet" type="text/css" href="../resources/style.css">

		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<script type="text/javascript">
		<!--
		if (screen.width <= 699) {
		document.location = "../../m/<?php echo"$pagelink";?>";
		}
		//-->
		</script>
	</head> 

	<body> 
		<div class="webtitle"> <a href="../"> <?php echo"$site_name";?></a> </div>

		<div class="top-bar"> </div>
		
		<div class="banner-ad-1">Publicidad</div>

		<<div class="search-area">
		<div class="search-bar">
		<form name="searchbar" action="../busqueda" method="GET">
		<input type="text" name="q" required="1" max="10" placeholder="<?php echo"$search_placeholder";?>"/><input type="submit"  value="">
		<input value="%%" name="d" hidden="">
		<input value="%%" name="c" hidden="">
		<input value="%%" name="p" hidden="">
		<select name="loc" required>
				<option value="" disabled>Escoge un lugar</option>
				<option value="Guayaquil">Guayaquil</option>
				<option value="Samborondón">&emsp;Samborondón</option>
				<option value="Vía a la costa">&emsp;Vía a la Costa</option>
				<option value="Puerto Santa Ana">&emsp;Puerto Santa Ana</option>
				<option value="Santa Elena">Santa Elena</option>
				<option value="Salinas">&emsp;Salinas</option>
				<option value="Libertad">&emsp;Libertad</option>
				<option value="Puerto Lucia">&emsp;Puerto Lucia</option>
				<option value="Ballenita">&emsp;Ballenita</option>
				<option value="Montañita">&emsp;Montañita</option>
				<option value="Olon">&emsp;Olon</option>
			</select>				
		</form>
		</div>
	</div>

	<div class="ag-lugares-content">
		<h3> Añadir un lugar </h3>
		<p> <?php echo"$N";?> ha sido ingresado, el lugar no aparecera hasta ser aprovado. </p>
	<div class="ag-lugares-form">
		
		<table>
			<tr>
			<td>
				<form action="registrar.php" method="POST">
					<input type="text" name="nombre"  size="35"  placeholder="Nombre del lugar" required>
					<br>
					<textarea name="search_tags" required rows="2" cols="33" placeholder="Palabras Claves: #vegetariano #" /></textarea>
					<br>
					<select id="categoria" name="categoria" required>
					<option selected disabled> Categoria* </option>
						<?php header('Content-Type:text/html; charset=UTF-8'); header('Content-Type:text/html; charset=UTF-15'); 
						$result = mysql_query("SELECT categoria FROM sub_categorias GROUP BY categoria ORDER BY categoria ASC");
						while($row = mysql_fetch_array($result)) {echo "<option value='".$row{'categoria'}."'>".$row{'categoria'}." </option>";} 
						?> 
					</select>
					<br><br>
					<select name="subcategoria1"> 
						<option value=" " selected disabled> Sub categoria* </option>
						<?php header('Content-Type:text/html; charset=UTF-8'); header('Content-Type:text/html; charset=UTF-15'); 
						$result = mysql_query("SELECT subcategoria, categoria FROM sub_categorias ORDER BY categoria ASC");
						while($row = mysql_fetch_array($result)) {echo "<option value='".$row{'subcategoria'}."'>".$row{'categoria'}." &middot; ".$row{'subcategoria'}."</option>";} 
						?> 
					</select>
					<br><br>
					<select name="subcategoria2"> 
						<option value=" " selected disabled> Sub categoria </option>
						<?php 
						$result = mysql_query("SELECT subcategoria, categoria FROM sub_categorias ORDER BY categoria ASC");
						while($row = mysql_fetch_array($result)) {echo "<option value='".$row{'subcategoria'}."'>".$row{'categoria'}." &middot; ".$row{'subcategoria'}."</option>";} 
						?> 
					</select>
					<br><br>
					<select name="subcategoria3"> 
						<option value=" " selected disabled> Sub categoria </option>
						<?php
						$result = mysql_query("SELECT subcategoria, categoria FROM sub_categorias ORDER BY categoria ASC");
						while($row = mysql_fetch_array($result)) {echo "<option value='".$row{'subcategoria'}."'>".$row{'categoria'}." &middot; ".$row{'subcategoria'}."</option>";} 
						?> 
					</select>
					
					<br><br>
					<div id="horario">
					Horario* 
					<br>
					lun.&nbsp;&nbsp;&emsp;<input type="text" size="6" maxlength="5" name="abre_lun" placeholder="00:00"> - <input type="text" size="6" maxlength="5"  name="cierra_lun" placeholder="00:00">
					<br>
					mar.&nbsp;&emsp;<input type="text" size="6" maxlength="5" name="abre_mar" placeholder="00:00"> - <input type="text" size="6" maxlength="5"  name="cierra_mar" placeholder="00:00">
					<br>
					mié.&nbsp;&emsp;<input type="text" size="6" maxlength="5" name="abre_mie" placeholder="00:00"> - <input type="text" size="6" maxlength="5"  name="cierra_mie" placeholder="00:00">
					<br>
					jue.&nbsp;&nbsp;&emsp;<input type="text" size="6" maxlength="5" name="abre_jue" placeholder="00:00"> - <input type="text" size="6" maxlength="5"  name="cierra_jue" placeholder="00:00">
					<br>
					vie.&nbsp;&nbsp;&emsp;<input type="text" size="6" maxlength="5" name="abre_vie" placeholder="00:00"> - <input type="text" size="6" maxlength="5"  name="cierra_vie" placeholder="00:00">
					<br>
					sáb.&nbsp;&emsp;<input type="text" size="6" maxlength="5" name="abre_sab" placeholder="00:00"> - <input type="text" size="6" maxlength="5"  name="cierra_sab" placeholder="00:00">
					<br>
					dom.&nbsp;&nbsp;&nbsp;<input type="text" size="6" maxlength="5" name="abre_dom" placeholder="00:00"> - <input type="text" size="6" maxlength="5"  name="cierra_dom" placeholder="00:00">

					</div>
					<br>
					
					<select name="ciudad" required>
						<option value="" selected disabled> Selecciona la ciudad o provincia* </option>
						<option value="Guayaquil">Ciudad: Guayaquil</option>
						<option value="Santa Elena">Ciudad: Santa Elena</option>
					</select>
					<br>
					<select name="zona" required>
						<option value="" selected disabled> Selecciona el sector* </option>
						<option value="Samborondón">Sector: Samborondón</option>
						<option value="Vía a la Costa">Sector: Vía a la costa</option>
						<option value="Urdesa">Sector: Urdesa</option>
						<option value="Centro">Sector: Centro </option>
						<option value="Norte">Sector: Las Peñas </option>
						<option value="Norte">Sector: Miraflores</option>
						<option value="Santa Elena">Sector: Santa Elena</option>
						<option value="La Libertad">Sector: La Libertad</option>
						<option value="Salinas">Sector: Salinas</option>
						<option value="Ballenita">Sector: Ballenita</option>
						<option value="Puerto Lucia">Sector: Puerto Lucia</option>
						<option value="Punta Blanca">Sector: Punta Blanca</option>
						<option value="Montañita">Sector: Motañita </option>
						<option value="Olon">Sector: Olon </option>
					</select>
					</div>
					</td>
					<td>
					<div class="ag-lugares-form">
					<input type="text" size="35" name="direccion" id="direccion" placeholder="Dirección* - La Piazza, Km. 1,5">
					<br> 
					<input type="text" size="35" name="telef_1" id="telef_1" maxlength="10"  placeholder="Teléfono 1 - 04 5550000" required>
					<br>
					<input type="text" size="35" name="telef_2" id="telef_2" maxlength="10" placeholder="Teléfono 2 - 090000000">
					<br>
					<input type="text" size="35" name="sitio_web" id="sitio_web" placeholder="Página Web - google.com">
					<br>
					
					<br>
					<select name="domicilio" required>
						<option value="" selected disabled> Entrega a domicilio* </option>
						<option value="Sí">Entrega a domicilio: Sí</option>
						<option value="No">Entrega a domicilio: No</option>
						<option> </option>
					</select>
					<br>
					<select name="rango" required>
						<option value='' selected disabled> Rango de precios </option>
						<option value='$'>Rango de precios: $ &middot; $1-10 </option>
						<option value='$$'>Rango de precios: $$ &middot; $11-25 </option>
						<option value='$$$'>Rango de precios: $$$ &middot; $25-40</option>
						<option value='$$$$'>Rango de precios: $$$$ &middot; $41-60</option>
						<option value='$$$$$'>Rango de precios: $$$$$ &middot; $61+</option>
					</select>
					<br>
					<select name="tarjeta" required>
						<option value=" " selected disabled> Aceptan tarjetas* </option>
						<option value="Sí">Aceptan tarjetas: Sí</option>
						<option value="No">Aceptan tarjetas: No</option>
						<option value="">Aceptan tarjetas:</option>
					</select>
					<br>
					<select name="wifi" required>
						<option value=" " selected disabled> Wi-fi* </option>
						<option value="Sí">Wi-Fi: Sí</option>
						<option value="No">Wi-Fi: No</option>
						<option value="">Wi-Fi:</option>
						<option> </option>
					</select>
					<br>
					<select name="alcohol" >
						<option value=" " selected disabled> Sirven alcohol </option>
						<option value="Solo cerveza y vino">Sirven alcohol: Solo cerveza y vino</option>
						<option value="Sí">Sirven alcohol: Sí</option>
						<option value="No">Sirven alcohol: No</option>
						<option value="">Sirven alcohol::</option>
					</select>
					<br>
					<select name="fumador" required>
						<option value=" " selected disabled> Area de fumadores </option>
						<option value="Sí">Area de fumadores: Sí</option>
						<option value="No">Area de fumadores: No</option>
						<option value="Afuera">Area de fumadores: Afuera</option>
						<option value="">Area de fumadores: </option>
						<option> </option>
					</select>
					<br>
					<select name="parqueo" required>
						<option value=" " selected disabled> Parqueo </option>
						<option value="Sí">Parqueo: Sí</option>
						<option value="No">Parqueo: No</option>
						<option value="Calle">Parqueo: En la calle</option>
						<option value="Pagado">Parqueo: Pagado</option>
						<option value="">Parqueo: </option>
					</select>
					<br>
		
					<select name="tv">
						<option value=" " selected disabled> Television </option>
						<option value="Sí">Television: Sí</option>
						<option value="No">Television: No</option>
						<option value="">Television: </option>
						<option> </option>
					</select>
					<br>
					<br>
					Logo URL (Imagenes Cuadradas)
					<br>
					<input type="text"  size="35"  name="logo">
					<br>
					Menú URL (Documento PDF o Pagina)
					<br>
					<input type="text"  size="35"  name="menu">
					
					<p> Al registrar usted aceptando los <br> <a href=""> terminos y condiciones. </a> </p>
					<input type="Submit" value="REGISTRAR">
				</form> 
				</td>
				</tr> 
				</table>
				</div>

</td></form></td></tr></table></div>

	</div>
	<div class="footer">
			<table>
				<tr>
					<td> © <?php echo"$site_name";?> </td>
					<td>
						<b><?php echo"$site_name";?></b>
						<br>
						<?php $result = mysql_query("SELECT name, directory FROM Page WHERE type='Principal' ORDER BY id_item "); while($row = mysql_fetch_array($result)) 
						{echo "<a href='../".$row{'directory'}."'>".$row{'name'}."</a><br>";}?>
					</td> 
					<td> 
						<b> Ciudades </b>
						<br>
						<?php $result = mysql_query("SELECT Location.ciudad, directory FROM Location, Establecimiento WHERE Establecimiento.ciudad = Location.ciudad GROUP BY ciudad"); while($row = mysql_fetch_array($result)) 
						{echo "<a href='../".$row{'ciudad'}."'>".$row{'ciudad'}."</a><br>";}?>
					</td> 
					<td>
						<b> Otros links </b>
						<br>
						<?php $result = mysql_query("SELECT name, directory FROM Page WHERE type='Otros links' ORDER BY id_item "); while($row = mysql_fetch_array($result)) 
						{echo "<a href='../".$row{'directory'}."'>".$row{'name'}."</a><br>";}?>
					</td>
				<tr>
			</table>
		</div>


</body> 


</html>