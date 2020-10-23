<?php 
include_once '../resources/dbconnect.php';									
$page_name = 'Busqueda';

$Loc=$_GET["loc"];
$C=$_GET["c"];
$D=$_GET["d"];
$P=$_GET["p"];
$a=$_GET["a"];
$q=$_GET["q"];

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

date_default_timezone_set('America/Bogota');
setlocale(LC_ALL,"ec_ES");
$hoy = strftime("%u");
$abretoday = "abre_$hoy";
$cierratoday = "cierra_$hoy";

$words=$q;
if(empty($words)){
    //redirect somewhere else!
}
$parts = explode(" ",trim($words));
$clauses1=array();
foreach ($parts as $part){
    //function_description in my case ,  replace it with whatever u want in ur table
$clauses1[]="nombre LIKE '%" . mysql_real_escape_string($q) . "%'";
$clauses3[]="search_tags LIKE '%" . mysql_real_escape_string($q) . "%'";
$clauses4[]="sub_categoria1 LIKE '%" . mysql_real_escape_string($q) . "%'";
$clauses5[]="sub_categoria2 LIKE '%" . mysql_real_escape_string($q) . "%'";
$clauses6[]="sub_categoria3 LIKE '%" . mysql_real_escape_string($q) . "%'";
$clauses7[]="direccion LIKE '%" . mysql_real_escape_string($q) . "%'";
}
$clause1=implode(' OR ' ,$clauses1);
$clause3=implode(' OR ' ,$clauses3);
$clause4=implode(' OR ' ,$clauses4);
$clause5=implode(' OR ' ,$clauses5);
$clause6=implode(' OR ' ,$clauses6);
$clause7=implode(' OR ' ,$clauses7);
//select your condition and add "AND ($clauses)" .

?>


