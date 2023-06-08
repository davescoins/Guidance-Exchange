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
  <section class="photo-section pt-5 pb-3" style="background-image: url('img/biotech-pattern.png'); background-attachment: fixed; background-size: cover;">
    <div class="container-fluid flex-column">
      <img class="profile-photo mb-3" style="border-color: #008a0e;" src="upload/david-anderson.png" alt="David Anderson Profile Photo">
      <div class="mentor-tag mb-2">
        <p class="py-1 px-3 m-0">Mentor</p>
      </div>
      <h1 class="profile-name mb-2">David Anderson</h1>
      <div class="flex-row">
        <i class="fa-solid fa-star filled"></i>
        <i class="fa-solid fa-star filled"></i>
        <i class="fa-solid fa-star filled"></i>
        <i class="fa-solid fa-star filled"></i>
        <i class="fa-solid fa-star unfilled"></i>
      </div>
      <h2 class="city-name mt-2 mb-3">Boston, MA</h2>
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
          <i class="fa-solid fa-hand-holding-hand"></i>
        </div>
        <div class="col-11 profile-wrap">
          <h3>Mentoring</h3>
          <p>David Anderson, an accomplished chemist with a passion for nurturing talent, is offering invaluable mentoring opportunities to aspiring chemists. Recognizing the importance of guidance and support in one's scientific journey, David is eager to share his knowledge and experiences with enthusiastic individuals looking to make their mark in the field. Through personalized mentoring sessions, he provides guidance on career paths, research methodologies, laboratory techniques, and scientific writing. David's patient and approachable nature fosters a supportive environment where mentees can gain practical insights, develop their skills, and embark on a successful career in chemistry with confidence.</p>
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
          <i class="fa-regular fa-calendar-check"></i>
        </div>
        <div class="col-11 profile-wrap">
          <h3>Schedule an Appointment</h3>
          <div>
            <a class="btn profile-skill" href="#" role="button" onclick="openModal('timeSelection')">July 1</a>
            <a class="btn profile-skill" href="#" role="button">July 2</a>
            <a class="btn profile-skill" href="#" role="button">July 8</a>
            <a class="btn profile-skill" href="#" role="button">July 9</a>
            <a class="btn profile-skill" href="#" role="button">July 15</a>
            <a class="btn profile-skill" href="#" role="button">July 16</a>
            <a class="btn profile-skill" href="#" role="button">July 22</a>
            <a class="btn profile-skill" href="#" role="button">July 23</a>
            <a class="btn profile-skill" href="#" role="button">July 29</a>
            <a class="btn profile-skill" href="#" role="button">July 30</a>
          </div>
          <div class="modal fade" id="timeSelection" tabindex="-1" aria-labelledby="timeLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header modal-header-gradient">
                  <h1 class="modal-title fs-5" id="timeLabel">July 1, 2023</h1>
                  <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form>
                  <div class="modal-body justify-content-center">
                    <fieldset class="row align-items-start py-3 mx-2">
                      <div class="form-check form-check-inline me-0 ps-1 pb-2 col-3 d-flex align-items-center justify-content-center">
                        <input type="radio" name="match" id="match_1" value="10:00" />
                        <label class="btn time-button" for="match_1">10:00 AM</label>
                      </div>
                      <div class="form-check form-check-inline me-0 ps-1 pb-2 col-3 d-flex align-items-center justify-content-center">
                        <input type="radio" name="match" id="match_2" value="11:00" />
                        <label class="btn time-button" for="match_2">11:00 AM</label>
                      </div>
                      <div class="form-check form-check-inline me-0 ps-1 pb-2 col-3 d-flex align-items-center justify-content-center">
                        <input type="radio" name="match" id="match_3" value="12:00" />
                        <label class="btn time-button" for="match_3">12:00 PM</label>
                      </div>
                      <div class="form-check form-check-inline me-0 ps-1 pb-2 col-3 d-flex align-items-center justify-content-center">
                        <input type="radio" name="match" id="match_4" value="13:00" />
                        <label class="btn time-button" for="match_4">1:00 PM</label>
                      </div>
                      <div class="form-check form-check-inline me-0 ps-1 pb-2 col-3 d-flex align-items-center justify-content-center">
                        <input type="radio" name="match" id="match_5" value="14:00" />
                        <label class="btn time-button" for="match_5">2:00 PM</label>
                      </div>
                      <div class="form-check form-check-inline me-0 ps-1 pb-2 col-3 d-flex align-items-center justify-content-center">
                        <input type="radio" name="match" id="match_6" value="15:00" />
                        <label class="btn time-button" for="match_6">3:00 PM</label>
                      </div>
                    </fieldset>
                  </div>
                  <div class="modal-footer justify-content-center">
                    <button class="btn time-button" type="submit">Submit</button>
                  </div>
                </form>
              </div>
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
    <div class="container-fluid pb-4">
      <div class="row align-items-start profile-section pt-2">
        <div class="col-1 d-flex align-items-center justify-content-center profile-icon">
          <i class="fa-solid fa-message"></i>
        </div>
        <div class="col-11 profile-wrap">
          <h3>About Me</h3>
          <p>Introducing David, a talented and dedicated chemist with a profound passion for unraveling the mysteries of matter. With a strong educational background and years of hands-on experience in the field, he thrives in the laboratory, meticulously conducting experiments and analyzing chemical reactions. David's relentless pursuit of scientific discovery and his expertise in analytical techniques make him a valuable asset in advancing our understanding of the world at the molecular level.</p>
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
          <p class="mb-0"><strong>Research Chemist at DEF Chemicals</strong></p>
          <p class="profile-date mb-0">(2018 - )</p>
          <p>David actively contributes to the development of novel pharmaceutical compounds, conducting in-depth research, and performing experiments to assess their efficacy and safety. He collaborates with interdisciplinary teams to optimize formulations and improve manufacturing processes. David also plays a key role in analyzing data, preparing technical reports, and presenting findings to stakeholders.</p>
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
          <p class="mb-0"><strong>Ph.D. in Chemistry, Massachussetts Institute of Technology</strong></p>
          <p class="profile-date mb-0">(2015 - 2018)</p>
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
            <a class="btn profile-skill" href="#" role="button">Chemical Analysis</a>
            <a class="btn profile-skill" href="#" role="button">Organic Synthesis</a>
            <a class="btn profile-skill" href="#" role="button">Spectroscopy</a>
            <a class="btn profile-skill" href="#" role="button">Chromatography</a>
            <a class="btn profile-skill" href="#" role="button">Lab Techniques</a>
            <a class="btn profile-skill" href="#" role="button">Data Analysis</a>
            <a class="btn profile-skill" href="#" role="button">Research Methodology</a>
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