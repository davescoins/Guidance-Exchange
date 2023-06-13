<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Profile Template</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />
  <link rel="stylesheet" href="css/main.css" />
</head>

<header>
  <nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="home.php"><img src="img/logo_gradient.png" alt="Guidance Exchange Logo" height="70" /></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link highlight-link nav-text px-4 active" href="#">Profile</a>
          </li>
          <li class="nav-item">
            <a class="nav-link highlight-link nav-text px-4" href="#">Communities</a>
          </li>
          <li class="nav-item">
            <a class="nav-link highlight-link nav-text px-4" href="#">Mentoring</a>
          </li>
        </ul>
        <ul class="navbar-nav d-flex flex-row me-1">
          <li class="nav-item me-3 me-lg-0 px-2">
            <a class="nav-link" href="#"><i class="fa-solid fa-magnifying-glass fa-xl"></i></i></i></a>
          </li>
          <li class="nav-item me-3 me-lg-0 px-2">
            <a class="nav-link" href="#"><i class="fa-solid fa-inbox fa-xl"></i></i></a>
          </li>
          <li class="nav-item me-3 me-lg-0 px-2">
            <a class="nav-link" href="#"><i class="fa-solid fa-user-group fa-xl"></i></i></a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>

<body>
  <?php
  include('includes/connect.inc.php');

  // *** TESTING USERID INSERTED - CHANGE TO SESSION FOR PRODUCTION!!! ***
  $sql = "SELECT * FROM `UserData_t` WHERE `UserID` = 1";
  $sqlAvailableAppointments = "SELECT `AppointmentTime` FROM `Appointments_t` WHERE `MentorID` = 1 AND `SchedulerID` IS NULL";
  $result = mysqli_query($con, $sql);
  $resultAvailableAppointments = mysqli_query($con, $sqlAvailableAppointments);

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
    $workLocation = $profile['WorkLocation'];
    $workLocationArray = explode(";", $workLocation ?? '');
    $workStartDate = $profile['WorkStartDate'];
    $workStartDateArray = explode(";", $workStartDate ?? '');
    $workEndDate = $profile['WorkEndDate'];
    $workEndDateArray = explode(";", $workEndDate ?? '');
    $workDescription = $profile['WorkDescription'];
    $workDescriptionArray = explode(";", $workDescription ?? '');
    $educationLocation = $profile['EducationLocation'];
    $educationLocationArray = explode(";", $educationLocation ?? '');
    $educationStartDate = $profile['EducationStartDate'];
    $educationStartDateArray = explode(";", $educationStartDate ?? '');
    $educationEndDate = $profile['EducationEndDate'];
    $educationEndDateArray = explode(";", $educationEndDate ?? '');
    $educationDescription = $profile['EducationDescription'];
    $educationDescriptionArray = explode(";", $educationDescription ?? '');
    $skills = $profile['Skills'];
    $skillsArray = explode(";", $skills ?? '');
    $associations = $profile['Associations'];
    $associationsArray = explode(";", $associations ?? '');
  }

  $availableAppointmentsArray = [];
  while ($availableAppointments = mysqli_fetch_assoc($resultAvailableAppointments)) {
    $availableAppointmentsArray[] = $availableAppointments['AppointmentTime'];
  }
  print_r($availableAppointmentsArray);
  echo '<br><br>';

  $associativeArray = array();

  foreach ($availableAppointmentsArray as $item) {
    $date = date('Y-m-d', strtotime($item));
    $time = date('H:i:s', strtotime($item));

    if (!isset($associativeArray[$date])) {
      $associativeArray[$date] = array();
    }

    $associativeArray[$date][] = $time;
  }

  print_r($associativeArray);
  echo '<br><br>';

  $keys = array_keys($associativeArray);
  $secondKey = $keys[1];
  $formattedDate = date('F j, Y', strtotime($secondKey));
  echo $formattedDate;
  echo '<br><br>';

  print_r($associativeArray[$keys[1]]);

  if (isset($associativeArray[$keys[1]])) {
    $times = $associativeArray[$keys[1]];
    foreach ($times as $time) {
      $formattedTime = date('H:i:s', strtotime($time));
      $formattedTimes[] = $formattedTime;
    }
  }

  print_r($formattedTimes);


  mysqli_close($con);

  // *** Photo Section ***

  echo '<section class="photo-section pt-5 pb-3" style="background-image: url(&#39;img/' . $profilePictureBackground . '&#39;); background-attachment: fixed; background-size: cover;">';
  echo '<div class="container-fluid flex-column">';
  echo '<img class="profile-photo mb-3" style="border-color: #' . $profilePictureBorder . ';" src="upload/' . $profilePicture . '" alt="' . $firstName . ' ' . $lastName . ' Profile Photo">';
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
      echo ', ' . $state . '</h2>';
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
      echo '<a href="https://www.linkedin.com' . $linkedIn . '" class="mx-3"><i class="fa fa-linkedin"></i></a>';
    }
    echo '</div>';
  }
  echo '</div>';
  echo '</section>';

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
  ?>

  <div class="container-fluid pb-4">
    <div class="row align-items-start profile-section pt-2">
      <div class="col-1 d-flex align-items-center justify-content-center profile-icon">
        <i class="fa-regular fa-calendar-check"></i>
      </div>
      <div class="col-11 profile-wrap">
        <h3>Schedule an Appointment</h3>
        <div>
          <a class="btn profile-skill" href="#" role="button" onclick="openModal('timeSelection')">July 1</a>
          <a class="btn profile-skill" href="#" role="button">July 2</a>
          <a class="btn profile-skill" href="#" role="button">July 8</a>
          <a class="btn profile-skill" href="#" role="button">July 9</a>
          <a class="btn profile-skill" href="#" role="button">July 15</a>
          <a class="btn profile-skill" href="#" role="button">July 16</a>
          <a class="btn profile-skill" href="#" role="button">July 22</a>
          <a class="btn profile-skill" href="#" role="button">July 23</a>
          <a class="btn profile-skill" href="#" role="button">July 29</a>
          <a class="btn profile-skill" href="#" role="button">July 30</a>
        </div>
        <div class="modal fade" id="timeSelection" tabindex="-1" aria-labelledby="timeLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header modal-header-gradient">
                <h1 class="modal-title fs-5" id="timeLabel">July 1, 2023</h1>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form>
                <div class="modal-body justify-content-center">
                  <fieldset class="row align-items-start py-3 mx-2">
                    <div class="form-check form-check-inline me-0 ps-1 pb-2 col-3 d-flex align-items-center justify-content-center">
                      <input type="radio" name="match" id="match_1" value="10:00" />
                      <label class="btn time-button" for="match_1">10:00 AM</label>
                    </div>
                    <div class="form-check form-check-inline me-0 ps-1 pb-2 col-3 d-flex align-items-center justify-content-center">
                      <input type="radio" name="match" id="match_2" value="11:00" />
                      <label class="btn time-button" for="match_2">11:00 AM</label>
                    </div>
                    <div class="form-check form-check-inline me-0 ps-1 pb-2 col-3 d-flex align-items-center justify-content-center">
                      <input type="radio" name="match" id="match_3" value="12:00" />
                      <label class="btn time-button" for="match_3">12:00 PM</label>
                    </div>
                    <div class="form-check form-check-inline me-0 ps-1 pb-2 col-3 d-flex align-items-center justify-content-center">
                      <input type="radio" name="match" id="match_4" value="13:00" />
                      <label class="btn time-button" for="match_4">1:00 PM</label>
                    </div>
                    <div class="form-check form-check-inline me-0 ps-1 pb-2 col-3 d-flex align-items-center justify-content-center">
                      <input type="radio" name="match" id="match_5" value="14:00" />
                      <label class="btn time-button" for="match_5">2:00 PM</label>
                    </div>
                    <div class="form-check form-check-inline me-0 ps-1 pb-2 col-3 d-flex align-items-center justify-content-center">
                      <input type="radio" name="match" id="match_6" value="15:00" />
                      <label class="btn time-button" for="match_6">3:00 PM</label>
                    </div>
                  </fieldset>
                </div>
                <div class="modal-footer justify-content-center">
                  <button class="btn time-button" type="submit">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 text-end">
        <div class="open-link">
          <div class="expand-btn"><i class="fa-solid fa-plus"></i></div>
        </div>
      </div>
    </div>
  </div>

  <?php
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
    foreach ($workLocationArray as $value) {
      $wl = 0;
      echo '<p class="mb-0"><strong>' . $value . '</strong></p>';
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
    foreach ($educationLocationArray as $value) {
      $el = 0;
      echo '<p class="mb-0"><strong>' . $value . '</strong></p>';
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
  if ($skills != null) {
    echo '<div class="container-fluid pb-4">';
    echo '<div class="row align-items-start profile-section pt-2">';
    echo '<div class="col-1 d-flex align-items-center justify-content-center profile-icon">';
    echo '<i class="fa-solid fa-file-pen"></i>';
    echo '</div>';
    echo '<div class="col-11 profile-wrap">';
    echo '<h3>Skills</h3>';
    echo '<div>';
    foreach ($skillsArray as $value) {
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
      echo '<a href="#"><img class="association-photo" src="upload/' . $associationProfilePicture . '" alt="' . $associationFirstName . ' ' . $associationLastName . ' Profile Photo"></a>';
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


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
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