<?php

require_once ("config.inc.php");
require_once ("functions.inc.php");

$date   = date('Y-m-d');
$time   = date('H:i');
$tomorrow = strtotime ('+1 day', strtotime ($date)) ;
$tomorrow = date ('Y-m-d', $tomorrow);

$connection=mysqli_connect($mysqlhost, $mysqluser, $mysqlpwd, $mysqldb);
mysqli_select_db($connection, $mysqldb);

echo '<!DOCTYPE html>
			<html>
			<head>
			<meta charset="UTF-8">
			<link rel="stylesheet" type="text/css" href="css/style.css" />
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<meta http-equiv="refresh" content="90; url=index.php" />
			<title>' . $titlePage . '</title>
			</head>
			<body>';

echo '<div id="booking-table" class="clear">';

// Sala izquierda
echo '<div class="room"><h3>' . getRoom($idroom_left);
if (occupationState(qryState($tomorrow, $idroom_left)) == 1){
	echo '<span class="tomorrow"><font color="#fe2e2e">Mañana</font></span></h3>
				<a class="signupon">Actividades</a>';
	printBooking(qryBooking($tomorrow, $idroom_left));
}else{
	echo '<span class="tomorrow"><font color="#72ce3f">Mañana</font></span></h3>
				<a class="signup">Libre</a>';
}
echo '</div>';

// Sala principal
echo '<div class="room" id="main"><h3>' . getRoom($idroom_main);
if (occupationState(qryState($tomorrow, $idroom_main)) == 1){
	echo '<span class="tomorrow"><font color="#fe2e2e">Mañana</font></span></h3>
				<a class="signupon">Actividades</a>';
	printBooking(qryBooking($tomorrow, $idroom_main));
}else{
	echo '<span class="tomorrow"><font color="#72ce3f">Mañana</font></span></h3>
				<a class="signup">Libre</a>';
}
echo '</div>';

// Sala derecha
echo '<div class="room"><h3>' . getRoom($idroom_right);
if (occupationState(qryState($tomorrow, $idroom_right)) == 1){
	echo '<span class="tomorrow"><font color="#fe2e2e">Mañana</font></span></h3>
				<a class="signupon">Actividades</a>';
	printBooking(qryBooking($tomorrow, $idroom_right));
}else{
	echo '<span class="tomorrow"><font color="#72ce3f">Mañana</font></span></h3>
				<a class="signup">Libre</a>';
}
echo '</div>';

echo '</div></body></html>';
?>
