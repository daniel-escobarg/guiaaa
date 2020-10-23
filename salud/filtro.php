<?php 
include_once '../resources/dbconnect.php';									
$C='Salud'; 	
$Loc=$_GET["loc"];
$page_name = $C;

if(empty($_GET['loc'])) 
{ 
  header('Location: ../');
  exit; 
}

$sql = mysql_query("SELECT directory FROM Page WHERE name='$C'");
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

date_default_timezone_set('America/Bogota');
setlocale(LC_ALL,"ec_ES");
$hoy = strftime("%u");
$time = strftime("%T");
$abretoday = "abre_$hoy";
$cierratoday = "cierra_$hoy";

$SC=$_GET["sc"];
$D=$_GET["d"];
$P=$_GET["p"];
?>

<html> 
	<head>
		<title> <?php echo"$page_name";?>  | <?php echo"$site_name";?> </title>
		<link rel="stylesheet" type="text/css" href="../resources/style.css">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta http-equiv="Content-Type" content="text/html; charset=ISO8859-15" />

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
			<?php $result = mysql_query("SELECT name, directory FROM Page WHERE type='Categorias' AND id_item > 29 ORDER BY id_item "); while($row = mysql_fetch_array($result)) {echo "<a href='../".$row{'directory'}."?loc=$Loc'>".$row{'name'}."</a><br><br>";}?>
		</div>

		
		<div class="banner-ad-1">
		PUBLICIDAD
		</div>

		<div class="main-results-filter">
			<div id="header">Filtros </div>
				<form name="categorysearch" id="categorysearch" action="filtro.php" method="GET">
					<select name="sc" required> 
					<option value="%%"  disabled> Tipo de <?php echo"$C";?> </option>
					<option value="%%"> Todas </option>
					<?php
					$result = mysql_query("SELECT sub_categorias.subcategoria  FROM sub_categorias, Establecimiento WHERE sub_categorias.categoria ='$C' AND (sub_categorias.subcategoria = Establecimiento.sub_categoria1 OR sub_categorias.subcategoria = Establecimiento.sub_categoria2 OR sub_categorias.subcategoria = Establecimiento.sub_categoria3) AND (Establecimiento.zona LIKE '%$Loc%' or Establecimiento.ciudad LIKE '%$Loc%') GROUP BY subcategoria"); 
					while($row = mysql_fetch_array($result)) {echo "<option value='".$row{'subcategoria'}."'>".$row{'subcategoria'}."</option>";} 
					?> 
					</select>
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
					<select name="d" required> 
						<option value="%%" selected > Delivery </option>
						<option value="Sí"> Sí </option>
						<option value="%%"> No Importa </option>
					</select>
					<select name="p" required> 
						<option value="%%" selected> Precios </option>
						<option value="%%"> Todo </option>
						<option value="$"> $ &middot; $1-$10 </option>
						<option value="$$"> $$ &middot; $11-$25 </option>
						<option value="$$$"> $$$ &middot; $25-$40 </option>
						<option value="$$$$"> $$$$ &middot; $41-$60 </option>
						<option value="$$$$$"> $$$$$ &middot; $61+ </option>
					</select>
				
				<input type="submit" name='categorysearch' id='categorysearch' form="categorysearch" value="Filtrar">
				</form>
		</div>
		
		<div class='main-results'> 
			<table>
					<?php
					echo"";
					$result=mysql_query("SELECT COUNT(id_establecimiento) as count FROM Establecimiento WHERE categoria LIKE '%$C%' AND (Establecimiento.zona LIKE '%$Loc%' or Establecimiento.ciudad LIKE '%$Loc%') AND (sub_categoria1 LIKE '%$SC%' OR sub_categoria2 LIKE '%$SC%' OR sub_categoria3 LIKE '%$SC%') AND delivery LIKE '$D' AND price_range LIKE '$P' ");
					while($row = mysql_fetch_array($result)) {echo "<tr><td></td> <td> <div class='main-results-count'>".$row{'count'}." resultado(s) de $C en $Loc </div> </td> <td> </td> </tr>";} echo"<tr> </tr>";
					
						$result = mysql_query("SELECT id_establecimiento, logo_url, menu_link, nombre, categoria, price_range, sub_categoria1, sub_categoria2, sub_categoria3, telef_1, telef_2, direccion, sitio_web, delivery, tarjeta, parqueo, wifi, alcohol, area_fumador, tv, Rango_precio.rango as rango, DATE_FORMAT(abre_1,'%H:%i') as abre_1, DATE_FORMAT(abre_2,'%H:%i') as abre_2, DATE_FORMAT(abre_3,'%H:%i') as abre_3, DATE_FORMAT(abre_4,'%H:%i') as abre_4, DATE_FORMAT(abre_5,'%H:%i') as abre_5, DATE_FORMAT(abre_6,'%H:%i') as abre_6, DATE_FORMAT(abre_7,'%H:%i') as abre_7, DATE_FORMAT(cierra_1,'%H:%i') as cierra_1, DATE_FORMAT(cierra_2,'%H:%i') as cierra_2, DATE_FORMAT(cierra_3,'%H:%i') as cierra_3, DATE_FORMAT(cierra_4,'%H:%i') as cierra_4, DATE_FORMAT(cierra_5,'%H:%i') as cierra_5, DATE_FORMAT(cierra_6,'%H:%i') as cierra_6, DATE_FORMAT(cierra_7,'%H:%i') as cierra_7,  DATE_FORMAT($abretoday,'%H:%i') as abre_hoy, DATE_FORMAT($cierratoday,'%H:%i') as cierra_hoy
						FROM Establecimiento, Rango_precio
						WHERE Rango_precio.signo = price_range AND categoria LIKE '%$C%' AND (Establecimiento.zona LIKE '%$Loc%' or Establecimiento.ciudad LIKE '%$Loc%') AND (sub_categoria1 LIKE '$SC' OR sub_categoria2 LIKE '$SC' OR sub_categoria3 LIKE '$SC' OR sub_categoria1 LIKE '$SC') AND delivery LIKE '$D' AND price_range LIKE '$P' ORDER BY special DESC, id_establecimiento ASC  limit 50 ");
						while($row = mysql_fetch_array($result)) 
						{echo "<tr>
						<td>
							<a href='../biz/?id=".$row{'id_establecimiento'}."&loc=$Loc'> <div class='main-results-logo' style='background: white url(".$row{'logo_url'}.") no-repeat center; background-size: 10vw;'></div></a>
						</td>
						<td>
							<div class='main-results-precio'>".$row{'price_range'}." </div> 
							<div class='main-results-nombre'> <a href='../biz/?id=".$row{'id_establecimiento'}."&loc=$Loc'> 
									".$row{'nombre'}."</a> </div>
							<div class='main-results-sub'><a href='../busqueda/cat.php?q=".$row{'sub_categoria1'}."&loc=$Loc'>".$row{'sub_categoria1'}."</a> 
								&middot; 
								<a href='../../busqueda/cat.php?q=".$row{'sub_categoria2'}."&loc=$Loc'>".$row{'sub_categoria2'}."</a>  &middot; <a href='../../busqueda/cat.php?q=".$row{'sub_categoria3'}."&loc=$Loc'>".$row{'sub_categoria3'}."</a>  
								<br>
							</div> 
							<div class='main-results-sum'>
								<b> Hoy </b> ".$row{'abre_hoy'}." - ".$row{'cierra_hoy'}." 
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

		
	</body> 

	<footer>

	</footer>
</html>