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

<?php
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "guidance_exhange";
    $port = 3306;

    // Include the database connection file
    include('includes/connect.inc.php');
    $conn = new mysqli($servername, $username, $password, $dbname, $port);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


$userID = $_SESSION['UserID'];


// Check if the community ID is provided in the URL

    // Get the community ID from the URL
    $communityId = $_GET['community_id'];

    // Now you have the community ID, you can use it as needed
    // For example, display it somewhere on the page
  


    // ... Rest of your code using the community ID

error_reporting(E_ALL);
ini_set('display_errors', 1);
      
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming you have a database connection, update the connection details accordingly

  // Handle the form submission
$postTitle = isset($_POST['postTitle']) ? $_POST['postTitle'] : '';
    $postContent = isset($_POST['postContent']) ? $_POST['postContent'] : '';
    $activeFlg = isset($_POST['activeFlg']) ? 1 : 0;


    // Your existing code here...

    // Debugging: Let's check the values received from the form


    // Prepare and execute the SQL query
    $sql = "INSERT INTO community_data_info (community_id, user_id, title, content, active_flg) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Check if the prepare statement was successful
    if ($stmt) {
        // Bind the parameters with the correct data types
        // Assuming 'community_id' is an integer type, 'user_id' is an integer type, 'title' is a string type,
        // 'content' is a string type, and 'active_flg' is an integer type (assuming 1 or 0 values)
        $stmt->bind_param("iisii", $communityId, $userID, $postTitle, $postContent, $activeFlg);

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect to community_info.php upon successful form submission
            
        header("Location: community_info.php");
        exit();        
        } else {
            // Close the database connection
            $conn->close();
            // Refresh the page with an error message
            echo "<script>alert('Form not properly completed, please try again!'); window.location.href = 'new_discussion.php';</script>";
            exit();
        }
    } else {
        // Handle prepare statement error
        // Close the database connection
        $conn->close();
        // Refresh the page with an error message
        echo "<script>alert('Prepare statement error, please try again!'); window.location.href = 'new_discussion.php';</script>";
        exit();
    }
}

?>

  <section>
    
        <form id="createCommunityForm" method="POST" action="new_discussion.php?community_id=<?php echo $communityId; ?>" role="form" data-toggle="validator">
      <input type="hidden" name = "community_id" value = "<?php echo $communityId; ?>" >
      <div class="row py-2">
        <div class="col">
          <label for="title" class="form-label">Discussion Title</label>
          <input type="text" class="form-control" id="postTitle" name="postTitle" placeholder="Enter Discussion Title" required>
        </div>
      </div>

      <div class="row py-2">
        <div class="col">
          <label for="content" class="form-label">What are we discussing?</label>
          <textarea class="form-control" id="postContent" name="postContent" rows="3" placeholder="Enter Discussion Content" required></textarea>
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
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </form>
  </section>

</form>
</section>
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
