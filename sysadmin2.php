<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Navbar Template</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />
  <link rel="stylesheet" href="css/sysadmin2.css">
  <script src="https://kit.fontawesome.com/6a1ed0e093.js" crossorigin="anonymous"></script>
</head>
<body>
  <div class="page">
      <header>
        <!-- <nav class="navbar navbar-expand-lg navbar-light"> -->
        <nav>
          <!-- <div class="container-fluid"> -->
          <div class="inner-nav">
            <a class="navbar-brand" href="home.php"><img src="img/logo_gradient.png" alt="Guidance Exchange Logo" height="70" /></a>
            <!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <i class="fas fa-bars"></i>
            </button> -->
            <!-- <div class="collapse navbar-collapse" id="navbarSupportedContent"> -->
            <div class="links">
              <ul class="page-links">
                <li class="nav-item">
                  <a class="nav-link highlight-link nav-text px-4" href="#">Profile</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link highlight-link nav-text px-4" href="#">Communities</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link highlight-link nav-text px-4" href="#">Mentoring</a>
                </li>
              </ul>
              <ul class="navbar-nav d-flex flex-row me-1">
                <li class="nav-item me-3 me-lg-0 px-2">
                  <a class="nav-link" href="#"><i class="fa-solid fa-magnifying-glass fa-xl"></i></i></i></a>
                </li>
                <li class="nav-item me-3 me-lg-0 px-2">
                  <a class="nav-link" href="#"><i class="fa-solid fa-inbox fa-xl"></i></i></a>
                </li>
                <li class="nav-item me-3 me-lg-0 px-2">
                  <a class="nav-link" href="#"><i class="fa-solid fa-user-group fa-xl"></i></i></a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
      </header>
      <!-- Content Section -->
      <h1>System Adminstrator</h1>
      <!-- <table id="systemadmin"> -->
          <div class="admin-pic">
              <img class="davesysadmin" src="img/dave2.jpeg" width= "100" alt = "davesphoto">
        </div>
        <div id = "moderatorpics">
            <h2>Moderators</h2>
            <div class="moderator">
                <img src ="img/adamjawarishpic.jpg" width=  "50" alt = "Adam Jawarish"/><em><b>Adam Jawarish</b></em>
            </div>          
            <div class="moderator">
                <img src ="img/JulieWpic.jpg" width=  "50" alt = "Juile Walizai"/><em><b>Julie Walizai</b></em>
            </div>
            <div class="moderator">
                <img src ="img/bezaterpic.jpg" width=  "50" alt = "Bezawit Tereri"/><em><b>Bezawit Tereri</b></em>
            </div>
            <div class="moderator"><img src ="img/berineyanpic.jpg" width=  "50" alt = "Bernie Yanos"/><em><b>Bernie Yanos</b></em></div>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
      <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
      <!-- <script src="https://kit.fontawesome.com/c5863419fe.js" crossorigin="anonymous"></script> -->
    </div>
    <form action="">
        <h2>Create Account</h2>
        <div class="form-element">
            <label for="Username">User Name</label>
            <input type="text" placeholder="Username">
        </div>
        <div class="form-element">
            <label for="Password">Password</label>
            <input type="Password" placeholder="Password">
        </div>
        <button type="submit">Create</button>
    </form>
    <footer>
        <nav class="navbar">
            <div class="inner-navbar">
                <div class="socials">
                    <a href="https://www.facebook.com/" class="mx-3"><i class="fa fa-facebook"></i></a>
                    <a href="https://www.instagram.com/" class="mx-3"><i class="fa fa-instagram"></i></a>
                    <a href="https://www.twitter.com/" class="mx-3"><i class="fa fa-twitter"></i></a>
                    <a href="https://www.linkedin.com" class="mx-3"><i class="fa fa-linkedin"></i></a>
                </div>
                <div class="footer-text text-center pb-3">© 2023 Guidance Exchange</div>
            </div>
        </nav>
    </footer>
</div>
</body>
</html>