<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Guidance Exchange | Administrator Dashboard</title>
  <link rel="icon" type="image/png" sizes="192x192" href="favicon-192.png">
  <link rel="icon" type="image/png" sizes="180x180" href="favicon-180.png">
  <link rel="icon" type="image/png" sizes="128x128" href="favicon-128.png">
  <link rel="icon" type="image/png" sizes="32x32" href="favicon-32.png">
  <link href="assets/fontawesome/css/fontawesome.css" rel="stylesheet">
  <link href="assets/fontawesome/css/brands.css" rel="stylesheet">
  <link href="assets/fontawesome/css/solid.css" rel="stylesheet">
  <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="css/administrator.css" />
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
            echo '<a class="nav-link highlight-link nav-text px-4" href="moderator-dashboard.php?profileID=' . $userID . '">Moderator Dashboard</a>';
            echo '</li>';
          }
          if ($userSystemAdministratorStatus == true) {
            echo '<li class="nav-item">';
            echo '<a class="nav-link highlight-link nav-text px-4 active" href="admin-dashboard.php?profileID=' . $userID . '">Administrator Dashboard</a>';
            echo '</li>';
          }
          ?>
          <li class="nav-item">
            <a class="nav-link highlight-link nav-text px-4" href="profile.php?profileID=<?php echo $userID ?>">Profile</a>
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

  // Fetch moderator entries from the UserData table and assign them to variables that can be used later
  $sqlModerator = "SELECT U.`UserID`, U.`FirstName`, U.`LastName`, U.`ProfilePicture` FROM `UserData_t` U JOIN `Auth_t` A ON U.`UserID` = A.`UserID` WHERE A.`ModeratorStatus` = 1 ORDER BY U.`LastName`";
  $resultModerator = mysqli_query($con, $sqlModerator);

  if (mysqli_num_rows($resultModerator) > 0) {
    $moderatorsArray = array();
    while ($moderator = mysqli_fetch_assoc($resultModerator)) {
      $moderatorsArray[] = array('UserID' => $moderator['UserID'], 'FirstName' => $moderator['FirstName'], 'LastName' => $moderator['LastName'], 'ProfilePicture' => $moderator['ProfilePicture']);
    }
  } else {
    $moderatorsArray = null;
  }

  mysqli_close($con);
  ?>

  <!-- Photo Section -->
  <section class="administrator__photo-section pt-5 pb-3" style="background-image: url('img/<?php echo $profilePictureBackground; ?>'); background-attachment: fixed; background-size: cover;">
    <div class="container-fluid flex-column">

      <?php
      if ($profilePictureBorder == null) {
        if ($profilePicture == null) {
          echo '<img class="administrator__profile-photo mb-3" style="border-color: #008a0e;" src="img/blank-profile-image.png" alt="' . $firstName . ' ' . $lastName . ' Profile Photo">';
        } else {
          echo '<img class="administrator__profile-photo mb-3" style="border-color: #008a0e;" src="upload/' . $profilePicture . '" alt="' . $firstName . ' ' . $lastName . ' Profile Photo">';
        }
      } else {
        if ($profilePicture == null) {
          echo '<img class="administrator__profile-photo mb-3" style="border-color: #008a0e;" src="img/blank-profile-image.png" alt="' . $firstName . ' ' . $lastName . ' Profile Photo">';
        } else {
          echo '<img class="administrator__profile-photo mb-3" style="border-color: ' . $profilePictureBorder . ';" src="upload/' . $profilePicture . '" alt="' . $firstName . ' ' . $lastName . ' Profile Photo">';
        }
      }
      ?>

      <div class="administrator__tag mb-2">
        <p class="py-1 px-3 m-0">System Administrator</p>
      </div>
      <h1 class="administrator__profile-name">Welcome back, <?php echo $firstName; ?>!</h1>
    </div>
  </section>

  <!-- Content Section -->
  <section class="content-section pt-4 content">
    <div class="d-flex justify-content-center">
      <h1 class="w-50 administrator__section-heading p-1 mb-3">Moderators</h1>
    </div>

    <?php
    if ($moderatorsArray != null) {
      foreach ($moderatorsArray as $moderator) {
        echo '<div class="container-fluid pb-4">';
        echo '<div class="row align-items-start moderators-section py-2">';
        echo '<div class="col-auto d-flex align-items-center justify-content-center moderator-picture">';

        if ($moderator['ProfilePicture'] == null) {
          echo '<img class="px-2" src="/img/blank-profile-image.png" alt="' . $moderator['FirstName'] . ' ' . $moderator['LastName'] . ' Profile Photo">';
        } else {
          echo '<img class="px-2" src="upload/' . $moderator['ProfilePicture'] . '" alt="' . $moderator['FirstName'] . ' ' . $moderator['LastName'] . ' Profile Photo">';
        }

        echo '</div>';
        echo '<div class="col d-flex align-items-center moderator-wrap">';
        echo '<h3 class="m-0">' . $moderator['FirstName'] . ' ' . $moderator['LastName'] . '</h3>';
        echo '</div>';

        echo '<div class="col-auto d-flex align-items-center justify-content-center moderator-icons me-3">';

        echo '<form action="modify-moderator.php" method="POST">';
        echo '<input type="hidden" name="userID" value="' . $moderator['UserID'] . '">';
        echo '<button class="btn p-0" type="submit" name="remove" value="remove"><i class="fa-solid fa-trash-can"></i></button>';
        echo '</form>';

        echo '</div></div></div>';
      }
    } else {
      echo '<div class="container-fluid pb-4 d-flex align-items-center">';
      echo '<h2 class="administrator__section-subHeading mb-3">No moderators found!</h2>';
      echo '</div>';
    }
    ?>

    </div>
  </section>

  <section class="content-section pt-4 content">
    <div class="d-flex justify-content-center">
      <h1 class="w-50 administrator__section-heading p-1 mb-3">Create Moderator Account</h1>
    </div>
    <div class="container-fluid pb-4">
      <div class="w-25 d-flex justify-content-center">
        <form action="modify-moderator.php" method="POST" class="w-100">
          <div class="mb-3">
            <label for="selection">New or Existing User?</label>
            <select class="form-select" name="selection" id="selection" aria-label="Moderator Account Creation">
              <option value="new" selected>New User</option>
              <option value="existing">Existing User</option>
            </select>
          </div>
          <div id="new" style="display: block;">
            <div class="mb-3">
              <label for="firstName" class="form-label">First Name</label>
              <input type="text" class="form-control" id="firstName" name="firstName" required>
            </div>
            <div class="mb-3">
              <label for="lastName" class="form-label">Last Name</label>
              <input type="text" class="form-control" id="lastName" name="lastName" required>
            </div>
            <div class="mb-3">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
              <label for="tel" class="form-label">Phone Number</label>
              <input type="tel" class="form-control" id="tel" name="tel" required>
            </div>
          </div>
          <div id="existing" style="display: none;">
            <div class="mb-3">
              <label for="existingUser" class="col-form-label">User Search</label>
              <div class="dropdown" id="userSearch">
                <input type="text" class="form-control" id="existingUser" placeholder="Search for a user" autocomplete="off">
                <ul class="dropdown-menu" id="userSearchResults"></ul>
              </div>
            </div>
            <button type="submit" class="btn main-button">Create</button>
        </form>
      </div>
    </div>
  </section>

  <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/jquery/jquery-3.7.0.min.js"></script>
  <script src="https://kit.fontawesome.com/c5863419fe.js" crossorigin="anonymous"></script>
  <script src="js/admin.js"></script>
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