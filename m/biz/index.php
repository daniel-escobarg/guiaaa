<?php 
include_once '../../resources/dbconnect.php';									
$page_name = 'Establecimiento';
$C=$page_name; 	
$ID=$_GET["id"];
$Loc=$_GET["loc"];


if(empty($_GET['id'])) 
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

$sql = mysql_query("SELECT nombre FROM Establecimiento WHERE id_establecimiento='$ID'");
while($row = mysql_fetch_array($sql)) 
$biz_name = $row['0'];
date_default_timezone_set('America/Bogota');

setlocale(LC_TIME,"es_MX");
$hoy = strftime("%u");
$hora = strftime("%k, %d");

$abretoday = "abre_$hoy";
$cierratoday = "cierra_$hoy";


?>

<html> 
	<head>
		<title> <?php echo"$biz_name";?>  | <?php echo"$site_name";?> </title>
		<meta name="description" content="">
		<meta name="keywords" content="">

		<link rel="stylesheet" type="text/css" href="../style.css">

		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	
	</head> 

	<body> 

		<div id="mySidenav" class="sidenav">
		<a href="javascript:void(0)" class="closebtn" style="border: 0vw white solid;" onclick="closeNav()">&times;</a>
		<a href="../busqueda">Busqueda</a>
		<a href="../">Inicio</a>
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

		<div class="top-bar">
			<span class="sidenavbtn" onclick="openNav()">&#9776;</span>
		</div>
		<div class="webtitle">
			<a href="../"> <?php echo"$biz_name";?></a>
		</div>

		<div class='biz-results'> 
				<?php
				setlocale(LC_ALL,"ec_ES");
				$hoy = strftime("%u");
				$abretoday = "abre_$hoy";
				$cierratoday = "cierra_$hoy";
				echo"";
					$result = mysql_query("SELECT id_establecimiento, logo_url, menu_link, LEFT(`nombre`,23) as nombre, categoria, price_range, sub_categoria1, sub_categoria2, sub_categoria3,  telef_1, telef_2, direccion, sitio_web, delivery, tarjeta, parqueo, wifi, alcohol, area_fumador, tv, Rango_precio.rango as rango, DATE_FORMAT(abre_1,'%I:%i %p') as abre_1, DATE_FORMAT(abre_2,'%I:%i %p') as abre_2, DATE_FORMAT(abre_3,'%I:%i %p') as abre_3, DATE_FORMAT(abre_4,'%I:%i %p') as abre_4, DATE_FORMAT(abre_5,'%I:%i %p') as abre_5, DATE_FORMAT(abre_6,'%I:%i %p') as abre_6, DATE_FORMAT(abre_7,'%I:%i %p') as abre_7, DATE_FORMAT(cierra_1,'%I:%i %p') as cierra_1, DATE_FORMAT(cierra_2,'%I:%i %p') as cierra_2, DATE_FORMAT(cierra_3,'%I:%i %p') as cierra_3, DATE_FORMAT(cierra_4,'%I:%i %p') as cierra_4, DATE_FORMAT(cierra_5,'%I:%i %p') as cierra_5, DATE_FORMAT(cierra_6,'%I:%i %p') as cierra_6, DATE_FORMAT(cierra_7,'%I:%i %p') as cierra_7,  DATE_FORMAT($abretoday,'%I:%i %p') as abre_hoy, DATE_FORMAT($cierratoday,'%I:%i %p') as cierra_hoy
					FROM Establecimiento, Rango_precio
					WHERE Rango_precio.signo = price_range AND id_establecimiento='$ID'");
					while($row = mysql_fetch_array($result)) 
					{echo "
					<div class='biz-results-logo'> <img src='".$row{'logo_url'}."'> </div> 	
					<div class='biz-results-price'>".$row{'price_range'}." </div> 	
					<div class='biz-results-nombre'>".$row{'nombre'}."</div>
					<div class='biz-results-sub'><a href='../busqueda/cat.php?sc=".$row{'sub_categoria1'}."&loc=$Loc'> ".$row{'sub_categoria1'}." </a> &middot; <a href='../busqueda/cat.php?sc=".$row{'sub_categoria2'}."&loc=$Loc'>".$row{'sub_categoria2'}."</a>  &middot; <a href='../busqueda/cat.php?sc=".$row{'sub_categoria3'}."&loc=$Loc'>".$row{'sub_categoria3'}."</a> </div> 
					

					<div class='biz-results-sum'>
						<center>
						".$row{'direccion'}."<br>".$row{'sitio_web'}." 
						 </center>
					</div>
					<div class='biz-results-sum'>
						<center>
						<img id='icon' src='https://cdn0.iconfinder.com/data/icons/feather/96/clock-128.png'>
						<br>Hoy<br>
						 ".$row{'abre_hoy'}." - ".$row{'cierra_hoy'}." 
						 </center>
					</div>
					<div class='biz-results-bttns'>
						<br>
						<a href='tel:".$row{'telef_1'}."'>".$row{'telef_1'}."</a> <a href='tel:".$row{'telef_2'}."'>".$row{'telef_2'}."</a> 
						<br>
						<a href='http://maps.google.com/?q=".$row{'nombre'}."+".$row{'direccion'}."' target='_blank'>Ver en mapa</a> 
						<a href='http://".$row{'menu_link'}."' target='_blank'>Ver el menú</a> 
					</div>
					

					

					<div class='biz-results-servicios'>
						<table>
							<tr>
								<td>
									<img id='icon' src='https://cdn2.iconfinder.com/data/icons/miscellaneous-31/60/truck-128.png'>
								 </td> 
								<td>
									<img id='icon' src='https://cdn2.iconfinder.com/data/icons/ios-7-icons/50/credit_card-512.png'>
								</td>
								<td>
									<img id='icon' src='https://cdn3.iconfinder.com/data/icons/outline-amenities-icon-set/64/Parking-512.png'>
								 </td> 
							</tr>
							<tr>
								<td> ".$row{'delivery'}." </td> 
								<td> ".$row{'tarjeta'}." </td> 
								<td> ".$row{'parqueo'}." </td> 
							</tr>
						</table>
					</div>
					<div class='biz-results-servicios'>
						<table>
							<tr>
								<tr>
								<td>
									<img id='icon' src='https://cdn0.iconfinder.com/data/icons/beverage/64/WINE-512.png'>
								 </td> 
								<td>
									<img id='icon' src='https://cdn3.iconfinder.com/data/icons/sympletts-free-sampler/128/wi-fi-512.png'>
								</td>
								<td>
									<img id='icon' src='https://cdn2.iconfinder.com/data/icons/ios-7-icons/50/tv-128.png'>
								 </td> 
							</tr>
							</tr>
							<tr>
								<td> ".$row{'alcohol'}." </td> 
								<td> ".$row{'wifi'}." </td> 
								<td> ".$row{'tv'}." </td> 
							</tr>
						</table>	
					</div>

					<div class='biz-results-horario'>
						<center><table>
						<tr><td>lun.</td><td>".$row{'abre_1'}." - ".$row{'cierra_1'}."</td></tr>
						<tr><td>mar.</td><td>".$row{'abre_2'}." - ".$row{'cierra_2'}."</td></tr>
						<tr><td>mié.</td><td>".$row{'abre_3'}." - ".$row{'cierra_3'}."</td></tr>
						<tr><td>jue.</td><td>".$row{'abre_4'}." - ".$row{'cierra_4'}."</td></tr>
						<tr><td>vie.</td><td>".$row{'abre_5'}." - ".$row{'cierra_5'}."</td></tr>
						<tr><td>sab.</td><td>".$row{'abre_6'}." - ".$row{'cierra_6'}."</td></tr>
						<tr><td>dóm.</td><td>".$row{'abre_7'}." - ".$row{'cierra_7'}."</td></tr>
						</table></center>
					</div> 				
						
					";}?>
	</div>
			
	</body> 


</html>