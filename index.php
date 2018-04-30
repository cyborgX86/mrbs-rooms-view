<?php

/*
Pendiente:
Revisar css.
Función javascript Fade con refresco.
*/

require_once ("config.inc.php");
require_once ("functions.php");

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
			<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
			<script type="text/javascript" src="js/alternate.js"></script>
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<!--<meta http-equiv="refresh" content="600" />-->
			<title>' . $titlePage . '</title>
			</head>';
echo '<body>
			<div id="booking-table" class="clear">
			<div id="today">';

// Sala izquierda
echo '<div class="room"><h3>' . getRoom($idroom_left);

if (occupationState(qryBooking($date, $idroom_left)) == 1){
  echo '<span><font color="#fe2e2e">Hoy</font></span></h3>
        <a class="occupied">Actividades</a>';
  printBooking(qryBooking($date, $idroom_left));
}elseif (occupationState(qryBooking($date, $idroom_left)) == 0) {
  echo '<span><font color="#72ce3f">Hoy</font></span></h3>
        <a class="vacant">Libre</a>';
}else{
  echo '<span><font color="#feaa02">Hoy</font></span></h3>
        <a class="requested">Solicitada: Pida información</a>';
}
echo '</div>';

// Sala principal
echo '<div class="room" id="main"><h3>' . getRoom($idroom_main);
if (occupationState(qryBooking($date, $idroom_main)) == 1){
  echo '<span><font color="#fe2e2e">Hoy</font></span></h3>
        <a class="occupied">Actividades</a>';
  printBooking(qryBooking($date, $idroom_main));
}elseif (occupationState(qryBooking($date, $idroom_main)) == 0) {
  echo '<span><font color="#72ce3f">Hoy</font></span></h3>
        <a class="vacant">Libre</a>';
}else{
  echo '<span><font color="#feaa02">Hoy</font></span></h3>
        <a class="requested">Solicitada: Pida información</a>';
}
echo '</div>';

// Sala derecha
echo '<div class="room"><h3>' . getRoom($idroom_right);

if (occupationState(qryBooking($date, $idroom_right)) == 1){
  echo '<span><font color="#fe2e2e">Hoy</font></span></h3>
        <a class="occupied">Actividades</a>';
  printBooking(qryBooking($date, $idroom_right));
}elseif (occupationState(qryBooking($date, $idroom_right)) == 0) {
  echo '<span><font color="#72ce3f">Hoy</font></span></h3>
        <a class="vacant">Libre</a>';
}else{
  echo '<span><font color="#feaa02">Hoy</font></span></h3>
        <a class="requested">Solicitada: Pida información</a>';
}
echo '</div></div>
      <div id="hide" style="display:none;">
      <div id="tomorrow">';

// Sala izquierda
echo '<div class="room"><h3>' . getRoom($idroom_left);
if (occupationState(qryBooking($tomorrow, $idroom_left)) == 1){
  echo '<span class="tomorrow"><font color="#fe2e2e">Mañana</font></span></h3>
        <a class="occupied">Actividades</a>';
  printBooking(qryBooking($tomorrow, $idroom_left));
}elseif (occupationState(qryBooking($tomorrow, $idroom_left)) == 0) {
  echo '<span class="tomorrow"><font color="#72ce3f">Mañana</font></span></h3>
        <a class="vacant">Libre</a>';
}else{
  echo '<span class="tomorrow"><font color="#feaa02">Mañana</font></span></h3>
        <a class="requested">Solicitada: Pida información</a>';
}
echo '</div>';

// Sala principal
echo '<div class="room" id="main"><h3>' . getRoom($idroom_main);
if (occupationState(qryBooking($tomorrow, $idroom_main)) == 1){
  echo '<span class="tomorrow"><font color="#fe2e2e">Mañana</font></span></h3>
        <a class="occupied">Actividades</a>';
  printBooking(qryBooking($tomorrow, $idroom_main));
}elseif (occupationState(qryBooking($tomorrow, $idroom_main)) == 0) {
  echo '<span class="tomorrow"><font color="#72ce3f">Mañana</font></span></h3>
        <a class="vacant">Libre</a>';
}else{
  echo '<span class="tomorrow"><font color="#feaa02">Mañana</font></span></h3>
        <a class="requested">Solicitada: Pida información</a>';
}
echo '</div>';

// Sala derecha
echo '<div class="room"><h3>' . getRoom($idroom_right);
if (occupationState(qryBooking($tomorrow, $idroom_right)) == 1){
  echo '<span class="tomorrow"><font color="#fe2e2e">Mañana</font></span></h3>
        <a class="occupied">Actividades</a>';
  printBooking(qryBooking($tomorrow, $idroom_right));
}elseif (occupationState(qryBooking($tomorrow, $idroom_right)) == 0) {
  echo '<span class="tomorrow"><font color="#72ce3f">Mañana</font></span></h3>
        <a class="vacant">Libre</a>';
}else{
  echo '<span class="tomorrow"><font color="#feaa02">Mañana</font></span></h3>
        <a class="requested">Solicitada: Pida información</a>';
}
echo '</div>
      </div></div>
      </div></body></html>';
?>
