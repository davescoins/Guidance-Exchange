<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Profile</title>
  <link rel="icon" type="image/png" sizes="192x192" href="/favicon-192.png">
  <link rel="icon" type="image/png" sizes="180x180" href="/favicon-180.png">
  <link rel="icon" type="image/png" sizes="128x128" href="/favicon-128.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32.png">
  <link href="assets/fontawesome/css/fontawesome.css" rel="stylesheet">
  <link href="assets/fontawesome/css/brands.css" rel="stylesheet">
  <link href="assets/fontawesome/css/solid.css" rel="stylesheet">
  <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="css/profile.css" />
  <link rel="stylesheet" href="css/main.css" />
</head>

<header>
  <?php
  include('includes/session.inc.php');
  $profileID = $_GET['profileID'];
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
            <?php if ($profileID == $userID) {
              echo '<a class="nav-link highlight-link nav-text px-4 active" href="profile.php?profileID=' . $userID . '">Profile</a>';
            } else {
              echo '<a class="nav-link highlight-link nav-text px-4" href="profile.php?profileID=' . $userID . '">Profile</a>';
            }
            ?>
          </li>
          <li class="nav-item">
            <a class="nav-link highlight-link nav-text px-4" href="#">Communities</a>
          </li>
        </ul>
        <ul class="navbar-nav d-flex flex-row me-1">
          <li class="nav-item me-3 me-lg-0 px-2">
            <a class="nav-link" href="#"><i class="fa-solid fa-magnifying-glass fa-xl"></i></a>
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
  $sql = "SELECT * FROM `UserData_t` WHERE `UserID` = $profileID";
  $result = mysqli_query($con, $sql);

  // Fetch all of the entries from the UserData table and assign them to variables that can be used later
  while ($profile = mysqli_fetch_assoc($result)) {
    $firstName = $profile['FirstName'];
    $lastName = $profile['LastName'];
    $profilePicture = $profile['ProfilePicture'];
    $profilePictureBorder = $profile['ProfilePictureBorder'];
    $profilePictureBackground = $profile['ProfilePictureBackground'];
    $mentorStatus = $profile['MentorStatus'];
    $rating = $profile['Rating'];
    $city = $profile['LocationCity'];
    $state = $profile['LocationState'];
    $facebook = $profile['Facebook'];
    $twitter = $profile['Twitter'];
    $instagram = $profile['Instagram'];
    $linkedIn = $profile['LinkedIn'];
    $mentoring = $profile['Mentoring'];
    $aboutMe = $profile['AboutMe'];
    $workTitle = $profile['WorkTitle'];
    $workTitleArray = explode(";", $workTitle ?? '');
    $workLocation = $profile['WorkLocation'];
    $workLocationArray = explode(";", $workTitle ?? '');
    $workStartDate = $profile['WorkStartDate'];
    $workStartDateArray = explode(";", $workStartDate ?? '');
    $workEndDate = $profile['WorkEndDate'];
    $workEndDateArray = explode(";", $workEndDate ?? '');
    $workDescription = $profile['WorkDescription'];
    $workDescriptionArray = explode(";", $workDescription ?? '');
    $educationDegree = $profile['EducationDegree'];
    $educationDegreeArray = explode(";", $educationDegree ?? '');
    $educationLocation = $profile['EducationLocation'];
    $educationLocationArray = explode(";", $educationLocation ?? '');
    $educationStartDate = $profile['EducationStartDate'];
    $educationStartDateArray = explode(";", $educationStartDate ?? '');
    $educationEndDate = $profile['EducationEndDate'];
    $educationEndDateArray = explode(";", $educationEndDate ?? '');
    $educationDescription = $profile['EducationDescription'];
    $educationDescriptionArray = explode(";", $educationDescription ?? '');
    $associations = $profile['Associations'];
    $associationsArray = explode(";", $associations ?? '');
  }

  // Fetch skills data from qualifications table and skills table
  $skillsSql = "SELECT * FROM `Qualifications_t` WHERE `UserID` = $profileID";
  $skillsResult = mysqli_query($con, $skillsSql);
  $skillsArray = array();
  while ($qualifications = mysqli_fetch_assoc($skillsResult)) {
    $skillsArray[] = $qualifications['SkillID'];
  }

  if ($skillsArray != null) {
    $qualificationsSql = "SELECT `skillName` FROM `skills_t` WHERE `skillID` IN (" . implode(',', $skillsArray) . ")";
    $qualificationsResult = mysqli_query($con, $qualificationsSql);
    $skillNames = array();
    while ($row = mysqli_fetch_assoc($qualificationsResult)) {
      $skillNames[] = $row['skillName'];
    }
  }

  if ($userID == $profileID && $mentorStatus == true) {
    // *** This section will run on the user's page ***

    // If user is a mentor, get appointment information
    $sqlScheduledAppointments = "SELECT `AppointmentTime`,`SchedulerID` FROM `Appointments_t` WHERE `MentorID` = 1 AND `SchedulerID` IS NOT NULL";
    $resultScheduledAppointments = mysqli_query($con, $sqlScheduledAppointments);

    // Fetch all appointments that have been booked for the user and assign them to an array then sort them in ascending order
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
  } elseif ($mentorStatus == true) {
    // *** This section will run on other user's pages ***

    // If user is a mentor, get appointment information
    $sqlAvailableAppointments = "SELECT `AppointmentTime` FROM `Appointments_t` WHERE `MentorID` = $profileID AND `SchedulerID` IS NULL";
    $resultAvailableAppointments = mysqli_query($con, $sqlAvailableAppointments);

    // Fetch all appointments that have NOT been booked for the user and assign them to an array then sort them in ascending order
    $availableAppointmentsArray = [];
    while ($availableAppointments = mysqli_fetch_assoc($resultAvailableAppointments)) {
      $availableAppointmentsArray[] = $availableAppointments['AppointmentTime'];
    }
    sort($availableAppointmentsArray);

    // Create an associative array with the date as the key and each date key has an array of the times available for that date
    $availableAppointmentsAssoc = array();
    foreach ($availableAppointmentsArray as $item) {
      $date = date('Y-m-d', strtotime($item));
      $time = date('H:i:s', strtotime($item));
      if (!isset($availableAppointmentsAssoc[$date])) {
        $availableAppointmentsAssoc[$date] = array();
      }
      $availableAppointmentsAssoc[$date][] = $time;
    }

    // Assign the available dates to an array so that they can be retrieved later and used to retrieve times from the $availableAppointmentsAssoc array
    $availableDates = array_keys($availableAppointmentsAssoc);
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
    'WI' => 'Wisconsin', 'WY' => 'Wyoming', 'DC' => 'Washington, D.C.'
  );

  // *** Photo Section ***

  echo '<section class="photo-section pt-5 pb-3" style="background-image: url(&#39;img/' . $profilePictureBackground . '&#39;); background-attachment: fixed; background-size: cover;">';
  echo '<div class="container-fluid flex-column">';
  if ($profilePictureBorder == null) {
    echo '<img class="profile-photo mb-3" style="border-color: #008a0e;" src="upload/' . $profilePicture . '" alt="' . $firstName . ' ' . $lastName . ' Profile Photo">';
  } else {
    echo '<img class="profile-photo mb-3" style="border-color: ' . $profilePictureBorder . ';" src="upload/' . $profilePicture . '" alt="' . $firstName . ' ' . $lastName . ' Profile Photo">';
  }
  if ($mentorStatus == true) {
    echo '<div class="mentor-tag mb-2">';
    echo '<p class="py-1 px-3 m-0">Mentor</p>';
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

  // *** Buttons Secion ***

  if ($userID == $profileID) {
    echo '<section class="profile__buttons-section d-flex justify-content-center">';
    echo '<div class="container text-center row profile__buttons_links">';
    echo '<div class="col">';
    echo '<a href="/edit-profile.php"><i class="fa-solid fa-pencil"></i><br>Edit Profile</a>';
    echo '</div>';
    echo '<div class="col">';
    echo '<a href="#"><i class="fa-solid fa-share-nodes"></i><br>Share</a>';
    echo '</div>';
    echo '<div class="col">';
    echo '<a href="#"><i class="fa-solid fa-gear"></i><br>Settings</a>';
    echo '</div>';
    echo '</div>';
    echo '</section>';
  }

  // *** Content Section ***

  echo '<section class="content-section pt-4">';
  if ($mentoring != null) {
    echo '<div class="container-fluid pb-4">';
    echo '<div class="row align-items-start profile-section pt-2">';
    echo '<div class="col-1 d-flex align-items-center justify-content-center profile-icon">';
    echo '<i class="fa-solid fa-hand-holding-hand"></i>';
    echo '</div>';
    echo '<div class="col-11 profile-wrap">';
    echo '<h3>Mentoring</h3>';
    echo '<p>' . $mentoring . '</p>';
    echo '</div>';
    echo '<div class="col-12 text-end">';
    echo '<div class="open-link">';
    echo '<div class="expand-btn"><i class="fa-solid fa-plus"></i></div>';
    echo '</div></div></div></div>';
  }

  if ($userID == $profileID && $scheduledAppointmentsArray != null) {
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
  } elseif ($availableAppointmentsArray != null) {
    echo '<div class="container-fluid pb-4">';
    echo '<div class="row align-items-start profile-section pt-2">';
    echo '<div class="col-1 d-flex align-items-center justify-content-center profile-icon">';
    echo '<i class="fa-regular fa-calendar-check"></i>';
    echo '</div>';
    echo '<div class="col-11 profile-wrap">';
    echo '<h3>Schedule an Appointment</h3>';
    echo '<div>';
    $ts = 0;
    foreach ($availableDates as $date) {
      echo '<a class="btn profile-skill me-1" href="#" role="button" onclick="openModal(&#39;timeSelection' . $ts . '&#39;)">' . date('F j', strtotime($date)) . '</a>';
      $ts++;
    }
    echo '</div>';

    // Modal section
    $ts2 = 0;
    foreach ($availableDates as $date) {
      echo '<div class="modal fade" id="timeSelection' . $ts2 . '" tabindex="-1" aria-labelledby="timeLabel' . $ts2 . '" aria-hidden="true">';
      echo '<div class="modal-dialog modal-dialog-centered">';
      echo '<div class="modal-content">';
      echo '<div class="modal-header modal-header-gradient">';
      echo '<h1 class="modal-title fs-5" id="timeLabel' . $ts2 . '">' . date('F j, Y', strtotime($availableDates[$ts2])) . '</h1>';
      echo '<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>';
      echo '</div>';
      echo '<form>';
      echo '<div class="modal-body justify-content-center">';
      echo '<fieldset class="row align-items-start py-3 mx-2">';
      $times = $availableAppointmentsAssoc[$availableDates[$ts2]];
      $at = 0;
      foreach ($times as $availableTime) {
        $formattedTime = date('g:i A', strtotime($availableTime));
        echo '<div class="form-check form-check-inline me-0 ps-1 pb-2 col-3 d-flex align-items-center justify-content-center">';
        echo '<input type="radio" name="time" id="time' . $ts2 . $at . '" value="' . $availableDates[$ts2] . ' ' . $availableTime . '" />';
        echo '<label class="btn main-button" for="time' . $ts2 . $at . '">' . $formattedTime . '</label>';
        echo '</div>';
        $at++;
      }
      echo '</fieldset>';
      echo '</div>';
      echo '<div class="modal-footer justify-content-center">';
      echo '<button class="btn main-button" type="submit">Submit</button>';
      echo '</div>';
      echo '</form>';
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

  if ($aboutMe != null) {
    echo '<div class="container-fluid pb-4">';
    echo '<div class="row align-items-start profile-section pt-2">';
    echo '<div class="col-1 d-flex align-items-center justify-content-center profile-icon">';
    echo '<i class="fa-solid fa-message"></i>';
    echo '</div>';
    echo '<div class="col-11 profile-wrap">';
    echo '<h3>About Me</h3>';
    echo '<p>' . $aboutMe . '</p>';
    echo '</div>';
    echo '<div class="col-12 text-end">';
    echo '<div class="open-link">';
    echo '<div class="expand-btn"><i class="fa-solid fa-plus"></i></div>';
    echo '</div></div></div></div>';
  }

  if ($workLocation != null) {
    echo '<div class="container-fluid pb-4">';
    echo '<div class="row align-items-start profile-section pt-2">';
    echo '<div class="col-1 d-flex align-items-center justify-content-center profile-icon">';
    echo '<i class="fa-solid fa-briefcase"></i>';
    echo '</div>';
    echo '<div class="col-11 profile-wrap">';
    echo '<h3>Work</h3>';
    foreach ($workLocationArray as $location) {
      $wl = 0;
      echo '<p class="mb-0"><strong>' . $workTitleArray[$wl] . ' at ' . $location . '</strong></p>';
      if ($workEndDateArray[$wl] != null) {
        echo '<p class="profile-date mb-0">(' . date_format(date_create($workStartDateArray[$wl]), "Y") . ' - ' . date_format(date_create($workEndDateArray[$wl]), "Y") . ')</p>';
      } else {
        echo '<p class="profile-date mb-0">(' . date_format(date_create($workStartDateArray[$wl]), "Y") . ' - )</p>';
      }
      echo '<p>' . $workDescriptionArray[$wl] . '</p>';
      $wl++;
    }
    echo '</div>';
    echo '<div class="col-12 text-end">';
    echo '<div class="open-link">';
    echo '<div class="expand-btn"><i class="fa-solid fa-plus"></i></div>';
    echo '</div></div></div></div>';
  }

  if ($educationLocation != null) {
    echo '<div class="container-fluid pb-4">';
    echo '<div class="row align-items-start profile-section pt-2">';
    echo '<div class="col-1 d-flex align-items-center justify-content-center profile-icon">';
    echo '<i class="fa-solid fa-book-open"></i>';
    echo '</div>';
    echo '<div class="col-11 profile-wrap">';
    echo '<h3>Education</h3>';
    foreach ($educationLocationArray as $location) {
      $el = 0;
      echo '<p class="mb-0"><strong>' . $educationDegreeArray[$el] . ', ' . $location . '</strong></p>';
      if ($educationEndDateArray[$el] != null) {
        echo '<p class="profile-date mb-0">(' . date_format(date_create($educationStartDateArray[$el]), "Y") . ' - ' . date_format(date_create($educationEndDateArray[$el]), "Y") . ')</p>';
      } else {
        echo '<p class="profile-date mb-0">(' . date_format(date_create($educationStartDateArray[$el]), "Y") . ' - )</p>';
      }
      echo '<p>' . $educationDescriptionArray[$el] . '</p>';
      $el++;
    }
    echo '</div>';
    echo '<div class="col-12 text-end">';
    echo '<div class="open-link">';
    echo '<div class="expand-btn"><i class="fa-solid fa-plus"></i></div>';
    echo '</div></div></div></div>';
  }

  if ($skillNames != null) {
    echo '<div class="container-fluid pb-4">';
    echo '<div class="row align-items-start profile-section pt-2">';
    echo '<div class="col-1 d-flex align-items-center justify-content-center profile-icon">';
    echo '<i class="fa-solid fa-file-pen"></i>';
    echo '</div>';
    echo '<div class="col-11 profile-wrap">';
    echo '<h3>Skills</h3>';
    echo '<div>';
    foreach ($skillNames as $value) {
      echo '<a class="btn profile-skill me-1" href="#" role="button">' . $value . '</a>';
    }
    echo '</div>';
    echo '</div>';
    echo '<div class="col-12 text-end">';
    echo '<div class="open-link">';
    echo '<div class="expand-btn"><i class="fa-solid fa-plus"></i></div>';
    echo '</div></div></div></div>';
  }

  if ($associations != null) {
    echo '<div class="container-fluid pb-4">';
    echo '<div class="row align-items-start profile-section pt-2">';
    echo '<div class="col-1 d-flex align-items-center justify-content-center profile-icon">';
    echo '<i class="fa-solid fa-user-group"></i>';
    echo '</div>';
    echo '<div class="col-11 profile-wrap">';
    echo '<h3>My Associations</h3>';
    echo '<div class="row pt-1">';

    // *** Fix this so it doesn't have to make calls to the database again ***

    include('includes/connect.inc.php');
    foreach ($associationsArray as $value) {
      $associationSql = "SELECT `FirstName`,`LastName`,`ProfilePicture` FROM `userdata_t` WHERE `UserID`=$value";
      $associationResult = mysqli_query($con, $associationSql);
      while ($profileAssociation = mysqli_fetch_assoc($associationResult)) {
        $associationFirstName = $profileAssociation['FirstName'];
        $associationLastName = $profileAssociation['LastName'];
        $associationProfilePicture = $profileAssociation['ProfilePicture'];
      }
      echo '<div class="col-2 d-flex align-items center justify-content-center">';
      echo '<a href="profile.php?profileID=' . $value . '"><img class="association-photo" src="upload/' . $associationProfilePicture . '" alt="' . $associationFirstName . ' ' . $associationLastName . ' Profile Photo"></a>';
      echo '</div>';
    }
    echo '</div>';
    echo '</div>';
    echo '<div class="col-12 text-end">';
    echo '<div class="open-link">';
    echo '<div class="expand-btn"><i class="fa-solid fa-plus"></i></div>';
    echo '</div></div></div></div>';
    mysqli_close($con);
  }

  echo '</section>';
  ?>

  <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/jquery/jquery-3.7.0.min.js"></script>
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

</html>