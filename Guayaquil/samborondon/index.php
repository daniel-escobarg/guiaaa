<?php 
include_once '../../resources/dbconnect.php';									

$Loc='Samborondón'; 	
$page_name = $Loc;

$sql = mysql_query("SELECT directory FROM Page WHERE name='$page_name'");
while($row = mysql_fetch_array($sql)) 
$page_link = $row['0'];

$sql = mysql_query("SELECT value2 FROM Variable WHERE value1='Sitename'");
while($row = mysql_fetch_array($sql)) 
$site_name = $row['0'];

$sql = mysql_query("SELECT directory FROM Page WHERE name='$site_name'");
while($row = mysql_fetch_array($sql)) 
$site_link = $row['0'];

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
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta http-equiv="Content-Type" content="text/html; charset=ISO8859-15" />

		<title> <?php echo"$page_name";?>  | <?php echo"$site_name";?> </title>
		
		<link rel="stylesheet" type="text/css" href="../../resources/style.css">
		
		<meta name="description" content="<?php echo"$description_tags";?>">
		<meta name="keywords" content="<?php echo"$keywords_tags";?>">
		<meta name="robots" content="index, follow">
		<link rel="alternate" media="only screen and (max-width: 600px)" href="http://www.<?php echo"$site_link";?>.com/<?php echo"$page_link";?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="alternate" href="" hreflang="es-ec" />
		<links> 
			<link rel="apple-touch-icon" sizes="57x57" href="../../resources/favicon/apple-touch-icon-57x57.png">
			<link rel="apple-touch-icon" sizes="60x60" href="../../resources/favicon/apple-touch-icon-60x60.png">
			<link rel="apple-touch-icon" sizes="72x72" href="../../resources/favicon/apple-touch-icon-72x72.png">
			<link rel="apple-touch-icon" sizes="76x76" href="../../resources/favicon/apple-touch-icon-76x76.png">
			<link rel="apple-touch-icon" sizes="114x114" href="../../resources/favicon/apple-touch-icon-114x114.png">
			<link rel="apple-touch-icon" sizes="120x120" href="../../resources/favicon/apple-touch-icon-120x120.png">
			<link rel="apple-touch-icon" sizes="144x144" href="../../resources/favicon/apple-touch-icon-144x144.png">
			<link rel="apple-touch-icon" sizes="152x152" href="../../resources/favicon/apple-touch-icon-152x152.png">
			<link rel="apple-touch-icon" sizes="180x180" href="../../resources/favicon/apple-touch-icon-180x180.png">
			<link rel="icon" type="image/png" href="../../resources/favicon/favicon-32x32.png" sizes="32x32">
			<link rel="icon" type="image/png" href="../../resources/favicon/android-chrome-192x192.png" sizes="192x192">
			<link rel="icon" type="image/png" href="../../resources/favicon/favicon-96x96.png" sizes="96x96">
			<link rel="icon" type="image/png" href="../../resources/favicon/favicon-16x16.png" sizes="16x16">
			<link rel="manifest" href="../../resources/favicon/manifest.json">
			<link rel="mask-icon" href="../../resources/favicon/safari-pinned-tab.svg" color="<?php echo"$bar_color";?>">
			<link rel="shortcut icon" href="../../resources/favicon/favicon.ico">
		</links>
		
		<meta name="msapplication-TileColor" content="<?php echo"$bar_color";?>">
		<meta name="msapplication-TileImage" content="../../resources/favicon/mstile-144x144.png">
		<meta name="msapplication-config" content="../../resources/favicon/browserconfig.xml">
		<meta name="theme-color" content="<?php echo"$bar_color";?>">
		
		<script language="javascript"> 
			$("#mp-event-results").simplyScroll();
		</script>
		
		<script type="text/javascript">
			<!--
			if (screen.width <= 699) {
			document.location = "/m";
			}
			//-->
		</script>

		<style>
		    .mp-slide {display:none;}
		</style>

	</head> 
	<body> 

		<div class="mp-slide" id="mp-slide-todo">
			<div class="webtitle"><a href="../"><?php echo"$site_name &middot; $page_name";?></a> </div>
			<h1> Encuentra todos los lugares </h1>
			<p> Teléfono, dirección, horario, delivery? — todo esta aquí.</p>
			<a id="mp-bttn-black" href="#">Suscribete</a>
		</div>

		<div class="mp-slide" id="mp-slide-comida">
			<div class="webtitle"><a style="color:white" href="../"><?php echo"$site_name &middot; $page_name";?></a> </div>
			<h1> Encuentra restaurantes</h1>
			<p> Pizza, cena, a domicilio? — todo en un lugar.</p>
			<a id="mp-bttn-white" href="../../comida?loc=<?php echo"$Loc";?>">Comida</a>
		</div>

		<div class="mp-slide" id="mp-slide-vidan">
			<div class="webtitle"><a style="color:white" href="../"><?php echo"$site_name &middot; $page_name";?></a> </div>
			<h1> Encuentra la vida nocturna </h1>
			<p> Discoteca, bar, rooftop? — todo en un lugar.</p>
			<a id="mp-bttn-white" href="../../vidanocturna?loc=<?php echo"$Loc";?>">Vida Nocturna</a>
		</div>
	
		<script>
			var slideIndex = 0;
			carousel();

			function carousel() {
			var i;
			var x = document.getElementsByClassName("mp-slide");
			for (i = 0; i < x.length; i++) {
			x[i].style.display = "none";
			}
			slideIndex++;
			if (slideIndex > x.length) {slideIndex = 1}
			x[slideIndex-1].style.display = "block";
			setTimeout(carousel, 3000);
			}
		</script>

		<div class="city-search-area" id="ciudad">
			<div class="mp-search-bar">
			<form name="searchbar" action="../../busqueda" method="GET">
				<input type="text"  name="q" required="1" max="10" placeholder="<?php echo"$search_placeholder";?>">
				<select name="loc" required>
					<option value="noplace" disabled>Escoge un lugar</option>
					<option value="Guayaquil">Guayaquil</option>
					<option value="Samborondón" selected>&emsp;Samborondón</option>
					<option value="Vía a la costa">&emsp;Vía a la Costa</option>
					<option value="Puerto Santa Ana">&emsp;Puerto Santa Ana</option>
				</select>					
				<input value="%%" name="d" hidden="">
				<input value="%%" name="c" hidden="">
				<input value="%%" name="p" hidden="">
				<input type="submit"  value="Buscar">
			</form>
			</div>
		</div>
		
		<div class="zones-bar">
			<?php $result = mysql_query("SELECT directory, zona FROM Location WHERE ciudad = (SELECT ciudad FROM Location WHERE zona  = '$Loc' OR ciudad = '$Loc' GROUP BY ciudad)  ORDER BY id_location"); while($row = mysql_fetch_array($result)) 
				{echo " <a href='../../".$row{'directory'}."'>".$row{'zona'}."</a> ";}?>
		</div>
	
		<div class="city-tiles">
			<table cellspacing="0" cellpadding="0">
					<tr>				
						<?php $result = mysql_query("SELECT name, directory, color FROM Page WHERE type='Categorias' AND id_item > 29 AND (name = 'Comida' OR name = 'Tiendas' OR name = 'Vida Nocturna' OR name = 'Belleza & Spa' )ORDER BY id_item LIMIT 7"); 
				while($row = mysql_fetch_array($result)) 
				{echo "<td> <a href='../".$row{'directory'}."?loc=$Loc'><div class='tile' style='background-color:".$row{'color'}."'><center> <h1> ".$row{'name'}." </h1>  </a></td>";}?>
					</tr>
					<tr>
						<?php $result = mysql_query("SELECT name, directory, color FROM Page WHERE type='Categorias' AND id_item > 29 AND (name = 'Mascotas' OR name = 'Ejercicio' OR name = 'Salud' OR name = 'Entretenimiento') ORDER BY id_item "); 
			while($row = mysql_fetch_array($result)) 
				{echo "<td> <a href='../".$row{'directory'}."?loc=$Loc'><div class='tile' style='background-color:".$row{'color'}."'><center> <h1> ".$row{'name'}." </h1>  </a></td>";}?>
					</tr>
					</center>
				</table>
		</div>

		<div class="footer">
			<table>
				<tr>
					<td> © <?php echo"$site_name";?> </td>
					<td>
						<b><?php echo"$site_name";?></b>
						<br>
						<?php $result = mysql_query("SELECT name, directory FROM Page WHERE type='Principal' ORDER BY id_item "); while($row = mysql_fetch_array($result)) 
						{echo "<a href='../../".$row{'directory'}."'>".$row{'name'}."</a><br>";}?>
					</td> 
					<td> 
						<b> Ciudades </b>
						<br>
						<?php $result = mysql_query("SELECT Location.ciudad, directory FROM Location, Establecimiento WHERE Establecimiento.ciudad = Location.ciudad GROUP BY ciudad"); while($row = mysql_fetch_array($result)) 
						{echo "<a href='../../".$row{'ciudad'}."'>".$row{'ciudad'}."</a><br>";}?>
					</td> 
					<td>
						<b> Otros links </b>
						<br>
						<?php $result = mysql_query("SELECT name, directory FROM Page WHERE type='Otros links' ORDER BY id_item "); while($row = mysql_fetch_array($result)) 
						{echo "<a href='../../".$row{'directory'}."'>".$row{'name'}."</a><br>";}?>
					</td>
				<tr>
			</table>
		</div>

	</body>

</html>