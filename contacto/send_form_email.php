<?php
 
if(isset($_POST['email'])) {
    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "descobar398@gmail.com";
    $email_subject = "Sambo Guía - Un mensaje del la Paginas Web";
 
    function died($error) {
        // your error code can go here
        echo "Lo sentimos, hay un error con la inforación ingresada.";
        echo "Aparecen estos errores.<br /><br />";
        echo $error."<br /><br />";
        echo "Porfavor regresar y corregirlos.<br /><br />";
        die();
    }

 
    // validation expected data exists
    if(!isset($_POST['first_name']) ||
        !isset($_POST['last_name']) ||
        !isset($_POST['email']) ||
        !isset($_POST['telephone']) ||
        !isset($_POST['comments'])) {
        died('Lo sentimos, hay un error con la inforación ingresada.');       
    }
 
    $first_name = $_POST['first_name']; // required
    $last_name = $_POST['last_name']; // required
    $email_from = $_POST['email']; // required
    $telephone = $_POST['telephone']; // not required
    $comments = $_POST['comments']; // required
 
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'El correo electonico ingresado no es valido. <br />';
  }
 
    $string_exp = "/^[A-Za-z .'-]+$/";
  if(!preg_match($string_exp,$first_name)) {
    $error_message .= 'El nombre ingresado no es valido.<br />';
 
  }
 
  if(!preg_match($string_exp,$last_name)) {
    $error_message .= 'El apellido ingresado no es valido.<br />';
  }
 
  if(strlen($comments) < 2) {
    $error_message .= 'El mensaje ingresado no es valido..<br />';
  }
 
  if(strlen($error_message) > 0) {
    died($error_message);
  }
 
    $email_message = "inforación: .\n\n";     
 
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
 
    }
 
     
    $email_message .= "Nombre ".clean_string($first_name)."\n";
    $email_message .= "Apellido: ".clean_string($last_name)."\n";
    $email_message .= "Correo: ".clean_string($email_from)."\n";
    $email_message .= "Teléfono: ".clean_string($telephone)."\n";
    $email_message .= "Mensaje: ".clean_string($comments)."\n";
 
// create email headers
 
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);  
 
?>

<!-- include your own success html here -->

<?php 


$Cat = 'Contacto';

include_once '../resources/dbconnect.php';									
$res1 = mysql_query("SELECT value FROM Item WHERE id_item='1'");
while($row = mysql_fetch_array($res1)) 
$titulo = $row['value'];

$res2 = mysql_query("SELECT value FROM Item WHERE id_item='2'");
while($row = mysql_fetch_array($res2)) 
$selecthead = $row['value'];


$menubar1 = mysql_query("SELECT value, value2 FROM Item WHERE id_item='3'");
while($row = mysql_fetch_array($menubar1)) 
$menutitle1 = $row['value'];

$menubar1 = mysql_query("SELECT value, value2 FROM Item WHERE id_item='3'");
while($row = mysql_fetch_array($menubar1)) 
$menulink1 = $row['value2'];


$menubar2 = mysql_query("SELECT value, value2 FROM Item WHERE id_item='4'");
while($row = mysql_fetch_array($menubar2)) 
$menutitle2 = $row['value'];

$menubar2 = mysql_query("SELECT value, value2 FROM Item WHERE id_item='4'");
while($row = mysql_fetch_array($menubar2)) 
$menulink2 = $row['value2'];

$menubar3 = mysql_query("SELECT value, value2 FROM Item WHERE id_item='5'");
while($row = mysql_fetch_array($menubar3)) 
$menutitle3 = $row['value'];

$menubar3 = mysql_query("SELECT value, value2 FROM Item WHERE id_item='5'");
while($row = mysql_fetch_array($menubar3)) 
$menulink3 = $row['value2'];

$menubar4 = mysql_query("SELECT value, value2 FROM Item WHERE id_item='6'");
while($row = mysql_fetch_array($menubar4)) 
$menulink4 = $row['value2'];

$menubar4 = mysql_query("SELECT value, value2 FROM Item WHERE id_item='6'");
while($row = mysql_fetch_array($menubar4)) 
$menutitle4 = $row['value'];

$menubar5 = mysql_query("SELECT value, value2 FROM Item WHERE id_item='7'");
while($row = mysql_fetch_array($menubar5)) 
$menulink5 = $row['value2'];

$menubar5 = mysql_query("SELECT value, value2 FROM Item WHERE id_item='7'");
while($row = mysql_fetch_array($menubar5)) 
$menutitle5 = $row['value'];

$res = mysql_query("SELECT value, value2, value3 FROM Item WHERE value='$Cat'");
while($row = mysql_fetch_array($res)) 
$categoria = $row['value'];

$res = mysql_query("SELECT value, value2, value3 FROM Item WHERE value='$Cat'");
while($row = mysql_fetch_array($res)) 
$categoriaplural = $row['1'];

$res = mysql_query("SELECT value, value2, value3 FROM Item WHERE value='$Cat'");
while($row = mysql_fetch_array($res)) 
$categorialink = $row['2'];

?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
		<title> <?php echo"$categoriaplural";?>  | <?php echo"$titulo";?> </title>
		<link rel="stylesheet" type="text/css" href="../resources/style.css">
		<link rel="alternate" media="only screen and (max-width: 640px)" href="http://danielescobarg.com/m/agregarlugares/">
		<meta name="viewport" content="initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta http-equiv="Content-Type" content="text/html; charset=ISO8859-15" />

		<script type="text/javascript">
		<!--
		if (screen.width <= 699) {
		document.location = "http://danielescobarg.com/m/agregarlugares";
		}
		//-->
		</script>

</head> 

<body> 
	<div class="webtitle">
			<a href="../"> <?php echo"$titulo";?></a>
	</div>


	<div class="top-bar">
					
	</div>

	

		<div class="Contacto">
		
			<h3> Contactanos </h3>
				
				<br>
				<br>
				<p> Gracias por contactarse con nosotros. </p>
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


 
<?php
 
}
 
