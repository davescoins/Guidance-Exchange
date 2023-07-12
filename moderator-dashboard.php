<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Guidance Exchange | Moderator Dashboard</title>
  <link rel="icon" type="image/png" sizes="192x192" href="/favicon-192.png">
  <link rel="icon" type="image/png" sizes="180x180" href="/favicon-180.png">
  <link rel="icon" type="image/png" sizes="128x128" href="/favicon-128.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32.png">
  <link href="assets/fontawesome/css/fontawesome.css" rel="stylesheet">
  <link href="assets/fontawesome/css/brands.css" rel="stylesheet">
  <link href="assets/fontawesome/css/solid.css" rel="stylesheet">
  <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="css/moderator.css" />
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
            <a class="nav-link highlight-link nav-text px-4" href="profile.php?profileID=<?php echo $userID ?>">Profile</a>
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
            <a class="nav-link" href="messages.php?profileID=<?php echo $userID ?>"><i class="fa-solid fa-inbox fa-xl"></i></a>
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
  // Fetch necessary entries from the UserData table and assign them to variables that can be used later
  $sql = "SELECT `FirstName`, `LastName`, `ProfilePicture`, `ProfilePictureBorder`, `ProfilePictureBackground` FROM `UserData_t` WHERE `UserID` = $userID";
  $result = mysqli_query($con, $sql);

  while ($profile = mysqli_fetch_assoc($result)) {
    $firstName = $profile['FirstName'];
    $lastName = $profile['LastName'];
    $profilePicture = $profile['ProfilePicture'];
    $profilePictureBorder = $profile['ProfilePictureBorder'];
    $profilePictureBackground = $profile['ProfilePictureBackground'];
  }

  // Fetch mentor request entries from the MentorRequests table and assign them to an array
  $sqlMentorRequests = "SELECT * FROM `MentorRequests_t`";
  $resultMentorRequests = mysqli_query($con, $sqlMentorRequests);

  $mentorRequestsArray = array();
  while ($mentorRequests = mysqli_fetch_assoc($resultMentorRequests)) {
    $mentorRequestsArray[] = array('UserID' => $mentorRequests['UserID'], 'ResumeLocation' => $mentorRequests['ResumeLocation'], 'MentorStatement' => $mentorRequests['MentorStatement']);
  }

  foreach ($mentorRequestsArray as $request) {
    $user = $request['UserID'];
    $sqlUser = "SELECT `FirstName`, `LastName`, `ProfilePicture`, `LinkedIn` FROM `UserData_t` WHERE `UserID` = $user";
    $resultUser = mysqli_query($con, $sqlUser);
    while ($userData = mysqli_fetch_assoc($resultUser)) {
      $userDataArray[] = array('UserID' => $request['UserID'], 'FirstName' => $userData['FirstName'], 'LastName' => $userData['LastName'], 'ProfilePicture' => $userData['ProfilePicture'], 'LinkedIn' => $userData['LinkedIn'], 'ResumeLocation' => $request['ResumeLocation'], 'MentorStatement' => $request['MentorStatement']);
    }
  }

  // Fetch community request entries from the CommunityRequests table and assign them to an array
  $sqlCommunityRequests = "SELECT * FROM `CommunityRequests_t`";
  $resultCommunityRequests = mysqli_query($con, $sqlCommunityRequests);

  $communityRequestsArray = array();
  while ($communityRequests = mysqli_fetch_assoc($resultCommunityRequests)) {
    $communityRequestsArray[] = array('CommunityRequestID' => $communityRequests['CommunityRequestID'], 'UserID' => $communityRequests['UserID'], 'CommunityName' => $communityRequests['CommunityName'], 'CommunityDescription' => $communityRequests['CommunityDescription'], 'CommunityPicture' => $communityRequests['CommunityPicture']);
  }

  foreach ($communityRequestsArray as $request) {
    $user = $request['UserID'];
    $sqlUser = "SELECT `FirstName`, `LastName`, `ProfilePicture` FROM `UserData_t` WHERE `UserID` = $user";
    $resultUser = mysqli_query($con, $sqlUser);
    while ($communityData = mysqli_fetch_assoc($resultUser)) {
      $communityDataArray[] = array('UserID' => $request['UserID'], 'FirstName' => $communityData['FirstName'], 'LastName' => $communityData['LastName'], 'ProfilePicture' => $communityData['ProfilePicture'], 'CommunityRequestID' => $request['CommunityRequestID'], 'CommunityName' => $request['CommunityName'], 'CommunityDescription' => $request['CommunityDescription'], 'CommunityPicture' => $request['CommunityPicture']);
    }
  }

  mysqli_close($con);
  ?>

  <!-- Photo Section -->
  <section class="moderator__photo-section pt-5 pb-3" style="background-image: url('img/<?php echo $profilePictureBackground; ?>'); background-attachment: fixed; background-size: cover;">
    <div class="container-fluid flex-column">
      <img class="moderator__profile-photo mb-3" style="border-color: <?php echo $profilePictureBorder; ?>;" src="upload/<?php echo $profilePicture; ?>" alt="<?php echo $firstName . ' ' . $lastName; ?> Profile Photo">
      <div class="moderator__tag mb-2">
        <p class="py-1 px-3 m-0">Moderator</p>
      </div>
      <h1 class="moderator__profile-name">Welcome back, <?php echo $firstName; ?>!</h1>
      <div class="container pb-4">
        <div class="row">
          <div class="col container-fluid justify-content-end me-5 mt-4">
            <div class="row row-cols-auto moderator__profile-section pt-2">
              <div class="col d-flex moderator__profile-icon align-items-center">
                <i class="fa-solid fa-hand-holding-hand"></i>
              </div>
              <div class="col moderator__profile-wrap">
                <h3>Pending<br>Mentor<br>Requests</h3>
              </div>
              <div class="col">
                <p class="moderator__requests-counter pe-3" style="color: 
                <?php
                if (sizeof($mentorRequestsArray) < 5) {
                  echo 'green';
                } elseif (sizeof($mentorRequestsArray) < 10) {
                  echo 'orange';
                } else {
                  echo 'red';
                }
                ?>;"><?php echo sizeof($mentorRequestsArray); ?></p>
              </div>
            </div>
          </div>
          <div class="col container-fluid justify-content-start ms-5 mt-4">
            <div class="row row-cols-auto moderator__profile-section pt-2">
              <div class="col d-flex moderator__profile-icon align-items-center">
                <i class="fa-solid fa-comments"></i>
              </div>
              <div class="col moderator__profile-wrap">
                <h3>Pending<br>Community<br>Requests</h3>
              </div>
              <div class="col">
                <p class="moderator__requests-counter pe-3" style="color: 
                <?php
                if (sizeof($communityRequestsArray) < 5) {
                  echo 'green';
                } elseif (sizeof($communityRequestsArray) < 10) {
                  echo 'orange';
                } else {
                  echo 'red';
                }
                ?>;"><?php echo sizeof($communityRequestsArray); ?></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Content Section -->
  <section class="content-section pt-4">
    <div class="container-fluid w-50 pb-4 flex-column">

      <?php
      if ($mentorRequestsArray != null) {
        echo '<div class="d-flex align-items-start w-100">';
        echo '<h4>Mentor Requests</h4>';
        echo '</div>';
        echo '<div class="accordion w-100 row" id="mentor-requests">';
        for ($i = 0; $i < sizeof($userDataArray); $i++) {
          echo '<div class="accordion-item">';
          echo '<div class="accordion-header">';
          echo '<button class="accordion-button collapsed py-2" type="button" data-bs-toggle="collapse" data-bs-target="#mentor_collapse' . $i . '" aria-expanded="false" aria-controls="mentor_collapse' . $i . '">';
          echo '<div class="d-flex align-items-center">';
          echo '<div class="d-flex align-items-center justify-content-center moderator__mentor-request-photo">';
          echo '<img class="pe-4" src="/upload/' . $userDataArray[$i]['ProfilePicture'] . '" alt="' . $userDataArray[$i]['FirstName'] . ' ' . $userDataArray[$i]['LastName'] . 'Profile Photo">';
          echo '</div>';
          echo '<h4 class="moderator__request-header ps-4 mb-0">' . $userDataArray[$i]['FirstName'] . ' ' . $userDataArray[$i]['LastName'] . '</h4>';
          echo '</div>';
          echo '</button>';
          echo '</div>';
          echo '<div id="mentor_collapse' . $i . '" class="accordion-collapse collapse" data-bs-parent="#mentor-requests">';
          echo '<div class="accordion-body">';
          echo '<div class="container-fluid d-flex justify-content-start px-0 pb-3">';
          echo '<a href="profile.php?profileID=' . $userDataArray[$i]['UserID'] . '"><img class="moderator__icons" src="img/GElogo_blue.png" alt="' . $userDataArray[$i]['FirstName'] . ' ' . $userDataArray[$i]['LastName'] . ' Profile"></a>';
          if ($userDataArray[$i]['LinkedIn'] != null) {
            echo '<a href="https://www.linkedin.com/in/' . $userDataArray[$i]['LinkedIn'] . '"><i class="fa-brands fa-linkedin moderator__icons"></i></a>';
          }
          if ($userDataArray[$i]['ResumeLocation'] != null) {
            echo '<a href="upload/' . $userDataArray[$i]['ResumeLocation'] . '"><i class="fa-solid fa-file-pdf moderator__icons"></i></a>';
          }
          echo '</div>';
          echo $userDataArray[$i]['MentorStatement'];
          echo '<div class="container-fluid pt-3">';
          echo '<form action="moderator-action.php" method="POST">';
          echo '<button type="submit" name="mentor" value="approve-' . $userDataArray[$i]['UserID'] . '" class="btn btn-success mx-4">Approve</button>';
          echo '<button type="submit" name="mentor" value="deny-' . $userDataArray[$i]['UserID'] . '" class="btn btn-danger mx-4">Deny</button>';
          echo '</form>';
          echo '</div></div></div></div>';
        }
        echo '</div>';
      }

      if ($communityRequestsArray != null) {
        echo '<div class="d-flex align-items-start w-100 pt-3">';
        echo '<h4>Community Requests</h4>';
        echo '</div>';
        echo '<div class="accordion w-100 row" id="community-requests">';
        for ($x = 0; $x < sizeof($communityDataArray); $x++) {
          echo '<div class="accordion-item">';
          echo '<div class="accordion-header">';
          echo '<button class="accordion-button collapsed py-2" type="button" data-bs-toggle="collapse" data-bs-target="#community_collapse' . $x . '" aria-expanded="false" aria-controls="community_collapse' . $x . '">';
          echo '<div class="d-flex align-items-center">';
          echo '<div class="d-flex align-items-center justify-content-center moderator__mentor-request-photo">';
          echo '<img class="pe-4" src="/upload/' . $communityDataArray[$x]['CommunityPicture'] . '" alt="' . $communityDataArray[$x]['CommunityName'] . ' Profile Photo">';
          echo '</div>';
          echo '<h4 class="moderator__request-header ps-4 mb-0">' . $communityDataArray[$x]['CommunityName'] . '</h4>';
          echo '</div>';
          echo '</button>';
          echo '</div>';
          echo '<div id="community_collapse' . $x . '" class="accordion-collapse collapse" data-bs-parent="#community-requests">';
          echo '<div class="accordion-body">';
          echo '<h5 class="pt-2">Requested by:</h5>';
          echo '<div class="container-fluid d-flex justify-content-start px-0 pb-3 pt-2 moderator__community-request-profile">';
          echo '<a href="profile.php?profileID=' . $communityDataArray[$x]['UserID'] . '"><img class="pe-4" src="upload/' . $communityDataArray[$x]['ProfilePicture'] . '" alt="' . $communityDataArray[$x]['FirstName'] . ' ' . $communityDataArray[$x]['LastName'] . ' Profile Picture"></a>';
          echo '<h6>' . $communityDataArray[$x]['FirstName'] . ' ' . $communityDataArray[$x]['LastName'] . '</h6>';
          echo '</div>';
          echo '<h5 class="pt-2">Description of Community:</h5>';
          echo $communityDataArray[$x]['CommunityDescription'];
          echo '<div class="container-fluid pt-3">';
          echo '<form action="moderator-action.php" method="POST">';
          echo '<button type="submit" name="community" value="approve-' . $communityDataArray[$x]['UserID'] . '-' . $communityDataArray[$x]['CommunityRequestID'] . '" class="btn btn-success mx-4">Approve</button>';
          echo '<button type="submit" name="community" value="deny-' . $communityDataArray[$x]['UserID'] . '-' . $communityDataArray[$x]['CommunityRequestID'] . '" class="btn btn-danger mx-4">Deny</button>';
          echo '</form>';
          echo '</div></div></div></div>';
        }
        echo '</div>';
      }
      ?>

    </div>
  </section>

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

</html>