<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Guidance Exchange | Search Results</title>
  <link rel="icon" type="image/png" sizes="192x192" href="favicon-192.png">
  <link rel="icon" type="image/png" sizes="180x180" href="favicon-180.png">
  <link rel="icon" type="image/png" sizes="128x128" href="favicon-128.png">
  <link rel="icon" type="image/png" sizes="32x32" href="favicon-32.png">
  <link href="assets/fontawesome/css/fontawesome.css" rel="stylesheet">
  <link href="assets/fontawesome/css/brands.css" rel="stylesheet">
  <link href="assets/fontawesome/css/solid.css" rel="stylesheet">
  <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="css/search.css" />
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
  <!-- Header Section -->
  <section class="search__header-section pt-5 pb-3">
    <div class="container-fluid flex-column">
      <h1 class="search__header">Search Results</h1>
    </div>
  </section>

  <!-- Content Section -->
  <section class="content-section pt-4">

    <!-- User Search Results -->
    <?php
    // Check for query
    if (isset($_GET['query'])) {
      $query = $_GET['query'];
      if (isset($_GET['mentorSearch'])) {
        $mentorSearch = $_GET['mentorSearch'];
      } else {
        $mentorSearch = false;
      }

      // Select the users that match the query string
      if (!$userSystemAdministratorStatus) {
        if ($mentorSearch) {
          $userSql = "SELECT U.`UserID`, U.`FirstName`, U.`LastName`, U.`ProfilePicture`, A.`MentorStatus`, A.`ModeratorStatus`, A.`SystemAdministratorStatus`
          FROM `UserData_t` U
          JOIN `Auth_t` A ON U.`UserID` = A.`UserID`
          WHERE U.`FullName` LIKE '%$query%'
          AND A.`SystemAdministratorStatus` <> '1'  AND U.`UserID` <> $userID AND A.`MentorStatus` = 1
          ORDER BY U.`LastName`";
        } else {
          $userSql = "SELECT U.`UserID`, U.`FirstName`, U.`LastName`, U.`ProfilePicture`, A.`MentorStatus`, A.`ModeratorStatus`, A.`SystemAdministratorStatus`
          FROM `UserData_t` U
          JOIN `Auth_t` A ON U.`UserID` = A.`UserID`
          WHERE U.`FullName` LIKE '%$query%'
          AND A.`SystemAdministratorStatus` <> '1'  AND U.`UserID` <> $userID
          ORDER BY U.`LastName`";
        }
      } else {
        if ($mentorSearch) {
          $userSql = "SELECT U.`UserID`, U.`FirstName`, U.`LastName`, U.`ProfilePicture`, A.`MentorStatus`, A.`ModeratorStatus`, A.`SystemAdministratorStatus`
          FROM `UserData_t` U
          JOIN `auth_t` A ON U.`UserID` = A.`UserID`
          WHERE U.`FullName` LIKE '%$query%' AND A.`MentorStatus` = 1
          ORDER BY U.`LastName`";
        } else {
          $userSql = "SELECT U.`UserID`, U.`FirstName`, U.`LastName`, U.`ProfilePicture`, A.`MentorStatus`, A.`ModeratorStatus`, A.`SystemAdministratorStatus`
          FROM `UserData_t` U
          JOIN `auth_t` A ON U.`UserID` = A.`UserID`
          WHERE U.`FullName` LIKE '%$query%'
          ORDER BY U.`LastName`";
        }
      }
      $userQueryResult = mysqli_query($con, $userSql);

      echo '<div class="d-flex justify-content-center">';
      echo '<h1 class="w-50 search__section-heading p-1 mb-3">User Results</h1>';
      echo '</div>';

      // Display search results
      if (mysqli_num_rows($userQueryResult) > 0) {
        while ($foundUser = mysqli_fetch_assoc($userQueryResult)) {
          if ($userID != $foundUser['UserID']) {
            echo '<div class="container-fluid pb-4">';
            echo '<div class="row align-items-start results-section py-2">';
            echo '<div class="col-auto d-flex align-items-center justify-content-center result-picture">';

            if ($foundUser['ProfilePicture'] == null) {
              echo '<img class="px-2" src="/img/blank-profile-image.png" alt="' . $foundUser['FirstName'] . ' ' . $foundUser['LastName'] . ' Profile Photo">';
            } else {
              echo '<img class="px-2" src="upload/' . $foundUser['ProfilePicture'] . '" alt="' . $foundUser['FirstName'] . ' ' . $foundUser['LastName'] . ' Profile Photo">';
            }

            echo '</div>';
            echo '<div class="col d-flex align-items-center result-wrap">';
            echo '<h3>' . $foundUser['FirstName'] . ' ' . $foundUser['LastName'] . '</h3>';
            echo '</div>';

            echo '<div class="col-3 d-flex align-items-center mentor-tag-wrap">';
            if ($foundUser['MentorStatus'] == true) {
              echo '<div class="mentor-tag">';
              echo '<p class="py-1 px-3 m-0">Mentor</p>';
              echo '</div>';
            }
            if ($foundUser['ModeratorStatus'] == true) {
              echo '<div class="mentor-tag">';
              echo '<p class="py-1 px-3 m-0">Moderator</p>';
              echo '</div>';
            }
            if ($foundUser['SystemAdministratorStatus'] == true) {
              echo '<div class="mentor-tag">';
              echo '<p class="py-1 px-3 m-0">System Administrator</p>';
              echo '</div>';
            }
            echo '</div>';

            echo '<div class="col-auto d-flex align-items-center justify-content-center result-icons me-3">';


            echo '<a href="profile.php?profileID=' . $foundUser['UserID'] . '"><i class="fa-solid fa-user fa-xl px-4"></i></a>';
            echo '<a href="#" data-bs-toggle="modal" data-bs-target="#newMessageModal' . $foundUser['UserID'] . '"><i class="fa-solid fa-envelope fa-xl px-4"></i></a>';
            if (in_array($foundUser['UserID'], $associationsArray)) {
              echo '<form action="associations.php" method="POST">';
              echo '<input type="hidden" name="query" value="' . $query . '">';
              echo '<input type="hidden" name="association" value="' . $foundUser['UserID'] . '">';
              echo '<button class="btn p-0" type="submit" name="update" value="remove"><i class="fa-solid fa-minus fa-xl px-4"></i></button>';
              echo '</form>';
            } else {
              echo '<form action="associations.php" method="POST">';
              echo '<input type="hidden" name="query" value="' . $query . '">';
              echo '<input type="hidden" name="association" value="' . $foundUser['UserID'] . '">';
              echo '<button class="btn p-0" type="submit" name="update" value="add"><i class="fa-solid fa-plus fa-xl px-4"></i></button>';
              echo '</form>';
            }
          }

          echo '</div></div></div>';

          // Start New Message Modal
          echo '<div class="modal fade" id="newMessageModal' . $foundUser['UserID'] . '" tabindex="-1" aria-labelledby="newMessageModalLabel' . $foundUser['UserID'] . '" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header modal-header-gradient">
                    <h1 class="modal-title fs-5" id="newMessageModalLabel' . $foundUser['UserID'] . '">New Message</h1>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form action="new-message.php" method="POST">
                      <div class="mb-3">
                        <label for="recipientName" class="col-form-label">Recipient:</label>
                        <div class="dropdown" id="newMessage">
                          <input type="text" class="form-control" id="recipientName" placeholder="Search for a person" autocomplete="off" value="' . $foundUser['FirstName'] . ' ' . $foundUser['LastName'] . '" disabled>
                          <ul class="dropdown-menu" id="messageSearchResults"></ul>
                          <input type="hidden" name="recipientID" value="' . $foundUser['UserID'] . '">
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
        }
      } else {
        echo '<div class="container-fluid pb-4 d-flex align-items-center">';
        echo '<h3>No users found.</h3>';
        echo '</div>';
      }

      mysqli_close($con);
    }
    ?>
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