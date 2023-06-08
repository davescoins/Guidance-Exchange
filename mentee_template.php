<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Profile Template</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />
  <link rel="stylesheet" href="css/main.css" />
</head>

<header>
  <nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="home.php"><img src="img/logo_gradient.png" alt="Guidance Exchange Logo" height="70" /></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link highlight-link nav-text px-4 active" href="#">Profile</a>
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

<body>
  <!-- Photo Section -->
  <section class="photo-section pt-5 pb-3" style="background-image: url('img/circuit_gray_transparent.png'); background-attachment: fixed; background-size: cover;">
    <div class="container-fluid flex-column">
      <img class="profile-photo mb-3" style="border-color: #fa7811;" src="upload/sophia-lee.png" alt="Sophia Lee Profile Photo">
      <h1 class="profile-name mb-2">Sophia Lee</h1>
      <div class="flex-row">
        <i class="fa-solid fa-star filled"></i>
        <i class="fa-solid fa-star filled"></i>
        <i class="fa-solid fa-star filled"></i>
        <i class="fa-solid fa-star filled"></i>
        <i class="fa-solid fa-star unfilled"></i>
      </div>
      <h2 class="city-name mt-2 mb-3">Washington, D.C.</h2>
      <div class="mb-0">
        <a href="https://www.facebook.com/" class="mx-3"><i class="fa fa-facebook"></i></a>
        <a href="https://www.instagram.com/" class="mx-3"><i class="fa fa-instagram"></i></a>
        <a href="https://www.twitter.com/" class="mx-3"><i class="fa fa-twitter"></i></a>
        <a href="https://www.linkedin.com" class="mx-3"><i class="fa fa-linkedin"></i></a>
      </div>
    </div>
  </section>

  <!-- Content Section -->
  <section class="content-section pt-4">
    <div class="container-fluid pb-4">
      <div class="row align-items-start profile-section pt-2">
        <div class="col-1 d-flex align-items-center justify-content-center profile-icon">
          <i class="fa-solid fa-message"></i>
        </div>
        <div class="col-11 profile-wrap">
          <h3>About Me</h3>
          <p>Meet Sophia, a dynamic and talented IT professional with a passion for innovation and problem-solving. With a strong educational background in computer science and a natural curiosity for emerging technologies, she thrives in the fast-paced world of IT. Her dedication, adaptability, and keen eye for detail make her an invaluable asset in developing cutting-edge solutions that propel businesses forward.</p>
        </div>
        <div class="col-12 text-end">
          <div class="open-link">
            <div class="expand-btn"><i class="fa-solid fa-plus"></i></div>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid pb-4">
      <div class="row align-items-start profile-section pt-2">
        <div class="col-1 d-flex align-items-center justify-content-center profile-icon">
          <i class="fa-solid fa-briefcase"></i>
        </div>
        <div class="col-11 profile-wrap">
          <h3>Work</h3>
          <p class="mb-0"><strong>Software Engineer at Innovate Inc.</strong></p>
          <p class="profile-date mb-0">(2020 - )</p>
          <p>Sophia plays a key role in developing and maintaining scalable software solutions for a diverse range of clients. She collaborates with cross-functional teams to design and implement efficient code, ensuring high-quality deliverables within strict deadlines. Her expertise in programming languages such as Java and Python helps streamline processes and enhance system performance.</p>
        </div>
        <div class="col-12 text-end">
          <div class="open-link">
            <div class="expand-btn"><i class="fa-solid fa-plus"></i></div>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid pb-4">
      <div class="row align-items-start profile-section pt-2">
        <div class="col-1 d-flex align-items-center justify-content-center profile-icon">
          <i class="fa-solid fa-book-open"></i>
        </div>
        <div class="col-11 profile-wrap">
          <h3>Education</h3>
          <p class="mb-0"><strong>Bachelor of Science in Computer Science, The George Washington University</strong></p>
          <p class="profile-date mb-0">(2016 - 2020)</p>
          <p>Sophia pursued her undergraduate studies in Computer Science, gaining a solid foundation in programming, algorithms, data structures, and software development. She actively participated in various coding competitions, clubs, and workshops, further refining her technical skills and fostering a passion for innovation.</p>
        </div>
        <div class="col-12 text-end">
          <div class="open-link">
            <div class="expand-btn"><i class="fa-solid fa-plus"></i></div>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid pb-4">
      <div class="row align-items-start profile-section pt-2">
        <div class="col-1 d-flex align-items-center justify-content-center profile-icon">
          <i class="fa-solid fa-file-pen"></i>
        </div>
        <div class="col-11 profile-wrap">
          <h3>Skills</h3>
          <div>
            <a class="btn profile-skill" href="#" role="button">Java</a>
            <a class="btn profile-skill" href="#" role="button">Python</a>
            <a class="btn profile-skill" href="#" role="button">Problem Solving</a>
            <a class="btn profile-skill" href="#" role="button">Ux Design</a>
            <a class="btn profile-skill" href="#" role="button">Database Management</a>
            <a class="btn profile-skill" href="#" role="button">Teamwork</a>
            <a class="btn profile-skill" href="#" role="button">Creativity</a>
          </div>
        </div>
        <div class="col-12 text-end">
          <div class="open-link">
            <div class="expand-btn"><i class="fa-solid fa-plus"></i></div>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid pb-4">
      <div class="row align-items-start profile-section pt-2">
        <div class="col-1 d-flex align-items-center justify-content-center profile-icon">
          <i class="fa-solid fa-user-group"></i>
        </div>
        <div class="col-11 profile-wrap">
          <h3>My Associations</h3>
          <div class="row pt-1">
            <div class="col-2 d-flex align-items center justify-content-center">
              <a href="#"><img class="association-photo" src="upload/benjamin-park.png" alt="benjamin park profile photo"></a>
            </div>
            <div class="col-2 d-flex align-items center justify-content-center">
              <a href="#"><img class="association-photo" src="upload/harper-brown.png" alt="harper brown profile photo"></a>
            </div>
            <div class="col-2 d-flex align-items center justify-content-center">
              <a href="#"><img class="association-photo" src="upload/lucas-khan.png" alt="lucas khan profile photo"></a>
            </div>
            <div class="col-2 d-flex align-items center justify-content-center">
              <a href="#"><img class="association-photo" src="upload/mia-wilson.png" alt="mia wilson profile photo"></a>
            </div>
          </div>
        </div>
        <div class="col-12 text-end">
          <div class="open-link">
            <div class="expand-btn"><i class="fa-solid fa-plus"></i></div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/c5863419fe.js" crossorigin="anonymous"></script>
  <script src="js/profile.js"></script>
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