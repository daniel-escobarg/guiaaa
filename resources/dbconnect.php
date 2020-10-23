<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "Guia";


// Create connection
$conn = mysqli_connect($servername, $username, $password, 'Guia');

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "";
?>
<?php

$sql = mysqli_query($conn, "SELECT value2 FROM Variable WHERE value1='Sitename'");
while($row = mysqli_fetch_array($sql)) 
$bar_color = $row['0'];
echo "$bar_color";

?>