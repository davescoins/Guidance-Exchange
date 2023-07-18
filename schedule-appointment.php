<?php
include('includes/session.inc.php');

if (isset($_POST['appointmentID'])) {
  $appointmentID = $_POST['appointmentID'];
  $schedulerID = $_POST['schedulerID'];

  $sql = "UPDATE `Appointments_t` SET `SchedulerID` = $schedulerID WHERE `AppointmentID` = $appointmentID";
  mysqli_query($con, $sql);

  mysqli_close($con);
}

header('Location: appointments.php?profileID=' . $userID);
exit();
