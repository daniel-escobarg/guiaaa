<?php 
include_once '../resources/dbconnect.php';									
$page_name = 'Contactanos';
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

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
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

<body> 		<div class="webtitle"> <a href="../"> <?php echo"$site_name";?></a> </div>

	<div class="top-bar"></div>

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
			
	<div class="Contacto">
		<h3> Contactanos </h3>
		<form name="contactform" method="post" action="send_form_email.php">
		  <input  type="text" name="first_name" maxlength="50"  placeholder="Nombre" size="30">
		  <br>
		  <input  type="text" name="last_name" maxlength="50" placeholder="Apellido" size="30">
		  <br>
		  <input  type="text" name="email" maxlength="80" placeholder="Correo Electronico" size="30">
		  <br>
		  <input  type="text" name="telephone" maxlength="30" placeholder="Telefono" size="30">
		  <br>
		  <textarea  name="comments" maxlength="1000" cols="28" placeholder="Mensaje" rows="6"></textarea>
		  <br> 
		  <input type="submit" value="Enviar">   
		</form>
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