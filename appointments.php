<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Guidance Exchange | Appointments</title>
  <link rel="icon" type="image/png" sizes="192x192" href="favicon-192.png">
  <link rel="icon" type="image/png" sizes="180x180" href="favicon-180.png">
  <link rel="icon" type="image/png" sizes="128x128" href="favicon-128.png">
  <link rel="icon" type="image/png" sizes="32x32" href="favicon-32.png">
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
            <a class="nav-link highlight-link nav-text px-4" href="#">Communities</a>
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
  // Fetch all of the necessary entries from the UserData table and assign them to variables that can be used later
  $sql = "SELECT * FROM `UserData_t` WHERE `UserID` = $userID";
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
  }

  // Get scheduled appointments information
  if ($userMentorStatus) {
    $sqlScheduledAppointments = "SELECT `AppointmentTime`,`SchedulerID` FROM `Appointments_t` WHERE `MentorID` = $userID AND `SchedulerID` IS NOT NULL";
    $resultScheduledAppointments = mysqli_query($con, $sqlScheduledAppointments);
  } else {
    $sqlScheduledAppointments = "SELECT `AppointmentTime`,`MentorID` FROM `Appointments_t` WHERE `SchedulerID` = $userID";
    $resultScheduledAppointments = mysqli_query($con, $sqlScheduledAppointments);
  }

  // Fetch all appointments that have been booked for the user and assign them to an array then sort them in ascending order
  if (mysqli_num_rows($resultScheduledAppointments) > 0) {
    $scheduledAppointmentsArray = array();
    while ($scheduledAppointments = mysqli_fetch_assoc($resultScheduledAppointments)) {
      $appointmentDateTime = $scheduledAppointments['AppointmentTime'];
      $appointmentDate = explode(" ", $appointmentDateTime)[0];
      $appointmentTime = explode(" ", $appointmentDateTime)[1];
      if ($userMentorStatus) {
        $scheduledAppointmentsArray[] = array($appointmentDate, $appointmentTime, $scheduledAppointments['SchedulerID']);
      } else {
        $scheduledAppointmentsArray[] = array($appointmentDate, $appointmentTime, $scheduledAppointments['MentorID']);
      }
    }
    sort($scheduledAppointmentsArray);

    // Create an associative array with each unique date as a key and each unique date key having an array of the times and their associated scheduler ID
    $scheduledAppointmentsAssoc = array();
    foreach ($scheduledAppointmentsArray as $appointment) {
      $date = $appointment[0];
      $time = $appointment[1];
      if ($userMentorStatus) {
        $schedulerID = $appointment[2];
      } else {
        $mentorID = $appointment[2];
      }
      if (!isset($scheduledAppointmentsAssoc[$date])) {
        $scheduledAppointmentsAssoc[$date] = array();
      }
      if ($userMentorStatus) {
        $scheduledAppointmentsAssoc[$date][] = array('time' => $time, 'schedulerID' => $schedulerID);
      } else {
        $scheduledAppointmentsAssoc[$date][] = array('time' => $time, 'mentorID' => $mentorID);
      }
    }

    // Add unique schedulers to an array to use for querying the database for their information
    if ($userMentorStatus) {
      $uniqueSchedulerIDs = array();
    } else {
      $uniqueMentorIDs = array();
    }
    foreach ($scheduledAppointmentsAssoc as $date => $appointments) {
      foreach ($appointments as $appointment) {
        if ($userMentorStatus) {
          $schedulerID = $appointment['schedulerID'];
          if (!in_array($schedulerID, $uniqueSchedulerIDs)) {
            $uniqueSchedulerIDs[] = $schedulerID;
          }
        } else {
          $mentorID = $appointment['mentorID'];
          if (!in_array($mentorID, $uniqueMentorIDs)) {
            $uniqueMentorIDs[] = $mentorID;
          }
        }
      }
    }

    // Save data for all people that scheduled appointments with the user to an array that can be accessed later
    $schedulerData = array();
    if ($userMentorStatus) {
      foreach ($uniqueSchedulerIDs as $id) {
        $sqlSchedulers = "SELECT `FirstName`,`LastName`,`ProfilePicture` FROM `UserData_t` WHERE `UserID`=$id";
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
      foreach ($uniqueMentorIDs as $id) {
        $sqlMentors = "SELECT `FirstName`,`LastName`,`ProfilePicture` FROM `userdata_t` WHERE `UserID`=$id";
        $mentorResult = mysqli_query($con, $sqlMentors);
        while ($mentorProfile = mysqli_fetch_assoc($mentorResult)) {
          $mentorFirstName = $mentorProfile['FirstName'];
          $mentorLastName = $mentorProfile['LastName'];
          $mentorProfilePicture = $mentorProfile['ProfilePicture'];
          $mentorDetails = array(
            'FirstName' => $mentorFirstName,
            'LastName' => $mentorLastName,
            'ProfilePicture' => $mentorProfilePicture
          );
          $mentorData[$id] = $mentorDetails;
        }
      }
    }
  } else {
    $scheduledAppointmentsArray = null;
  }

  // Get open appointments slots information
  $sqlOpenAppointments = "SELECT `AppointmentTime` FROM `Appointments_t` WHERE `MentorID` = $userID AND `SchedulerID` IS NULL";
  $resultOpenAppointments = mysqli_query($con, $sqlOpenAppointments);

  if (mysqli_num_rows($resultOpenAppointments) > 0) {
    $openAppointmentsArray = array();
    while ($openAppointments = mysqli_fetch_assoc($resultOpenAppointments)) {
      $appointmentDateTime = $openAppointments['AppointmentTime'];
      $appointmentDate = explode(" ", $appointmentDateTime)[0];
      $appointmentTime = explode(" ", $appointmentDateTime)[1];
      $openAppointmentsArray[] = array($appointmentDate, $appointmentTime);
    }
    sort($openAppointmentsArray);


    // Create an associative array with each unique date as a key and each unique date key having an array of the times available
    $openAppointmentsAssoc = array();
    foreach ($openAppointmentsArray as $appointment) {
      $date = $appointment[0];
      $time = $appointment[1];
      if (!isset($openAppointmentsAssoc[$date])) {
        $openAppointmentsAssoc[$date] = array();
      }
      $openAppointmentsAssoc[$date][] = $time;
    }
  } else {
    $openAppointmentsArray = null;
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

  // *** Buttons Section ***

  if ($userID == $profileID) {
    echo '<section class="profile__buttons-section d-flex justify-content-center">';
    echo '<div class="container text-center row profile__buttons_links">';
    echo '<div class="col">';
    echo '<a href="edit-profile.php"><i class="fa-solid fa-pencil"></i><br>Edit Profile</a>';
    echo '</div>';
    echo '<div class="col">';
    echo '<a href="profile.php?profileID=' . $userID . '"><i class="fa-solid fa-user"></i><br>Back to Profile</a>';
    echo '</div>';
    echo '</div>';
    echo '</section>';
  }
  ?>

  <!-- *** Scheduled Appointments Section *** -->

  <section class="content-section pt-4 container d-flex align-items-center">
    <div class="w-100 d-flex justify-content-center p-1 mb-3 appointments__section-heading">
      <h1>Scheduled Appointments</h1>
    </div>

    <?php
    if ($scheduledAppointmentsArray != null) {
      // Group the data by month
      $groupedAppointments = [];
      foreach ($scheduledAppointmentsAssoc as $date => $entries) {
        $month = date('F Y', strtotime($date));
        $groupedAppointments[$month][$date] = $entries;
      }

      // Print the grouped data
      foreach ($groupedAppointments as $month => $monthData) {
        echo '<div class="profile-section mb-3">';
        echo '<div class="d-flex justify-content-center appointments__month-heading">';
        echo '<h2 class="appointments__section-subHeading mb-3 mt-4">' . $month . '</h2>';
        echo '</div>';
        echo '<div class="container">';

        $firstDate = true;

        foreach ($monthData as $date => $entries) {
          if ($firstDate) {
            echo '<div class="row p-2">';
            $firstDate = false;
          } else {
            echo '<div class="row p-2 appointments__dayRow">';
          }
          echo '<div class="col-3">';
          echo '<span class="appointments__day pe-1">' . date_format(date_create($date), "j") . '</span>';
          echo '<span class="appointments__dayOfWeek">' . date_format(date_create($date), "D") . '</span>';
          echo '</div>';
          echo '<div class="col-9 row">';

          foreach ($entries as $entry) {
            $time = $entry['time'];
            if ($userMentorStatus) {
              $schedulerID = $entry['schedulerID'];

              echo '<div class="col-3 d-flex align-items-center mb-3">';
              echo '<p class="scheduler-name m-0">' . date_format(date_create($time), "g:i A") . '</p>';
              echo '</div>';
              echo '<div class="col-2 mb-3">';
              echo '<a href="profile.php?profileID=' . $schedulerID . '"><img class="schedule-photo" src="upload/' . $schedulerData[$schedulerID]['ProfilePicture'] . '" alt="' . $schedulerData[$schedulerID]['FirstName'] . ' ' . $schedulerData[$schedulerID]['LastName'] . ' Profile Picture"></a>';
              echo '</div>';
              echo '<div class="col-7 d-flex align-items-center mb-3">';
              echo '<p class="scheduler-name m-0">' . $schedulerData[$schedulerID]['FirstName'] . ' ' . $schedulerData[$schedulerID]['LastName'] . '</p>';
            } else {
              $mentorID = $entry['mentorID'];

              echo '<div class="col-3 d-flex align-items-center mb-3">';
              echo '<p class="scheduler-name m-0">' . date_format(date_create($time), "g:i A") . '</p>';
              echo '</div>';
              echo '<div class="col-2 mb-3">';
              echo '<a href="profile.php?profileID=' . $mentorID . '"><img class="schedule-photo" src="upload/' . $mentorData[$mentorID]['ProfilePicture'] . '" alt="' . $mentorData[$mentorID]['FirstName'] . ' ' . $mentorData[$mentorID]['LastName'] . ' Profile Picture"></a>';
              echo '</div>';
              echo '<div class="col-7 d-flex align-items-center mb-3">';
              echo '<p class="scheduler-name m-0">' . $mentorData[$mentorID]['FirstName'] . ' ' . $mentorData[$mentorID]['LastName'] . '</p>';
            }
            echo '</div>';
          }

          echo '</div>';
          echo '</div>';
        }

        echo '</div>';
        echo '</div>';
      }
    } else {
      echo '<h2 class="appointments__section-subHeading mb-3">No appointments scheduled!</h2>';
    }
    ?>

  </section>

  <!-- *** Open Appointments Section *** -->
  <?php
  if ($userMentorStatus) {
    echo '<section class="content-section pt-4 container d-flex align-items-center">';
    echo '<div class="w-100 d-flex justify-content-center p-1 mb-3 appointments__section-heading">';
    echo '<h1>Open Appointment Slots</h1>';
    echo '</div>';

    if ($openAppointmentsArray != null) {
      // Group the data by month
      $groupedAppointments = [];
      foreach ($openAppointmentsAssoc as $date => $entries) {
        $month = date('F Y', strtotime($date));
        $groupedAppointments[$month][$date] = $entries;
      }

      $x = 0;

      // Print the grouped data
      foreach ($groupedAppointments as $month => $monthData) {
        echo '<div class="profile-section open-appointments-section mb-3">';
        echo '<div class="d-flex justify-content-center appointments__month-heading">';
        echo '<h2 class="appointments__section-subHeading mb-3 mt-4">' . $month . '</h2>';
        echo '</div>';
        echo '<div class="container p-0">';
        echo '<div class="accordion" id="accordion-' . $x . '">';

        foreach ($monthData as $date => $entries) {

          echo '<div class="accordion-item">';
          echo '<h3 class="accordion-header" id="heading-' . $date . '">';
          echo '<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-' . $date . '" aria-expanded="false" aria-controls="collapse-' . $date . '">';
          echo '<div>';
          echo '<span class="appointments__day pe-1">' . date_format(date_create($date), "j") . '</span>';
          echo '<span class="appointments__dayOfWeek">' . date_format(date_create($date), "D") . '</span>';
          echo '</div>';
          echo '</button>';
          echo '</h3>';
          echo '<div id="collapse-' . $date . '" class="accordion-collapse collapse" aria-labelledby="heading-' . $date . '" data-bs-parent="#accordion-' . $x . '">';

          foreach ($entries as $time) {
            echo '<div class="accordion-body">';
            echo '<p class="scheduler-name mt-2 mb-0">' . date_format(date_create($time), "g:i A") . '</p>';
            echo '</div>';
          }

          echo '</div>';
          echo '</div>';
        }

        $x++;
        echo '</div>';
        echo '</div>';
        echo '</div>';
      }
    } else {
      echo '<h2 class="appointments__section-subHeading mb-3">No open appointment slots!</h2>';
    }
    echo '</section>';
  }
  ?>

  <!-- *** Add Appointments Section *** -->
  <?php
  if ($userMentorStatus) {
    echo '<section class="add-appointment-content-section pt-4 container d-flex align-items-center mb-4">';
    echo '<div class="w-100 d-flex justify-content-center p-1 mb-3 appointments__section-heading">';
    echo '<h1>Add Appointments</h1>';
    echo '</div>';
    echo '<div class="profile-section open-appointments-section mb-3 d-flex justify-content-center">';
    echo '<form class="add-appointment mt-3" action="add-appointments.php" method="POST">';
    echo '<div>';
    echo '<label for="selection">Add a single appointment slot or a range?</label>';
    echo '<select class="form-control" name="selection" id="selection">';
    echo '<option value="single">Single Appointment</option>';
    echo '<option value="range">Appointment Range</option>';
    echo '</select>';
    echo '</div>';
    echo '<div class="mt-3" id="singleAppointment" style="display: block;">';
    echo '<fieldset>';
    echo '<legend>Add Single Appointment Slot</legend>';
    echo '<label for="date" class="form-label">Date</label>';
    echo '<input type="date" class="form-control mb-2" name="singleDate" id="date" min="' . date("Y-m-d") . '">';
    echo '<label for="time" class="form-label">Time (15 minute increments)</label>';
    echo '<input type="time" class="form-control mb-3" name="singleTime" id="time" step="900">';
    echo '<div class="d-flex justify-content-center">';
    echo '<button type="submit" class="btn main-button btn-std me-4">Submit</button>';
    echo '<button type="reset" class="btn cancel-button">Clear</button>';
    echo '</div>';
    echo '</fieldset>';
    echo '</div>';
    echo '<div class="mt-3" id="rangeAppointment" style="display: none;">';
    echo '<fieldset>';
    echo '<legend>Add a Range of Appointment Times</legend>';
    echo '<label for="duration" class="form-label">Appointment Duration (in minutes)</label>';
    echo '<input type="number" class="form-control mb-2" name="duration" id="duration" min="15" step="15" value="15">';
    echo '<label for="startDate" class="form-label">Start Date</label>';
    echo '<input type="date" class="form-control mb-2" name="startDate" id="startDate" min="' . date("Y-m-d") . '">';
    echo '<label for="endDate" class="form-label">End Date</label>';
    echo '<input type="date" class="form-control mb-3" name="endDate" id="endDate" min="' . date("Y-m-d") . '">';
    echo '<label class="form-label">Times (15 minute increments)</label>';
    echo '<div class="input-group mb-3">';
    echo '<span class="input-group-text days">Sun</span>';
    echo '<input type="time" class="form-control" name="sunStartTime" id="sunStartTime" step="900">';
    echo '<span class="input-group-text">-</span>';
    echo '<input type="time" class="form-control" name="sunEndTime" id="sunEndTime" step="900">';
    echo '</div>';
    echo '<div class="input-group mb-3">';
    echo '<span class="input-group-text days">Mon</span>';
    echo '<input type="time" class="form-control" name="monStartTime" id="monStartTime" step="900">';
    echo '<span class="input-group-text">-</span>';
    echo '<input type="time" class="form-control" name="monEndTime" id="monEndTime" step="900">';
    echo '</div>';
    echo '<div class="input-group mb-3">';
    echo '<span class="input-group-text days">Tue</span>';
    echo '<input type="time" class="form-control" name="tueStartTime" id="tueStartTime" step="900">';
    echo '<span class="input-group-text">-</span>';
    echo '<input type="time" class="form-control" name="tueEndTime" id="tueEndTime" step="900">';
    echo '</div>';
    echo '<div class="input-group mb-3">';
    echo '<span class="input-group-text days">Wed</span>';
    echo '<input type="time" class="form-control" name="wedStartTime" id="wedStartTime" step="900">';
    echo '<span class="input-group-text">-</span>';
    echo '<input type="time" class="form-control" name="wedEndTime" id="wedEndTime" step="900">';
    echo '</div>';
    echo '<div class="input-group mb-3">';
    echo '<span class="input-group-text days">Thu</span>';
    echo '<input type="time" class="form-control" name="thuStartTime" id="thuStartTime" step="900">';
    echo '<span class="input-group-text">-</span>';
    echo '<input type="time" class="form-control" name="thuEndTime" id="thuEndTime" step="900">';
    echo '</div>';
    echo '<div class="input-group mb-3">';
    echo '<span class="input-group-text days">Fri</span>';
    echo '<input type="time" class="form-control" name="friStartTime" id="friStartTime" step="900">';
    echo '<span class="input-group-text">-</span>';
    echo '<input type="time" class="form-control" name="friEndTime" id="friEndTime" step="900">';
    echo '</div>';
    echo '<div class="input-group mb-3">';
    echo '<span class="input-group-text days">Sat</span>';
    echo '<input type="time" class="form-control" name="satStartTime" id="satStartTime" step="900">';
    echo '<span class="input-group-text">-</span>';
    echo '<input type="time" class="form-control" name="satEndTime" id="satEndTime" step="900">';
    echo '</div>';
    echo '<div class="d-flex justify-content-center">';
    echo '<button type="submit" class="btn main-button btn-std me-4">Submit</button>';
    echo '<button type="reset" class="btn cancel-button">Clear</button>';
    echo '</div>';
    echo '</fieldset>';
    echo '</div>';
    echo '</form>';
    echo '</div>';
    echo '</section>';
  }
  ?>

  <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/jquery/jquery-3.7.0.min.js"></script>
  <script src="https://kit.fontawesome.com/c5863419fe.js" crossorigin="anonymous"></script>
  <script src="js/appointments.js"></script>
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