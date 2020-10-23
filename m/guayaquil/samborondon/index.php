<?php 
include_once '../../../resources/dbconnect.php';									
$Loc='Samborondón'; 	
$page_name = $Loc;

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
		<link rel="stylesheet" type="text/css" href="../../style.css">
		<meta name="description" content="">
		<meta name="keywords" content="">
		<meta name="robots" content="index, follow">		
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta http-equiv="Content-Type" content="text/html; charset=ISO8859-15" />	
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link rel="canonical" href="http://www.danielescobarg.com">
		
		<link rel="apple-touch-icon" sizes="57x57" href="../../../resources/favicon/apple-touch-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="60x60" href="../../../resources/favicon/apple-touch-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="72x72" href="../../../resources/favicon/apple-touch-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="76x76" href="../../../resources/favicon/apple-touch-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="114x114" href="../../../resources/favicon/apple-touch-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="120x120" href="../../../resources/favicon/apple-touch-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="144x144" href="../../../resources/favicon/apple-touch-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="152x152" href="../../../resources/favicon/apple-touch-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180" href="../../../resources/favicon/apple-touch-icon-180x180.png">
		<link rel="icon" type="image/png" href="../../../resources/favicon/favicon-32x32.png" sizes="32x32">
		<link rel="icon" type="image/png" href="../../../resources/favicon/android-chrome-192x192.png" sizes="192x192">
		<link rel="icon" type="image/png" href="../../../resources/favicon/favicon-96x96.png" sizes="96x96">
		<link rel="icon" type="image/png" href="../../../resources/favicon/favicon-16x16.png" sizes="16x16">
		<link rel="manifest" href="../../../resources/favicon/manifest.json">
		<link rel="mask-icon" href="../../../resources/favicon/safari-pinned-tab.svg" color="<?php echo"$bar_color";?>">
		<link rel="shortcut icon" href="../../../resources/favicon/favicon.ico">
		<meta name="msapplication-TileColor" content="<?php echo"$bar_color";?>">
		<meta name="msapplication-TileImage" content="../../../resources/favicon/mstile-144x144.png">
		<meta name="msapplication-config" content="../../../resources/favicon/browserconfig.xml">
		<meta name="theme-color" content="<?php echo"$bar_color";?>">
