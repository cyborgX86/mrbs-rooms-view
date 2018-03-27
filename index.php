<?php

// Pendiente:
// revisar CSS.
// ajax para actualizar automáticamente el contenido del div.
// ver qué pasa con las conexiones mysql que abrimos.


require_once ("config.inc.php");
require_once ("functions.inc.php");

$date   = date('Y-m-d');
$time   = date('H:i');

$connection=mysqli_connect($mysqlhost, $mysqluser, $mysqlpwd, $mysqldb);
mysqli_select_db($connection, $mysqldb);

echo '<!DOCTYPE html>
			<html>
			<head>
			<meta charset="UTF-8">
			<link rel="stylesheet" type="text/css" href="css/style.css" />
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<meta http-equiv="refresh" content="90; url=tomorrow.php" />
			<title>' . $titlePage . '</title>
			</head>
			<body>';


echo '<div id="booking-table" class="clear">';

// Sala izquierda
echo '<div class="room"><h3>' . getRoom($idroom_left);
if (occupationState(qryState($date, $idroom_left)) == 1){
	echo '<span><font color="#fe2e2e">Hoy</font></span></h3>
				<a class="signupon">Actividades</a>';
	printBooking(qryBooking($date, $idroom_left));
}else{
	echo '<span><font color="#72ce3f">Hoy</font></span></h3>
				<a class="signup">Libre</a>';
}
echo '</div>';

// Sala principal
echo '<div class="room" id="main"><h3>' . getRoom($idroom_main);
if (occupationState(qryState($date, $idroom_main)) == 1){
	echo '<span><font color="#fe2e2e">Hoy</font></span></h3>
				<a class="signupon">Actividades</a>';
	printBooking(qryBooking($date, $idroom_main));
}else{
	echo '<span><font color="#72ce3f">Hoy</font></span></h3>
				<a class="signup">Libre</a>';
}
echo '</div>';

// Sala derecha
echo '<div class="room"><h3>' . getRoom($idroom_right);
if (occupationState(qryState($date, $idroom_right)) == 1){
	echo '<span><font color="#fe2e2e">Hoy</font></span></h3>
				<a class="signupon">Actividades</a>';
	printBooking(qryBooking($date, $idroom_right));
}else{
	echo '<span><font color="#72ce3f">Hoy</font></span></h3>
				<a class="signup">Libre</a>';
}
echo '</div>';

echo '</div></body></html>';
?>
