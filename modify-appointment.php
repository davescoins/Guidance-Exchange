<?php
include('includes/session.inc.php');

if (isset($_POST['appointmentID'])) {
  $appointmentID = $_POST['appointmentID'];
  if (isset($_POST['canceled'])) {
    $sql = "UPDATE `Appointments_t` SET `Canceled` = 1 WHERE `AppointmentID` = $appointmentID";
    mysqli_query($con, $sql);
  }
  if (isset($_POST['complete'])) {
    $sql = "UPDATE `Appointments_t` SET `Completed` = 1 WHERE `AppointmentID` = $appointmentID";
    mysqli_query($con, $sql);
  }
  if (isset($_POST['missed'])) {
    $sql = "UPDATE `Appointments_t` SET `Missed` = 1 WHERE `AppointmentID` = $appointmentID";
    mysqli_query($con, $sql);
  }

  mysqli_close($con);
}

header('Location: appointments.php?profileID=' . $userID);
exit();
