<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Guidance Exchange | Add Appointments</title>
  <link rel="icon" type="image/png" sizes="192x192" href="/favicon-192.png">
  <link rel="icon" type="image/png" sizes="180x180" href="/favicon-180.png">
  <link rel="icon" type="image/png" sizes="128x128" href="/favicon-128.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32.png">
  <link href="assets/fontawesome/css/fontawesome.css" rel="stylesheet">
  <link href="assets/fontawesome/css/brands.css" rel="stylesheet">
  <link href="assets/fontawesome/css/solid.css" rel="stylesheet">
  <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="css/profile.css" />
  <link rel="stylesheet" href="css/appointments.css" />
  <link rel="stylesheet" href="css/main.css" />
</head>

<header>
  <?php
  include('includes/session.inc.php');
  ?>
  <nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="home.php"><img src="img/logo_gradient.png" alt="Guidance Exchange Logo" height="70" /></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <?php
          if ($userModeratorStatus == true) {
            echo '<li class="nav-item">';
            echo ' <a class="nav-link highlight-link nav-text px-4" href="moderator-dashboard.php?profileID=' . $userID . '">Moderator Dashboard</a>';
            echo '</li>';
          }
          if ($userSystemAdministratorStatus == true) {
            echo '<li class="nav-item">';
            echo ' <a class="nav-link highlight-link nav-text px-4" href="admin-dashboard.php?profileID=' . $userID . '">Administrator Dashboard</a>';
            echo '</li>';
          }
          ?>
          <li class="nav-item">
            <a class="nav-link highlight-link nav-text px-4" href="profile.php?profileID=<?php echo ' . $userID . '; ?>">Profile</a>
          </li>
          <li class="nav-item">
            <a class="nav-link highlight-link nav-text px-4" href="#">Communities</a>
          </li>
        </ul>
        <ul class="navbar-nav d-flex flex-row me-1">
          <li class="nav-item me-3 me-lg-0 px-2 d-flex align-items-center">
            <form class="d-flex" role="search" action="search.php" method="GET">
              <input class="form-control me-2" name="query" type="search" placeholder="Search" aria-label="Search">
              <button class="btn" type="submit"><i class="fa-solid fa-magnifying-glass fa-xl"></i></button>
            </form>
          </li>
          <li class="nav-item me-3 me-lg-0 px-2">
            <a class="nav-link" href="#"><i class="fa-solid fa-inbox fa-xl"></i></a>
          </li>
          <li class="nav-item dropdown me-3 me-lg-0 px-2 d-flex justify-content-center">
            <button class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa-solid fa-user-group fa-xl"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item" href="logout.php">Logout</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>

<body>
  <?php

  if (isset($_POST['selection'])) {
    $sqlAppointments = "SELECT `AppointmentTime` FROM `Appointments_t` WHERE `MentorID` = $userID";
    $resultAppointments = mysqli_query($con, $sqlAppointments);

    if (mysqli_num_rows($resultAppointments) > 0) {
      $appointmentsArray = array();
      while ($appointments = mysqli_fetch_assoc($resultAppointments)) {
        $appointmentDateTime = $appointments['AppointmentTime'];
        $appointmentDate = explode(" ", $appointmentDateTime)[0];
        $appointmentTime = explode(" ", $appointmentDateTime)[1];
        $appointmentsArray[] = array($appointmentDate, $appointmentTime);
      }
      sort($appointmentsArray);
    }

    $appointmentsAssoc = array();
    foreach ($appointmentsArray as $appointment) {
      $date = $appointment[0];
      $time = $appointment[1];
      if (!isset($appointmentsAssoc[$date])) {
        $appointmentsAssoc[$date] = array();
      }
      $appointmentsAssoc[$date][] = $time;
    }

    if ($_POST['selection'] == 'single') {
      if (isset($_POST['singleDate']) && isset($_POST['singleTime'])) {
        $dateTime = $_POST['singleDate'] . ' ' . date_format(date_create($_POST['singleTime']), "G:i:s");
        echo $dateTime;

        if (in_array(date_format(date_create($_POST['singleTime']), "G:i:s"), $appointmentsAssoc[$_POST['singleDate']])) {
          echo 'Appointment slot already exists. Please try again.';
          echo '<br>';
          echo '<a href="appointments.php?profileID=' . $userID . '"><< Go Back</a>';
        } else {
          $sql = "INSERT INTO `Appointments_t` (`MentorID`, `SchedulerID`, `AppointmentTime`) VALUES ($userID, NULL, '$dateTime')";
          mysqli_query($con, $sql);

          mysqli_close($con);
          header('Location: appointments.php?profileID=' . $userID);
          exit();
        }
      } else {
        echo 'Error: All fields required. Please try again.';
        echo '<br>';
        echo '<a href="appointments.php?profileID=' . $userID . '"><< Go Back</a>';
      }
    }

    if ($_POST['selection'] == 'range') {
      if (isset($_POST['duration']) && isset($_POST['startDate']) && isset($_POST['endDate'])) {
        $duration = $_POST['duration'];
        $startDate = $_POST['startDate'];
        $endDate = $_POST['startDate'];
        $sunSet = false;
        $monSet = false;
        $tueSet = false;
        $wedSet = false;
        $thuSet = false;
        $friSet = false;
        $satSet = false;
        $errorSun = false;
        $errorMon = false;
        $errorTue = false;
        $errorWed = false;
        $errorThu = false;
        $errorFri = false;
        $errorSat = false;
        $errorSunMissing = true;
        $errorMonMissing = true;
        $errorTueMissing = true;
        $errorWedMissing = true;
        $errorThuMissing = true;
        $errorFriMissing = true;
        $errorSatMissing = true;

        if (isset($_POST['sunStartTime']) && isset($_POST['sunEndTime'])) {
          if (strtotime($_POST['sunStartTime']) < strtotime($_POST['sunEndTime'])) {
            $sunStartTime = $_POST['sunStartTime'];
            $sunEndTime = $_POST['sunEndTime'];
            $sunSet = true;
          } else {
            $errorSun = true;
          }
        } elseif (isset($_POST['sunStartTime']) || isset($_POST['sunEndTime'])) {
          $errorSunMissing = true;
        }

        // echo 'Error: Times selected for Sunday are invalid. The start or end time is missing.';
        // echo '<br>';

        // echo 'Error: Times selected for Sunday are invalid. The end time must be after the start time.';
        // echo '<br>';


      } else {
        echo 'Error: Appointment Duration, Start Date, and End Date fields required. Please try again.';
        echo '<br>';
        echo '<a href="appointments.php?profileID=' . $userID . '"><< Go Back</a>';
      }
    }
  }
  ?>

  <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/jquery/jquery-3.7.0.min.js"></script>
  <script src="https://kit.fontawesome.com/c5863419fe.js" crossorigin="anonymous"></script>
</body>

<footer>
  <nav class="navbar">
    <div class="mx-auto">
      <div class="my-3">
        <a href="https://www.facebook.com/" class="mx-3"><i class="fa fa-facebook"></i></a>
        <a href="https://www.instagram.com/" class="mx-3"><i class="fa fa-instagram"></i></a>
        <a href="https://www.twitter.com/" class="mx-3"><i class="fa fa-twitter"></i></a>
        <a href="https://www.linkedin.com" class="mx-3"><i class="fa fa-linkedin"></i></a>
      </div>
      <div class="footer-text text-center pb-3">© 2023 Guidance Exchange</div>
    </div>
  </nav>
</footer>