<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Edit Appointments</title>
  <link rel="icon" type="image/png" sizes="192x192" href="/favicon-192.png">
  <link rel="icon" type="image/png" sizes="180x180" href="/favicon-180.png">
  <link rel="icon" type="image/png" sizes="128x128" href="/favicon-128.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32.png">
  <link href="assets/fontawesome/css/fontawesome.css" rel="stylesheet">
  <link href="assets/fontawesome/css/brands.css" rel="stylesheet">
  <link href="assets/fontawesome/css/solid.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
  <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="css/profile.css" />
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
          <li class="nav-item">
            <a class="nav-link highlight-link nav-text px-4 active" href="profile.php?profileID=<?php echo $userID; ?>">Profile</a>
          </li>
          <li class="nav-item">
            <a class="nav-link highlight-link nav-text px-4" href="#">Communities</a>
          </li>
        </ul>
        <ul class="navbar-nav d-flex flex-row me-1">
          <li class="nav-item me-3 me-lg-0 px-2">
            <a class="nav-link" href="#"><i class="fa-solid fa-magnifying-glass fa-xl"></i></i></i></a>
          </li>
          <li class="nav-item me-3 me-lg-0 px-2">
            <a class="nav-link" href="#"><i class="fa-solid fa-inbox fa-xl"></i></i></a>
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
  $sql = "SELECT * FROM `UserData_t` WHERE `UserID` = $userID";
  $result = mysqli_query($con, $sql);

  // Fetch all of the entries from the UserData table and assign them to variables that can be used later
  while ($profile = mysqli_fetch_assoc($result)) {
    $firstName = $profile['FirstName'];
    $lastName = $profile['LastName'];
    $profilePicture = $profile['ProfilePicture'];
    $profilePictureBorder = $profile['ProfilePictureBorder'];
    $profilePictureBackground = $profile['ProfilePictureBackground'];
    $rating = $profile['Rating'];
    $city = $profile['LocationCity'];
    $state = $profile['LocationState'];
    $facebook = $profile['Facebook'];
    $twitter = $profile['Twitter'];
    $instagram = $profile['Instagram'];
    $linkedIn = $profile['LinkedIn'];
  }

  // If user is a mentor, get appointment information
  $sqlScheduledAppointments = "SELECT `AppointmentTime`,`SchedulerID` FROM `Appointments_t` WHERE `MentorID` = $userID AND `SchedulerID` IS NOT NULL";
  $resultScheduledAppointments = mysqli_query($con, $sqlScheduledAppointments);

  // Fetch all appointments that have been booked for the user and assign them to an array then sort them in ascending order

  if (mysqli_num_rows($resultScheduledAppointments) > 0) {
    $scheduledAppointmentsArray = array();
    while ($scheduledAppointments = mysqli_fetch_assoc($resultScheduledAppointments)) {
      $appointmentDateTime = $scheduledAppointments['AppointmentTime'];
      $appointmentDate = explode(" ", $appointmentDateTime)[0];
      $appointmentTime = explode(" ", $appointmentDateTime)[1];
      $scheduledAppointmentsArray[] = array($appointmentDate, $appointmentTime, $scheduledAppointments['SchedulerID']);
    }
    sort($scheduledAppointmentsArray);

    // Create an associative array with each unique date as a key and each unique date key having an array of the times and their associated scheduler ID
    $scheduledAppointmentsAssoc = array();
    foreach ($scheduledAppointmentsArray as $appointment) {
      $date = $appointment[0];
      $time = $appointment[1];
      $schedulerID = $appointment[2];
      if (!isset($scheduledAppointmentsAssoc[$date])) {
        $scheduledAppointmentsAssoc[$date] = array();
      }
      $scheduledAppointmentsAssoc[$date][] = array('time' => $time, 'schedulerID' => $schedulerID);
    }

    // Assign the available dates to an array so that they can be retrieved later and used to retrieve times from the $availableAppointmentsAssoc array
    $scheduledDates = array_keys($scheduledAppointmentsAssoc);

    // Add unique schedulers to an array to use for querying the database for their information
    $uniqueSchedulerIDs = array();
    foreach ($scheduledAppointmentsAssoc as $date => $appointments) {
      foreach ($appointments as $appointment) {
        $schedulerID = $appointment['schedulerID'];
        if (!in_array($schedulerID, $uniqueSchedulerIDs)) {
          $uniqueSchedulerIDs[] = $schedulerID;
        }
      }
    }

    // Save data for all people that scheduled appointments with the user to an array that can be accessed later
    $schedulerData = array();
    foreach ($uniqueSchedulerIDs as $id) {
      $sqlSchedulers = "SELECT `FirstName`,`LastName`,`ProfilePicture` FROM `userdata_t` WHERE `UserID`=$id";
      $schedulerResult = mysqli_query($con, $sqlSchedulers);
      while ($schedulerProfile = mysqli_fetch_assoc($schedulerResult)) {
        $schedulerFirstName = $schedulerProfile['FirstName'];
        $schedulerLastName = $schedulerProfile['LastName'];
        $schedulerProfilePicture = $schedulerProfile['ProfilePicture'];
        $schedulerDetails = array(
          'FirstName' => $schedulerFirstName,
          'LastName' => $schedulerLastName,
          'ProfilePicture' => $schedulerProfilePicture
        );
        $schedulerData[$id] = $schedulerDetails;
      }
    }
  } else {
    $scheduledAppointmentsArray = null;
  }

  mysqli_close($con);

  $state_abbreviations = array(
    'AL' => 'Alabama', 'AK' => 'Alaska', 'AZ' => 'Arizona', 'AR' => 'Arkansas', 'CA' => 'California', 'CO' => 'Colorado',
    'CT' => 'Connecticut', 'DE' => 'Delaware', 'FL' => 'Florida', 'GA' => 'Georgia', 'HI' => 'Hawaii', 'ID' => 'Idaho',
    'IL' => 'Illinois', 'IN' => 'Indiana', 'IA' => 'Iowa', 'KS' => 'Kansas', 'KY' => 'Kentucky', 'LA' => 'Louisiana',
    'ME' => 'Maine', 'MD' => 'Maryland', 'MA' => 'Massachusetts', 'MI' => 'Michigan', 'MN' => 'Minnesota', 'MS' => 'Mississippi',
    'MO' => 'Missouri', 'MT' => 'Montana', 'NE' => 'Nebraska', 'NV' => 'Nevada', 'NH' => 'New Hampshire', 'NJ' => 'New Jersey',
    'NM' => 'New Mexico', 'NY' => 'New York', 'NC' => 'North Carolina', 'ND' => 'North Dakota', 'OH' => 'Ohio', 'OK' => 'Oklahoma',
    'OR' => 'Oregon', 'PA' => 'Pennsylvania', 'RI' => 'Rhode Island', 'SC' => 'South Carolina', 'SD' => 'South Dakota', 'TN' => 'Tennessee',
    'TX' => 'Texas', 'UT' => 'Utah', 'VT' => 'Vermont', 'VA' => 'Virginia', 'WA' => 'Washington', 'WV' => 'West Virginia',
    'WI' => 'Wisconsin', 'WY' => 'Wyoming', 'DC' => 'District of Columbia'
  );

  // *** Photo Section ***

  echo '<section class="photo-section pt-5 pb-3" style="background-image: url(&#39;img/' . $profilePictureBackground . '&#39;); background-attachment: fixed; background-size: cover;">';
  echo '<div class="container-fluid flex-column">';
  if ($profilePictureBorder == null) {
    if ($profilePicture == null) {
      echo '<img class="profile-photo mb-3" style="border-color: #008a0e;" src="img/blank-profile-image.png" alt="' . $firstName . ' ' . $lastName . ' Profile Photo">';
    } else {
      echo '<img class="profile-photo mb-3" style="border-color: #008a0e;" src="upload/' . $profilePicture . '" alt="' . $firstName . ' ' . $lastName . ' Profile Photo">';
    }
  } else {
    if ($profilePicture == null) {
      echo '<img class="profile-photo mb-3" style="border-color: #008a0e;" src="img/blank-profile-image.png" alt="' . $firstName . ' ' . $lastName . ' Profile Photo">';
    } else {
      echo '<img class="profile-photo mb-3" style="border-color: ' . $profilePictureBorder . ';" src="upload/' . $profilePicture . '" alt="' . $firstName . ' ' . $lastName . ' Profile Photo">';
    }
  }
  if ($userMentorStatus == true) {
    echo '<div class="mentor-tag mb-2">';
    echo '<p class="py-1 px-3 m-0">Mentor</p>';
    echo '</div>';
  }
  if ($userModeratorStatus == true) {
    echo '<div class="mentor-tag mb-2">';
    echo '<p class="py-1 px-3 m-0">Moderator</p>';
    echo '</div>';
  }
  if ($userSystemAdministratorStatus == true) {
    echo '<div class="mentor-tag mb-2">';
    echo '<p class="py-1 px-3 m-0">System Administrator</p>';
    echo '</div>';
  }
  echo '<h1 class="profile-name mb-2">' . $firstName . ' ' . $lastName . '</h1>';
  if ($rating != null) {
    echo '<div class="flex-row">';
    for ($x = 1; $x <= $rating; $x++) {
      echo '<i class="fa-solid fa-star filled px-1"></i>';
    }
    if ($rating < 5) {
      $unfilled = 5 - $rating;
      for ($y = 1; $y <= $unfilled; $y++) {
        echo '<i class="fa-solid fa-star unfilled px-1"></i>';
      }
    }
    echo '</div>';
  }
  if ($city != null) {
    echo '<h2 class="city-name mt-2 mb-3">' . $city;
    if ($state != null) {
      $abbreviation = array_search($state, $state_abbreviations);
      echo ', ' . $abbreviation . '</h2>';
    } else {
      echo '</h2>';
    }
  } elseif ($state != null) {
    echo '<h2 class="city-name mt-2 mb-3">' . $state . '</h2>';
  }
  if ($facebook or $instagram or $twitter or $linkedIn != null) {
    echo '<div class="mb-0">';
    if ($facebook != null) {
      echo '<a href="https://www.facebook.com/' . $facebook . '" class="mx-3"><i class="fa fa-facebook"></i></a>';
    }
    if ($instagram != null) {
      echo '<a href="https://www.instagram.com/' . $instagram . '" class="mx-3"><i class="fa fa-instagram"></i></a>';
    }
    if ($twitter != null) {
      echo '<a href="https://www.twitter.com/' . $twitter . '" class="mx-3"><i class="fa fa-twitter"></i></a>';
    }
    if ($linkedIn != null) {
      echo '<a href="https://www.linkedin.com/in/' . $linkedIn . '" class="mx-3"><i class="fa fa-linkedin"></i></a>';
    }
    echo '</div>';
  }
  echo '</div>';
  echo '</section>';

  echo '<section class="content-section pt-4">';
  if ($scheduledAppointmentsArray != null) {
    echo '<div class="container-fluid pb-4">';
    echo '<div class="row align-items-start profile-section pt-2">';
    echo '<div class="col-1 d-flex align-items-center justify-content-center profile-icon">';
    echo '<i class="fa-regular fa-calendar-check"></i>';
    echo '</div>';
    echo '<div class="col-11 profile-wrap">';
    echo '<h3>Scheduled Appointments</h3>';
    echo '<div>';
    $ts = 0;
    foreach ($scheduledDates as $date) {
      echo '<a class="btn profile-skill me-1" href="#" role="button" onclick="openModal(&#39;timeSelection' . $ts . '&#39;)">' . date('F j', strtotime($date)) . '</a>';
      $ts++;
    }
    echo '</div>';

    // Modal section
    $ts2 = 0;
    foreach ($scheduledAppointmentsAssoc as $date => $appointments) {
      echo '<div class="modal fade" id="timeSelection' . $ts2 . '" tabindex="-1" aria-labelledby="timeLabel' . $ts2 . '" aria-hidden="true">';
      echo '<div class="modal-dialog modal-dialog-centered">';
      echo '<div class="modal-content">';
      echo '<div class="modal-header modal-header-gradient">';
      echo '<h1 class="modal-title fs-5" id="timeLabel' . $ts2 . '">' . date('F j, Y', strtotime($date)) . '</h1>';
      echo '<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>';
      echo '</div>';
      echo '<div class="modal-body justify-content-center align-items-center pt-4">';
      foreach ($appointments as $appointment) {
        $time = $appointment['time'];
        $schedulerID = $appointment['schedulerID'];
        $schedulerInfo = $schedulerData[$schedulerID];
        $schedulerFirstName = $schedulerInfo['FirstName'];
        $schedulerLastName = $schedulerInfo['LastName'];
        $schedulerProfilePicture = $schedulerInfo['ProfilePicture'];
        echo '<div class="container d-flex align-items-center row schedule-container mx-0 mb-3 py-1">';
        echo '<h2 class="col-5 m-0 scheduler-time">' . date('g:i A', strtotime($time)) . '</h2>';
        echo '<a href="#" class="col-2 p-0"><img class="schedule-photo" src="upload/' . $schedulerProfilePicture . '" alt="' . $schedulerFirstName . ' ' . $schedulerLastName . ' Profile Picture"></a>';
        echo '<h3 class="col-5 ps-2 m-0 scheduler-name">' . $schedulerFirstName . ' ' . $schedulerLastName . '</h3>';
        echo '</div>';
      }
      echo '</div>';
      echo '</div>';
      echo '</div>';
      echo '</div>';
      $ts2++;
    }
    // End modal section

    echo '</div>';
    echo '<div class="col-12 text-end">';
    echo '<div class="open-link">';
    echo '<div class="expand-btn"><i class="fa-solid fa-plus"></i></div>';
    echo '</div></div></div></div>';
  }



  echo '</section>';
  ?>

  <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/jquery/jquery-3.7.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
  <script src="https://kit.fontawesome.com/c5863419fe.js" crossorigin="anonymous"></script>
  <script src="js/profile.js"></script>
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