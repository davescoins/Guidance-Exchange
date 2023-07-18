<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Guidance Exchange | Mentor sign up</title>

    <link href="assets\fontawesome\css\fontawesome.css" rel="stylesheet">
    <link href="assets\fontawesome\css\brands.css" rel="stylesheet">
    <link href="assets\fontawesome\css\solid.css" rel="stylesheet">
    <link href="assets\bootstrap\css\bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
    <link rel="stylesheet" href="css/main.css" />
    <link rel="stylesheet" href="css/home_signup.css" />
</head>

<header>
    <?php
    include('includes/connect.inc.php');
    ?>
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
        <div class="hero home-hero bg-hero-form-section">
            <div id="home-hero-text form-hero-text" class="text-center">
                <h1 class="text-white">Sign Up!</h1>
                <p class="text-light container-sm  mb-3 mt-5">Join our mentoring platform and be a part of a global network that thrives on collaboration, knowledge sharing, and the power of mentorship. Together, we can build a brighter future, one connection at a time.</p>
                <br>
            </div>
        </div>
    </section>

    <Section>
        <?php

        // Create an associative array for all of the skills in the database
        $sqlSkills = "SELECT * FROM `Skills_t`";
        $skillsResult = mysqli_query($con, $sqlSkills);
        $allSkillsArray = array();

        while ($fetchSkills = mysqli_fetch_assoc($skillsResult)) {
            $skillID = $fetchSkills['SkillID'];
            $allSkillsArray[$skillID] = array(
                'SkillName' => $fetchSkills['SkillName'],
                'SkillGroup' => $fetchSkills['SkillGroup']
            );
        }
        ?>

        <form class="needs-validation" id="signupForm" method="POST" action="signup_process.php" role="form" data-toggle="validator" novalidate>
            <div class="container container-singupform py-4">

                <div class="row py-2">
                    <div class="col-12">
                        <p> What do you want to sign up as?</p>
                        <select class="form-select was-validated" id="userType" name="userType" onchange="toggleFields()">
                            <option value="1">Mentor</option>
                            <option value="0" selected>Mentee</option>

                        </select>
                    </div>
                </div>

                <div class="row py-2">
                    <div class="col-12 col-lg-6">
                        <label for="firstName" class="form-label text-signup-label"> First Name</label>
                        <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Enter First Name" required>
                        <div class="invalid-feedback">
                        First Name is required.
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <label for="lastName" class="form-label text-signup-label"> Last Name</label>
                        <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Enter Last Name" required>
                        <div class="invalid-feedback">
                        Last name is required.
                        </div>
                    </div>
                </div>
                <div class="row py-2">
                    <div class="col-12 col-lg-6">
                        <label for="userCity" class="form-label text-signup-label">City</label>
                        <input type="text" class="form-control" id="userCity" name="userCity" placeholder="Enter City">

                    </div>
                    <div class="col-12 col-lg-6">
                        <label for="userState" class="form-label text-signup-label"> State</label>
                        <select class="form-select" aria-label="Select City" id="userState" name="userState">
                            <option value="Alabama">Select a state</option>
                            <option value="Alabama">Alabama</option>
                            <option value="Alaska">Alaska</option>
                            <option value="Arizona">Arizona</option>
                            <option value="Arkansas">Arkansas</option>
                            <option value="California">California</option>
                            <option value="Colorado">Colorado</option>
                            <option value="Connecticut">Connecticut</option>
                            <option value="Delaware">Delaware</option>
                            <option value="District of Columbia">District of Columbia</option>
                            <option value="Florida">Florida</option>
                            <option value="Georgia">Georgia</option>
                            <option value="Guam">Guam</option>
                            <option value="Hawaii">Hawaii</option>
                            <option value="Idaho">Idaho</option>
                            <option value="Illinois">Illinois</option>
                            <option value="Indiana">Indiana</option>
                            <option value="Iowa">Iowa</option>
                            <option value="Kansas">Kansas</option>
                            <option value="Kentucky">Kentucky</option>
                            <option value="Louisiana">Louisiana</option>
                            <option value="Maine">Maine</option>
                            <option value="Maryland">Maryland</option>
                            <option value="Massachusetts">Massachusetts</option>
                            <option value="Michigan">Michigan</option>
                            <option value="Minnesota">Minnesota</option>
                            <option value="Mississippi">Mississippi</option>
                            <option value="Missouri">Missouri</option>
                            <option value="Montana">Montana</option>
                            <option value="Nebraska">Nebraska</option>
                            <option value="Nevada">Nevada</option>
                            <option value="New Hampshire">New Hampshire</option>
                            <option value="New Jersey">New Jersey</option>
                            <option value="New Mexico">New Mexico</option>
                            <option value="New York">New York</option>
                            <option value="North Carolina">North Carolina</option>
                            <option value="North Dakota">North Dakota</option>
                            <option value="Northern Marianas Islands">Northern Marianas Islands</option>
                            <option value="Ohio">Ohio</option>
                            <option value="Oklahoma">Oklahoma</option>
                            <option value="Oregon">Oregon</option>
                            <option value="Pennsylvania">Pennsylvania</option>
                            <option value="Puerto Rico">Puerto Rico</option>
                            <option value="Rhode Island">Rhode Island</option>
                            <option value="South Carolina">South Carolina</option>
                            <option value="South Dakota">South Dakota</option>
                            <option value="Tennessee">Tennessee</option>
                            <option value="Texas">Texas</option>
                            <option value="Utah">Utah</option>
                            <option value="Vermont">Vermont</option>
                            <option value="Virginia">Virginia</option>
                            <option value="Virgin Islands">Virgin Islands</option>
                            <option value="Washington">Washington</option>
                            <option value="West Virginia">West Virginia</option>
                            <option value="Wisconsin">Wisconsin</option>
                            <option value="Wyoming">Wyoming</option>
                        </select>

                        </select>
                    </div>
                </div>
                <div class="mx-auto my-3 w-75 border-bottom border border-secondary">
                </div>

                <!-- Login Information -->

                <div class="row py-2">
                    <div class="col text-center  text-signup-label">
                        <h5>Login Information</h5>
                    </div>
                </div>
                <div class="row py-2">
                    <div class="col-12 col-lg-6">
                        <label for="userName" class="form-label text-signup-label"> User Name</label>
                        <input type="text" class="form-control" id="userName" name="userName" placeholder="Enter your User Name" required>
                        <div class="invalid-feedback">
                        User Name is required.
                        </div>
                    </div>
                    <div class="col">
                        <label for="userPassword" class="form-label text-signup-label"> Password</label>
                        <input type="password" class="form-control" id="userPassword" name="userPassword" placeholder="Enter your Password " required>
                        <div class="invalid-feedback">
                        Password is required.
                        </div>
                    </div>
                </div>
                <div class="row py-2">
                    <div class="col-12 col-lg-6">

                        <label for="userEmail" class="form-label text-signup-label">Email address</label>
                        <input type="email" class="form-control" id="userEmail" name="userEmail" placeholder="email@example.com" required>
                        <div class="invalid-feedback">
                        Email address is required.
                        </div>
                    </div>
                    <div class="col">
                        <label for="userPhone" class="form-label text-signup-label">Phone number</label>
                        <input type="tel" class="form-control" id="userPhone" name="userPhone" placeholder="(111)-111-1111">
                    </div>
                </div>
                <div class="mx-auto my-3 w-75 border-bottom border border-secondary">
                </div>

                <!-- Social media section -->

                <div class="row py-2">
                    <div class="col text-center  text-signup-label">
                        <h5>Socials</h5>
                    </div>
                </div>
                <div class="row py-2">
                    <div class="col-12 col-lg-6">

                        <label for="userLinkedIn" class="form-label text-signup-label">LinkedIn</label>
                        <input type="text" class="form-control" id="userLinkedIn" name="userLinkedIn" placeholder="https://www.linkedin.com/in/user123">
                    </div>
                    <div class="col">

                        <label for="userTwitter" class="form-label text-signup-label">Twitter</label>
                        <input type="text" class="form-control" id="userTwitter" name="userTwitter" placeholder="https://twitter.com/123">
                    </div>
                </div>
                <div class="row py-2">
                    <div class="col-12 col-lg-6">

                        <label for="userFaceBook" class="form-label text-signup-label">Facebook</label>
                        <input type="text" class="form-control" id="userFaceBook" name="userFaceBook" placeholder="https://www.facebook.com/123">
                    </div>
                    <div class="col">

                        <label for="userInstagram" class="form-label text-signup-label">Instagram</label>
                        <input type="text" class="form-control" id="userInstagram" name="userInstagram" placeholder="https://www.instagram.com/123">
                    </div>
                </div>
                <div class="mx-auto my-3 w-75 border-bottom border border-secondary">
                </div>

                <!-- Details section -->

                <div class="row py-2">
                    <div class="col text-center  text-signup-label">
                        <h5>Details</h5>
                    </div>
                </div>
                <div class="row py-2">
                    <div class="col-12 col-lg-6">
                        <label for="userInstagram" class="form-label text-signup-label">Work</label>
                        <input type="text" class="form-control" id="userWork" name="userWork" placeholder="Enter your employer name">
                    </div>
                    <div class="col-12 col-lg-3">

                        <label for="workFrom" class="form-label text-signup-label">From</label>
                        <input type="date" class="form-control" id="workFrom" name="workFrom" placeholder="Select year">
                    </div>
                    <div class="col-12 col-lg-3">
                        <label for="workEnd" class="form-label text-signup-label">To</label>
                        <input type="date" class="form-control" id="workEnd" name="workEnd" placeholder="Select year">
                    </div>
                </div>

                <div class="row py-2">
                    <div class="col-12 col-lg-6">
                        <label for="userEducation" class="form-label text-signup-label">Education</label>
                        <input type="text" class="form-control" id="userEducation" name="userEducation" placeholder="Enter your school name">
                    </div>
                    <div class="col-12 col-lg-3">

                        <label for="EducationFrom" class="form-label text-signup-label">From</label>
                        <input type="date" class="form-control" id="EducationFrom" name="EducationFrom" placeholder="Select year">
                    </div>
                    <div class="col-12 col-lg-3">
                        <label for="EducationEnd" class="form-label text-signup-label">To</label>
                        <input type="date" class="form-control" id="EducationEnd" name="EducationEnd" placeholder="Select year">
                    </div>
                </div>

                <div class="row py-2">
                    <div class="col-12 col-lg-6">
                        <label class="text-signup-label" for="Skills">Select Skills:</label>
                        <br>
                        <select id="choices-multiple-remove-button" name="skills[]" class="form-select mb-3" multiple>
                            <option value="">Select Skills...</option>
                            <?php
                            foreach ($allSkillsArray as $skillID => $skill) {
                                // $selected = in_array($skillID, $qualificationsArray) ? 'selected' : '';
                                if (!isset($currentGroup) || $currentGroup !== $skill['SkillGroup']) {
                                    if (isset($currentGroup)) {
                                        echo '</optgroup>';
                                    }
                                    $currentGroup = $skill['SkillGroup'];
                                    echo '<optgroup label="' . $currentGroup . '">';
                                }
                                echo '<option value="' . $skillID . '" >' . $skill['SkillName'] . '</option>';
                            }
                            echo '</optgroup>';
                            ?>
                        </select>

                    </div>
                </div>

                <!-- About Me section-->

                <div class="row py-2">
                    <div class="col-12">
                        <label for="aboutMe" class="form-label text-signup-label">About Me</label>
                        <textarea rows="3" class="form-control" id="aboutMe" name="aboutMe" placeholder="Provide a short bio about your life/experience."> </textarea>
                    </div>
                </div>

                <!-- Section below only for Mentors -->
                <div class="row py-2" id="mentorOnlySection">

                </div>

                <div class="row my-5">
                    <div class="col text-center">
                        <input type="submit" name="Register" value="Register" class="btn main-button">
                        </input>
                    </div>
                </div>
            </div>
        </form>

    </Section>

    <script src="assets\bootstrap\js\bootstrap.bundle.min.js"></script>
    <script src="assets\jquery\jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    <script src="https://kit.fontawesome.com/c5863419fe.js" crossorigin="anonymous"></script>
    <script src="js/form_city_country.js"></script>
    <script src="js/signup.js" lang="javascript">
    </script>
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
})()
    </script>
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