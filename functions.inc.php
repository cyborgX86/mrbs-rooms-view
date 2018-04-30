<?php

/* qryBooking($date, $idroom) devuelve consulta sql de la lista de reservas. */
function qryBooking($date, $idroom){

  global $connection;
  $sql = "SELECT name,description,from_unixtime(start_time),from_unixtime(end_time),status
            FROM mrbs_entry
          WHERE from_unixtime(start_time)LIKE '%'$date'%' AND room_id = '$idroom'
            ORDER BY from_unixtime(start_time);";
  $qry = mysqli_query($connection, $sql);
  return $qry;
}

/* getRoom($idroom) devuelve en nombre de la sala.*/
function getRoom($idroom){

  global $connection;
  $sql = "SELECT room_name FROM mrbs_room WHERE id = '$idroom';";
  $qry = mysqli_query($connection, $sql);
  $room = mysqli_fetch_array($qry);
  return utf8_encode($room[0]);
}

/* ocupationState($qry) devuelve el estado de ocupación de la sala en función de
la fecha y hora del sistema.Return: 0-libre, 1:actividades, 2:solicitada.*/

/*Ejemplo $array_qry, array bidemensional (array de reservas):
Array (
[0] => Array (
[0] => Prueba de desarrollo No aprobar [name] => Prueba de desarrollo No aprobar
[1] => [description] =>
[2] => 2018-04-05 09:00:00 [from_unixtime(start_time)] => 2018-04-05 09:00:00
[3] => 2018-04-05 10:00:00 [from_unixtime(end_time)] => 2018-04-05 10:00:00
[4] => 2 [status] => 2)
[1] => Array (
[0] => Prueba de desarrollo No borrar [name] => Prueba de desarrollo No borrar
[1] => [description] =>
[2] => 2018-04-05 14:00:00 [from_unixtime(start_time)] => 2018-04-05 14:00:00
[3] => 2018-04-05 15:00:00 [from_unixtime(end_time)] => 2018-04-05 15:00:00
[4] => 0 [status] => 0)
)*/
//status = $booking[4]: 0-reserva aprobada, 2-reserva pendiente de aprobación.
function occupationState($qry){

  global $date;
  global $time;
  if (mysqli_num_rows($qry) == 0){
    return 0; //sala: libre.
  }else{
    $array_qry = array(); //array de reservas pendientes array_push($array_qry, $row).
    while($row=mysqli_fetch_array($qry)) {
      $dateBookingEnd = substr($row[3],0,10);
      $timeBookingEnd = substr($row[3],11,5);
      if ( ($dateBookingEnd > $date) || ($timeBookingEnd >= $time) ){
        array_push($array_qry, $row);
      }
    }
    if (count ($array_qry) == 0){
      return 0;
    }else{
      $flag = 0; //flag de estado (status == 2, occupationState($qry) == 2).
      foreach ($array_qry as $booking) {
        if ($booking[4] == 0) { //status == 0 - reserva aprobada
          $flag = 1;
          return 1; //sala: actividades.
          break;
        }
      }
      if ($flag == 0){
        return 2; //sala: solicitada.
      }
    }
  }
}

 /* printBooking($qry) devuelve la lista de reservas de la sala.*/
function printBooking($qry){

  global $date;
  global $time;

  echo "<ul>";
  while($row=mysqli_fetch_array($qry)) {
    $dateBookingEnd = substr($row[3],0,10);
    $timeBookingEnd = substr($row[3],11,5);
    $status = $row[4];
    if ( ($status == 0) && ( ($dateBookingEnd > $date) || ($timeBookingEnd >= $time) ) ){
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