<meta name="mobile-web-app-capable" content="yes">
	</head> 

	<body id="zone-page"> 
	<div id="mySidenav" class="sidenav">
		<a href="javascript:void(0)" class="closebtn" style="border: 0vw white solid;" onclick="closeNav()">&times;</a>
		<a href="../../busqueda?loc=<?php echo"$Loc";?>">Busqueda</a>
		<a href="../../">Inicio</a>
		<a href="../../anadirlugares">Añadir un lugar</a>
		<a href="../../anadireventos">Añadir un evento</a>
		<a href="../../nosotros">Nosotros</a>
		<a href="../../contacto">Contactanos</a>
		<a href="../../ciudades">Ciudades</a>
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
		
		
		<div class="areas-slide" id="areas-slide-1">
			<span class="sidenavbtn" style="color:white" onclick="openNav()">&#9776;</span>
			<h1> Encuentra todo en <?php echo"$Loc";?> </h1>
			<p> ¿Restaurantes, tiendas, peluquerias, bares? — todo esta aquí.
			</p>
		</div>

		<div class="areas-slide" id="areas-slide-2">
			<span class="sidenavbtn" style="color:white" onclick="openNav()">&#9776;</span>
			<h1> Encuentra restaurantes </h1>
			<p> ¿Teléfono, dirección, horario, algo a domicilio? — todo esta aquí.</p>
			<a id="areas-slide-2-bttn" href="../comida?loc=<?php echo"$Loc";?>">Comida</a>
		</div>



	

	
		<script>
			var slideIndex = 0;
			carousel();

			function carousel() {
			var i;
			var x = document.getElementsByClassName("areas-slide");
			for (i = 0; i < x.length; i++) {
			x[i].style.display = "none";
			}
			slideIndex++;
			if (slideIndex > x.length) {slideIndex = 1}
			x[slideIndex-1].style.display = "block";
			setTimeout(carousel, 5000);
			}
		</script>


		<div class="city-search-area">
			<form action="../../busqueda" method="GET">
			<input type="text" name="q" required="1" max="10" value="" placeholder="Busca en <?php echo"$Loc";?>" />
			<input name="loc" value="<?php echo"$Loc";?>" hidden>
			<input value="%%" name="d" hidden>
			<input value="%%" name="c" hidden>
			<input value="%%" name="p" hidden>
			<input type="submit" value="">
			</form>
		</div>
		<div class="areas-bar">
			 <center><table> <tr>
		<?php $result = mysql_query("SELECT directory, zona FROM Location WHERE ciudad = (SELECT ciudad FROM Location WHERE zona  = '$Loc' OR ciudad = '$Loc' GROUP BY ciudad) AND zona NOT LIKE '%$Loc%'  ORDER BY id_location"); while($row = mysql_fetch_array($result)) 
				{echo "<td><a href='../../".$row{'directory'}."'>".$row{'zona'}."</a></td><td>&middot;</td>";}?>
		<td> <a href="../../" > <?php echo"$Loc";?></a></td></tr> </table> </div></center> 


		<div class="category-tiles">
			<table cellspacing="0" cellpadding="0">
					<tr>
						<td> <a href='../../comida?loc=<?php echo"$Loc";?>'> <div class='tile' style='background-color:orange'><center> <h1> Comida </h1> </center></div> </a></td>
						<td> <a href='../../tiendas?loc=<?php echo"$Loc";?>'> <div class='tile' style='background-color:#98E0FF'><center>  <h1> Tiendas </h1> </div> </a></td>	
						<td> <a href='../../vidanocturna?loc=<?php echo"$Loc";?>'> <div class='tile' style='background-color:#432341'> <center> <h1> Vida <br> Nocturna </h1> </div> </a></td>
					</tr>
					<tr>
						<td> <a href='../../belleza?loc=<?php echo"$Loc";?>'> <div class='tile' style='background-color:#FB9297'><center>  <h1> Belleza <br> & Spa </h1> </div> </a></td>
						<td> <a href='../../ejercicio?loc=<?php echo"$Loc";?>'> <div class='tile' style='background-color:#3c3c3c'> <center> <h1> Ejercicio </h1> </div> </a></td>
						<td> <a href='../../servicios?loc=<?php echo"$Loc";?>'> <div class='tile' style='background-color:#363EA0'> <center> <h1> Servicios </h1> </div> </a></td>
					</tr>
					<tr>						
						<td> <a href='../../salud?loc=<?php echo"$Loc";?>'> <div class='tile' style='background-color:#D12700'> <center> <h1> Salud </h1> </div> </a></td>
						<td> <a href='../../mascotas?loc=<?php echo"$Loc";?>'> <div class='tile' style='background-color:#DAC691'> <center> <h1> Mascotas </h1> </div> </a></td>
				
						<td> <a href='../../entretenimiento?loc=<?php echo"$Loc";?>'> <div class='tile' style='background-color:#30C6CD'> <center> <h1> Entreteni-<br>miento </h1> </div> </a></td>
						
			
						
						
					</tr>
				</table>
		</div>

		<br>
		<br>
		<br>
		<div class="areas-events">
			<h3> Eventos en <?php echo"$Loc";?> </h3>
			<table> <tr>
			<?php
				setlocale(LC_ALL,"es_ES");
				$hoy = strftime("%u");
				echo"";
				$result = mysql_query("SELECT id_evento, costo, Evento.categoria, poster_url, Establecimiento.id_establecimiento, Evento.nombre, DATE_FORMAT(fecha,'%b %e') as fecha_i, DATE_FORMAT(hora_inicio,'%H:%i') as hora_inicio_i, DATE_FORMAT(hora_termina,'%H:%i') as hora_termina, Establecimiento.nombre as nombre_lugar FROM Evento, Establecimiento WHERE Establecimiento.id_establecimiento = Evento.id_establecimiento AND fecha >= CURDATE() AND (Evento.zona='$Loc' OR Evento.ciudad ='$Loc') ORDER BY fecha ASC, hora_inicio ASC limit 20");
				while($row = mysql_fetch_array($result)) 
				{echo " <td> 
				<a href='../../evento/?id=".$row{'id_evento'}."'> 
					<div class='areas-events-logo' style='background:  white url(".$row{'poster_url'}.") no-repeat center; background-size: auto 24vw;'>
					</div> 
				</a>
				<br>
				<div class='areas-events-title'>
					<b> <a href='../../evento/?id=".$row{'id_evento'}."'>".$row{'nombre'}."  </a> </b>
					<br>
						<a href='evento/?id=".$row{'id_evento'}."'>".$row{'fecha_i'}." </a> 
					&middot; <a href='../../evento/?id=".$row{'id_evento'}."'>".$row{'hora_inicio_i'}."</a>

				</div>
				</td>";}
					?> 
			</tr></table>

        </div>

	</body>

</html>