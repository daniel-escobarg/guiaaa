<?php 
include_once 'resources/dbconnect.php';				
			
$page_name = 'Inicio';
$C=$page_name; 	

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
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta http-equiv="Content-Type" content="text/html; charset=ISO8859-15" />

		<title><?php echo"$site_name";?> </title>
		<link rel="stylesheet" type="text/css" href="resources/style.css">
		
		<meta name="description" content="<?php echo"$description_tags";?>">
		<meta name="keywords" content="<?php echo"$keywords_tags";?>">
		<meta name="robots" content="index, follow">
		<link rel="alternate" media="only screen and (max-width: 600px)" href="m">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="alternate" href="" hreflang="es-ec" />

		<link rel="apple-touch-icon" sizes="57x57" href="resources/favicon/apple-touch-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="60x60" href="resources/favicon/apple-touch-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="72x72" href="resources/favicon/apple-touch-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="76x76" href="resources/favicon/apple-touch-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="114x114" href="resources/favicon/apple-touch-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="120x120" href="resources/favicon/apple-touch-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="144x144" href="resources/favicon/apple-touch-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="152x152" href="resources/favicon/apple-touch-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180" href="resources/favicon/apple-touch-icon-180x180.png">
		<link rel="icon" type="image/png" href="resources/favicon/favicon-32x32.png" sizes="32x32">
		<link rel="icon" type="image/png" href="resources/favicon/android-chrome-192x192.png" sizes="192x192">
		<link rel="icon" type="image/png" href="resources/favicon/favicon-96x96.png" sizes="96x96">
		<link rel="icon" type="image/png" href="resources/favicon/favicon-16x16.png" sizes="16x16">
		<link rel="manifest" href="resources/favicon/manifest.json">
		<link rel="mask-icon" href="resources/favicon/safari-pinned-tab.svg" color="<?php echo"$bar_color";?>">
		<link rel="shortcut icon" href="../resources/favicon/favicon.ico">
		<meta name="msapplication-TileColor" content="<?php echo"$bar_color";?>">
		<meta name="msapplication-TileImage" content="../resources/favicon/mstile-144x144.png">
		<meta name="msapplication-config" content="../resources/favicon/browserconfig.xml">
		<meta name="theme-color" content="<?php echo"$bar_color";?>">
		

		<script type="text/javascript">
		<!--
		if (screen.width <= 699) {
		document.location = "/m";
		}
		//-->
		</script>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script>
			$(document).ready(function() {
			$.get("http://ipinfo.io", function(response) {
			console.log(response.ip, response.country);
			if (response.city == 'La Puntilla') {
			    window.location.replace("guayaquil");
			}
			else if (response.city == 'Guayaquil') {
			    window.location.replace("guayaquil");
			}
			}, "jsonp");
			});
		</script>


		<style>
		    .mySlides {display:none;}
		</style>

	</head> 
	<body> 


		<div class="mp-slide-zonepage" id="mp-slide-todo">
		<div class="webtitle"><a href=""><?php echo"$page_name";?></a> </div>
		<h1> Encuentra todos los lugares </h1>
		<p> Teléfono, dirección, horario, delivery? — todo esta aquí.</p>
		<a id="mp-bttn-black" href="suscripcion">Suscribete</a>
		</div>

		<div class="mp-slide-zonepage" id="mp-slide-comida">
		<div class="webtitle"><a style="color:white" href=""><?php echo"$page_name";?></a> </div>
		<h1> Encuentra restaurantes</h1>
		<p> Pizza, cena, a domicilio? — todo en un lugar.</p>
		<a id="mp-bttn-white" href="">Comida</a>
		</div>

		<div class="mp-slide-zonepage" id="mp-slide-vidan">
		<div class="webtitle"><a style="color:white" href=""><?php echo"$page_name";?></a> </div>
		<h1> Descubre la vida nocturna </h1>
		<p> Discoteca, bar, rooftop? — todo en un lugar.</p>
		<a id="mp-bttn-white" href="">Vida Nocturna</a>
		</div>

	
		<script>
		var slideIndex = 0;
		carousel();

		function carousel() {
		var i;
		var x = document.getElementsByClassName("mp-slide-zonepage");
		for (i = 0; i < x.length; i++) {
		x[i].style.display = "none";
		}
		slideIndex++;
		if (slideIndex > x.length) {slideIndex = 1}
		x[slideIndex-1].style.display = "block";
		setTimeout(carousel, 5000);
		}
		</script>

		<div class="mp-search-area">
			<div class="mp-search-bar">
			<form name="searchbar" action="busqueda" method="GET">
				<input type="text"  name="q" required="1" max="10" placeholder="<?php echo"$search_placeholder";?>">
				
				<select name="loc" required>
					<option value="noplace" disabled>Escoge un lugar</option>
					<option value="Guayaquil" selected>Guayaquil</option>
					<option value="Samborondón">&emsp;Samborondón</option>
					<option value="Vía a la costa">&emsp;Vía a la Costa</option>
				</select>					
				<input value="%%" name="d" hidden="">
				<input value="%%" name="c" hidden="">
				<input value="%%" name="p" hidden="">
				<input value="%%" name="a" hidden="">
				<input type="submit"  value="Enter">
			</form>
			</div>
		</div>
		<div class="mp-cities-bar">
		<?php $result = mysqli_query($conn, "SELECT nombre FROM Ciudad ORDER BY nombre"); while($row = mysqli_fetch_array($result)) 
				{echo " <a href='".$row{'nombre'}."'>".$row{'nombre'}."</a> ";}?>
		</div>

		<div class="mp-arrow"> <a href="#ciudades">Explora<br> <img src="https://cdn3.iconfinder.com/data/icons/google-material-design-icons/48/ic_keyboard_arrow_down_48px-64.png"/> </a> </div>
		
	

		<div class="mp-tiles"> <a name="ciudades">
			<table cellspacing="0" cellpadding="0">
				<tr>
					<td> <a href='guayaquil'> <div class='tile-zone' style='background-color:#084E84'><center> <h1> Guayaquil </h1> </center></div> </a></td>

					<td> <a href='' disabled> <div class='tile-zone' style='background-color:#269af2'><center>  <h1> Sta. Elena </h1> </center></div> </a></td>
				</tr>
			</table>
		</div>
		
	

		<div class="footer">
			<table>
				<tr>
					<td> © <?php echo"$site_name";?> </td>
					<td>
						<b><?php echo"$site_name";?></b>
						<br>
						<?php $result = mysqli_query($conn, "SELECT name, directory FROM Page WHERE type='Principal' ORDER BY id_item "); while($row = mysqli_fetch_array($result)) 
						{echo "<a href='".$row{'directory'}."'>".$row{'name'}."</a><br>";}?>
					</td> 
					<td> 
						<b> Ciudades </b>
						<br>
						<?php $result = mysqli_query($conn, "SELECT nombre FROM Zona "); while($row = mysqli_fetch_array($result)) 
						{echo "<a href='".$row{'nombre'}."'>".$row{'nombre'}."</a><br>";}?>
					</td> 
					<td>
						<b> Otros links </b>
						<br>
						<?php $result = mysqli_query($conn, "SELECT name, directory FROM Page WHERE type='Otros links' ORDER BY id_item "); while($row = mysqli_fetch_array($result)) 
						{echo "<a href='".$row{'directory'}."'>".$row{'name'}."</a><br>";}?>
					</td>
				<tr>
			</table>
		</div>
<!-- Start of StatCounter Code for Default Guide -->
<script type="text/javascript">
var sc_project=10932719; 
var sc_invisible=1; 
var sc_security="8e7032eb"; 
var scJsHost = (("https:" == document.location.protocol) ?
"https://secure." : "http://www.");
document.write("<sc"+"ript type='text/javascript' src='" +
scJsHost+
"statcounter.com/counter/counter.js'></"+"script>");
</script>
<noscript><div class="statcounter"><a title="shopify
analytics tool" href="http://statcounter.com/shopify/"
target="_blank"><img class="statcounter"
src="//c.statcounter.com/10932719/0/8e7032eb/1/"
alt="shopify analytics tool"></a></div></noscript>
<!-- End of StatCounter Code for Default Guide -->

	</body>
		
		
		
	
</html>