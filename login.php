<?php
$errors = array('uname' => '', 'pwd' => '');
$uname = '';

// process form on a user submit

if (isset($_POST['submit'])) {

  $uname = htmlspecialchars($_POST['uname']);
  $pwd = htmlspecialchars($_POST['pwd']);
  // required fields
  if (empty($_POST['uname'])) {

    $errors['uname'] = 'A user is required. <br>';
  }

  if (empty($_POST['pwd'])) {

    $errors['pwd'] = 'A password is required. <br>';
  } else {

    // validate password

    include('includes/connect.inc.php');

    if (!$con) {

      $error['uname'] = 'connection error: ' . mysqli_connect_error();
    } else {

      // build the query

      $sql = 'SELECT * FROM Auth_t WHERE username = \'' . $uname . '\' ';

      //echo $sql;

      // run the query

      $results = mysqli_query($con, $sql);


      if (mysqli_num_rows($results) > 0) {

        $user = mysqli_fetch_assoc($results);

        if ($user['password'] != $pwd) {

          $errors['uname'] = 'Username or password is not correct. <br>';
        }
      } else {

        $errors['uname'] = 'Username or password is not correct. <br>';
      }
    }
  }

  // if no errors set globals and redirect to appropriate page

  if (empty($errors['uname']) && empty($errors['pwd'])) {

    session_start();

    $_SESSION['uname'] = $uname;

    $_SESSION['UserID'] = $user['UserID'];

    $_SESSION['MentorStatus'] = $user['MentorStatus'];

    $_SESSION['ModeratorStatus'] = $user['ModeratorStatus'];

    $_SESSION['SystemAdministratorStatus'] = $user['SystemAdministratorStatus'];

    // Get user associations
    $userID = $user['UserID'];
    $sqlAssociations = "SELECT `Associations` FROM `UserData_t` WHERE `UserID` = $userID";
    $resultAssociations = mysqli_query($con, $sqlAssociations);

    if (mysqli_num_rows($resultAssociations) > 0) {
      while ($profile = mysqli_fetch_assoc($resultAssociations)) {
        $associations = $profile['Associations'];
        $associationsArray = explode(";", $associations ?? '');
      }
    } else {
      $associationsArray = null;
    }

    $_SESSION['Associations'] = $associationsArray;

    // Get user profile info
    $sqlProfile = "SELECT `FirstName`, `LastName`, `ProfilePicture` FROM `UserData_t` WHERE `UserID` = $userID";
    $resultProfile = mysqli_query($con, $sqlProfile);
    while ($profile = mysqli_fetch_assoc($resultProfile)) {
      $profileArray = array('FirstName' => $profile['FirstName'], 'LastName' => $profile['LastName'], 'ProfilePicture' => $profile['ProfilePicture']);
    }

    $_SESSION['Profile'] = $profileArray;

    // free the memory and connection

    mysqli_free_result($results);
    mysqli_free_result($resultAssociations);

    mysqli_close($con);

    if ($user['ModeratorStatus'] == 1) {
      $url = 'moderator-dashboard.php?profileID=' . $_SESSION['UserID'];
    } elseif ($user['SystemAdministratorStatus'] == 1) {
      $url = 'administrator-dashboard.php?profileID=' . $_SESSION['UserID'];
    } else {
      $url = 'profile.php?profileID=' . $_SESSION['UserID'];
    }

    header('Location: ' . $url);
    exit();
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<body>

  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Guidance Exchange | Login</title>
    <link href="assets\fontawesome\css\fontawesome.css" rel="stylesheet">
    <link href="assets\fontawesome\css\brands.css" rel="stylesheet">
    <link href="assets\fontawesome\css\solid.css" rel="stylesheet">
    <link href="assets\bootstrap\css\bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="css\main.css" />
    <link rel="stylesheet" href="css\loginPage.css" />
  </head>

  <header>
    <nav class="navbar navbar-expand-lg navbar-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="home.php"><img src="img/logo_gradient.png" alt="Guidance Exchange Logo" height="70" /></a>      
      </div>
    </nav>
  </header>

  <body>
    <!-- Content Section -->
    <section class="geColor">
      <div class="geflex">
        <h1 class="geColorWhite">Welcome Back!</h1>
      </div>
      <div class="geflex">
        <img src="./img/loginPicture.png" alt="loginPicture">
      </div>

    </section>
    <div class="container">
      <form action="login.php" method="POST">
        <label for="uname"><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="uname" required value="<?php echo $uname; ?>">
        <div class="error"> <?php echo $errors['uname']; ?> </div>
        <label for="pwd"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="pwd" required>
        <button type="submit" name="submit" value="login">Login</button>
    </div>
    </form>

    <script src="assets\bootstrap\js\bootstrap.bundle.min.js"></script>
    <script src="assets\jquery\jquery-3.7.0.min.js"></script>
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