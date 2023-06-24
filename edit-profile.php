<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Edit Profile</title>
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

  $sqlEmail = "SELECT `email` FROM `Auth_t` WHERE `UserID` = $userID";
  $emailResult = mysqli_query($con, $sqlEmail);

  while ($fetchEmail = mysqli_fetch_assoc($emailResult)) {
    $email = $fetchEmail['email'];
  }

  // Create an associative array for all of the skills in the database
  $sqlSkills = "SELECT * FROM `Skills_t`";
  $skillsResult = mysqli_query($con, $sqlSkills);
  $allSkillsArray = array();

  while ($fetchSkills = mysqli_fetch_assoc($skillsResult)) {
    $skillID = $fetchSkills['SkillID'];
    $allSkillsArray[$skillID] = array(
      'SkillName' => $fetchSkills['SkillName'],
      'SkillGroup' => $fetchSkills['SkillGroup']
    );
  }

  // Fetch qualifications data from qualifications table and skills table
  $qualificationsSql = "SELECT * FROM `Qualifications_t` WHERE `UserID` = $userID";
  $qualificationsResult = mysqli_query($con, $qualificationsSql);
  $qualificationsArray = array();
  while ($qualifications = mysqli_fetch_assoc($qualificationsResult)) {
    $qualificationsArray[] = $qualifications['SkillID'];
  }

  mysqli_close($con);

  // Create an array for all US States and D.C.
  $us_states = array(
    'Alabama', 'Alaska', 'Arizona', 'Arkansas', 'California', 'Colorado', 'Connecticut', 'Delaware', 'Florida', 'Georgia',
    'Hawaii', 'Idaho', 'Illinois', 'Indiana', 'Iowa', 'Kansas', 'Kentucky', 'Louisiana', 'Maine', 'Maryland',
    'Massachusetts', 'Michigan', 'Minnesota', 'Mississippi', 'Missouri', 'Montana', 'Nebraska', 'Nevada', 'New Hampshire', 'New Jersey',
    'New Mexico', 'New York', 'North Carolina', 'North Dakota', 'Ohio', 'Oklahoma', 'Oregon', 'Pennsylvania', 'Rhode Island', 'South Carolina',
    'South Dakota', 'Tennessee', 'Texas', 'Utah', 'Vermont', 'Virginia', 'Washington', 'West Virginia', 'Wisconsin', 'Wyoming',
    'Washington, D.C.'
  );

  // Create an array of months
  $months = array(
    '01' => 'January',
    '02' => 'February',
    '03' => 'March',
    '04' => 'April',
    '05' => 'May',
    '06' => 'June',
    '07' => 'July',
    '08' => 'August',
    '09' => 'September',
    '10' => 'October',
    '11' => 'November',
    '12' => 'December'
  );


  // Create an array of days
  $days = array();
  for ($i = 1; $i <= 31; $i++) {
    $day = sprintf("%02d", $i); // Format the number with leading zeros
    $days[$day] = $i;
  }

  // Create an array of years
  $years = array();
  for ($i = 1900; $i <= 2023; $i++) {
    $years[] = $i;
  }

  $overlayArray = array('BioTech' => 'biotech-pattern.png', 'Circuits' => 'circuit_gray_transparent.png');

  // *** Photo Section ***

  echo '<section class="photo-section pt-5 pb-3">';
  echo '<div class="container-fluid flex-column">';
  echo '<img class="profile-photo mb-3" style="border-color: ' . $profilePictureBorder . ';" src="upload/' . $profilePicture . '" alt="' . $firstName . ' ' . $lastName . ' Profile Photo">';
  echo '</div>';
  echo '</section>';

  // *** Content Section ***

  echo '<section class="content-section pt-4">';
  ?>
  <form action="edit.php" method="POST" class="container w-50">
    <h1 class="w-100 edit__section-heading p-1 mb-3">Personal Details</h1>
    <div class="w-75 container">
      <div class="row mb-3 align-items-center">
        <label for="firstName" class="col-sm-2 form-label m-0">First Name</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="firstName" id="firstName" value="<?php echo $firstName; ?>" required>
        </div>
      </div>
      <div class="row mb-3 align-items-center">
        <label for="lastName" class="col-sm-2 form-label m-0">Last Name</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="lastName" id="lastName" value="<?php echo $lastName; ?>" required>
        </div>
      </div>
      <div class="row mb-3 align-items-center">
        <label for="city" class="col-sm-2 form-label m-0">City</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="city" id="city" value="<?php echo $city; ?>">
        </div>
      </div>
      <div class="row mb-3 align-items-center">
        <label for="state" class="col-sm-2 form-label m-0">State</label>
        <div class="col-sm-10">
          <select class="form-select" name="state" id="state">
            <?php
            if ($state == null) {
              echo '<option value="" selected>Choose...</option>';
              foreach ($us_states as $stateName) {
                echo '<option value="' . $stateName . '">' . $stateName . '</option>';
              }
            } else {
              echo '<option value="">Choose...</option>';
              foreach ($us_states as $stateName) {
                if ($stateName == $state) {
                  echo '<option value="' . $stateName . '" selected="selected">' . $stateName;
                } else {
                  echo '<option value="' . $stateName . '">' . $stateName;
                }
                echo '</option>';
              }
            }
            ?>
          </select>
        </div>
      </div>
      <div class="row mb-3 align-items-center">
        <label for="email" class="col-sm-2 form-label m-0">Email</label>
        <div class="col-sm-10">
          <input type="email" class="form-control" name="email" id="email" value="<?php echo $email; ?>">
        </div>
      </div>
    </div>

    <h1 class="w-100 edit__section-heading p-1 mb-3">Social Media</h1>
    <div class="w-75 container">
      <div class="row mb-3 align-items-center">
        <label for="facebook" class="col-sm-2 form-label m-0">Facebook</label>
        <div class="col-sm-10 input-group">
          <span class="input-group-text">https://www.facebook.com/</span>
          <input type="text" class="form-control" name="facebook" id="facebook" value="<?php echo $facebook; ?>">
        </div>
      </div>
      <div class="row mb-3 align-items-center">
        <label for="twitter" class="col-sm-2 form-label m-0">Twitter</label>
        <div class="col-sm-10 input-group">
          <span class="input-group-text">https://www.twitter.com/</span>
          <input type="text" class="form-control" name="twitter" id="twitter" value="<?php echo $twitter; ?>">
        </div>
      </div>
      <div class="row mb-3 align-items-center">
        <label for="instagram" class="col-sm-2 form-label m-0">Instagram</label>
        <div class="col-sm-10 input-group">
          <span class="input-group-text">https://www.instagram.com/</span>
          <input type="text" class="form-control" name="instagram" id="instagram" value="<?php echo $instagram; ?>">
        </div>
      </div>
      <div class="row mb-3 align-items-center">
        <label for="linkedIn" class="col-sm-2 form-label m-0">LinkedIn</label>
        <div class="col-sm-10 input-group">
          <span class="input-group-text">https://www.linkedin.com/in/</span>
          <input type="text" class="form-control" name="linkedIn" id="linkedIn" value="<?php echo $linkedIn; ?>">
        </div>
      </div>
    </div>

    <h1 class="w-100 edit__section-heading p-1 mb-3">Experience</h1>
    <div class="w-75 container">
      <h2 class="edit__section-subHeading mb-3 mt-4">About Me</h2>
      <div class="mb-3 text-left">
        <textarea class="form-control" name="aboutMe" id="aboutMe" rows="3"><?php echo $aboutMe; ?></textarea>
      </div>
      <h2 class="edit__section-subHeading mb-3 mt-4">Work</h2>
      <div class="row mb-3 align-items-center">
        <label for="jobTitle" class="col-sm-2 form-label m-0">Job Title</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="jobTitle" id="jobTitle" value="<?php echo $workTitle; ?>">
        </div>
      </div>
      <div class="row mb-3 align-items-center">
        <label for="workLocation" class="col-sm-2 form-label m-0">Company</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="workLocation" id="workLocation" value="<?php echo $workLocation; ?>">
        </div>
      </div>
      <div class="row mb-3 align-items-center">
        <label class="col-sm-2 form-label m-0">Start Date</label>
        <div class="col-auto">
          <select class="form-select" name="workStartMonth">
            <?php
            $workStartMonth = date("F", strtotime($workStartDate));
            if ($workStartDate == null) {
              echo '<option value="null" selected>Month</option>';
              foreach ($months as $key => $month) {
                echo '<option value="' . $key . '">' . $month . '</option>';
              }
            } else {
              echo '<option value="null">Month</option>';
              foreach ($months as $key => $month) {
                if ($month == $workStartMonth) {
                  echo '<option value="' . $key . '" selected="selected">' . $month;
                } else {
                  echo '<option value="' . $key . '">' . $month;
                }
                echo '</option>';
              }
            }
            ?>
          </select>
        </div>
        <div class="col-auto">
          <select class="form-select" name="workStartDay">
            <?php
            $workStartDay = date("j", strtotime($workStartDate));
            if ($workStartDate == null) {
              echo '<option value="null" selected>Day</option>';
              foreach ($days as $key => $day) {
                echo '<option value="' . $key . '">' . $day . '</option>';
              }
            } else {
              echo '<option value="null">Day</option>';
              foreach ($days as $key => $day) {
                if ($day == $workStartDay) {
                  echo '<option value="' . $key . '" selected="selected">' . $day;
                } else {
                  echo '<option value="' . $key . '">' . $day;
                }
                echo '</option>';
              }
            }
            ?>
          </select>
        </div>
        <div class="col-auto">
          <select class="form-select" name="workStartYear">
            <?php
            $workStartYear = date("Y", strtotime($workStartDate));
            if ($workStartDate == null) {
              echo '<option value="null" selected>Year</option>';
              foreach ($years as $year) {
                echo '<option value="' . $year . '">' . $year . '</option>';
              }
            } else {
              echo '<option value="null">Year</option>';
              foreach ($years as $year) {
                if ($year == $workStartYear) {
                  echo '<option value="' . $year . '" selected="selected">' . $year;
                } else {
                  echo '<option value="' . $year . '">' . $year;
                }
                echo '</option>';
              }
            }
            ?>
          </select>
        </div>
      </div>
      <div class="row mb-3 align-items-center">
        <label class="col-sm-2 form-label m-0">End Date</label>
        <div class="col-auto">
          <select class="form-select" name="workEndMonth">
            <?php
            $workEndMonth = date("F", strtotime($workEndDate));
            if ($workEndDate == null) {
              echo '<option value="null" selected>Month</option>';
              foreach ($months as $key => $month) {
                echo '<option value="' . $key . '">' . $month . '</option>';
              }
            } else {
              echo '<option value="null">Month</option>';
              foreach ($months as $key => $month) {
                if ($month == $workEndMonth) {
                  echo '<option value="' . $key . '" selected="selected">' . $month;
                } else {
                  echo '<option value="' . $key . '">' . $month;
                }
                echo '</option>';
              }
            }
            ?>
          </select>
        </div>
        <div class="col-auto">
          <select class="form-select" name="workEndDay">
            <?php
            $workEndDay = date("j", strtotime($workEndDate));
            if ($workEndDate == null) {
              echo '<option value="null" selected>Day</option>';
              foreach ($days as $key => $day) {
                echo '<option value="' . $key . '">' . $day . '</option>';
              }
            } else {
              echo '<option value="null">Day</option>';
              foreach ($days as $key => $day) {
                if ($day == $workEndDay) {
                  echo '<option value="' . $key . '" selected="selected">' . $day;
                } else {
                  echo '<option value="' . $key . '">' . $day;
                }
                echo '</option>';
              }
            }
            ?>
          </select>
        </div>
        <div class="col-auto">
          <select class="form-select" name="workEndYear">
            <?php
            $workEndYear = date("Y", strtotime($workEndDate));
            if ($workEndDate == null) {
              echo '<option value="null" selected>Year</option>';
              foreach ($years as $year) {
                echo '<option value="' . $year . '">' . $year . '</option>';
              }
            } else {
              echo '<option value="null">Year</option>';
              foreach ($years as $year) {
                if ($year == $workEndYear) {
                  echo '<option value="' . $year . '" selected="selected">' . $year;
                } else {
                  echo '<option value="' . $year . '">' . $year;
                }
                echo '</option>';
              }
            }
            ?>
          </select>
        </div>
      </div>
      <p>Accomplishments</p>
      <div class="mb-3 text-left">
        <textarea class="form-control" name="workDescription" id="workDescription" rows="3"><?php echo $workDescription; ?></textarea>
      </div>
      <h2 class="edit__section-subHeading mb-3 mt-4">Education</h2>
      <div class="row mb-3 align-items-center">
        <label for="degreeTitle" class="col-sm-2 form-label m-0">Degree</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="degreeTitle" id="degreeTitle" value="<?php echo $educationDegree; ?>">
        </div>
      </div>
      <div class="row mb-3 align-items-center">
        <label for="educationLocation" class="col-sm-2 form-label m-0">School</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="educationLocation" id="educationLocation" value="<?php echo $educationLocation; ?>">
        </div>
      </div>
      <div class="row mb-3 align-items-center">
        <label class="col-sm-2 form-label m-0">Start Date</label>
        <div class="col-auto">
          <select class="form-select" name="educationStartMonth">
            <?php
            $educationStartMonth = date("F", strtotime($educationStartDate));
            if ($educationStartDate == null) {
              echo '<option value="null" selected>Month</option>';
              foreach ($months as $key => $month) {
                echo '<option value="' . $key . '">' . $month . '</option>';
              }
            } else {
              echo '<option value="null">Month</option>';
              foreach ($months as $key => $month) {
                if ($month == $educationStartMonth) {
                  echo '<option value="' . $key . '" selected="selected">' . $month;
                } else {
                  echo '<option value="' . $key . '">' . $month;
                }
                echo '</option>';
              }
            }
            ?>
          </select>
        </div>
        <div class="col-auto">
          <select class="form-select" name="educationStartDay">
            <?php
            $educationStartDay = date("j", strtotime($educationStartDate));
            if ($educationStartDate == null) {
              echo '<option value="null" selected>Day</option>';
              foreach ($days as $key => $day) {
                echo '<option value="' . $key . '">' . $day . '</option>';
              }
            } else {
              echo '<option value="null">Day</option>';
              foreach ($days as $key => $day) {
                if ($day == $educationStartDay) {
                  echo '<option value="' . $key . '" selected="selected">' . $day;
                } else {
                  echo '<option value="' . $key . '">' . $day;
                }
                echo '</option>';
              }
            }
            ?>
          </select>
        </div>
        <div class="col-auto">
          <select class="form-select" name="educationStartYear">
            <?php
            $educationStartYear = date("Y", strtotime($educationStartDate));
            if ($educationStartDate == null) {
              echo '<option value="null" selected>Year</option>';
              foreach ($years as $year) {
                echo '<option value="' . $year . '">' . $year . '</option>';
              }
            } else {
              echo '<option value="null">Year</option>';
              foreach ($years as $year) {
                if ($year == $educationStartYear) {
                  echo '<option value="' . $year . '" selected="selected">' . $year;
                } else {
                  echo '<option value="' . $year . '">' . $year;
                }
                echo '</option>';
              }
            }
            ?>
          </select>
        </div>
      </div>
      <div class="row mb-3 align-items-center">
        <label class="col-sm-2 form-label m-0">End Date</label>
        <div class="col-auto">
          <select class="form-select" name="educationEndMonth">
            <?php
            $educationEndMonth = date("F", strtotime($educationEndDate));
            if ($educationEndDate == null) {
              echo '<option value="null" selected>Month</option>';
              foreach ($months as $key => $month) {
                echo '<option value="' . $key . '">' . $month . '</option>';
              }
            } else {
              echo '<option value="null">Month</option>';
              foreach ($months as $key => $month) {
                if ($month == $educationEndMonth) {
                  echo '<option value="' . $key . '" selected="selected">' . $month;
                } else {
                  echo '<option value="' . $key . '">' . $month;
                }
                echo '</option>';
              }
            }
            ?>
          </select>
        </div>
        <div class="col-auto">
          <select class="form-select" name="educationEndDay">
            <?php
            $educationEndDay = date("j", strtotime($educationEndDate));
            if ($educationEndDate == null) {
              echo '<option value="null" selected>Day</option>';
              foreach ($days as $key => $day) {
                echo '<option value="' . $key . '">' . $day . '</option>';
              }
            } else {
              echo '<option value="null">Day</option>';
              foreach ($days as $key => $day) {
                if ($day == $educationEndDay) {
                  echo '<option value="' . $key . '" selected="selected">' . $day;
                } else {
                  echo '<option value="' . $key . '">' . $day;
                }
                echo '</option>';
              }
            }
            ?>
          </select>
        </div>
        <div class="col-auto">
          <select class="form-select" name="educationEndYear">
            <?php
            $educationEndYear = date("Y", strtotime($educationEndDate));
            if ($educationEndDate == null) {
              echo '<option value="null" selected>Year</option>';
              foreach ($years as $year) {
                echo '<option value="' . $year . '">' . $year . '</option>';
              }
            } else {
              echo '<option value="null">Year</option>';
              foreach ($years as $year) {
                if ($year == $educationEndYear) {
                  echo '<option value="' . $year . '" selected="selected">' . $year;
                } else {
                  echo '<option value="' . $year . '">' . $year;
                }
                echo '</option>';
              }
            }
            ?>
          </select>
        </div>
      </div>
      <p>Accomplishments</p>
      <div class="mb-3 text-left">
        <textarea class="form-control" name="educationDescription" id="educationDescription" rows="3"><?php echo $educationDescription; ?></textarea>
      </div>
      <h2 class="edit__section-subHeading mb-3 mt-4">Skills</h2>
      <div class="row mb-3 align-items-center">
        <select id="choices-multiple-remove-button" name="skills[]" class="form-select mb-3" multiple>
          <option value="">Select Skills...</option>
          <?php
          foreach ($allSkillsArray as $skillID => $skill) {
            $selected = in_array($skillID, $qualificationsArray) ? 'selected' : '';
            if (!isset($currentGroup) || $currentGroup !== $skill['SkillGroup']) {
              if (isset($currentGroup)) {
                echo '</optgroup>';
              }
              $currentGroup = $skill['SkillGroup'];
              echo '<optgroup label="' . $currentGroup . '">';
            }
            echo '<option value="' . $skillID . '" ' . $selected . '>' . $skill['SkillName'] . '</option>';
          }
          echo '</optgroup>';
          ?>
        </select>
      </div>
    </div>

    <h1 class="w-100 edit__section-heading p-1 mb-3">Page Design</h1>
    <div class="w-75 container">
      <div class="row mb-3 align-items-center">
        <label for="overlay" class="col-sm-2 form-label m-0">Overlay</label>
        <div class="col-sm-10">
          <select class="form-select" name="overlay" id="overlay">
            <?php
            if ($profilePictureBackground == null) {
              echo '<option value="null" selected>Choose...</option>';
              foreach ($overlayArray as $overlayName => $overlayPath) {
                echo '<option value="' . $overlayPath . '">' . $overlayName . '</option>';
              }
            } else {
              echo '<option value="null">Choose...</option>';
              foreach ($overlayArray as $overlayName => $overlayPath) {
                if ($profilePictureBackground == $overlayPath) {
                  echo '<option value="' . $overlayPath . '" selected="selected">' . $overlayName;
                } else {
                  echo '<option value="' . $overlayPath . '">' . $overlayName;
                }
                echo '</option>';
              }
            }
            ?>
          </select>
        </div>
      </div>
      <div class="row mb-3 align-items-center">
        <label for="profilePictureBorder" class="col-sm-4 form-label m-0">Profile Picture Border</label>
        <div class="col-sm-8">
          <input type="color" class="form-control form-control-color" id="profilePictureBorder" name="profilePictureBorder" value="<?php echo $profilePictureBorder; ?>" title="Choose your color">
        </div>
      </div>
      <div class="d-flex justify-content-center my-5">
        <button type="submit" class="btn main-button me-3">Save</button>
        <button type="button" class="btn cancel-button ms-3" data-bs-toggle="modal" data-bs-target="#cancelModal">
          Cancel
        </button>

        <!-- Cancel Modal -->
        <div class="modal fade" id="cancelModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="cancelModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header modal-header-gradient">
                <h1 class="modal-title fs-5" id="cancelModalLabel">Cancel?</h1>
              </div>
              <div class="modal-body">
                Are you sure you want to discard your changes?
              </div>
              <div class="modal-footer justify-content-center">
                <button type="button" class="btn main-button btn-long" id="confirm" data-userid="<?php echo $userID; ?>">Discard Changes</button>
                <button type="button" class="btn cancel-button btn-long" data-bs-dismiss="modal">Go back to edit</button>
              </div>
            </div>
          </div>
        </div>
        <!-- End Cancel Modal -->

      </div>
    </div>
  </form>
  <?php
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

</html>