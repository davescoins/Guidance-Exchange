<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Guidance Exchange | New Discussion</title>
  <link rel="icon" type="image/png" sizes="192x192" href="favicon-192.png">
  <link rel="icon" type="image/png" sizes="180x180" href="favicon-180.png">
  <link rel="icon" type="image/png" sizes="128x128" href="favicon-128.png">
  <link rel="icon" type="image/png" sizes="32x32" href="favicon-32.png">
  <link href="assets/fontawesome/css/fontawesome.css" rel="stylesheet">
  <link href="assets/fontawesome/css/brands.css" rel="stylesheet">
  <link href="assets/fontawesome/css/solid.css" rel="stylesheet">
  <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="css/main.css" />
  <link rel="stylesheet" href="css/home_signup.css" />
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

<section>
  <div class="hero home-hero bg-hero-form-section">
    <div id="home-hero-text form-hero-text" class="text-center">
      <h1 class="text-white">Start a Discussion!</h1>
      <p class="text-light container-sm  mb-3 mt-5">Not finding a forum or a active topic on something you want to discuss, start your own discussion by filling out the form below!</p>
      <br>
    </div>
  </div>
</section>

<body>
  <section class="content">

    <div class="d-flex justify-content-center">
      <form id="createCommunityForm" method="POST" action="create_discussion.php" role="form" data-toggle="validator" class="w-75 mt-3">
        <input type="hidden" name="community_id" value="<?php echo $_GET['community_id']; ?>">
        <div class="row py-2">
          <div class="col">
            <label for="title" class="form-label">Discussion Title</label>
            <input type="text" class="form-control" id="postTitle" name="postTitle" placeholder="Enter Discussion Title" required>
          </div>
        </div>

        <div class="row py-2">
          <div class="col">
            <label for="postContent" class="form-label">What are we discussing?</label>
            <textarea class="form-control" id="postContent" name="postContent" rows="3" placeholder="Enter Discussion Description" required></textarea>
          </div>
        </div>

        <div class="row py-2">
          <div class="col">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="activeFlg" id="activeYes" value="1" checked>
              <label class="form-check-label" for="activeYes">Active</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="activeFlg" id="activeNo" value="0">
              <label class="form-check-label" for="activeNo">Inactive</label>
            </div>
          </div>
        </div>

        <div class="row my-5">
          <div class="col text-center">
            <button type="submit" class="btn main-button">Submit</button>
          </div>
        </div>
      </form>
    </div>
  </section>
</body>

<script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/jquery/jquery-3.7.0.min.js"></script>
<script src="https://kit.fontawesome.com/c5863419fe.js" crossorigin="anonymous"></script>
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