<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Guidance Exchange | Messages</title>
  <link rel="icon" type="image/png" sizes="192x192" href="favicon-192.png">
  <link rel="icon" type="image/png" sizes="180x180" href="favicon-180.png">
  <link rel="icon" type="image/png" sizes="128x128" href="favicon-128.png">
  <link rel="icon" type="image/png" sizes="32x32" href="favicon-32.png">
  <link href="assets/fontawesome/css/fontawesome.css" rel="stylesheet">
  <link href="assets/fontawesome/css/brands.css" rel="stylesheet">
  <link href="assets/fontawesome/css/solid.css" rel="stylesheet">
  <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="css/messages.css" />
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
  <?php
  // Get the all messages where user is recipient or sender
  $sqlMessages = "SELECT R.`RecipientID`, M.`SenderID` FROM `Message_Recipient_t` R JOIN `Messages_t` M ON R.`MessageID` = M.`MessageID` WHERE `RecipientID` = $userID OR `SenderID` = $userID ORDER BY M.`SendDate`";
  $resultMessages = mysqli_query($con, $sqlMessages);

  if (mysqli_num_rows($resultMessages) > 0) {
    $messagesArray = array();
    while ($messages = mysqli_fetch_assoc($resultMessages)) {
      $messagesArray[] = array('RecipientID' => $messages['RecipientID'], 'SenderID' => $messages['SenderID']);
    }

    $uniqueUsers = array();
    foreach ($messagesArray as $message) {
      $senderID = $message['SenderID'];
      $recipientID = $message['RecipientID'];
      if ($senderID != $userID && !in_array($senderID, $uniqueUsers)) {
        $uniqueUsers[] = $senderID;
      }
      if ($recipientID != $userID && !in_array($recipientID, $uniqueUsers)) {
        $uniqueUsers[] = $recipientID;
      }
    }

    $senderData = array();
    foreach ($uniqueUsers as $user) {
      $sqlSender = "SELECT `UserID`, `FirstName`, `LastName`, `ProfilePicture` FROM `UserData_t` WHERE `UserID` = $user";
      $resultSender = mysqli_query($con, $sqlSender);
      while ($row = mysqli_fetch_assoc($resultSender)) {
        $senderData[] = array('SenderID' => $row['UserID'], 'FirstName' => $row['FirstName'], 'LastName' => $row['LastName'], 'ProfilePicture' => $row['ProfilePicture']);
      }
    }

    $senderDataColumns = array_column($senderData, 'LastName');
    array_multisort($senderDataColumns, SORT_ASC, $senderData);
  } else {
    $messagesArray = null;
    $senderData = null;
  }
  ?>

  <!-- Header Section -->
  <section class="messages__header-section pt-5 pb-3">
    <div class="container-fluid flex-column">
      <h1 class="messages__header">Messages</h1>
    </div>
  </section>

  <!-- Content Section -->
  <section class="content m-4">
    <div class="container p-0">

      <div class="card">
        <div class="row g-0 messages__header-section">
          <div class="col-12 col-lg-5 col-xl-3 border-bottom-heading">
            <div class="px-4 d-none d-md-block">
              <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                  <!-- <h1 class="messages__header">Inbox</h1> -->
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-lg-7 col-xl-9">
            <div class="py-2 px-4 border-bottom-heading d-none d-lg-block">
              <div class="d-flex align-items-center py-1 justify-content-end">
                <button class="btn main-button me-3 btn-long" data-bs-toggle="modal" data-bs-target="#newMessageModal">New Message</button>
              </div>
            </div>
          </div>
        </div>

        <div class="row g-0">
          <div class="col-12 col-lg-5 col-xl-3 border-right">

            <!-- <div class="px-4 d-none d-md-block">
              <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                  <input type="text" class="form-control my-3" placeholder="Search...">
                </div>
              </div>
            </div> -->


            <div class="list-group">
              <?php
              if ($messagesArray != null) {
                $firstSender = true;
                foreach ($senderData as $sender) {
                  $senderID = $sender['SenderID'];
                  $senderFirstName = $sender['FirstName'];
                  $senderLastName = $sender['LastName'];
                  $senderProfilePicture = $sender['ProfilePicture'];
                  if ($senderID != $userID) {
                    if ($firstSender) {
                      echo '<button type="button" id="firstUser" class="list-group-item list-group-item-action border-0 active" aria-current="true">';
                      echo '<div class=" d-flex align-items-start">';
                      echo '<img src="upload/' . $senderProfilePicture . '" class="rounded-circle me-1" alt="' . $senderFirstName . ' ' . $senderLastName . '" width="40" height="40">';
                      echo '<div class="userID" style="display: none;">';
                      echo $senderID;
                      echo '</div>';
                      echo '<div class="flex-grow-1 ms-3">';
                      echo $senderFirstName . ' ' . $senderLastName;
                      echo '</div></div></button>';
                      $firstSender = false;
                      $firstUser = $senderID;
                    } else {
                      echo '<button type="button" class="list-group-item list-group-item-action border-0">';
                      echo '<div class=" d-flex align-items-start">';
                      echo '<img src="upload/' . $senderProfilePicture . '" class="rounded-circle me-1" alt="' . $senderFirstName . ' ' . $senderLastName . '" width="40" height="40">';
                      echo '<div class="userID" style="display: none;">';
                      echo $senderID;
                      echo '</div>';
                      echo '<div class="flex-grow-1 ms-3">';
                      echo $senderFirstName . ' ' . $senderLastName;
                      echo '</div></div></button>';
                    }
                  }
                }
              }
              ?>
            </div>

          </div>
          <div class="col-12 col-lg-7 col-xl-9">
            <div class="py-2 px-4 border-bottom d-none d-lg-block">
              <div class="d-flex align-items-center py-1 message-title">

                <?php
                if ($senderData != null) {
                  foreach ($senderData as $sender) {
                    if ($sender['SenderID'] == $firstUser) {
                      echo '<div class="position-relative">';
                      echo '<img src="upload/' . $sender['ProfilePicture'] . '" class="rounded-circle me-1" alt="' . $sender['FirstName'] . ' ' . $sender['LastName'] . '" width="40" height="40">';
                      echo '</div>';
                      echo '<div class="flex-grow-1 ps-3">';
                      echo '<strong>' . $sender['FirstName'] . ' ' . $sender['LastName'] . '</strong>';
                      echo '</div>';
                    }
                  }
                }
                ?>

              </div>

              <!-- New Message Modal -->
              <div class="modal fade" id="newMessageModal" tabindex="-1" aria-labelledby="newMessageModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header modal-header-gradient">
                      <h1 class="modal-title fs-5" id="newMessageModalLabel">New Message</h1>
                      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form action="new-message.php" method="POST">
                        <div class="mb-3">
                          <label for="recipientName" class="col-form-label">Recipient:</label>
                          <div class="dropdown" id="newMessage">
                            <input type="text" class="form-control" id="recipientName" placeholder="Search for a person" autocomplete="off">
                            <ul class="dropdown-menu" id="messageSearchResults"></ul>
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
              </div>
              <!-- End New Message Modal -->

            </div>

            <div class="position-relative">
              <div class="messages p-4">
              </div>
            </div>

            <div class="flex-grow-0 py-3 px-4 border-top">
              <form id="message-form">
                <div class="input-group">
                  <input type="hidden" name="recipientID" id="recipientID" value="<?php echo $firstUser; ?>">
                  <input type="text" class="form-control" placeholder="Type your message" name="message" autocomplete="off">
                  <button class="btn main-button btn-std">Send</button>
                </div>
              </form>
            </div>

          </div>
        </div>
      </div>
    </div>
  </section>

  <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/jquery/jquery-3.7.0.min.js"></script>
  <script src="https://kit.fontawesome.com/c5863419fe.js" crossorigin="anonymous"></script>
  <script src="js/messages.js"></script>
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