<?php 
include_once '../resources/dbconnect.php';				
			
$page_name = 'Inicio';
$C=$page_name; 	
$Loc=$_GET["loc"];


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
		<title> <?php echo"$site_name";?> </title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<meta name="description" content="<?php echo"$description_tags";?>">
		<meta name="keywords" content="<?php echo"$keywords_tags";?>">
		<meta name="robots" content="index, follow">		
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta http-equiv="Content-Type" content="text/html; charset=ISO8859-15" />	
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link rel="canonical" href="http://www.danielescobarg.com">
		
		<link rel="apple-touch-icon" sizes="57x57" href="../resources/favicon/apple-touch-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="60x60" href="../resources/favicon/apple-touch-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="72x72" href="../resources/favicon/apple-touch-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="76x76" href="../resources/favicon/apple-touch-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="114x114" href="../resources/favicon/apple-touch-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="120x120" href="../resources/favicon/apple-touch-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="144x144" href="../resources/favicon/apple-touch-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="152x152" href="../resources/favicon/apple-touch-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180" href="../resources/favicon/apple-touch-icon-180x180.png">
		<link rel="icon" type="image/png" href="../resources/favicon/favicon-32x32.png" sizes="32x32">
		<link rel="icon" type="image/png" href="../resources/favicon/android-chrome-192x192.png" sizes="192x192">
		<link rel="icon" type="image/png" href="../resources/favicon/favicon-96x96.png" sizes="96x96">
		<link rel="icon" type="image/png" href="../resources/favicon/favicon-16x16.png" sizes="16x16">
		<link rel="manifest" href="../resources/favicon/manifest.json">

		<link rel="mask-icon" href="../resources/favicon/safari-pinned-tab.svg" color="<?php echo"$bar_color";?> ">
		<link rel="shortcut icon" href="../resources/favicon/favicon.ico">
		<meta name="msapplication-TileColor" content="<?php echo"$bar_color";?> ">
		<meta name="msapplication-TileImage" content="../resources/favicon/mstile-144x144.png">
		<meta name="msapplication-config" content="../resources/favicon/browserconfig.xml">
		<meta name="theme-color" content="<?php echo"$bar_color";?> ">
		<meta name="mobile-web-app-capable" content="yes">
		
	</head> 
	<body> 
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script>
			$(document).ready(function() {
			$.get("http://ipinfo.io", function(response) {
			console.log(response.ip, response.country);
			if (response.city == '') {
			    window.location.replace("guayaquil");
			}
			else if (response.city == '') {
			    window.location.replace("guayaquil");
			}
			}, "jsonp");
			});
		</script>

	

	
		<div class="mp-slide" id="mp-slide-1">
		</div>
		<div class="mp-title"><?php echo"$site_name";?> </div>

		<div class="mp-search-area">
			<form action="busqueda" method="GET">
			<input type="text" name="q" required="1" max="10" value="" placeholder="<?php echo"$search_placeholder";?>" />
			<select name="loc" required>
				<option value="Guayaquil" selected>en Guayaquil</option>
				<option value="Samborondón">&emsp;en Samborondón</option>
				<option value="Vía a la costa">&emsp;en Vía a la Costa</option>
			</select>
			<input value="%%" name="d" hidden>
			<input value="%%" name="c" hidden>
			<input value="%%" name="p" hidden>
			<input type="submit" value="Buscar">
			</form>
		</div>

		<a href="guayaquil">
		<div class="mp-explore-cities"> 
			<h1> Explora Guayaquil </h1>
		</div>
		</a>


		
	

		<!-- Start of StatCounter Code for Default Guide -->
		<script type="text/javascript">
			var sc_project=11176122; 
			var sc_invisible=1; 
			var sc_security="906ff04d"; 
			var scJsHost = (("https:" == document.location.protocol) ?
			"https://secure." : "http://www.");
			document.write("<sc"+"ript type='text/javascript' src='" +
			scJsHost+
			"statcounter.com/counter/counter.js'></"+"script>");
		</script>
		<noscript>
			<div class="statcounter"><a title="hit counter"
			href="http://statcounter.com/" target="_blank"><img
			class="statcounter"
			src="//c.statcounter.com/11176122/0/906ff04d/1/" alt="hit
			counter"></a></div>
		</noscript>
		<!-- End of StatCounter Code for Default Guide -->
	</body>

</html>