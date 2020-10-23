<?php 
	include_once '../resources/dbconnect.php';									
	$C='Comida'; 	
	$Loc=$_GET["loc"];
	$page_name = $C;

	$sql = mysqli_query($conn, "SELECT directory FROM Page WHERE name='$page_name'");
	while($row = mysqli_fetch_array($sql)) 
	$pagelink = $row['0'];

	$sql = mysqli_query($conn, "SELECT value2 FROM Variable WHERE value1='Sitename'");
	while($row = mysqli_fetch_array($sql)) 
	$site_name = $row['0'];

	$sql = mysqli_query($conn, "SELECT value2 FROM Variable WHERE value1='Description Tags'");
	while($row = mysqli_fetch_array($sql)) 
	$description_tags= $row['0'];

	$sql = mysqli_query($conn, "SELECT value2 FROM Variable WHERE value1='Keywords Tags'");
	while($row = mysqli_fetch_array($sql)) 
	$keywords_tags = $row['0'];

	$sql = mysqli_query($conn, "SELECT value2 FROM Variable WHERE value1='Bar color'");
	while($row = mysqli_fetch_array($sql)) 
	$bar_color = $row['0'];

	$sql = mysqli_query($conn, "SELECT value2 FROM Variable WHERE value1='Search placeholder'");
	while($row = mysqli_fetch_array($sql)) 
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
			<form name="searchbar" action="../busqueda" method="GET">
			<input type="text" name="q" required="1" max="10" placeholder="<?php echo"$search_placeholder";?>"/><input type="submit"  value="">
			<input value="%%" name="d" hidden="">
			<input value="%%" name="c" hidden="">
			<input value="%%" name="p" hidden="">
			<select name="loc" required>
					<option value="<?php echo"$Loc";?>"><?php echo"$Loc";?></option>
					<option value="noplace" disabled>Escoge un lugar</option>
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

		<div class="cat-sidebar">
			<a href='../'>Inicio</a>
			<br><br>
			<?php $result = mysqli_query($conn, "SELECT name, directory FROM Page WHERE type='Categorias' AND id_item > 29 ORDER BY id_item "); while($row = mysqli_fetch_array($result)) {echo "<a href='../".$row{'directory'}."?loc=$Loc'>".$row{'name'}."</a><br><br>";}?>
		</div>
		
		<div class='main-results'> 
			<table>
				<?php
					date_default_timezone_set('America/Bogota');
					setlocale(LC_ALL,"ec_ES");
					$hoy = strftime("%u");
					$abretoday = "abre_$hoy";
					$cierratoday = "cierra_$hoy";
					echo"";
					$result = mysqli_query($conn, "SELECT COUNT(Establecimiento.nombre) as count FROM Establecimiento, Establecimiento_subcategoria, Categoria, Subcategoria WHERE Categoria.Nombre LIKE '%$C%' AND Establecimiento.id_establecimiento = Establecimiento_subcategoria.id_establecimiento AND Subcategoria.id_subcategoria = Establecimiento_subcategoria.id_subcategoria GROUP BY Establecimiento_subcategoria.id_establecimiento"); 
					while($row = mysqli_fetch_array($result)) 
						{echo "<tr><td></td> <td> <div class='main-results-count'>".$row{'count'}." resultado(s) de $C en $Loc </div> </td> <td> </td> </tr>";} echo"<tr> </tr>";
					
					$result = mysqli_query($conn, "SELECT Establecimiento.id_establecimiento, Nombre.id_establecimientom, Establecimiento.price_range, Establecimiento.logo_url, Establecimiento.telef_1, Establecimiento.telef_2, Establecimiento.direccion, Establecimiento.delivery, Establecimiento.tarjeta, Establecimiento.parqueo FROM Establecimiento, Establecimiento_subcategoria, Categoria, Subcategoria WHERE Categoria.Nombre LIKE '%$C%' AND Establecimiento.id_establecimiento = Establecimiento_subcategoria.id_establecimiento AND Subcategoria.id_subcategoria = Establecimiento_subcategoria.id_subcategoria GROUP BY Establecimiento.id_establecimiento");
						while($row = mysqli_fetch_array($result)) 
						{echo "<tr>
						<td>
							<a href='../biz/?id=".$row{'id_establecimiento'}."&loc=$Loc'> <div class='main-results-logo' style='background: white url(".$row{'logo_url'}.") no-repeat center; background-size: 10vw;'></div></a>
						</td>
						<td>
							<div class='main-results-precio'>".$row{'price_range'}." </div> 
							<div class='main-results-nombre'> <a href='../biz/?id=".$row{'id_establecimiento'}."&loc=$Loc'> 
									".$row{'nombre'}."</a> </div>
							
							<div class='main-results-sum'>
								<b> Hoy </b> 
								<br><br>
								<img id='icon' src='https://cdn4.iconfinder.com/data/icons/standard-free-icons/139/Call01-32.png'> ".$row{'telef_1'}." &middot; ".$row{'telef_2'}."
								<br>
								<img id='icon' src='https://cdn2.iconfinder.com/data/icons/social-networks-7/128/Socialmedia_icons_Navigation-32.png'> ".$row{'direccion'}."
							</div>
						</td>
						<td>
							<div class='main-results-servicios'>
								<b>Servicios</b>								
								<br>
								Servicio a domicilio <b> ".$row{'delivery'}." </b>
								<br>
								Acepta tarjetas de crédito <b> ".$row{'tarjeta'}."</b>
								<br>
								Estacionamiento <b>".$row{'parqueo'}."</b>
								<br>
								Wi-fi <b> ".$row{'wifi'}."</b>
								<br>
								<a href='../biz/?id=".$row{'id_establecimiento'}."&loc=$Loc'> 
								<b> Horario Completo </b> </a>
							</div>
						</td>
					</tr><tr></tr>";}?>
					</table>
				</div>
		</div> 
		<div class="footer-categoria">
			<table>
				<tr>
					<td> © <?php echo"$site_name";?> </td>
					<td>
						<b><?php echo"$site_name";?></b>
						<br>
						<?php $result = mysqli_query($conn, "SELECT name, directory FROM Page WHERE type='Principal' ORDER BY id_item "); while($row = mysqli_fetch_array($result)) 
						{echo "<a href='../".$row{'directory'}."'>".$row{'name'}."</a><br>";}?>
					</td> 
					<td> 
						<b> Ciudades </b>
						<br>
						<?php $result = mysqli_query($conn, "SELECT nombre FROM Ciudad "); while($row = mysqli_fetch_array($result)) 
						{echo "<a href='".$row{'nombre'}."'>".$row{'nombre'}."</a><br>";}?>
					</td> 
					<td>
						<b> Otros links </b>
						<br>
						<?php $result = mysqli_query($conn, "SELECT name, directory FROM Page WHERE type='Otros links' ORDER BY id_item "); while($row = mysqli_fetch_array($result)) 
						{echo "<a href='../".$row{'directory'}."'>".$row{'name'}."</a><br>";}?>
					</td>
				<tr>
			</table>
		</div>
	</body>
</html>