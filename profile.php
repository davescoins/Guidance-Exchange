<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Guidance Exchange | Profile</title>
  <link rel="icon" type="image/png" sizes="192x192" href="favicon-192.png">
  <link rel="icon" type="image/png" sizes="180x180" href="favicon-180.png">
  <link rel="icon" type="image/png" sizes="128x128" href="favicon-128.png">
  <link rel="icon" type="image/png" sizes="32x32" href="favicon-32.png">
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
            <?php if ($profileID == $userID) {
              echo '<a class="nav-link highlight-link nav-text px-4 active" href="profile.php?profileID=' . $userID . '">Profile</a>';
            } else {
              echo '<a class="nav-link highlight-link nav-text px-4" href="profile.php?profileID=' . $userID . '">Profile</a>';
            }
            ?>
          </li>
          <li class="nav-item">
            <a class="nav-link highlight-link nav-text px-4" href="communities.php">Communities</a>
          </li>
        </ul>
        <ul class="navbar-nav d-flex flex-row me-1">
          <li class="nav-item me-3 me-lg-0 px-2 d-flex align-items-center">
            <form class="d-flex" role="search" action="search.php" method="GET">
              <div class="input-group">
                <input class="form-control" name="query" type="search" placeholder="Search" aria-label="Search" autocomplete="off">
                <button type="button" class="btn main-button btn-drop dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" data-bs-auto-close="false" aria-expanded="false">
                  <span class="visually-hidden">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                  <div class="my-2 ms-3">
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" id="mentorSearch" name="mentorSearch">
                      <label class="form-check-label" for="mentorSearch">
                        Mentors
                      </label>
                    </div>
                  </div>
                </div>
              </div>
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
  // Get the status of the visited user profile
  $sqlAuth = "SELECT * FROM `Auth_t` WHERE `UserID` = $profileID";
  $resultAuth = mysqli_query($con, $sqlAuth);

  while ($auth = mysqli_fetch_assoc($resultAuth)) {
    $mentorStatus = $auth['MentorStatus'];
    $moderatorStatus = $auth['ModeratorStatus'];
    $systemAdministratorStatus = $auth['SystemAdministratorStatus'];
  }

  // Fetch all of the entries from the UserData table and assign them to variables that can be used later
  $sql = "SELECT * FROM `UserData_t` WHERE `UserID` = $profileID";
  $result = mysqli_query($con, $sql);

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
    $mentoring = $profile['Mentoring'];
    $aboutMe = $profile['AboutMe'];
    $workTitle = $profile['WorkTitle'];
    $workTitleArray = explode(";", $workTitle ?? '');
    $workLocation = $profile['WorkLocation'];
    $workLocationArray = explode(";", $workLocation ?? '');
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
    $profileAssociations = $profile['Associations'];
    $profileAssociationsArray = explode(";", $profileAssociations ?? '');
  }

  // Fetch skills data from qualifications table and skills table
  $skillsSql = "SELECT * FROM `Qualifications_t` WHERE `UserID` = $profileID";
  $skillsResult = mysqli_query($con, $skillsSql);
  $skillsArray = array();
  while ($qualifications = mysqli_fetch_assoc($skillsResult)) {
    $skillsArray[] = $qualifications['SkillID'];
  }

  if ($skillsArray != null) {
    $qualificationsSql = "SELECT `SkillName` FROM `Skills_t` WHERE `SkillID` IN (" . implode(',', $skillsArray) . ")";
    $qualificationsResult = mysqli_query($con, $qualificationsSql);
    $skillNames = array();
    while ($row = mysqli_fetch_assoc($qualificationsResult)) {
      $skillNames[] = $row['SkillName'];
    }
  }

  if ($mentorStatus == true) {
    // If user is a mentor, get appointment information
    $sqlAvailableAppointments = "SELECT `AppointmentID`, `AppointmentTime` FROM `Appointments_t` WHERE `MentorID` = $profileID AND `SchedulerID` IS NULL";
    $resultAvailableAppointments = mysqli_query($con, $sqlAvailableAppointments);

    // Fetch all appointments that have NOT been booked for the user and assign them to an array then sort them in ascending order
    if (mysqli_num_rows($resultAvailableAppointments) > 0) {
      $availableAppointmentsArray = [];
      while ($availableAppointments = mysqli_fetch_assoc($resultAvailableAppointments)) {
        $availableAppointmentsArray[] = array('AppointmentID' => $availableAppointments['AppointmentID'], 'AppointmentTime' => $availableAppointments['AppointmentTime']);
      }
      $columns = array_column($availableAppointmentsArray, 'AppointmentTime');
      array_multisort($columns, SORT_ASC, $availableAppointmentsArray);

      // Create an associative array with the date as the key and each date key has an array of the times available for that date
      $availableAppointmentsAssoc = array();
      foreach ($availableAppointmentsArray as $item) {
        $date = date('Y-m-d', strtotime($item['AppointmentTime']));
        $time = date('H:i:s', strtotime($item['AppointmentTime']));
        if (!isset($availableAppointmentsAssoc[$date])) {
          $availableAppointmentsAssoc[$date] = array();
        }
        $availableAppointmentsAssoc[$date][] = array('AppointmentID' => $item['AppointmentID'], 'AppointmentTime' => $time);
      }

      // Assign the available dates to an array so that they can be retrieved later and used to retrieve times from the $availableAppointmentsAssoc array
      $availableDates = array_keys($availableAppointmentsAssoc);
    } else {
      $availableAppointmentsArray = null;
    }
  } else {
    $availableAppointmentsArray = null;
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
      echo '<img class="profile-photo mb-3 rounded-circle" style="border-color: #008a0e;" src="img/blank-profile-image.png" alt="' . $firstName . ' ' . $lastName . ' Profile Photo" width="210" height="210">';
    } else {
      echo '<img class="profile-photo mb-3 rounded-circle" style="border-color: #008a0e;" src="upload/' . $profilePicture . '" alt="' . $firstName . ' ' . $lastName . ' Profile Photo" width="210" height="210">';
    }
  } else {
    if ($profilePicture == null) {
      echo '<img class="profile-photo mb-3 rounded-circle" style="border-color: ' . $profilePictureBorder . ';" src="img/blank-profile-image.png" alt="' . $firstName . ' ' . $lastName . ' Profile Photo" width="210" height="210">';
    } else {
      echo '<img class="profile-photo mb-3 rounded-circle" style="border-color: ' . $profilePictureBorder . ';" src="upload/' . $profilePicture . '" alt="' . $firstName . ' ' . $lastName . ' Profile Photo" width="210" height="210">';
    }
  }
  if ($mentorStatus == true) {
    echo '<div class="mentor-tag mb-2">';
    echo '<p class="py-1 px-3 m-0">Mentor</p>';
    echo '</div>';
  }
  if ($moderatorStatus == true) {
    echo '<div class="mentor-tag mb-2">';
    echo '<p class="py-1 px-3 m-0">Moderator</p>';
    echo '</div>';
  }
  if ($systemAdministratorStatus == true) {
    echo '<div class="mentor-tag mb-2">';
    echo '<p class="py-1 px-3 m-0">System Administrator</p>';
    echo '</div>';
  }
  echo '<h1 class="profile-name mb-2">' . $firstName . ' ' . $lastName . '</h1>';
  // if ($rating != null) {
  //   echo '<div class="flex-row">';
  //   for ($x = 1; $x <= $rating; $x++) {
  //     echo '<i class="fa-solid fa-star filled px-1"></i>';
  //   }
  //   if ($rating < 5) {
  //     $unfilled = 5 - $rating;
  //     for ($y = 1; $y <= $unfilled; $y++) {
  //       echo '<i class="fa-solid fa-star unfilled px-1"></i>';
  //     }
  //   }
  //   echo '</div>';
  // }
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

  // *** Buttons Section ***

  if ($userID == $profileID) {
    echo '<section class="profile__buttons-section d-flex justify-content-center">';
    echo '<div class="container text-center row profile__buttons_links">';
    echo '<div class="col">';
    echo '<a href="/edit-profile.php"><i class="fa-solid fa-pencil"></i><br>Edit Profile</a>';
    echo '</div>';
    // echo '<div class="col">';
    // echo '<a href="#"><i class="fa-solid fa-share-nodes"></i><br>Share</a>';
    // echo '</div>';
    echo '<div class="col">';
    echo '<a href="appointments.php?profileID=' . $userID . '"><i class="fa-regular fa-calendar-days"></i><br>Appointments</a>';
    echo '</div>';
    echo '</div>';
    echo '</section>';
  } else {
    echo '<section class="profile__buttons-section d-flex justify-content-center">';
    echo '<div class="container text-center row profile__buttons_links">';
    echo '<div class="col">';
    if (in_array($profileID, $associationsArray)) {
      echo '<form action="associations.php" method="POST">';
      echo '<input type="hidden" name="association" value="' . $profileID . '">';
      echo '<input type="hidden" name="profile" value="' . $profileID . '">';
      echo '<button class="btn profile__buttons" type="submit" name="update" value="remove"><i class="fa-solid fa-minus fa-xl px-4"></i><br>Remove Association</button>';
      echo '</form>';
    } else {
      echo '<form action="associations.php" method="POST">';
      echo '<input type="hidden" name="association" value="' . $profileID . '">';
      echo '<input type="hidden" name="profile" value="' . $profileID . '">';
      echo '<button class="btn profile__buttons" type="submit" name="update" value="add"><i class="fa-solid fa-plus fa-xl px-4"></i><br>Add Association</button>';
      echo '</form>';
    }
    echo '</div>';
    // echo '<div class="col">';
    // echo '<a href="#"><i class="fa-solid fa-share-nodes"></i><br>Share</a>';
    // echo '</div>';
    echo '<div class="col d-flex align-items-center justify-content-center">';
    echo '<a href="#" data-bs-toggle="modal" data-bs-target="#newMessageModal' . $profileID . '"><i class="fa-solid fa-envelope fa-xl px-4"></i><br>Send Message</a>';
    echo '</div>';
    echo '</div>';
    echo '</section>';
  }

  // Start New Message Modal
  echo '<div class="modal fade" id="newMessageModal' . $profileID . '" tabindex="-1" aria-labelledby="newMessageModalLabel' . $profileID . '" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header modal-header-gradient">
        <h1 class="modal-title fs-5" id="newMessageModalLabel' . $profileID . '">New Message</h1>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="new-message.php" method="POST">
          <div class="mb-3">
            <label for="recipientName" class="col-form-label">Recipient:</label>
            <div class="dropdown" id="newMessage">
              <input type="text" class="form-control" id="recipientName" placeholder="Search for a person" autocomplete="off" value="' . $firstName . ' ' . $lastName . '" disabled>
              <ul class="dropdown-menu" id="messageSearchResults"></ul>
              <input type="hidden" name="recipientID" value="' . $profileID . '">
            </div>
          </div>
          <div class="mb-3">
            <label for="messageText" class="col-form-label">Message:</label>
            <textarea class="form-control" id="messageText" name="message"></textarea>
          </div>
      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button type="submit" class="btn main-button btn-std">Send</button>
        <button type="button" class="btn cancel-button" data-bs-dismiss="modal">Cancel</button>
      </div>
      </form>
    </div>
  </div>
  </div>';
  // End New Message Modal

  // *** Content Section ***

  echo '<section class="content-section pt-4">';
  if ($mentoring != null && $userMentorStatus == 1) {
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
    echo '</div></div></div>';
  }

  if ($availableAppointmentsArray != null && $userID != $profileID) {
    echo '<div class="container-fluid pb-4">';
    echo '<div class="row align-items-start profile-section pt-2">';
    echo '<div class="col-1 d-flex align-items-center justify-content-center profile-icon">';
    echo '<i class="fa-regular fa-calendar"></i>';
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

    // Modal Section
    $ts2 = 0;
    foreach ($availableDates as $date) {
      echo '<div class="modal fade" id="timeSelection' . $ts2 . '" tabindex="-1" aria-labelledby="timeLabel' . $ts2 . '" aria-hidden="true">';
      echo '<div class="modal-dialog modal-dialog-centered">';
      echo '<div class="modal-content">';
      echo '<div class="modal-header modal-header-gradient">';
      echo '<h1 class="modal-title fs-5" id="timeLabel' . $ts2 . '">' . date('F j, Y', strtotime($availableDates[$ts2])) . '</h1>';
      echo '<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>';
      echo '</div>';
      echo '<form action="schedule-appointment.php" method="POST">';
      echo '<div class="modal-body justify-content-center">';
      echo '<fieldset class="row align-items-start py-3 mx-2">';
      $appointments = $availableAppointmentsAssoc[$date];
      foreach ($appointments as $appointment) {
        $formattedTime = date('g:i A', strtotime($appointment['AppointmentTime']));
        echo '<div class="form-check form-check-inline me-0 ps-1 pb-2 col-4 d-flex align-items-center justify-content-center profile__appointments">';
        echo '<input type="checkbox" name="time" id="appointmentID' . $appointment['AppointmentID'] . '" value="" />';
        echo '<label class="btn main-button btn-std my-1" for="appointmentID' . $appointment['AppointmentID'] . '">' . $formattedTime . '</label>';
        echo '<input type="hidden" name="appointmentID" value="' . $appointment['AppointmentID'] . '"/>';
        echo '<input type="hidden" name="schedulerID" value="' . $userID . '"/>';
        echo '</div>';
      }
      echo '</fieldset>';
      echo '</div>';
      echo '<div class="modal-footer justify-content-center">';
      echo '<button class="btn main-button btn-std" type="submit">Submit</button>';
      echo '</div>';
      echo '</form>';
      echo '</div>';
      echo '</div>';
      echo '</div>';
      $ts2++;
    }
    // End Modal Section

    echo '</div>';
    echo '<div class="col-12 text-end">';
    echo '</div></div></div>';
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
    echo '</div></div></div>';
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
      if ($workTitleArray[$wl] != null) {
        echo '<p class="mb-0"><strong>' . $workTitleArray[$wl] . ' at ' . $location . '</strong></p>';
      } else {
        echo '<p class="mb-0"><strong>' . $location . '</strong></p>';
      }
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
    echo '</div></div></div>';
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
      if ($educationDegreeArray[$el] != null) {
        echo '<p class="mb-0"><strong>' . $educationDegreeArray[$el] . ', ' . $location . '</strong></p>';
      } else {
        echo '<p class="mb-0"><strong>' . $location . '</strong></p>';
      }
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
    echo '</div></div></div>';
  }

  if (isset($skillNames) && $skillNames != null) {
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
    echo '</div></div></div>';
  }

  if ($profileAssociations != null) {
    echo '<div class="container-fluid pb-4">';
    echo '<div class="row align-items-start profile-section pt-2">';
    echo '<div class="col-1 d-flex align-items-center justify-content-center profile-icon">';
    echo '<i class="fa-solid fa-user-group"></i>';
    echo '</div>';
    echo '<div class="col-11 profile-wrap">';
    if ($profileID == $userID) {
      echo '<h3>My Associations</h3>';
    } else {
      echo '<h3>' . $firstName . '&#39;s Associations</h3>';
    }
    echo '<div class="row pt-1">';

    // *** Fix this so it doesn't have to make calls to the database again ***

    include('includes/connect.inc.php');
    foreach ($profileAssociationsArray as $value) {
      $associationSql = "SELECT `FirstName`,`LastName`,`ProfilePicture` FROM `UserData_t` WHERE `UserID`=$value";
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
    echo '</div></div></div>';
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