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

$sql = mysql_query("SELECT nombre FROM Evento WHERE id_evento='$ID'");
while($row = mysql_fetch_array($sql)) 
$biz_name = $row['0'];

$tags = mysql_query("SELECT search_tags FROM Evento WHERE id_evento='$ID'");
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
		<div class="top-bar">	</div>
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
					<option value="Puerto Santa Ana">&emsp;Puerto Santa Ana</option>
					<option value="Santa Elena">Santa Elena</option>
					<option value="Salinas">&emsp;Salinas</option>
					<option value="Libertad">&emsp;Libertad</option>
					<option value="Puerto Lucia">&emsp;Puerto Lucia</option>
					<option value="Ballenita">&emsp;Ballenita</option>
					<option value="Montañita">&emsp;Montañita</option>
					<option value="Olon">&emsp;Olon</option>
				</select>				
			</form>
			</div>
		</div>
	
	<div class="evento-content">
	<div class='evento-results'> 
	<table>
	<tr>
		<?php
			$result = mysql_query("SELECT  *, DATE_FORMAT(hora_inicio,'%I:%i') as hora_i, DATE_FORMAT(hora_termina,'%I:%i') as hora_t, DATE_FORMAT(fecha,'%b %e, %y') as fecha, Establecimiento.nombre as nombre_lugar
			FROM Establecimiento, Evento
			WHERE Establecimiento.id_establecimiento=Evento.id_establecimiento AND  id_evento='$ID '");
			while($row = mysql_fetch_array($result)) 
			{echo "<td>
			<div class='evento-results-logo' style='background: white url(".$row{'poster_url'}.") no-repeat center;    background-size: 16vw;'></div>
		</td>
		<td>
			
		<div class='evento-results-nombre'> ".$row{'nombre'}."</a> </div>
			
			<div class='evento-results-sub'> 
				<a href='../busqueda/cat.php?q=".$row{'categoria'}."'>".$row{'categoria'}."</a> 
  				| ".$row{'clasificacion'}." 
				 
			</div>
			
			<div class='evento-results-sum'>
				<img id='icon' src='http://simpleicon.com/wp-content/uploads/coin-money-2.png'> 
				Costo <b>".$row{'costo'}."</b>
				<br>
				<img id='icon' src='https://cdn3.iconfinder.com/data/icons/linecons-free-vector-icons-pack/32/calendar-128.png'> 
				Fecha <b>".$row{'fecha'}."</b>
				<br>
				<img id='icon' src='https://cdn0.iconfinder.com/data/icons/feather/96/clock-128.png'> 
				Hora <b>".$row{'hora_i'}." - ".$row{'hora_t'}."</b>
				<br>
				<img id='icon' src='https://cdn2.iconfinder.com/data/icons/social-networks-7/128/Socialmedia_icons_Navigation-32.png'> 
				Lugar <b><a href='../biz/?id=".$row{'id_establecimiento'}."&loc=$Loc'>".$row{'nombre_lugar'}."</a></b>
			</div>
			<div class='evento-results-descripcion'
				<p>".$row{'descripcion'}."</p>
			</div>
			<div class='evento-results-tags'>
			$st
			</td> <td>";}
			echo"<div class='evento-results-funciones'>
				<h3> Todas las funciones </h3>	";
			$result = mysql_query("SELECT DATE_FORMAT(hora_inicio,'%H:%i') as hora_i, DATE_FORMAT(hora_termina,'%H:%i') as hora_t, DATE_FORMAT(fecha,'%b %e, %Y') as fecha FROM Evento
			WHERE Evento.nombre=(SELECT Nombre FROM Evento WHERE id_evento='$ID ')");
			while($row = mysql_fetch_array($result)) 
			{echo "
				".$row{'fecha'}." - <b> ".$row{'hora_i'}."</b> 
				<br>

				";} 	
			echo"</div> ";

			$result = mysql_query("SELECT  *, Establecimiento.nombre as nombre_lugar, DATE_FORMAT(abre_1,'%H:%i') as abre_1, DATE_FORMAT(abre_2,'%H:%i') as abre_2, DATE_FORMAT(abre_3,'%H:%i') as abre_3, DATE_FORMAT(abre_4,'%H:%i') as abre_4, DATE_FORMAT(abre_5,'%H:%i') as abre_5, DATE_FORMAT(abre_6,'%H:%i') as abre_6, DATE_FORMAT(abre_7,'%H:%i') as abre_7, DATE_FORMAT(cierra_1,'%H:%i') as cierra_1, DATE_FORMAT(cierra_2,'%H:%i') as cierra_2, DATE_FORMAT(cierra_3,'%H:%i') as cierra_3, DATE_FORMAT(cierra_4,'%H:%i') as cierra_4, DATE_FORMAT(cierra_5,'%H:%i') as cierra_5, DATE_FORMAT(cierra_6,'%H:%i') as cierra_6, DATE_FORMAT(cierra_7,'%H:%i') as cierra_7
			FROM Establecimiento, Evento
			WHERE Establecimiento.id_establecimiento=Evento.id_establecimiento AND  id_evento='$ID '");
			while($row = mysql_fetch_array($result)) 
			{echo "

			<div class='evento-results-servicios'>
				<h3> ".$row{'nombre_lugar'}." </h3>	

				Acepta tarjetas de crédito <b> ".$row{'tarjeta'}."</b>
				<br>
				Estacionamiento <b>".$row{'parqueo'}."</b>
				<br>
				Sirven alcohol <b>".$row{'alcohol'}."</b>
				<br>
				Wi-fi <b> ".$row{'wifi'}."</b>
			</div>
			</div>
			
			<div class='evento-results-contact'>
				<iframe width='100%' height='60%'frameborder='0' style='border:0' src='https://www.google.com/maps/embed/v1/place?key=AIzaSyBVfn0ZZyTZn5R9c25SgxaCq9K6_niHFUw&q=".$row{'nombre_lugar'}."+samborondon&language=es_EC&zoom=17 allowfullscreen'>
				</iframe>	
				<img id='icon' src='http://icons.veryicon.com/ico/System/iOS7%20Minimal/Maps%20Near%20me.ico'>&emsp;".$row{'direccion'}.", Av. Samborondón
				<hr>
				<img id='icon' src='http://images.clipartpanda.com/phone-call-icon-aiqeMor9T.png'>&emsp;".$row{'telef_1'}." ".$row{'telef_2'}." 
				<hr>			
				<img id='icon' src='https://cdn2.iconfinder.com/data/icons/gentle-edges-icon-set/128/Iconfinder_0039_15.png'>&emsp;<a href='http://".$row{'sitio_web'}."' target='_blank'>".$row{'sitio_web'}." </a>
			</div>
			<div class='evento-results-horario'>
				<h3> Horas de atención </h3>	
				    <b>lun.</b>&nbsp;&nbsp;&emsp;".$row{'abre_1'}." - ".$row{'cierra_1'}."
				<br><b>mar.</b>&nbsp;&emsp;".$row{'abre_2'}." - ".$row{'cierra_2'}."
				<br><b>mie.</b>&nbsp;&emsp;".$row{'abre_3'}." - ".$row{'cierra_3'}."
				<br><b>jue.</b>&nbsp;&nbsp;&emsp;".$row{'abre_4'}." - ".$row{'cierra_4'}."
				<br><b>vie.</b>&nbsp;&nbsp;&emsp;".$row{'abre_5'}." - ".$row{'cierra_5'}."
				<br><b>sab.</b>&nbsp;&emsp;".$row{'abre_6'}." - ".$row{'cierra_6'}."
				<br><b>dom.</b>&nbsp;&nbsp;&nbsp;".$row{'abre_7'}." - ".$row{'cierra_7'}."
			</div> 
		</td>";} ?>
		

		
		<td>
			<div class='evento-sim'>
			<h3> Proximos eventos </h3>	
			<table>
			<tr>
			<?php
				$result = mysql_query("SELECT id_evento, costo, Evento.categoria, poster_url, Establecimiento.id_establecimiento, Evento.nombre, DATE_FORMAT(fecha,'%b %e') as fecha_i, DATE_FORMAT(hora_inicio,'%H:%i') as hora_inicio_i, DATE_FORMAT(hora_termina,'%H:%i') as hora_btermina, Establecimiento.nombre as nombre_lugar FROM Evento, Establecimiento WHERE Establecimiento.id_establecimiento = Evento.id_establecimiento AND fecha >= CURDATE() AND Evento.nombre != (Select nombre From Evento WHERE id_evento='$ID ')  ORDER BY fecha ASC, hora_inicio ASC limit 10
				");
				while($row = mysql_fetch_array($result)) 
				{echo "<tr><td> 
				<a href='../evento/?id=".$row{'id_evento'}."&loc=$Loc'> <div class='evento-sim-logo' style='background:  white url(".$row{'poster_url'}.") no-repeat center; background-size: auto 6.6vw;'>
					</div> </a>
					</td> <td>
				<div class='evento-sim-title'>
					<b><a href='../evento/?id=".$row{'id_evento'}."&loc=$Loc'>".$row{'nombre'}."</a></b><i><a href='../evento/?id=".$row{'id_evento'}."&loc=$Loc'>".$row{'categoria'}."</a></i>
					<br>					
					<a href='../evento/?id=".$row{'id_evento'}."&loc=$Loc'>".$row{'fecha_i'}." ".$row{'hora_inicio_i'}."</a> &middot; <a href='../evento/?id=".$row{'id_evento'}."&loc=$Loc'>".$row{'costo'}."</a>
					<br>
					<a href='../biz/?id=".$row{'id_establecimiento'}."&loc=$Loc'>".$row{'nombre_lugar'}."</a>
				</div>
				</td></tr>";}
					?> 
</table>
			</div>
			
		</div>
			</td>
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
						<?php $result = mysql_query("SELECT name, directory FROM Page WHERE type='Principal' ORDER BY id_item "); while($row = mysql_fetch_array($result)) 
						{echo "<a href='../".$row{'directory'}."'>".$row{'name'}."</a><br>";}?>
					</td> 
					<td> 
						<b> Ciudades </b>
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