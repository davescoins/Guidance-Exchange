<!DOCTYPE html>
<html lang="en">

<!-- PHP Start session -->
<?php
session_start();
?>


<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Guidnace Exchange | Home</title>
  <link rel="icon" type="image/png" sizes="192x192" href="favicon-192.png">
  <link rel="icon" type="image/png" sizes="180x180" href="favicon-180.png">
  <link rel="icon" type="image/png" sizes="128x128" href="favicon-128.png">
  <link rel="icon" type="image/png" sizes="32x32" href="favicon-32.png">
  <link href="assets\fontawesome\css\fontawesome.css" rel="stylesheet">
  <link href="assets\fontawesome\css\brands.css" rel="stylesheet">
  <link href="assets\fontawesome\css\solid.css" rel="stylesheet">
  <link href="assets\bootstrap\css\bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="css/main.css" />
  <link rel="stylesheet" href="css/home_signup.css" />
</head>

<!-- Header 1 - Search bar
Header 2 - LOgged out

If the user is not logged in
- Hide header 1

IF the user is logged in
- Hide header 2
-->


<header <?php
        if (!isset($_SESSION['UserID'])) {
          echo 'class="d-none"';
        };

        ?>>
  <?php

  $profileID = $_SESSION['UserID'];
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
            echo ' <a class="nav-link highlight-link nav-text px-4" href="moderator-dashboard.php?profileID=' . $profileID . '">Moderator Dashboard</a>';
            echo '</li>';
          }
          if ($userSystemAdministratorStatus == true) {
            echo '<li class="nav-item">';
            echo ' <a class="nav-link highlight-link nav-text px-4" href="admin-dashboard.php?profileID=' . $profileID . '">Administrator Dashboard</a>';
            echo '</li>';
          }
          ?>
          <li class="nav-item">
            <?php
            echo '<a class="nav-link highlight-link nav-text px-4 active" href="profile.php?profileID=' . $profileID . '">Profile</a>';



            ?>
          </li>
          <li class="nav-item">
            <a class="nav-link highlight-link nav-text px-4" href="#">Communities</a>
          </li>
        </ul>
        <ul class="navbar-nav d-flex flex-row me-1">
          <li class="nav-item me-3 me-lg-0 px-2 d-flex align-items-center">
            <form class="d-flex" role="search" action="search.php" method="GET">
              <input class="form-control me-2" name="query" type="search" placeholder="Search" aria-label="Search" autocomplete="off">
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

<header <?php
        if (isset($_SESSION['UserID'])) {
          echo 'class="d-none"';
        };

        ?>>
  <nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="home.php"><img src="img/logo_gradient.png" alt="Guidance Exchange Logo" height="70" /></a>
      <a type="button" href="login.php" class="btn main-button">
        Login
      </a>

    </div>
  </nav>
</header>


<body>

  <!-- Content Section -->

  <section>
    <div class="hero home-hero">
      <video playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop" loading="lazy">
        <source src="img/Hero_Mentor.mp4" type="video/mp4" />
      </video>
      <div id="home-hero-text" class="text-center">
        <h1 class="text-white">Guidance Exchange</h1>
        <p class="text-light container-sm  mb-5 mt-5">Welcome to our mentoring platform, where meaningful connections between mentors and mentees are formed across the globe. We invite you to join our vibrant community and embark on a journey of personal and professional growth.</p>
        <?php
        if (!isset($_SESSION['UserID'])) {
          echo ' <a class="btn main-button btn-long" href="signup.php" role="button">Join GE Today!</a>';
        }


        ?>



      </div>

    </div>
  </section>


  <section>
    <div class="container">
      <div class="row bg-white my-4">
        <div class="col-12 col-lg-3 d-flex align-items-center justify-content-center">
          <img class="img-thumbnail rounded-circle img-row" src="img/home_objectives.PNG" alt="objectives">
        </div>
        <div class="col">
          <h3 class="color-home-header my-5">Core Objectives</h3>
          <p>
            The objective of Guidance Exchange is to provide a web-based mentorship platform that connects mentors and mentees from diverse backgrounds and industries. The platform aims to facilitate personal and professional development by offering valuable insights, guidance, and real-world knowledge to mentees. Additionally, the platform strives to create a community-driven environment that fosters networking, deeper relationships, and empowerment among its users.
          </p>

        </div>
      </div>
      <div class="row bg-white my-4">
        <div class="col">
          <h3 class="color-home-header my-5">Mission</h3>
          <p>
            Our mission at Guidance Exchange is to connect individuals worldwide with mentors who can provide valuable guidance, support, and insights to foster personal and professional growth. We strive to create a community-driven platform that empowers users to enhance their skills, expand their networks, and make meaningful connections across various industries and interests.

          </p>
        </div>
        <div class="col-12 col-lg-3 d-flex align-items-center justify-content-center">
          <img class="img-thumbnail rounded-circle img-row" src="img/home_mission.PNG" alt="objectives">
        </div>
      </div>
      <div class="row bg-white my-5">
        <div class="col-12 col-lg-3 d-flex align-items-center justify-content-center">
          <img class="img-thumbnail rounded-circle img-row" src="img/home_vision.png" alt="objectives">
        </div>
        <div class="col">
          <h3 class="color-home-header my-5">Vision</h3>
          <p>
            Our vision is to become the leading web-based mentorship social media site, enabling individuals to unlock their full potential and achieve their goals through mentorship. We aim to revolutionize the way mentorship is accessed by providing a user-friendly platform that facilitates diverse mentor-mentee connections, fosters community engagement, and promotes lifelong learning. By leveraging technology and collaboration, we envision Guidance Exchange as the go-to platform for mentorship, empowering individuals to thrive in their personal and professional lives.




          </p>
        </div>

      </div>
      <div class="row bg-white my-4">
        <div class="col-12 text-center my-5">
          <h3 class="color-home-header">Meet The Team</h3>
        </div>
        <div class="col text-center">
          <img class="rounded-circle img-team" src="img/adamjawarishpic.jpg" alt="profile">
          <h6>Adam Jawarish</h6>
          <p> Database Developer</p>
        </div>
        <div class="col text-center">
          <img class="rounded-circle img-team" src="img/berineyanpic.jpg" alt="profile">
          <h6>Bernie Yanos</h6>
          <p>Software Developer</p>
        </div>
        <div class="col text-center">
          <img class="rounded-circle img-team" src="img/Beza.jpg" alt="profile">
          <h6>Bezawit Teferi</h6>
          <p> Software Developer</p>
        </div>
        <div class="col text-center">
          <img class="rounded-circle img-team" src="img/David.jpg" alt="profile">
          <h6>David Miller</h6>
          <p>Project Manager</p>
        </div>
        <div class="col text-center">
          <img class="rounded-circle img-team" src="img/Juliet.jpg" alt="profile">
          <h6>Juliet Walizai</h6>
          <p>Project Manager</p>
        </div>
      </div>

    </div>
  </section>

  <script src="assets\bootstrap\js\bootstrap.bundle.min.js"></script>
  <script src="assets\jquery\jquery-3.7.0.min.js"></script>
  <script src="https://kit.fontawesome.com/c5863419fe.js" crossorigin="anonymous"></script>
  <script src="js/thankyou.js"></script>


</body>
<footer>
  <nav class=" navbar">
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