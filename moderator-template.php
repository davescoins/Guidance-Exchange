<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Moderator Template</title>

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
            <a class="nav-link highlight-link nav-text px-4 active" href="#">Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link highlight-link nav-text px-4" href="#">Communities</a>
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
  <section class="moderator__photo-section pt-5 pb-3" style="background-image: url('img/abstract-lines-pattern_trans.png'); background-attachment: fixed; background-size: cover;">
    <div class="container-fluid flex-column">
      <img class="moderator__profile-photo mb-3" style="border-color: #ef5f9e;" src="upload/isabella-martinez.png" alt="Isabella Martinez Profile Photo">
      <div class="moderator__tag mb-2">
        <p class="py-1 px-3 m-0">Moderator</p>
      </div>
      <h1 class="moderator__profile-name">Welcome back, Isabella!</h1>
      <div class="container pb-4">
        <div class="row">
          <div class="col container-fluid justify-content-end me-5 mt-4">
            <div class="row row-cols-auto moderator__profile-section pt-2">
              <div class="col d-flex moderator__profile-icon align-items-center">
                <i class="fa-solid fa-hand-holding-hand"></i>
              </div>
              <div class="col moderator__profile-wrap">
                <h3>Pending<br>Mentor<br>Requests</h3>
              </div>
              <div class="col">
                <p class="moderator__requests-counter pe-3" style="color: orange;">5</p>
              </div>
            </div>
          </div>
          <div class="col container-fluid justify-content-start ms-5 mt-4">
            <div class="row row-cols-auto moderator__profile-section pt-2">
              <div class="col d-flex moderator__profile-icon align-items-center">
                <i class="fa-solid fa-comments"></i>
              </div>
              <div class="col moderator__profile-wrap">
                <h3>Pending<br>Community<br>Requests</h3>
              </div>
              <div class="col">
                <p class="moderator__requests-counter pe-3" style="color: green;">3</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Content Section -->
  <section class="content-section pt-4">
    <div class="container-fluid w-50 pb-4 flex-column">
      <div class="d-flex align-items-start w-100">
        <h4>Mentor Requests</h4>
      </div>
      <div class="accordion w-100 row" id="mentor-requests">

        <div class="accordion-item">
          <div class="accordion-header">
            <button class="accordion-button collapsed py-2" type="button" data-bs-toggle="collapse" data-bs-target="#mentor_collapse1" aria-expanded="false" aria-controls="mentor_collapse1">
              <div class="d-flex align-items-center">
                <div class="d-flex align-items-center justify-content-center moderator__mentor-request-photo">
                  <img class="pe-4" src="/upload/benjamin-park.png" alt="Benjamin Park Profile Photo">
                </div>
                <h4 class="moderator__request-header ps-4 mb-0">Benjamin Park</h4>
              </div>
            </button>
          </div>
          <div id="mentor_collapse1" class="accordion-collapse collapse" data-bs-parent="#mentor-requests">
            <div class="accordion-body">
              <div class="container-fluid d-flex justify-content-start px-0 pb-3">
                <a href="#"><img class="moderator__icons" src="img/GElogo_blue.png" alt="Guidance Exchange Profile"></a>
                <a href="#"><i class="fa-brands fa-linkedin moderator__icons"></i></a>
                <a href="#"><i class="fa-solid fa-file-pdf moderator__icons"></i></a>
              </div>
              Lorem ipsum, dolor sit amet consectetur adipisicing elit. Excepturi omnis, quod odio praesentium rem cupiditate soluta laborum aspernatur, explicabo temporibus veritatis a cumque quas dolor libero corrupti vero dolorum consequatur! Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae voluptatem ipsam libero iure fugit facere omnis, consequuntur dolor? In aperiam pariatur ex aut vel vitae reprehenderit sunt vero modi deleniti.
              <div class="container-fluid pt-3">
                <button type="button" class="btn btn-success mx-4">Approve</button>
                <button type="button" class="btn btn-danger mx-4">Deny</button>
              </div>
            </div>
          </div>
        </div>

        <div class="accordion-item">
          <div class="accordion-header">
            <button class="accordion-button collapsed py-2" type="button" data-bs-toggle="collapse" data-bs-target="#mentor_collapse2" aria-expanded="false" aria-controls="mentor_collapse2">
              <div class="d-flex align-items-center">
                <div class="d-flex align-items-center justify-content-center moderator__mentor-request-photo">
                  <img class="pe-4" src="/upload/harper-brown.png" alt="Harper Brown Profile Photo">
                </div>
                <h4 class="moderator__request-header ps-4 mb-0">Harper Brown</h4>
              </div>
            </button>
          </div>
          <div id="mentor_collapse2" class="accordion-collapse collapse" data-bs-parent="#mentor-requests">
            <div class="accordion-body">
              <div class="container-fluid d-flex justify-content-start px-0 pb-3">
                <a href="#"><img class="moderator__icons" src="img/GElogo_blue.png" alt="Guidance Exchange Profile"></a>
                <a href="#"><i class="fa-brands fa-linkedin moderator__icons"></i></a>
                <a href="#"><i class="fa-solid fa-file-pdf moderator__icons"></i></a>
              </div>
              Lorem ipsum, dolor sit amet consectetur adipisicing elit. Excepturi omnis, quod odio praesentium rem cupiditate soluta laborum aspernatur, explicabo temporibus veritatis a cumque quas dolor libero corrupti vero dolorum consequatur! Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae voluptatem ipsam libero iure fugit facere omnis, consequuntur dolor? In aperiam pariatur ex aut vel vitae reprehenderit sunt vero modi deleniti.
              <div class="container-fluid pt-3">
                <button type="button" class="btn btn-success mx-4">Approve</button>
                <button type="button" class="btn btn-danger mx-4">Deny</button>
              </div>
            </div>
          </div>
        </div>

        <div class="accordion-item">
          <div class="accordion-header">
            <button class="accordion-button collapsed py-2" type="button" data-bs-toggle="collapse" data-bs-target="#mentor_collapse3" aria-expanded="false" aria-controls="mentor_collapse3">
              <div class="d-flex align-items-center">
                <div class="d-flex align-items-center justify-content-center moderator__mentor-request-photo">
                  <img class="pe-4" src="/upload/lucas-khan.png" alt="Lucas Khan Profile Photo">
                </div>
                <h4 class="moderator__request-header ps-4 mb-0">Lucas Khan</h4>
              </div>
            </button>
          </div>
          <div id="mentor_collapse3" class="accordion-collapse collapse" data-bs-parent="#mentor-requests">
            <div class="accordion-body">
              <div class="container-fluid d-flex justify-content-start px-0 pb-3">
                <a href="#"><img class="moderator__icons" src="img/GElogo_blue.png" alt="Guidance Exchange Profile"></a>
                <a href="#"><i class="fa-brands fa-linkedin moderator__icons"></i></a>
                <a href="#"><i class="fa-solid fa-file-pdf moderator__icons"></i></a>
              </div>
              Lorem ipsum, dolor sit amet consectetur adipisicing elit. Excepturi omnis, quod odio praesentium rem cupiditate soluta laborum aspernatur, explicabo temporibus veritatis a cumque quas dolor libero corrupti vero dolorum consequatur! Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae voluptatem ipsam libero iure fugit facere omnis, consequuntur dolor? In aperiam pariatur ex aut vel vitae reprehenderit sunt vero modi deleniti.
              <div class="container-fluid pt-3">
                <button type="button" class="btn btn-success mx-4">Approve</button>
                <button type="button" class="btn btn-danger mx-4">Deny</button>
              </div>
            </div>
          </div>
        </div>

        <div class="accordion-item">
          <div class="accordion-header">
            <button class="accordion-button collapsed py-2" type="button" data-bs-toggle="collapse" data-bs-target="#mentor_collapse4" aria-expanded="false" aria-controls="mentor_collapse4">
              <div class="d-flex align-items-center">
                <div class="d-flex align-items-center justify-content-center moderator__mentor-request-photo">
                  <img class="pe-4" src="/upload/mia-wilson.png" alt="Mia Wilson Profile Photo">
                </div>
                <h4 class="moderator__request-header ps-4 mb-0">Mia Wilson</h4>
              </div>
            </button>
          </div>
          <div id="mentor_collapse4" class="accordion-collapse collapse" data-bs-parent="#mentor-requests">
            <div class="accordion-body">
              <div class="container-fluid d-flex justify-content-start px-0 pb-3">
                <a href="#"><img class="moderator__icons" src="img/GElogo_blue.png" alt="Guidance Exchange Profile"></a>
                <a href="#"><i class="fa-brands fa-linkedin moderator__icons"></i></a>
                <a href="#"><i class="fa-solid fa-file-pdf moderator__icons"></i></a>
              </div>
              I am a seasoned stock broker with a wealth of experience in managing stock portfolios, and am dedicated to helping aspiring stock traders navigate the dynamic world of investments. With my deep understanding of market trends, risk management strategies, and financial analysis, I aim to offer invaluable mentoring and advice to those looking to enter the exciting realm of stock trading. Drawing from my years of experience in executing trades, analyzing market data, and building successful portfolios, I can provide personalized guidance tailored to individual goals and risk tolerance. My passion for empowering others, coupled with my extensive expertise, makes me an ideal mentor for aspiring stock traders seeking to achieve financial success in the stock market.
              <div class="container-fluid pt-3">
                <button type="button" class="btn btn-success mx-4">Approve</button>
                <button type="button" class="btn btn-danger mx-4">Deny</button>
              </div>
            </div>
          </div>
        </div>

        <div class="accordion-item">
          <div class="accordion-header">
            <button class="accordion-button collapsed py-2" type="button" data-bs-toggle="collapse" data-bs-target="#mentor_collapse5" aria-expanded="false" aria-controls="mentor_collapse5">
              <div class="d-flex align-items-center">
                <div class="d-flex align-items-center justify-content-center moderator__mentor-request-photo">
                  <img class="pe-4" src="/upload/sophia-lee.png" alt="Sophia Lee Profile Photo">
                </div>
                <h4 class="moderator__request-header ps-4 mb-0">Sophia Lee</h4>
              </div>
            </button>
          </div>
          <div id="mentor_collapse5" class="accordion-collapse collapse" data-bs-parent="#mentor-requests">
            <div class="accordion-body">
              <div class="container-fluid d-flex justify-content-start px-0 pb-3">
                <a href="#"><img class="moderator__icons" src="img/GElogo_blue.png" alt="Guidance Exchange Profile"></a>
                <a href="#"><i class="fa-brands fa-linkedin moderator__icons"></i></a>
                <a href="#"><i class="fa-solid fa-file-pdf moderator__icons"></i></a>
              </div>
              Lorem ipsum, dolor sit amet consectetur adipisicing elit. Excepturi omnis, quod odio praesentium rem cupiditate soluta laborum aspernatur, explicabo temporibus veritatis a cumque quas dolor libero corrupti vero dolorum consequatur! Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae voluptatem ipsam libero iure fugit facere omnis, consequuntur dolor? In aperiam pariatur ex aut vel vitae reprehenderit sunt vero modi deleniti.
              <div class="container-fluid pt-3">
                <button type="button" class="btn btn-success mx-4">Approve</button>
                <button type="button" class="btn btn-danger mx-4">Deny</button>
              </div>
            </div>
          </div>
        </div>

      </div>

      <div class="d-flex align-items-start w-100 pt-3">
        <h4>Community Requests</h4>
      </div>
      <div class="accordion w-100 row" id="community-requests">

        <div class="accordion-item">
          <div class="accordion-header">
            <button class="accordion-button collapsed py-2" type="button" data-bs-toggle="collapse" data-bs-target="#community_collapse1" aria-expanded="false" aria-controls="community_collapse1">
              <div class="d-flex align-items-center">
                <div class="d-flex align-items-center justify-content-center moderator__mentor-request-photo">
                  <img class="pe-4" src="/upload/java_icon.png" alt="Java Programming Profile Photo">
                </div>
                <h4 class="moderator__request-header ps-4 mb-0">Java Programming</h4>
              </div>
            </button>
          </div>
          <div id="community_collapse1" class="accordion-collapse collapse" data-bs-parent="#community-requests">
            <div class="accordion-body">
              <h5 class="pt-2">Requested by:</h5>
              <div class="container-fluid d-flex justify-content-start px-0 pb-3 pt-2 moderator__community-request-profile">
                <a href="#"><img class="pe-4" src="upload/sophia-lee.png" alt="Sophia Lee Profile Picture"></a>
                <h6>Sophia Lee</h6>
              </div>
              <h5 class="pt-2">Description of Community:</h5>
              I'm thrilled to propose the creation of a fantastic forum community for Java programming enthusiasts. I'm looking for a place where passionate programmers can come together to discuss, learn, and share knowledge about Java. Imagine a space brimming with like-minded individuals who are just as eager as you are to delve into the intricacies of Java programming. I want a Java community where you can initiate and participate in stimulating conversations, exchange valuable code snippets, seek advice on troubleshooting, and connect with seasoned professionals ready to mentor. Whether you're a beginner seeking guidance or a seasoned expert eager to contribute, the Java community would be a supportive environment where growth and collaboration thrive. Thank you for considering creating this exciting space for Java enthusiasts, and let's unlock endless possibilities for learning and networking within the Java community.
              <div class="container-fluid pt-3">
                <button type="button" class="btn btn-success mx-4">Approve</button>
                <button type="button" class="btn btn-danger mx-4">Deny</button>
              </div>
            </div>
          </div>
        </div>

        <div class="accordion-item">
          <div class="accordion-header">
            <button class="accordion-button collapsed py-2" type="button" data-bs-toggle="collapse" data-bs-target="#community_collapse2" aria-expanded="false" aria-controls="community_collapse2">
              <div class="d-flex align-items-center">
                <div class="d-flex align-items-center justify-content-center moderator__mentor-request-photo">
                  <img class="pe-4" src="/upload/stocks_circle.png" alt="Stock Trading Profile Photo">
                </div>
                <h4 class="moderator__request-header ps-4 mb-0">Stock Trading</h4>
              </div>
            </button>
          </div>
          <div id="community_collapse2" class="accordion-collapse collapse" data-bs-parent="#community-requests">
            <div class="accordion-body">
              <h5 class="pt-2">Requested by:</h5>
              <div class="container-fluid d-flex justify-content-start px-0 pb-3 pt-2 moderator__community-request-profile">
                <a href="#"><img class="pe-4" src="upload/mia-wilson.png" alt="Mia Wilson Profile Picture"></a>
                <h6>Mia Wilson</h6>
              </div>
              <h5 class="pt-2">Description of Community:</h5>
              Lorem ipsum, dolor sit amet consectetur adipisicing elit. Excepturi omnis, quod odio praesentium rem cupiditate soluta laborum aspernatur, explicabo temporibus veritatis a cumque quas dolor libero corrupti vero dolorum consequatur! Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae voluptatem ipsam libero iure fugit facere omnis, consequuntur dolor? In aperiam pariatur ex aut vel vitae reprehenderit sunt vero modi deleniti.
              <div class="container-fluid pt-3">
                <button type="button" class="btn btn-success mx-4">Approve</button>
                <button type="button" class="btn btn-danger mx-4">Deny</button>
              </div>
            </div>
          </div>
        </div>

        <div class="accordion-item">
          <div class="accordion-header">
            <button class="accordion-button collapsed py-2" type="button" data-bs-toggle="collapse" data-bs-target="#community_collapse3" aria-expanded="false" aria-controls="community_collapse3">
              <div class="d-flex align-items-center">
                <div class="d-flex align-items-center justify-content-center moderator__mentor-request-photo">
                  <img class="pe-4" src="/upload/coins_circle.png" alt="Coin Collecting Profile Photo">
                </div>
                <h4 class="moderator__request-header ps-4 mb-0">Coin Collecting</h4>
              </div>
            </button>
          </div>
          <div id="community_collapse3" class="accordion-collapse collapse" data-bs-parent="#community-requests">
            <div class="accordion-body">
              <h5 class="pt-2">Requested by:</h5>
              <div class="container-fluid d-flex justify-content-start px-0 pb-3 pt-2 moderator__community-request-profile">
                <a href="#"><img class="pe-4" src="upload/lucas-khan.png" alt="Lucas Khan Profile Picture"></a>
                <h6>Lucas Khan</h6>
              </div>
              <h5 class="pt-2">Description of Community:</h5>
              Lorem ipsum, dolor sit amet consectetur adipisicing elit. Excepturi omnis, quod odio praesentium rem cupiditate soluta laborum aspernatur, explicabo temporibus veritatis a cumque quas dolor libero corrupti vero dolorum consequatur! Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae voluptatem ipsam libero iure fugit facere omnis, consequuntur dolor? In aperiam pariatur ex aut vel vitae reprehenderit sunt vero modi deleniti.
              <div class="container-fluid pt-3">
                <button type="button" class="btn btn-success mx-4">Approve</button>
                <button type="button" class="btn btn-danger mx-4">Deny</button>
              </div>
            </div>
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