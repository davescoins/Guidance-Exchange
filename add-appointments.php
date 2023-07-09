<?php
include('includes/session.inc.php');

if (isset($_POST['selection'])) {
  if ($_POST['selection'] == 'single' && isset($_POST['singleDate']) && isset($_POST['singleTime'])) {
    $dateTime = $_POST['singleDate'] . ' ' . $_POST['singleTime'];
    echo $dateTime;

    $sql = "INSERT INTO `Appointments_t` (`MentorID`, `SchedulerID`, `AppointmentTime`) VALUES ($userID, NULL, $dateTime);";
    mysqli_query($con, $sql);

    mysqli_close($con);
    header('Location: appointments.php?profileID=' . $userID);
    exit();
  } else {
    echo 'Error: All fields required';
    echo '<br>';
    echo '<a href="appointments.php?profileID=' . $userID . '<< Go Back</a>"';
  }

  if ($_POST['selection' == 'range']) {
  }
}
