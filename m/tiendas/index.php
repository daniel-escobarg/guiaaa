<?php 
include_once '../../resources/dbconnect.php';									
$page_name = 'Tiendas';
$Loc=$_GET["loc"];
$C=$page_name; 	

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

?>
<html> 
	<head>
		<title> <?php echo"$page_name";?>  | <?php echo"$site_name";?> </title>
		<meta name="description" content="<?php echo"$description_tags";?>">
		<meta name="keywords" content="<?php echo"$keywords_tags";?>">
		<meta name="theme-color" content="<?php echo"$bar_color";?>">

		<link rel="stylesheet" type="text/css" href="../style.css">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	
	</head> 

	<body> 
	<div id="mySidenav" class="sidenav">
		<a href="javascript:void(0)" class="closebtn" style="border: 0vw white solid;" onclick="closeNav()">&times;</a>
		<a href="../busqueda?loc=<?php echo"$Loc";?>">Busqueda</a>
		<a href="../">Inicio</a>
		<a href="../anadirlugares">Añadir un lugar</a>
		<a href="../anadireventos">Añadir un evento</a>
		<a href="../nosotros">Nosotros</a>
		<a href="../contacto">Contactanos</a>
		<a href="../ciudades">Ciudades</a>
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
			<form name="categorysearch" id="categorysearch" action="filtro.php" method="GET">
			<select name="sc" required> 
					<option value="%%" selected> Tipo de <?php echo"$page_name";?> </option>
					<?php
					$result = mysql_query("SELECT sub_categorias.subcategoria  FROM sub_categorias, Establecimiento WHERE sub_categorias.categoria ='$C' AND (sub_categorias.subcategoria = Establecimiento.sub_categoria1 OR sub_categorias.subcategoria = Establecimiento.sub_categoria2 OR sub_categorias.subcategoria = Establecimiento.sub_categoria3) AND (Establecimiento.zona='$Loc' OR Establecimiento.ciudad='$Loc') GROUP BY subcategoria"); 
					while($row = mysql_fetch_array($result)) {echo "<option value='".$row{'subcategoria'}."'>".$row{'subcategoria'}."</option>";} 
					?> 
					</select>
					<select name="loc" required>
						<option value="<?php echo"$Loc";?>"><?php echo"$Loc";?></option>
						<option value="" disabled>Escoge un lugar</option>
						<option value="Guayaquil">Guayaquil</option>
						<option value="Samborondón">&emsp;Samborondón</option>
						<option value="Vía a la costa">&emsp;Vía a la Costa</option>
						<option disabled value="Puerto Santa Ana">&emsp;Puerto Santa Ana</option>
						<option disabled value="Santa Elena">Santa Elena</option>
						<option disabled value="Salinas">&emsp;Salinas</option>
						<option disabled value="Libertad">&emsp;Libertad</option>
						<option disabled value="Puerto Lucia">&emsp;Puerto Lucia</option>
						<option disabled value="Ballenita">&emsp;Ballenita</option>
						<option disabled value="Montañita">&emsp;Montañita</option>
						<option disabled value="Olon">&emsp;Olon</option>

					</select>
					<select name="d" required> 
						<option value="%%" selected> Delivery </option>
						<option value="Sí"> Sí </option>
					</select>
					<select name="p" required> 
						<option value="%%"> Precios </option>
						<option value="$"> $ &middot; $1-$10 </option>
						<option value="$$"> $$ &middot; $11-$25 </option>
						<option value="$$$"> $$$ &middot; $25-$40 </option>
						<option value="$$$$"> $$$$ &middot; $41-$60 </option>
						<option value="$$$$$"> $$$$$ &middot; $61+ </option>
					</select>
			<input type="submit" form="categorysearch" value="Filtrar">
			</form>
			<a href="javascript:void(0)" class="closebtn" style="" onclick="closeFiltr()"><h1>Cerrar</h1></a>
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

		<div class="webtitle"> <a href="../<?php echo"$pagelink";?>?loc=<?php echo"$Loc";?>"> <?php echo"$page_name";?></a> </div>


		<div class='main-results'> 
		<table>
				<?php

					$result = mysql_query("SELECT COUNT(id_establecimiento) as count FROM Establecimiento WHERE (Establecimiento.zona LIKE '%$Loc%' OR Establecimiento.ciudad LIKE '%$Loc%') AND categoria LIKE '%$C%'"); while($row = mysql_fetch_array($result)) 
					{echo "<tr><td style='background: white; font-size: 4vw; text-align: right; vertical-align: middle;'>".$row{'count'}."</td> <td style='background: white; text-align: left; font-size: 4vw;vertical-align: middle;'> resultado(s) &middot;  Top 20  </td> <td> </td> </tr>";} echo"<tr> </tr>";

					$result = mysql_query("SELECT id_establecimiento, logo_url, LEFT(`nombre`,25) as nombre, categoria, price_range, CONCAT(LEFT(CONCAT(sub_categoria1, ', ',sub_categoria2,', ', sub_categoria3),40),'') as sub_categorias, telef_1, telef_2, LEFT(`direccion`,40) as direccion
					FROM Establecimiento, Rango_precio
					WHERE Rango_precio.signo = price_range AND categoria LIKE '%$C%' AND (Establecimiento.zona LIKE '%$Loc%' OR Establecimiento.ciudad LIKE '%$Loc%')  ORDER BY special DESC, Nombre  limit 20");
					while($row = mysql_fetch_array($result)) 
					{echo "<tr>
							<td><a href='../biz/?id=".$row{'id_establecimiento'}."&loc=$Loc'><div class='main-results-logo' style='background: white url(".$row{'logo_url'}.") no-repeat center; background-size: 24vw;'></div></a></td>
							<td>
								<div class='main-results-price'>".$row{'price_range'}." </div>
								<div class='main-results-nombre'><a href='../biz/?id=".$row{'id_establecimiento'}."&loc=$Loc'>".$row{'nombre'}."</a></div>				
								<div class='main-results-sum'><a href='tel:".$row{'telef_1'}."'>".$row{'telef_1'}."</a> &middot; <a href='tel:".$row{'telef_2'}."'>".$row{'telef_2'}."</a><br>".$row{'direccion'}."</div>
								<div class='main-results-sub'>".$row{'sub_categorias'}."</div>
							</td>
						</tr>
						";}?>
		</table>
	</div>
			
	</body> 
</html>