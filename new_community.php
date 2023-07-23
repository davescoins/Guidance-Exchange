<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Create a Community</title>

    <link href="assets\fontawesome\css\fontawesome.css" rel="stylesheet">
    <link href="assets\fontawesome\css\brands.css" rel="stylesheet">
    <link href="assets\fontawesome\css\solid.css" rel="stylesheet">
    <link href="assets\bootstrap\css\bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
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
    <section>
        <div class="hero home-hero bg-hero-form-section">
            <div id="home-hero-text form-hero-text" class="text-center">
                <h1 class="text-white">Create a Community!</h1>
                <p class="text-light container-sm  mb-3 mt-5">Not finding a community that interests you? Create a community here by filling out the form below. Once the community is active, mentors and mentees will be able to start collaborating and discussing relevant community topics!</p>
                <br>
            </div>
        </div>
    </section>


        <script src="assets\bootstrap\js\bootstrap.bundle.min.js"></script>
    <script src="assets\jquery\jquery-3.7.0.min.js"></script>
    
    <script src="https://kit.fontawesome.com/c5863419fe.js" crossorigin="anonymous"></script>
    </script>




<?php
// Assuming you have a database connection, update the connection details accordingly

// Connect to the database
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "guidance_exhange";
$port = 3306; 

include('includes/connect.inc.php');


$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Debug: Check if the form is being submitted
    echo "Form submitted!<br>";

    $communityName = $_POST['communityName'];
    $communityDesc = $_POST['communityDesc'];
    $activeFlg = isset($_POST['activeFlg']) ? 1 : 0;

    // Prepare and execute the SQL query for community_data table
    $sql_community_data = "INSERT INTO community_data (community_name, community_desc, active_flg)
                           VALUES (?, ?, ?)";
    $stmt_community_data = $conn->prepare($sql_community_data);
    $stmt_community_data->bind_param("ssi", $communityName, $communityDesc, $activeFlg);

    if ($stmt_community_data->execute()) {
        // Get the auto-generated community_id from the inserted row
        $community_id = $conn->insert_id;

        // Debug: Check if the userID is being received correctly
        echo "User ID: " . $userID . "<br>";

        // Prepare and execute the SQL query for CommunityRequests_t table
        $sql_community_requests = "INSERT INTO CommunityRequests_t (UserID, CommunityName, CommunityDescription)
                                   VALUES (?, ?, ?)";
        $stmt_community_requests = $conn->prepare($sql_community_requests);
        $stmt_community_requests->bind_param("iss", $userID, $communityName, $communityDesc);

    // Execute the prepared statement
        if ($stmt_community_requests->execute()) {
            // Both INSERTs successful, redirect to all_communities_template.php
            //header("Location: communities.php");
            //exit();
        } else {
            // Error creating community request, redirect back to new_community.php with error message
            header("Location: new_community.php?error=1&message=Error creating community request");
            exit();
        }
    } else {
        // Error executing the SQL query for community_data table, redirect back to new_community.php with an error message
        header("Location: new_community.php?error=1&message=Error executing SQL query for community_data");
        exit();
    }
}
// Close the database connection
$conn->close();
?>



<Section>
  <form id="createCommunityForm" method="POST" action="new_community.php" role="form" data-toggle="validator">
    <div class="container container-singupform py-4">
      <div class="row py-2">
        <div class="col">
          <label for="communityName" class="form-label text-signup-label">Community Name</label>
          <input type="text" class="form-control" id="communityName" name="communityName" placeholder="Enter Community Name" required>
        </div>
      </div>

      <div class="row py-2">
        <div class="col">
          <label for="communityDesc" class="form-label text-signup-label">Community Description</label>
          <textarea class="form-control" id="communityDesc" name="communityDesc" rows="3" placeholder="Enter Community Description" required></textarea>
        </div>
      </div>

      <div class="row py-2">
        <div class="col">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" id="activeFlg" name="activeFlg">
            <label class="form-check-label" for="activeFlg">Active</label>
          </div>
        </div>
      </div>

      <div class="row my-5">
        <div class="col text-center">
          <button type="submit" class="btn btn-hero-section text-white rounded-pill">Create Community</button>
        </div>
      </div>
    </div>
  </form>
</Section>
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