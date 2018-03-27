<?php

/* qryBooking() devuelve consulta sql de la lista de reservas.*/

function qryBooking($date, $idroom){

global $connection;

$sql = "SELECT name,description,from_unixtime(start_time),from_unixtime(end_time)
          FROM mrbs_entry
        WHERE from_unixtime(start_time)LIKE '%" . $date . "%' AND room_id = " . $idroom . "
          ORDER BY from_unixtime(start_time);";

$qry = mysqli_query($connection, $sql);
return $qry;
}

/* qryState() devuelve la última fila de la consulta sql para evaluar si existen
reservas (ocupación).*/

function qryState($date, $idroom){

global $connection;

$sql = "SELECT name,description,from_unixtime(start_time),from_unixtime(end_time)
          FROM mrbs_entry
        WHERE from_unixtime(start_time) LIKE '%" . $date . "%' AND room_id = " . $idroom . "
          ORDER BY from_unixtime(start_time) DESC LIMIT 1;";

$qry = mysqli_query($connection, $sql);
return $qry;
}

/* getRoom() devuelve en nombre de la sala.*/

function getRoom($idroom){

global $connection;

$sql = "SELECT room_name FROM mrbs_room WHERE id = " . $idroom . ";";
$qry = mysqli_query($connection, $sql);
$room = mysqli_fetch_array($qry);

return utf8_encode($room[0]);
}

 /* ocupationState() evalúa si existen o no reservas en función de la fecha y hora
 del sistema.*/

function occupationState($qryState){

  	global $date;
   	global $time;
  	$row = mysqli_fetch_array($qryState);
  	$dateBookingEnd = substr($row[3],0,10);
  	$timeBookingEnd = substr($row[3],11,5);

  	if (mysqli_num_rows($qryState) == 0){
  		return 0;
  	}else{
  		if ( ($dateBookingEnd > $date) || ($timeBookingEnd >= $time) ){
  			return 1;
  		}else{
  			return 0;
  		}
  	}
  }

/* printBooking() devuelve la lista de reservas de la sala.*/

function printBooking($qry){

  global $date;
 	global $time;

	echo "<ul>";
	while($row=mysqli_fetch_array($qry)) {

    $dateBookingEnd = substr($row[3],0,10);
		$timeBookingEnd = substr($row[3],11,5);

    if ( ($dateBookingEnd > $date) || ($timeBookingEnd >= $time) ){
			echo '<li><table><tr>
			      <th width="25%">' . substr($row[2],11,5) . '-' . substr($row[3],11,5) .'</th>
			      <th>' . utf8_encode ($row['name']) . '</th></tr>';
      if (empty ($row['description'])){
      	echo '<tr><td colspan="2">No existe información detallada para esta actividad
              </td></tr></table></li>';
      }else{
      	echo '<tr><td colspan="2">' . utf8_encode ($row['description']) .
             '</td></tr></table></li>';
			}
		}
	}
  echo '</ul>Información actualizada en tiempo real - Hora del sistema: ' . $time;
}
?>
