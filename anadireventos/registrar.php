<?php
	$conn = new mysqli('guiaaa.com','guiausuario', 'guia2016', 'Guia');
	if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);} 
	$N=$_POST["nombre"]; 
	$ST=$_POST["search_tags"]; 
	$D=$_POST["descripcion"]; 
	$CAT=$_POST["categoria"]; 
	$CL=$_POST["clasisficacion"]; 
	$CD=$_POST["ciudad"]; 
	$ZN=$_POST["zona"]; 

 	$vLogo=$_POST["poster_url"]; 


	$sql ="INSERT INTO Evento VALUES (DEFAULT,'$vN','$vLogo','$vC','$vSB1','$vSB2','$vSB3','$vMenu','$vPR','$vDir','$vT1','$vT2','$SW','$vDom','$vT','$vP','$vW','$vTV','$vA','$vF','','$vST','$vAlun','$vAmar','$vAmie','$vAjue','$vAvie','$vAsab','$vAdom','$vClun','$vCmar','$vCmie','$vCjue','$vCvie','$vCsab','$vCdom', $CD, $ZN,'Pending',DEFAULT, DEFAULT)";
	if ($conn->query($sql) === TRUE) {print "Evento $N registrado.";} 
	else {print "No se pudo registrar" . $conn->error;}
	$conn->close();
error_reporting(0);
?>

<?php 
include_once '../resources/dbconnect.php';									
$page_name = 'Añadir eventos';
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

		<div class="search-area">
			<div class="search-bar">
			<form name="searchbar" action="../../busqueda" method="GET">
			<input type="text" name="q" required="1" max="10" placeholder="<?php echo"$search_placeholder";?>"/><input type="submit"  value="">
			<input value="%%" name="d" hidden="">
			<input value="%%" name="c" hidden="">
			<input value="%%" name="p" hidden="">
			<select name="z">
				<option value="%%">Todo</option>
				<option value="Samborondón" selected>Samborondón</option>
				<option value="Via a la costa">Vía a la Costa</option>
			</select>			
			</form>
			</div>
		</div>
	<div class="ag-lugares-content">
		<h3> Añadir un evento </h3>
		<p> El evento no aparecera hasta ser aprovado. </p>
	<div class="ag-lugares-form">
		
		<table>
			<tr>
			<td>
				<form action="registrar.php" method="POST">
					<input type="text" name="nombre"  size="35"  placeholder="Nombre del evento" required>
					<br>
					<textarea name="descripcion" required rows="5" cols="33" placeholder="Descripción del evento" /></textarea>
					<br>
					<textarea name="search_tags" required rows="2" cols="33" placeholder="Palabras Claves: #vegetariano #" /></textarea>
					<br>
					
					<input type="text" name="clasisficacion"  size="35"  placeholder="Clasisficación de evento (Todo Público)" required>
					<br>
					<select id="categoria" name="categoria" required>
					<option selected disabled> Categoria* </option>
						<?php header('Content-Type:text/html; charset=UTF-8'); header('Content-Type:text/html; charset=UTF-15'); 
						$result = mysql_query("SELECT subcategoria FROM sub_categorias WHERE categoria='Eventos' ORDER BY subcategoria ASC");
						while($row = mysql_fetch_array($result)) {echo "<option value='".$row{'subcategoria'}."'>".$row{'subcategoria'}." </option>";} 
						?> 
					</select>
					
					<select name="lugar" required>
						<option value="" selected disabled> Selecciona el lugar* </option>
						<option value="Sí">Zona: Samborondón</option>
						<option value="No">Zona: Vía a la costa</option>
						<option value="999">Otro</option>
					</select>
					<select name="ciudad" required>
						<option value="" selected disabled> Selecciona la ciudad* </option>
						<option value="Guayaquil">Ciudad: Guayaquil</option>
						<option value="Samborondón">Ciudad: Samborondón</option>
						<option value="Samborondón">Ciudad: Salinas</option>
					</select>
					
					
					</div>
					</td>
					<td>
					<div class="ag-lugares-form">
					
					
					

					<div id="horario">
					Hora &nbsp;&nbsp;&emsp;<input type="text" size="6" maxlength="5" name="abre_lun" placeholder="00:00"> - <input type="text" size="6" maxlength="5"  name="cierra_lun" placeholder="00:00"> </div>
					<input type="text" size="35" name="fecha" maxlength="10" placeholder="Fecha- (AA-MM-DD)">
					<br>
					<input type="text" size="35" name="costo" maxlength="10"  placeholder="Costo - $-$" required>
					<br>
					
					<input type="text" size="35" name="sitio_web" id="sitio_web" placeholder="Página Web - google.com">
					<br>
					
					
					<br>
					<input type="text"  size="35"  name="logo" placeholder="Poster Imagen URL">
					<br>
					
					
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
						<b> Lugares </b>
						<br>
						<?php $result = mysql_query("SELECT name, directory FROM Page WHERE type='Lugar' ORDER BY id_item "); while($row = mysql_fetch_array($result)) 
						{echo "<a href='../".$row{'directory'}."'>".$row{'name'}."</a><br>";}?>
					</td> 
					<td>
						<b> Otros links </b>
						<br>
						<?php $result = mysql_query("SELECT name, directory FROM Page WHERE type='Lugar' ORDER BY id_item "); while($row = mysql_fetch_array($result)) 
						{echo "<a href='../".$row{'directory'}."'>".$row{'name'}."</a><br>";}?>
					</td>
				<tr>
			</table>
		</div>

</body> 


</html>