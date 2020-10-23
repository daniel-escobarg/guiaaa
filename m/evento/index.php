<?php 
include_once '../../resources/dbconnect.php';									
$page_name = 'Eventos';
$C=$page_name; 	
$ID=$_GET["id"];

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

$sql = mysql_query("SELECT nombre FROM Evento WHERE id_evento='$ID'");
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
		<table>
				<?php
				setlocale(LC_ALL,"ec_ES");
				$hoy = strftime("%u");
				$abretoday = "abre_$hoy";
				$cierratoday = "cierra_$hoy";
				echo"";
					$result = mysql_query("SELECT  *, DATE_FORMAT(hora_inicio,'%I:%i %p') as hora_i, DATE_FORMAT(hora_termina,'%I:%i %p') as hora_t, DATE_FORMAT(fecha,'%e %b %Y') as fecha, Establecimiento.nombre as nombre_lugar, DATE_FORMAT(abre_1,'%I:%i %p') as abre_1, DATE_FORMAT(abre_2,'%I:%i %p') as abre_2, DATE_FORMAT(abre_3,'%I:%i %p') as abre_3, DATE_FORMAT(abre_4,'%I:%i %p') as abre_4, DATE_FORMAT(abre_5,'%I:%i %p') as abre_5, DATE_FORMAT(abre_6,'%I:%i %p') as abre_6, DATE_FORMAT(abre_7,'%I:%i %p') as abre_7, DATE_FORMAT(cierra_1,'%I:%i %p') as cierra_1, DATE_FORMAT(cierra_2,'%I:%i %p') as cierra_2, DATE_FORMAT(cierra_3,'%I:%i %p') as cierra_3, DATE_FORMAT(cierra_4,'%I:%i %p') as cierra_4, DATE_FORMAT(cierra_5,'%I:%i %p') as cierra_5, DATE_FORMAT(cierra_6,'%I:%i %p') as cierra_6, DATE_FORMAT(cierra_7,'%I:%i %p') as cierra_7 FROM Establecimiento, Evento WHERE Establecimiento.id_establecimiento=Evento.id_establecimiento AND id_evento='$ID' ");
					while($row = mysql_fetch_array($result)) 
					{echo "  
					<div class='biz-results-logo' style='position: fixed; top: 14vw; left: 0vw; width: 100vw; height: 40vw; padding-top: 0vw; padding-bottom: 0vw;background:  url(".$row{'poster_url'}.") no-repeat center;   background-size: auto 38vw;z-index:-2;'></div> 
					</div>
					
					<div class='biz-results-nombre'>".$row{'nombre'}."</div>
					<div class='biz-results-price'>".$row{'costo'}." </div> 	
					<div class='biz-results-sub'><a href='../busqueda/cat.php?sc=".$row{'sub_categoria1'}."'> ".$row{'sub_categoria1'}." </a> </div> 
					

					<div class='biz-results-sum'>
					".$row{'fecha'}." &middot; ".$row{'hora_i'}." - ".$row{'hora_t'}." 
					<br>
					".$row{'Establecimiento.direccion'}."
					</div>
					
					<a href='http://maps.google.com/?q=".$row{'direccion'}."' target='_blank'>
					<div class='biz-results-linkbttn'>
					<h1> <img id='icon' src='https://cdn3.iconfinder.com/data/icons/google-material-design-icons/48/ic_directions_48px-128.png'>  Como llegar </h1> </div>
					</a> 
					<a href='tel:".$row{'telef_1'}."' target='_blank'>
					<div class='biz-results-linkbttn'>
					<h1> <img id='icon' src='http://images.clipartpanda.com/phone-call-icon-aiqeMor9T.png'>   ".$row{'telef_1'}." </h1> </div>
					</a> 
					<a href='tel:".$row{'telef_2'}."' target='_blank'>
					<div class='biz-results-linkbttn'>
					<h1> <img id='icon' src='http://images.clipartpanda.com/phone-call-icon-aiqeMor9T.png'>   ".$row{'telef_2'}." </h1> </div>
					</a> 
					
					<a href='http://".$row{'sitio_web'}."' target='_blank'>
					<div class='biz-results-linkbttn'><h1><img id='icon' src='https://cdn2.iconfinder.com/data/icons/gentle-edges-icon-set/128/Iconfinder_0039_15.png'> 	
					".$row{'sitio_web'}." </h1></div></a>

			
					";}?>
		</table>
	</div>
			
	</body> 


</html>