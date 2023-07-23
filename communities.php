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
  <!-- Add these inside the <head> tag -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/jquery/jquery-3.7.0.min.js"></script>
  <script src="https://kit.fontawesome.com/c5863419fe.js" crossorigin="anonymous"></script>
  
  <link rel="stylesheet" href="css/main.css" />
  <link rel="stylesheet" href="css/updated_community.css" />
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

<body>
  <!-- Content Section -->

<div class="communitiespics" style="background-image: url('img/biotech-pattern.png');">
  <div class="communitypics-grid">
    <a href=""><img src="img/IT_pic.jpeg" alt="IT picture" class="communitypic"></a>
    <a href=""><img src="img/stocks_pic.jpeg" alt="stock picture" class="communitypic"></a>
    <a href=""><img src="img/marketing_pics.jpeg" alt="marketing picture" class="communitypic"></a>
    <a href=""><img src="img/coins_pic.jpeg" alt="coins picture" class="communitypic"></a>
    <a href=""><img src="img/personaldevelop_pic.jpeg" alt="development picture" class="communitypic"></a>
    <a href=""><img src="img/gambling_pic.jpeg" alt="gambling picture" class="communitypic"></a>
  </div>
  <a class="btn btn-primary btn-hero-section mx-5 rounded-pill bottom-right" href="new_community.php<?php echo isset($_GET['profileID']) ? '?profileID=' . $_GET['profileID'] : ''; ?>">Request Community</a>   
</div>

 
<?php

// Connect to your database and perform necessary queries to retrieve the active communities

// Example code for fetching community data from the database
// Replace it with your actual database connection and query
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "guidance_exhange";
$port = 3306; 

// Create a connection
include('includes/connect.inc.php');
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve active communities from the database
$sql = "SELECT community_id, community_name FROM community_data WHERE active_flg = 1";
$result = $conn->query($sql);

// Store the community data in an array
$communities = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $communities[] = $row;
    }
}

// Close the database connection
$conn->close();

?>

<style>
  .card-title a {
    color: black;
    text-decoration: none;
  }
</style>


<div class="container mt-4">
    
  <?php foreach ($communities as $community) { ?>
    <div class="card mb-4">
      <div class="card-body d-flex align-items-center">
        <img src="img/logo_gradient.png" alt="Guidance Exchange Logo" height="70" class="me-3">
        <h3 class="card-title mb-0"><a href="community_info.php?community_id=<?php echo $community['community_id']; ?>"><?php echo $community['community_name']; ?></a></h3>

        
      </div>
    </div>
  <?php } ?>
</div>






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
</body>
</html>
