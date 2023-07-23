
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
<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "guidance_exchange"; // Corrected database name
$port = 3306;

// Create a connection
include('includes/connect.inc.php');
$conn = new mysqli($servername, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

error_reporting(E_ALL);
ini_set('display_errors', 1);


// Handle the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Fetch the post ID from the form submission
    if (isset($_POST['post_id'])) {
        $postId = $_POST['post_id'];

        // Retrieve the submitted comment content
        $commentContent = $_POST['comment_content'];

        // Insert the comment into the database table
        $sqlInsertComment = "INSERT INTO post_comments (post_comment_id, post_id, comment_text) VALUES (NULL, ?, ?)";
        $stmt = $conn->prepare($sqlInsertComment);

        // Bind the values to the prepared statement
        $stmt->bind_param("is", $postId, $commentContent);

        // Execute the prepared statement
        $stmt->execute();

        // Redirect to the same page to display the updated comments
        header("Location: forum.php?post_id=$postId");
        exit;
    }
}

// Fetch the post data based on the provided post ID
if (isset($_GET['post_id'])) {
    $postId = $_GET['post_id'];

    // Retrieve the post from the database
     $sqlPost = "SELECT C.*, U.FirstName, U.LastName, U.ProfilePicture FROM community_data_info C
                JOIN UserData_t U ON C.User_ID = U.UserID
                WHERE C.post_id = $postId";
    $resultPost = $conn->query($sqlPost);

    if ($resultPost->num_rows === 1) {
        $post = $resultPost->fetch_assoc();
        $postTitle = $post['title'];
        $postContent = $post['content'];
        $userFirstName = $post['FirstName'];
        $userLastName = $post['LastName'];
        $userProfilePicture = $post['ProfilePicture'];

        // Retrieve the comments for the post from the database
      // Retrieve the comments for the post from the database
        $sqlComments = "SELECT * FROM post_comments WHERE post_id = ?";
        $stmtComments = $conn->prepare($sqlComments);
        $stmtComments->bind_param("i", $postId);
        $stmtComments->execute();
        $resultComments = $stmtComments->get_result();

// Fetch all comments as an array
$sampleComments = [];
while ($row = $resultComments->fetch_assoc()) {
    $sampleComments[] = $row;
}


    }
}
?>



<section class="content m-4">
    <div class="container p-0">
        <div class="card">
            <div class="row g-0">
                <div class="col-12 col-lg-5 col-xl-3 border-right">
                    <!-- Your existing code for the left column -->
                    <h2 class="card-title"><?php echo $postTitle; ?></h2>
                    <p class="card-text"><?php echo $postContent; ?></p>
                </div>
                <div class="col-12 col-lg-7 col-xl-9">
                    <div class="py-2 px-4 border-bottom d-none d-lg-block">
                        <div class="d-flex align-items-center py-1 message-title">
                            <div class="position-relative">
                                <img src="upload/<?php echo $userProfilePicture; ?>" class="rounded-circle me-1" alt="<?php echo $userFirstName . ' ' . $userLastName; ?>" width="40" height="40">
                            </div>
                            <div class="flex-grow-1 ps-3">
                                <strong><?php echo $userFirstName . ' ' . $userLastName; ?></strong>
                            </div>
                        </div>
                    </div>

                        <div class="position-relative">
                            <div class="messages p-4">
                                
                                <!-- Display the comments -->
                                <section class="messages mb-3">
                                    <h3 class="messages__header">Comments</h3>
                                    <div class="messages__content">
                                        <?php if (is_array($sampleComments) && count($sampleComments) > 0) { ?>
                                            <?php foreach ($sampleComments as $comment) { ?>
                                                <div class="message-left message mb-3">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <p class="card-text"><?php echo $comment['comment_text']; ?></p
                                                            <small class="text-muted"><?php echo $userFirstName; ?></small>                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <p>No comments yet.</p>
                                        <?php } ?>
                                    </div>
                                </section>

                                <!-- New Comment Form -->
                                <section class="content comment-form">
                                    <div class="container p-0">
                                        <form action="forum.php?post_id=<?php echo $postId; ?>" method="post">
                                            <div class="mb-3">
                                                <textarea class="form-control" name="comment_content" rows="4" cols="50" required></textarea>
                                            </div>
                                            <input type="hidden" name="post_id" value="<?php echo $postId; ?>&profileID=<?php echo $userID; ?>">
                                            <button type="submit" name="submit_comment" class="btn main-button">Submit Comment</button>
                                        </form>
                                    </div>
                                </section>
                                <!-- End New Comment Form -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

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

    <!-- Add your script tags and other closing elements here -->
</body>
</html>

