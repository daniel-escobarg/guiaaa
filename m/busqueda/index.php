<?php 
include_once '../../resources/dbconnect.php';							
$page_name = 'Busqueda';

$Loc=$_GET["loc"];
$D=$_GET["d"];
$P=$_GET["p"];
$C=$_GET["c"];
$q=$_GET["q"];

if(empty($_GET['loc'])) 
{ 
  header('Location: ../');
  exit; 
}

if(empty($_GET['q'])) 
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
		<title> <?php echo"$q";?> | <?php echo"$site_name";?></title>
		<link rel="stylesheet" type="text/css" href="../style.css">
		
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta http-equiv="Content-Type" content="text/html; charset=ISO8859-15" />
		<meta name="mobile-web-app-capable" content="yes">

		
	</head> 

	<body> 
	<div id="mySidenav" class="sidenav">
		<a href="javascript:void(0)" class="closebtn" style="border: 0vw white solid;" onclick="closeNav()">&times;</a>
		<a id="active" href="../busqueda?loc=<?php echo"$Loc";?>">Busqueda</a>
		<a href="../">Inicio</a>
		<a href="../ciudades">Ciudades</a>
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

			<div id="mySideFiltr" class="sidefilter">
		<div class="main-results-filter">
			<h1> Filtra </h1>
			<form name="categorysearch" id="categorysearch" action="../busqueda" method="GET">
			<input type="text" name="q" value="<?php echo"$q"; error_reporting(0); ?>">
			<select name="loc" required>
					<option value="<?php echo"$Loc";?>"><?php echo"$Loc";?></option>
					<option value="noplace" disabled>Escoge un lugar</option>
					<option value="Guayaquil">Guayaquil</option>
					<option value="Samborondón">&emsp;Samborondón</option>
					<option value="Vía a la costa">&emsp;Vía a la Costa</option>
			</select>
					<select name="c" required> 
					<option value="%%" selected> Categoria </option>
					<option value="%%"> Todas </option>
					<?php
					$result = mysql_query("
						SELECT sub_categorias.categoria  FROM sub_categorias, Establecimiento 
						WHERE (sub_categorias.subcategoria = Establecimiento.sub_categoria1 OR sub_categorias.subcategoria = Establecimiento.sub_categoria2 OR sub_categorias.subcategoria = Establecimiento.sub_categoria3) 
						GROUP BY categoria"); 
					while($row = mysql_fetch_array($result)) {echo "<option value='".$row{'categoria'}."'>".$row{'categoria'}."</option>";} 
					?> 
				</select>	
			<select name="d" required> 
				<option value="%%" selected > Delivery </option>
				<option value="Sí"> Sí </option>
				<option value="%%"> Todo </option>
			</select>
			<select name="p" required> 
				<option value="%%" selected> Rango de precios </option>
				<option value="%%"> Todo </option>
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
			

	
		<div class="search-area">
			<form name="searchbar" action="../busqueda" method="GET">
			<input type="text" name="q" required="1" max="10"  placeholder="<?php echo"$search_placeholder";?>" value="<?php echo"$q"; error_reporting(0); ?>"/>
			<input value="<?php echo"$Loc";?>" name="loc" hidden>
			<input value="%%" name="c" hidden>
			<input value="%%" name="d" hidden>
			<input value="%%" name="p" hidden>
			<input type="submit" value="">
					
			</form>
		</div>

		

		<div class='main-results' > 
		<table>
		<?php
		$result = mysql_query("SELECT COUNT(id_establecimiento) as count FROM Establecimiento WHERE (zona LIKE '%$Loc%' OR ciudad LIKE '%$Loc%') AND delivery LIKE '$D' AND price_range LIKE '$P' AND categoria LIKE '%$C%'  AND (($clause1) OR categoria='$q' OR ($clause3) OR ($clause4) OR ($clause5) OR ($clause6) OR ($clause7))"); 
			while($row = mysql_fetch_array($result)){echo "<tr><td style='background: white; font-size: 4vw; text-align: right; vertical-align: middle;'>".$row{'count'}."</td> <td style='background: white; text-align: left; font-size: 4vw;vertical-align: middle;'> resultado(s) en $Loc </td> <td> </td> </tr>";} echo"<tr> </tr>";


		
		$result = mysql_query("SELECT *, CONCAT(LEFT(CONCAT(sub_categoria1, ', ',sub_categoria2,', ', sub_categoria3),32),'') as sub_categorias, Rango_precio.rango as rango, DATE_FORMAT(abre_1,'%H:%i') as abre_1, DATE_FORMAT(abre_2,'%H:%i') as abre_2, DATE_FORMAT(abre_3,'%H:%i') as abre_3, DATE_FORMAT(abre_4,'%H:%i') as abre_4, DATE_FORMAT(abre_5,'%H:%i') as abre_5, DATE_FORMAT(abre_6,'%H:%i') as abre_6, DATE_FORMAT(abre_7,'%H:%i') as abre_7, DATE_FORMAT(cierra_1,'%H:%i') as cierra_1, DATE_FORMAT(cierra_2,'%H:%i') as cierra_2, DATE_FORMAT(cierra_3,'%H:%i') as cierra_3, DATE_FORMAT(cierra_4,'%H:%i') as cierra_4, DATE_FORMAT(cierra_5,'%H:%i') as cierra_5, DATE_FORMAT(cierra_6,'%H:%i') as cierra_6, DATE_FORMAT(cierra_7,'%H:%i') as cierra_7,  DATE_FORMAT($abretoday,'%H:%i') as abre_hoy, DATE_FORMAT($cierratoday,'%H:%i') as cierra_hoy FROM Establecimiento, Rango_precio
				WHERE Rango_precio.signo = price_range AND (zona LIKE '%$Loc%' OR ciudad LIKE '%$Loc%') AND categoria LIKE '%$C%'  AND  delivery LIKE '$D' AND price_range LIKE '$P' AND (($clause1) OR categoria='$words' OR ($clause3) OR ($clause4) OR ($clause5) OR ($clause6) OR ($clause7)) GROUP BY id_establecimiento ORDER BY special DESC"); 
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
	";}?> </table></div>
				



		
		
	</body> 

	<footer>

	</footer>
</html>