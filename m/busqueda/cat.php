<?php 
include_once '../../resources/dbconnect.php';							
$page_name = 'Busqueda';
$Loc=$_GET["loc"];
$C=$_GET["c"];
$SC=$_GET["sc"];
$D=$_GET["d"];
$P=$_GET["p"];

if(empty($_GET['sc'])) 
{ 
  header('Location: ../');
  exit; 
}
if(empty($_GET['loc'])) 
{ 
  header('Location: ../');
  exit; 
}


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

setlocale(LC_ALL,"ec_ES");
$hoy = strftime("%u");
$abretoday = "abre_$hoy";
$cierratoday = "cierra_$hoy";




?>

<html> 
	<head>
		<title> <?php echo"$SC";?> en <?php echo"$Loc";?> | <?php echo"$site_name";?> </title>
		<link rel="stylesheet" type="text/css" href="../style.css">
		
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta http-equiv="Content-Type" content="text/html; charset=ISO8859-15" />

		
	</head> 

	<body> 
	<div id="mySidenav" class="sidenav">
		<a href="javascript:void(0)" class="closebtn" style="border: 0vw white solid;" onclick="closeNav()">&times;</a>
		<a id="active"href="../busqueda">Busqueda</a>
		<a href="../">Inicio</a>
		<a href="../samborondon">Explora Samborondón</a>
		<a href="../viaalacosta">Explora Vía a la Costa</a>
		<a href="../anadirlugares">Añadir un lugar</a>
		<a href="../anadireventos">Añadir un evento</a>
		<a href="../nosotros">Nosotros</a>
		<a href="../contacto">Contactanos</a>
	</div>

		<script>
		function openNav() {
		document.getElementById("mySidenav").style.width = "90vw";
		}

		function closeNav() {
		document.getElementById("mySidenav").style.width = "0";
		}
		</script>

			<div id="mySideFiltr" class="sidefilter">
		<div class="main-results-filter">
			<h1> Filtra </h1>
			<form name="categorysearch" id="categorysearch" action="../busqueda" method="GET">
			<input name="q" value="<?php echo"$SC"; error_reporting(0); ?>" hidden>
			<select name="z" required> 
						<option value="%%" selected> Zona </option>
						<option value="Samborondón"> Samborondón </option>
						<option value='Vía a la Costa'> Vía a la Costa </option>
					</select>
			<select name="c" required> 
					<option value="%%" selected> Categoria </option>
					<option value="%%"> Todas </option>
					<?php
					$result = mysql_query("SELECT categoria  FROM sub_categorias GROUP BY categoria"); 
					while($row = mysql_fetch_array($result)) {echo "<option value='".$row{'categoria'}."'>".$row{'categoria'}."</option>";} 
					?> 
			</select>
			<select name="d" required> 
				<option value="%%" selected > Delivery </option>
				<option value="Sí"> Sí </option>
				<option value="%%"> No importa </option>
			</select>
			<select name="p" required> 
				<option value="%%" selected> Rango de precios </option>
				<option value="%%"> Todo </option>
				<option value="$"> $ &middot; $1-$10 </option>
				<option value="$$"> $$ &middot; $11-$25 </option>
				<option value="$$$"> $$$ &middot; $25-$40 </option>
				<option value="$$$$"> $$$$ &middot; $41-$60 </option>
				<option value="$$$$$"> $$$$$ &middot; $61+ </option>
			</select>
					
					
			
			<input type="submit" form="categorysearch" value="Filtrar">
			</form>
			<a href="javascript:void(0)" class="closebtn" style="border: 0vw white solid;" onclick="closeFiltr()">Cerrar</a>
			</div>
	
	</div>

		<script>
		function openFiltr() {
		document.getElementById("mySideFiltr").style.height = "99%";
		}

		function closeFiltr() {
		document.getElementById("mySideFiltr").style.height = "0";
		}
		</script>

		<div class="sidenavbtn" onclick="openNav()"  onclick="closeFiltr()">&#9776;</div>
		<img class="sidefilterbtn" onclick="openFiltr()" onclick="closeNav()" src="../../resources/images/icons/filter.png">
		<div class="top-bar"></div>
			

	




		<div class="webtitle">
			<a href="../"> <?php echo"$SC";?></a>
		</div>

		<div class="search-area">
			<div class="search-bar">
			<form name="searchbar" action="../busqueda" method="POST">
			<input type="text" name="search" required="1" max="10"  value="<?php {echo"$SC";} error_reporting(0); ?>"/><input type="submit"  value="">
			</div>
		</div>

	<div class="search-content">

		<table> 	
		<tr>
		<td style='vertical-align:top;'>
			<div class='main-results'> 
			<table>
			<?php

			$result = mysql_query("SELECT COUNT(id_establecimiento) as count FROM Establecimiento WHERE (sub_categoria1 = '$SC' OR sub_categoria2 = '$SC' OR sub_categoria3 = '$SC') AND (zona LIKE '%$Loc%' OR ciudad LIKE '%$Loc%')  "); 
			while($row = mysql_fetch_array($result)) {echo "<tr><td style='background: white; font-size: 4vw; text-align: right; vertical-align: middle;'>".$row{'count'}."</td> <td style='background: white; text-align: left; font-size: 4vw;vertical-align: middle;'> resultado(s) en $Loc </td> <td> </td> </tr>";} echo"<tr> </tr>";
			$result = mysql_query("SELECT id_establecimiento, logo_url, menu_link, LEFT(`nombre`,20) as nombre, categoria, price_range, CONCAT(LEFT(CONCAT(sub_categoria1, ', ',sub_categoria2,', ', sub_categoria3),24),'...') as sub_categorias, telef_1, telef_2, direccion, sitio_web, delivery, tarjeta, parqueo, wifi, alcohol, area_fumador, tv, Rango_precio.rango as rango, DATE_FORMAT(abre_1,'%H:%i') as abre_1, DATE_FORMAT(abre_2,'%H:%i') as abre_2, DATE_FORMAT(abre_3,'%H:%i') as abre_3, DATE_FORMAT(abre_4,'%H:%i') as abre_4, DATE_FORMAT(abre_5,'%H:%i') as abre_5, DATE_FORMAT(abre_6,'%H:%i') as abre_6, DATE_FORMAT(abre_7,'%H:%i') as abre_7, DATE_FORMAT(cierra_1,'%H:%i') as cierra_1, DATE_FORMAT(cierra_2,'%H:%i') as cierra_2, DATE_FORMAT(cierra_3,'%H:%i') as cierra_3, DATE_FORMAT(cierra_4,'%H:%i') as cierra_4, DATE_FORMAT(cierra_5,'%H:%i') as cierra_5, DATE_FORMAT(cierra_6,'%H:%i') as cierra_6, DATE_FORMAT(cierra_7,'%H:%i') as cierra_7,  DATE_FORMAT($abretoday,'%H:%i') as abre_hoy, DATE_FORMAT($cierratoday,'%H:%i') as cierra_hoy
			FROM Establecimiento, Rango_precio
			WHERE Rango_precio.signo = price_range AND (sub_categoria1 = '$SC' OR sub_categoria2 = '$SC' OR sub_categoria3 = '$SC') AND (zona LIKE '%$Loc%' OR ciudad LIKE '%$Loc%') limit 30 ");
			while($row = mysql_fetch_array($result)) 
			{echo "<tr>
		<td><a href='../biz/?id=".$row{'id_establecimiento'}."'><div class='main-results-logo' style='background: white url(".$row{'logo_url'}.") no-repeat center; background-size: 24vw;'></div></a></td>
		<td>
			<div class='main-results-price'>".$row{'price_range'}." </div>
			<div class='main-results-nombre'><a href='../biz/?id=".$row{'id_establecimiento'}."'>".$row{'nombre'}."</a></div>				
			<div class='main-results-sum'><a href='tel:".$row{'telef_1'}."'>".$row{'telef_1'}."</a> &middot; <a href='tel:".$row{'telef_2'}."'>".$row{'telef_2'}."</a><br>".$row{'direccion'}."</div>
			<div class='main-results-sub'>".$row{'sub_categorias'}."</div>
		</td>
	</tr>
	";}?> </table></div>


		
		
	</body> 

	<footer>

	</footer>
</html>