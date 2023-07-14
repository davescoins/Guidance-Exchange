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
              <input class="form-control me-2" name="query" type="search" placeholder="Search" aria-label="Search" autocomplete="off">
              <button class="btn" type="submit"><i class="fa-solid fa-magnifying-glass fa-xl"></i></button>
            </form>
          </li>
          <li class="nav-item me-3 me-lg-0 px-2">
            <a class="nav-link" href="messages.php"><i class="fa-solid fa-inbox fa-xl"></i></a>
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

      $appointmentsAssoc = array();
      foreach ($appointmentsArray as $appointment) {
        $date = $appointment[0];
        $time = $appointment[1];
        if (!isset($appointmentsAssoc[$date])) {
          $appointmentsAssoc[$date] = array();
        }
        $appointmentsAssoc[$date][] = $time;
      }
    } else {
      $appointmentsArray = null;
    }

    if ($_POST['selection'] == 'single') {
      if (!empty($_POST['singleDate']) && !empty($_POST['singleTime'])) {
        $dateTime = $_POST['singleDate'] . ' ' . date_format(date_create($_POST['singleTime']), "H:i:s");

        if ($appointmentsArray != null) {
          if (in_array(date_format(date_create($_POST['singleTime']), "H:i:s"), $appointmentsAssoc[$_POST['singleDate']])) {
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
      if (!empty($_POST['duration']) && !empty($_POST['startDate']) && !empty($_POST['endDate'])) {
        if (strtotime($_POST['startDate']) <= strtotime($_POST['endDate'])) {
          $duration = $_POST['duration'];
          $startDate = $_POST['startDate'];
          $endDate = $_POST['endDate'];
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
          $errorSunMissing = false;
          $errorMonMissing = false;
          $errorTueMissing = false;
          $errorWedMissing = false;
          $errorThuMissing = false;
          $errorFriMissing = false;
          $errorSatMissing = false;

          if (!empty($_POST['sunStartTime']) && !empty($_POST['sunEndTime'])) {
            if (strtotime($_POST['sunStartTime']) < strtotime($_POST['sunEndTime'])) {
              $sunStartTime = date_format(date_create($_POST['sunStartTime']), "G:i:s");
              $sunEndTime = date_format(date_create($_POST['sunEndTime']), "G:i:s");
              $sunSet = true;
            } else {
              $errorSun = true;
            }
          } elseif (!empty($_POST['sunStartTime']) || !empty($_POST['sunEndTime'])) {
            $errorSunMissing = true;
          }
          if (!empty($_POST['monStartTime']) && !empty($_POST['monEndTime'])) {
            if (strtotime($_POST['monStartTime']) < strtotime($_POST['monEndTime'])) {
              $monStartTime = date_format(date_create($_POST['monStartTime']), "G:i:s");
              $monEndTime = date_format(date_create($_POST['monEndTime']), "G:i:s");
              $monSet = true;
            } else {
              $errorMon = true;
            }
          } elseif (!empty($_POST['monStartTime']) || !empty($_POST['monEndTime'])) {
            $errorMonMissing = true;
          }
          if (!empty($_POST['tueStartTime']) && !empty($_POST['tueEndTime'])) {
            if (strtotime($_POST['tueStartTime']) < strtotime($_POST['tueEndTime'])) {
              $tueStartTime = date_format(date_create($_POST['tueStartTime']), "G:i:s");
              $tueEndTime = date_format(date_create($_POST['tueEndTime']), "G:i:s");
              $tueSet = true;
            } else {
              $errorTue = true;
            }
          } elseif (!empty($_POST['tueStartTime']) || !empty($_POST['tueEndTime'])) {
            $errorTueMissing = true;
          }
          if (!empty($_POST['wedStartTime']) && !empty($_POST['wedEndTime'])) {
            if (strtotime($_POST['wedStartTime']) < strtotime($_POST['wedEndTime'])) {
              $wedStartTime = date_format(date_create($_POST['wedStartTime']), "G:i:s");
              $wedEndTime = date_format(date_create($_POST['wedEndTime']), "G:i:s");
              $wedSet = true;
            } else {
              $errorWed = true;
            }
          } elseif (!empty($_POST['wedStartTime']) || !empty($_POST['wedEndTime'])) {
            $errorWedMissing = true;
          }
          if (!empty($_POST['thuStartTime']) && !empty($_POST['thuEndTime'])) {
            if (strtotime($_POST['thuStartTime']) < strtotime($_POST['thuEndTime'])) {
              $thuStartTime = date_format(date_create($_POST['thuStartTime']), "G:i:s");
              $thuEndTime = date_format(date_create($_POST['thuEndTime']), "G:i:s");
              $thuSet = true;
            } else {
              $errorThu = true;
            }
          } elseif (!empty($_POST['thuStartTime']) || !empty($_POST['thuEndTime'])) {
            $errorThuMissing = true;
          }
          if (!empty($_POST['friStartTime']) && !empty($_POST['friEndTime'])) {
            if (strtotime($_POST['friStartTime']) < strtotime($_POST['friEndTime'])) {
              $friStartTime = date_format(date_create($_POST['friStartTime']), "G:i:s");
              $friEndTime = date_format(date_create($_POST['friEndTime']), "G:i:s");
              $friSet = true;
            } else {
              $errorFri = true;
            }
          } elseif (!empty($_POST['friStartTime']) || !empty($_POST['friEndTime'])) {
            $errorFriMissing = true;
          }
          if (!empty($_POST['satStartTime']) && !empty($_POST['satEndTime'])) {
            if (strtotime($_POST['satStartTime']) < strtotime($_POST['satEndTime'])) {
              $satStartTime = date_format(date_create($_POST['satStartTime']), "G:i:s");
              $satEndTime = date_format(date_create($_POST['satEndTime']), "G:i:s");
              $satSet = true;
            } else {
              $errorSat = true;
            }
          } elseif (!empty($_POST['satStartTime']) || !empty($_POST['satEndTime'])) {
            $errorSatMissing = true;
          }

          $currentDay = $startDate;
          $startTimes = array();
          $endTimes = array();
          if ($sunSet) {
            $startTimes += array(
              "Sunday" => $sunStartTime
            );
            $endTimes += array(
              "Sunday" => $sunEndTime
            );
          } else {
            $startTimes += array(
              "Sunday" => '12:00:00'
            );
            $endTimes += array(
              "Sunday" => '12:00:00'
            );
          }
          if ($monSet) {
            $startTimes += array(
              "Monday" => $monStartTime
            );
            $endTimes += array(
              "Monday" => $monEndTime
            );
          } else {
            $startTimes += array(
              "Monday" => '12:00:00'
            );
            $endTimes += array(
              "Monday" => '12:00:00'
            );
          }
          if ($tueSet) {
            $startTimes += array(
              "Tuesday" => $tueStartTime
            );
            $endTimes += array(
              "Tuesday" => $tueEndTime
            );
          } else {
            $startTimes += array(
              "Tuesday" => '12:00:00'
            );
            $endTimes += array(
              "Tuesday" => '12:00:00'
            );
          }
          if ($wedSet) {
            $startTimes += array(
              "Wednesday" => $wedStartTime
            );
            $endTimes += array(
              "Wednesday" => $wedEndTime
            );
          } else {
            $startTimes += array(
              "Wednesday" => '12:00:00'
            );
            $endTimes += array(
              "Wednesday" => '12:00:00'
            );
          }
          if ($thuSet) {
            $startTimes += array(
              "Thursday" => $thuStartTime
            );
            $endTimes += array(
              "Thursday" => $thuEndTime
            );
          } else {
            $startTimes += array(
              "Thursday" => '12:00:00'
            );
            $endTimes += array(
              "Thursday" => '12:00:00'
            );
          }
          if ($friSet) {
            $startTimes += array(
              "Friday" => $friStartTime
            );
            $endTimes += array(
              "Friday" => $friEndTime
            );
          } else {
            $startTimes += array(
              "Friday" => '12:00:00'
            );
            $endTimes += array(
              "Friday" => '12:00:00'
            );
          }
          if ($satSet) {
            $startTimes += array(
              "Saturday" => $satStartTime
            );
            $endTimes += array(
              "Saturday" => $satEndTime
            );
          } else {
            $startTimes += array(
              "Saturday" => '12:00:00'
            );
            $endTimes += array(
              "Saturday" => '12:00:00'
            );
          }

          while ($currentDay <= $endDate) {
            $dayOfWeek = date("l", strtotime($currentDay));
            $startTime = strtotime($startTimes[$dayOfWeek]);
            $endTime = strtotime($endTimes[$dayOfWeek]);
            $interval = $duration * 60;
            while (($startTime + $interval) <= $endTime) {
              $appointmentTime = $currentDay . ' ' . date("H:i:s", $startTime);

              if ($appointmentsArray != null && array_key_exists($currentDay, $appointmentsAssoc)) {
                if (!in_array(date("H:i:s", $startTime), $appointmentsAssoc[$currentDay])) {
                  $sql = "INSERT INTO `Appointments_t` (`MentorID`, `SchedulerID`, `AppointmentTime`) VALUES ($userID, null, '$appointmentTime')";
                  mysqli_query($con, $sql);
                }
              } else {
                $sql = "INSERT INTO `Appointments_t` (`MentorID`, `SchedulerID`, `AppointmentTime`) VALUES ($userID, null, '$appointmentTime')";
                mysqli_query($con, $sql);
              }

              $startTime += $interval;
            }

            $currentDay = date("Y-m-d", strtotime("+1 day", strtotime($currentDay)));
          }
        } else {
          echo 'Error: The selected dates are invalid. The start date must be after the end date. Please try again.';
          echo '<br>';
          echo '<a href="appointments.php?profileID=' . $userID . '"><< Go Back</a>';
        }

        if ($errorSun || $errorMon || $errorTue || $errorWed || $errorThu || $errorFri || $errorSat || $errorSunMissing || $errorMonMissing || $errorTueMissing || $errorWedMissing || $errorThuMissing || $errorFriMissing || $errorSatMissing) {
          if ($errorSun) {
            echo 'Error: Times selected for Sunday are invalid. The start or end time is missing.';
            echo '<br>';
          } elseif ($errorSunMissing) {
            echo 'Error: Times selected for Sunday are invalid. The end time must be after the start time.';
            echo '<br>';
          }
          if ($errorMon) {
            echo 'Error: Times selected for Monday are invalid. The start or end time is missing.';
            echo '<br>';
          } elseif ($errorMonMissing) {
            echo 'Error: Times selected for Monday are invalid. The end time must be after the start time.';
            echo '<br>';
          }
          if ($errorTue) {
            echo 'Error: Times selected for Sunday are invalid. The start or end time is missing.';
            echo '<br>';
          } elseif ($errorTueMissing) {
            echo 'Error: Times selected for Sunday are invalid. The end time must be after the start time.';
            echo '<br>';
          }
          if ($errorWed) {
            echo 'Error: Times selected for Wednesday are invalid. The start or end time is missing.';
            echo '<br>';
          } elseif ($errorWedMissing) {
            echo 'Error: Times selected for Wednesday are invalid. The end time must be after the start time.';
            echo '<br>';
          }
          if ($errorThu) {
            echo 'Error: Times selected for Thursday are invalid. The start or end time is missing.';
            echo '<br>';
          } elseif ($errorThuMissing) {
            echo 'Error: Times selected for Thursday are invalid. The end time must be after the start time.';
            echo '<br>';
          }
          if ($errorFri) {
            echo 'Error: Times selected for Friday are invalid. The start or end time is missing.';
            echo '<br>';
          } elseif ($errorFriMissing) {
            echo 'Error: Times selected for Friday are invalid. The end time must be after the start time.';
            echo '<br>';
          }
          if ($errorSat) {
            echo 'Error: Times selected for Saturday are invalid. The start or end time is missing.';
            echo '<br>';
          } elseif ($errorSatMissing) {
            echo 'Error: Times selected for Saturday are invalid. The end time must be after the start time.';
            echo '<br>';
          }
          mysqli_close($con);
          echo 'Appointment times for all days without error submitted successfully.';
          echo '<br>';
          echo '<a href="appointments.php?profileID=' . $userID . '"><< Go Back</a>';
        } else {
          mysqli_close($con);
          header('Location: appointments.php?profileID=' . $userID);
          exit();
        }
      } else {
        mysqli_close($con);
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