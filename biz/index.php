<?php 
include_once '../resources/dbconnect.php';									
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

$tags = mysql_query("SELECT search_tags FROM Establecimiento WHERE id_establecimiento='$ID'");
while($row = mysql_fetch_array($tags)) 
$st = $row['search_tags'];
$template = '<a href="../busqueda/?q=%1$s">%1$s</a>';
$st =(preg_replace("/(?!(?:[^<]+>|[^>]+<\/a>))\b([a-z]+)\b/is", sprintf($template, "\\1"), $st));

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
		<meta name="description" content="<?php echo"$description_tags";?>">
		<meta name="keywords" content="<?php echo"$keywords_tags";?>">

		<link rel="stylesheet" type="text/css" href="../resources/style.css">

		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<script type="text/javascript">
		<!--
		if (screen.width <= 699) {
		document.location = "../m/<?php echo"$pagelink";?>";
		}
		//-->
		</script>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta http-equiv="Content-Type" content="text/html; charset=ISO8859-15" />

		
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

			</select>				
		</form>
		</div>
	</div>
	<div class="biz-content">
	
	<div class='biz-results'> 
	<table>
	<tr>
		<?php

			$result = mysql_query("SELECT id_establecimiento, logo_url, menu_link, nombre, categoria, price_range, sub_categoria1, sub_categoria2, sub_categoria3, telef_1, telef_2, direccion, sitio_web, delivery, search_tags, tarjeta, parqueo, wifi, alcohol, area_fumador, tv, Rango_precio.rango as rango, DATE_FORMAT(abre_1,'%H:%i') as abre_1, DATE_FORMAT(abre_2,'%H:%i') as abre_2, DATE_FORMAT(abre_3,'%H:%i') as abre_3, DATE_FORMAT(abre_4,'%H:%i') as abre_4, DATE_FORMAT(abre_5,'%H:%i') as abre_5, DATE_FORMAT(abre_6,'%H:%i') as abre_6, DATE_FORMAT(abre_7,'%H:%i') as abre_7, DATE_FORMAT(cierra_1,'%H:%i') as cierra_1, DATE_FORMAT(cierra_2,'%H:%i') as cierra_2, DATE_FORMAT(cierra_3,'%H:%i') as cierra_3, DATE_FORMAT(cierra_4,'%H:%i') as cierra_4, DATE_FORMAT(cierra_5,'%H:%i') as cierra_5, DATE_FORMAT(cierra_6,'%H:%i') as cierra_6, DATE_FORMAT(cierra_7,'%H:%i') as cierra_7,  DATE_FORMAT($abretoday,'%H:%i') as abre_hoy, DATE_FORMAT($cierratoday,'%H:%i') as cierra_hoy
			FROM Establecimiento, Rango_precio
			WHERE Rango_precio.signo = price_range AND id_establecimiento='$ID'");
			while($row = mysql_fetch_array($result)) 
			{echo "
		<td>
			<div class='biz-results-logo' style='background: white url(".$row{'logo_url'}.") no-repeat center;    background-size: 13vw;'></div>
			<br>
			<div class='biz-results-tags'>
			$st
			</div>
		</td>
		<td>
			<div class='biz-results-price'>".$row{'price_range'}."  </div>
			<div class='biz-results-nombre'> ".$row{'nombre'}."</a> </div>
			<div class='biz-results-sub'> 
				<a href='../busqueda/cat.php?q=".$row{'sub_categoria1'}."'>".$row{'sub_categoria1'}."</a> 
					&middot; 
				<a href='../busqueda/cat.php?q=".$row{'sub_categoria2'}."'>".$row{'sub_categoria2'}."</a>  
					&middot; 
				<a href='../busqueda/cat.php?q=".$row{'sub_categoria3'}."'>".$row{'sub_categoria3'}."</a>  
			</div>
			
			<div class='biz-results-sum'>
				<img id='icon' src='http://www.freeiconspng.com/uploads/fork-kitchen-knife-icon-7.png'> 
				<a href='http://".$row{'menu_link'}."' target='_blank'> 
					Menú completo
				</a>
				<br>
				<img id='icon' src='http://simpleicon.com/wp-content/uploads/coin-money-2.png'> 
				Rango de precios ".$row{'rango'}."
				<br>
				<img id='icon' src='https://cdn0.iconfinder.com/data/icons/feather/96/clock-128.png'> 
				Hoy ".$row{'abre_hoy'}." - ".$row{'cierra_hoy'}."
			</div>
			
			<div class='biz-results-contact'>
				<iframe width='100%' height='60%'frameborder='0' style='border:0' src='https://www.google.com/maps/embed/v1/place?key=AIzaSyBVfn0ZZyTZn5R9c25SgxaCq9K6_niHFUw&q=".$row{'nombre'}."+".$row{'direccion'}."&language=es_EC&zoom=17 allowfullscreen'>
				</iframe>	
				<img id='icon' src='http://icons.veryicon.com/ico/System/iOS7%20Minimal/Maps%20Near%20me.ico'>&nbsp;&nbsp;".$row{'direccion'}."
				<hr>
				<img id='icon' src='http://images.clipartpanda.com/phone-call-icon-aiqeMor9T.png'>&nbsp;&nbsp;".$row{'telef_1'}."&nbsp;&nbsp;".$row{'telef_2'}." 
				<hr>			
				<img id='icon' src='https://cdn2.iconfinder.com/data/icons/gentle-edges-icon-set/128/Iconfinder_0039_15.png'>&nbsp;&nbsp;<a href='http://".$row{'sitio_web'}."' target='_blank'>".$row{'sitio_web'}."</a>
			</div>

			</td>
			<td>

			<div class='biz-results-horario'>
				<h3> Horario </h3>	
				<table> 
					<tr> <td> lun. </td><td>".$row{'abre_1'}." - ".$row{'cierra_1'}." </td></tr>
					<tr> <td> mar. </td><td>".$row{'abre_2'}." - ".$row{'cierra_2'}." </td></tr>
					<tr> <td> mie. </td><td>".$row{'abre_3'}." - ".$row{'cierra_3'}." </td></tr>
					<tr> <td> jue. </td><td>".$row{'abre_4'}." - ".$row{'cierra_4'}." </td></tr>
					<tr> <td> vie. </td><td>".$row{'abre_5'}." - ".$row{'cierra_5'}." </td></tr>
					<tr> <td> sab. </td><td>".$row{'abre_6'}." - ".$row{'cierra_6'}." </td></tr>
					<tr> <td> dom. </td><td>".$row{'abre_7'}." - ".$row{'cierra_7'}." </td></tr>
				</table>
			</div> 
			<div class='biz-results-servicios'>
				<h3> Servicios </h3>	
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
		</td>"
		;}?>
		<td>
			<div class='biz-results-similares'>
			<h3> Lugares similares </h3>	
			<table>
				<?php
					$result = mysql_query("SELECT * FROM Establecimiento WHERE nombre = (SELECT nombre FROM Establecimiento WHERE id_establecimiento='$ID') AND id_establecimiento !='$ID'");
					while($row = mysql_fetch_array($result)) 
					{echo "
					<tr> 
					<td width='6vw'>
					<a href='../biz/?id=".$row{'id_establecimiento'}."'> <div class='biz-sim-results-logo' style='background: white url(".$row{'logo_url'}.") no-repeat center; background-size: 5vw auto;'></div></a>
					</td>
					<td>
					<div class='biz-sim-results-nombre'> 
						<a href='../biz/?id=".$row{'id_establecimiento'}."'> ".$row{'nombre'}."</a> 
					</div>
					<div class='biz-sim-results-sub'>
					<a href='../busqueda/cat.php?q=".$row{'sub_categoria1'}."'>".$row{'sub_categoria1'}." </a> 
					&middot;
					<a href='../busqueda/cat.php?q=".$row{'sub_categoria2'}."'>".$row{'sub_categoria2'}." </a>  
					&middot;
					<a href='../busqueda/cat.php?q=".$row{'sub_categoria3'}."'> ".$row{'sub_categoria3'}." </a>  
					<br> ".$row{'direccion'}." 

					</div> 
					</td>
					</tr>
					<tr></tr>";}
				?>


				<?php
					$result = mysql_query("SELECT * FROM Establecimiento WHERE nombre != (SELECT nombre FROM Establecimiento WHERE id_establecimiento='$ID') AND 
					(sub_categoria1=(SELECT sub_categoria1 FROM Establecimiento WHERE id_establecimiento='$ID') OR sub_categoria2=(SELECT sub_categoria1 FROM Establecimiento WHERE id_establecimiento='$ID')) ORDER BY special DESC LIMIT 5");
					while($row = mysql_fetch_array($result)) 
					{echo "
					<tr> <td width='6vw'>
					<a href='../biz/?id=".$row{'id_establecimiento'}."'> <div class='biz-sim-results-logo' style='background: white url(".$row{'logo_url'}.") no-repeat center; background-size: 5vw auto;'></div></a>
					</td><td>
					<div class='biz-sim-results-nombre'> <a href='../biz/?id=".$row{'id_establecimiento'}."'> ".$row{'nombre'}."</a> </div>
					<div class='biz-sim-results-sub'> <a href='../busqueda/cat.php?q=".$row{'sub_categoria1'}."'>".$row{'sub_categoria1'}." </a>  &middot; <a href='../busqueda/cat.php?q=".$row{'sub_categoria2'}."'>".$row{'sub_categoria2'}." </a>  &middot; <a href='../busqueda/cat.php?q=".$row{'sub_categoria3'}."'> ".$row{'sub_categoria3'}." </a> <br> ".$row{'direccion'}." </div> 
					</td>
					</tr>";}
				?>
				<?php
					$result = mysql_query("SELECT * FROM Establecimiento WHERE nombre != (SELECT nombre FROM Establecimiento WHERE id_establecimiento='$ID') AND 
					(sub_categoria1=(SELECT sub_categoria2 FROM Establecimiento WHERE id_establecimiento='$ID') OR sub_categoria2=(SELECT sub_categoria2 FROM Establecimiento WHERE id_establecimiento='$ID')) ORDER BY special DESC LIMIT 4");
					while($row = mysql_fetch_array($result)) 
					{echo "
					<tr> <td width='6vw'>
					<a href='../biz/?id=".$row{'id_establecimiento'}."'> <div class='biz-sim-results-logo' style='background: white url(".$row{'logo_url'}.") no-repeat center; background-size: 5vw auto;'></div></a>
					</td><td>
					<div class='biz-sim-results-nombre'> <a href='../biz/?id=".$row{'id_establecimiento'}."'> ".$row{'nombre'}."</a> </div>
					<div class='biz-sim-results-sub'> <a href='../busqueda/cat.php?q=".$row{'sub_categoria1'}."'>".$row{'sub_categoria1'}." </a>  &middot; <a href='../busqueda/cat.php?q=".$row{'sub_categoria2'}."'>".$row{'sub_categoria2'}." </a>  &middot; <a href='../busqueda/cat.php?q=".$row{'sub_categoria3'}."'> ".$row{'sub_categoria3'}." </a> <br> ".$row{'direccion'}." </div> 
					</td>
					</tr>";}
				?>
				<?php
					$result = mysql_query("SELECT * FROM Establecimiento WHERE nombre != (SELECT nombre FROM Establecimiento WHERE id_establecimiento='$ID') AND 
					(sub_categoria1=(SELECT sub_categoria3 FROM Establecimiento WHERE id_establecimiento='$ID') OR sub_categoria2=(SELECT sub_categoria3 FROM Establecimiento WHERE id_establecimiento='$ID')) ORDER BY special DESC LIMIT 4");
					while($row = mysql_fetch_array($result)) 
					{echo "
					<tr> <td width='6vw'>
					<a href='../biz/?id=".$row{'id_establecimiento'}."'> <div class='biz-sim-results-logo' style='background: white url(".$row{'logo_url'}.") no-repeat center; background-size: 5vw auto;'></div></a>
					</td><td>
					<div class='biz-sim-results-nombre'> <a href='../biz/?id=".$row{'id_establecimiento'}."'> ".$row{'nombre'}."</a> </div>
					<div class='biz-sim-results-sub'> <a href='../busqueda/cat.php?q=".$row{'sub_categoria1'}."'>".$row{'sub_categoria1'}." </a>  &middot; <a href='../busqueda/cat.php?q=".$row{'sub_categoria2'}."'>".$row{'sub_categoria2'}." </a>  &middot; <a href='../busqueda/cat.php?q=".$row{'sub_categoria3'}."'> ".$row{'sub_categoria3'}." </a> <br> ".$row{'direccion'}." </div> 
					</td>
					</tr>";}
				?>

			
			</table>
			</div>
		</div>
			</td>
			</tr>
			</table>


				
		</div> 
		</div>
		<div class="footer">
			<table>
				<tr>
					<td> © <?php echo"$site_name";?> </td>
					<td>
						<b> <?php echo"$site_name";?> </b>
						<br>
						<?php $result = mysql_query("SELECT name, directory FROM Page WHERE type='Principal' ORDER BY id_item "); while($row = mysql_fetch_array($result)) 
						{echo "<a href='../".$row{'directory'}."'>".$row{'name'}."</a><br>";}?>
					</td> 
					<td> 
						<b>  Ciudades </b>
						<br>
						<?php $result = mysql_query("SELECT Location.ciudad, directory FROM Location, Establecimiento WHERE Establecimiento.ciudad = Location.ciudad GROUP BY ciudad"); while($row = mysql_fetch_array($result)) 
						{echo "<a href='../".$row{'ciudad'}."'>".$row{'ciudad'}."</a><br>";}?>
					</td> 
					<td>
						 <b> Otros links </b>
						<br>
						<?php $result = mysql_query("SELECT name, directory FROM Page WHERE type='Otros links' ORDER BY id_item "); while($row = mysql_fetch_array($result)) 
						{echo "<a href='../".$row{'directory'}."'>".$row{'name'}."</a><br>";}?>
					</td>
				<tr>
			</table>
		</div>

		
	</body> 



</html>