<html> 
	<head>
		<title> <?php echo"$q";?> </title>
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
				
	</div>
	
	<div class="search-area">
			<div class="search-bar">
			<form name="searchbar" action="../busqueda" method="GET">
			<input type="text" name="q" required="1" max="10"  value="<?php {echo"$words";} error_reporting(0); ?>" placeholder="<?php echo"$search_placeholder";?>"/><input type="submit"  value="">
			<select name="loc" required>
					<option value="noplace" selected disabled>Escoge un lugar</option>
					<option value="<?php {echo"$Loc";} error_reporting(0); ?>" selected><?php {echo"$Loc";} error_reporting(0); ?></option>
					<option value="" disabled=""></option>
					<option value="Guayaquil">Guayaquil</option>
					<option value="Samborondón">&emsp;Samborondón</option>
					<option value="Vía a la costa">&emsp;Vía a la Costa</option>

				</select>	
			<input value="%%" name="d" hidden="">
			<input value="%%" name="c" hidden="">
			<input value="%%" name="p" hidden="">
			</form>		
			</div>
	</div>
	

		<div class="main-results-filter">
			<div id="header">Filtros </div>
				<form name="categorysearch" id="categorysearch" action="../busqueda" method="GET">
					<input value="<?php {echo"$words";} error_reporting(0); ?>" name="q" hidden="">	
					
					<select name="loc" required>
					<option value="<?php echo"$Loc";?>"><?php echo"$Loc";?></option>
					<option value="noplace" disabled>Escoge un lugar</option>
					<option value="Guayaquil">Guayaquil</option>
					<option value="Samborondón">&emsp;Samborondón</option>
					<option value="Vía a la costa">&emsp;Vía a la Costa</option>

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

		<div class="search-content">
			<div class='main-results'> 
			<table>
			<?php
			setlocale(LC_ALL,"ec_ES");
			$hoy = strftime("%u");
			$abretoday = "abre_$hoy";
			$cierratoday = "cierra_$hoy";
			echo"";

			include_once '../resources/dbconnect.php';									
				$result = mysql_query("SELECT COUNT(id_establecimiento) as count
				FROM Establecimiento
				WHERE (zona LIKE '%$Loc%' or ciudad LIKE '%$Loc%') AND nombre LIKE '%$q%' OR sub_categoria1 LIKE '%$q%' OR sub_categoria2 LIKE '%$q%' OR sub_categoria3 LIKE '%$q%' OR categoria LIKE '%$q%' OR direccion LIKE '%$q%' OR  price_range LIKE '%$q%' OR  search_tags LIKE '%$q%' ");
				while($row = mysql_fetch_array($result)) 
				{echo "<tr><td></td> <td>".$row{'count'}." resultado(s)  </td> <td> </td> </tr>";}
			echo"<tr> </tr>";
				include_once '../resources/dbconnect.php';									
				$result = mysql_query("SELECT *, Rango_precio.rango as rango, DATE_FORMAT(abre_1,'%H:%i') as abre_1, DATE_FORMAT(abre_2,'%H:%i') as abre_2, DATE_FORMAT(abre_3,'%H:%i') as abre_3, DATE_FORMAT(abre_4,'%H:%i') as abre_4, DATE_FORMAT(abre_5,'%H:%i') as abre_5, DATE_FORMAT(abre_6,'%H:%i') as abre_6, DATE_FORMAT(abre_7,'%H:%i') as abre_7, DATE_FORMAT(cierra_1,'%H:%i') as cierra_1, DATE_FORMAT(cierra_2,'%H:%i') as cierra_2, DATE_FORMAT(cierra_3,'%H:%i') as cierra_3, DATE_FORMAT(cierra_4,'%H:%i') as cierra_4, DATE_FORMAT(cierra_5,'%H:%i') as cierra_5, DATE_FORMAT(cierra_6,'%H:%i') as cierra_6, DATE_FORMAT(cierra_7,'%H:%i') as cierra_7,  DATE_FORMAT($abretoday,'%H:%i') as abre_hoy, DATE_FORMAT($cierratoday,'%H:%i') as cierra_hoy
				FROM Establecimiento, Rango_precio
				WHERE Rango_precio.signo = price_range AND sub_categoria1 = '$q' AND (zona LIKE '%$Loc%' or ciudad LIKE '%$Loc%') 
				GROUP BY id_establecimiento ORDER BY nombre  Limit 30  ");
				while($row = mysql_fetch_array($result)) 
				{echo "<tr>
					<td>
						<a href='../biz/?id=".$row{'id_establecimiento'}."'> 
							<div class='main-results-logo' style='background: white url(".$row{'logo_url'}.") no-repeat center; background-size: 10.9vw;'></div>
						</a>
					</td>
					<td>
						<span class='main-results-nombre'> 
							<a href='../biz/?id=".$row{'id_establecimiento'}."'> 
								".$row{'nombre'}."</a> 
						</span>
						<br>
						<span class='main-results-sub'>
							".$row{'price_range'}." | 
							<a href='../busqueda/cat.php?q=".$row{'sub_categoria1'}."'>
								".$row{'sub_categoria1'}."
							</a> 
							&middot; 
							<a href='../busqueda/cat.php?q=".$row{'sub_categoria2'}."'>
								".$row{'sub_categoria2'}."
							</a>  
							&middot; 
							<a href='../busqueda/cat.php?q=".$row{'sub_categoria3'}."'>
								".$row{'sub_categoria3'}."
							</a>  
							<br>
						</span> 
						<span class='main-results-sum'>
							<img id='icon' src='http://www.freeiconspng.com/uploads/fork-kitchen-knife-icon-7.png'> 
							<a href='http://".$row{'menu_link'}."' target='_blank'> 
								<b>Menú completo</b></a>
							<br>
							<img id='icon' src='http://simpleicon.com/wp-content/uploads/coin-money-2.png'> 
							<b>Rango de precios</b> ".$row{'rango'}."
							<br>
						 	<img id='icon' src='https://cdn0.iconfinder.com/data/icons/feather/96/clock-128.png'> 
							<b> Hoy </b> ".$row{'abre_hoy'}." - ".$row{'cierra_hoy'}." 
							<br>
							<br>
							<img id='icon' src='https://cdn4.iconfinder.com/data/icons/standard-free-icons/139/Call01-32.png'> ".$row{'telef_1'}." ".$row{'telef_2'}."
							<br>
							<img id='icon' src='https://cdn2.iconfinder.com/data/icons/social-networks-7/128/Socialmedia_icons_Navigation-32.png'> ".$row{'direccion'}."
						</span>
					</td>
					<td>
						<span class='main-results-servicios'>
							<b>Servicios</b>								
							<br>
							Entrega a domicilio <b> ".$row{'delivery'}." </b>
							<br>
							Acepta tarjetas de crédito <b> ".$row{'tarjeta'}."</b>
							<br>
							Estacionamiento <b>".$row{'parqueo'}."</b>
							<br>
							Alcohol <b>".$row{'alcohol'}."</b>
							<br>
							Wi-fi <b> ".$row{'wifi'}."</b>
							<br>
							<a href='../biz/?id=".$row{'id_establecimiento'}."'> 
							<b> Horario Completo </b> </a>
						</span>
					</td>
				</tr>
				<tr></tr>";}

			$result = mysql_query("SELECT *, Rango_precio.rango as rango, DATE_FORMAT(abre_1,'%H:%i') as abre_1, DATE_FORMAT(abre_2,'%H:%i') as abre_2, DATE_FORMAT(abre_3,'%H:%i') as abre_3, DATE_FORMAT(abre_4,'%H:%i') as abre_4, DATE_FORMAT(abre_5,'%H:%i') as abre_5, DATE_FORMAT(abre_6,'%H:%i') as abre_6, DATE_FORMAT(abre_7,'%H:%i') as abre_7, DATE_FORMAT(cierra_1,'%H:%i') as cierra_1, DATE_FORMAT(cierra_2,'%H:%i') as cierra_2, DATE_FORMAT(cierra_3,'%H:%i') as cierra_3, DATE_FORMAT(cierra_4,'%H:%i') as cierra_4, DATE_FORMAT(cierra_5,'%H:%i') as cierra_5, DATE_FORMAT(cierra_6,'%H:%i') as cierra_6, DATE_FORMAT(cierra_7,'%H:%i') as cierra_7,  DATE_FORMAT($abretoday,'%H:%i') as abre_hoy, DATE_FORMAT($cierratoday,'%H:%i') as cierra_hoy
				FROM Establecimiento, Rango_precio
				WHERE Rango_precio.signo = price_range AND sub_categoria2 = '$q' 

				GROUP BY id_establecimiento ORDER BY nombre  ");
				while($row = mysql_fetch_array($result)) 
				{echo "<tr>
					<td>
						<a href='../biz/?id=".$row{'id_establecimiento'}."'> 
							<div class='main-results-logo' style='background: white url(".$row{'logo_url'}.") no-repeat center; background-size: 10.9vw;'></div>
						</a>
					</td>
					<td>
						<span class='main-results-nombre'> 
							<a href='../biz/?id=".$row{'id_establecimiento'}."'> 
								".$row{'nombre'}."</a> 
						</span>
						<br>
						<span class='main-results-sub'>
							".$row{'price_range'}." | 
							<a href='../busqueda/cat.php?q=".$row{'sub_categoria1'}."'>
								".$row{'sub_categoria1'}."
							</a> 
							&middot; 
							<a href='../busqueda/cat.php?q=".$row{'sub_categoria2'}."'>
								".$row{'sub_categoria2'}."
							</a>  
							&middot; 
							<a href='../busqueda/cat.php?q=".$row{'sub_categoria3'}."'>
								".$row{'sub_categoria3'}."
							</a>  
							<br>
						</span> 
						<span class='main-results-sum'>
							<img id='icon' src='http://www.freeiconspng.com/uploads/fork-kitchen-knife-icon-7.png'> 
							<a href='http://".$row{'menu_link'}."' target='_blank'> 
								<b>Menú completo</b></a>
							<br>
							<img id='icon' src='http://simpleicon.com/wp-content/uploads/coin-money-2.png'> 
							<b>Rango de precios</b> ".$row{'rango'}."
							<br>
						 	<img id='icon' src='https://cdn0.iconfinder.com/data/icons/feather/96/clock-128.png'> 
							<b> Hoy </b> ".$row{'abre_hoy'}." - ".$row{'cierra_hoy'}." 
							<br>
							<br>
							<img id='icon' src='https://cdn4.iconfinder.com/data/icons/standard-free-icons/139/Call01-32.png'> ".$row{'telef_1'}." ".$row{'telef_2'}."
							<br>
							<img id='icon' src='https://cdn2.iconfinder.com/data/icons/social-networks-7/128/Socialmedia_icons_Navigation-32.png'> ".$row{'direccion'}."
						</span>
					</td>
					<td>
						<span class='main-results-servicios'>
							<b>Servicios</b>								
							<br>
							Entrega a domicilio <b> ".$row{'delivery'}." </b>
							<br>
							Acepta tarjetas de crédito <b> ".$row{'tarjeta'}."</b>
							<br>
							Estacionamiento <b>".$row{'parqueo'}."</b>
							<br>
							Alcohol <b>".$row{'alcohol'}."</b>
							<br>
							Wi-fi <b> ".$row{'wifi'}."</b>
							<br>
							<a href='../biz/?id=".$row{'id_establecimiento'}."'> 
							<b> Horario Completo </b> </a>
						</span>
					</td>
				</tr>
				<tr></tr>";}
				
				$result = mysql_query("SELECT *, Rango_precio.rango as rango, DATE_FORMAT(abre_1,'%H:%i') as abre_1, DATE_FORMAT(abre_2,'%H:%i') as abre_2, DATE_FORMAT(abre_3,'%H:%i') as abre_3, DATE_FORMAT(abre_4,'%H:%i') as abre_4, DATE_FORMAT(abre_5,'%H:%i') as abre_5, DATE_FORMAT(abre_6,'%H:%i') as abre_6, DATE_FORMAT(abre_7,'%H:%i') as abre_7, DATE_FORMAT(cierra_1,'%H:%i') as cierra_1, DATE_FORMAT(cierra_2,'%H:%i') as cierra_2, DATE_FORMAT(cierra_3,'%H:%i') as cierra_3, DATE_FORMAT(cierra_4,'%H:%i') as cierra_4, DATE_FORMAT(cierra_5,'%H:%i') as cierra_5, DATE_FORMAT(cierra_6,'%H:%i') as cierra_6, DATE_FORMAT(cierra_7,'%H:%i') as cierra_7,  DATE_FORMAT($abretoday,'%H:%i') as abre_hoy, DATE_FORMAT($cierratoday,'%H:%i') as cierra_hoy
				FROM Establecimiento, Rango_precio
				WHERE Rango_precio.signo = price_range AND sub_categoria3 = '$q'

				GROUP BY id_establecimiento ORDER BY nombre  Limit 30  ");
				while($row = mysql_fetch_array($result)) 
				{echo "<tr>
					<td>
						<a href='../biz/?id=".$row{'id_establecimiento'}."'> 
							<div class='main-results-logo' style='background: white url(".$row{'logo_url'}.") no-repeat center; background-size: 10.9vw;'></div>
						</a>
					</td>
					<td>
						<span class='main-results-nombre'> 
							<a href='../biz/?id=".$row{'id_establecimiento'}."'> 
								".$row{'nombre'}."</a> 
						</span>
						<br>
						<span class='main-results-sub'>
							".$row{'price_range'}." | 
							<a href='../busqueda/cat.php?q=".$row{'sub_categoria1'}."'>
								".$row{'sub_categoria1'}."
							</a> 
							&middot; 
							<a href='../busqueda/cat.php?q=".$row{'sub_categoria2'}."'>
								".$row{'sub_categoria2'}."
							</a>  
							&middot; 
							<a href='../busqueda/cat.php?q=".$row{'sub_categoria3'}."'>
								".$row{'sub_categoria3'}."
							</a>  
							<br>
						</span> 
						<span class='main-results-sum'>
							<img id='icon' src='http://www.freeiconspng.com/uploads/fork-kitchen-knife-icon-7.png'> 
							<a href='http://".$row{'menu_link'}."' target='_blank'> 
								<b>Menú completo</b></a>
							<br>
							<img id='icon' src='http://simpleicon.com/wp-content/uploads/coin-money-2.png'> 
							<b>Rango de precios</b> ".$row{'rango'}."
							<br>
						 	<img id='icon' src='https://cdn0.iconfinder.com/data/icons/feather/96/clock-128.png'> 
							<b> Hoy </b> ".$row{'abre_hoy'}." - ".$row{'cierra_hoy'}." 
							<br>
							<br>
							<img id='icon' src='https://cdn4.iconfinder.com/data/icons/standard-free-icons/139/Call01-32.png'> ".$row{'telef_1'}." ".$row{'telef_2'}."
							<br>
							<img id='icon' src='https://cdn2.iconfinder.com/data/icons/social-networks-7/128/Socialmedia_icons_Navigation-32.png'> ".$row{'direccion'}."
						</span>
					</td>
					<td>
						<span class='main-results-servicios'>
							<b>Servicios</b>								
							<br>
							Entrega a domicilio <b> ".$row{'delivery'}." </b>
							<br>
							Acepta tarjetas de crédito <b> ".$row{'tarjeta'}."</b>
							<br>
							Estacionamiento <b>".$row{'parqueo'}."</b>
							<br>
							Alcohol <b>".$row{'alcohol'}."</b>
							<br>
							Wi-fi <b> ".$row{'wifi'}."</b>
							<br>
							<a href='../biz/?id=".$row{'id_establecimiento'}."'> 
							<b> Horario Completo </b> </a>
						</span>
					</td>
				</tr>
				<tr></tr>";}


							?>						
		</table>
					</div>
			</tr>
			</table>
		</div>


		
	</body> 

	<footer>

	</footer>
</html>