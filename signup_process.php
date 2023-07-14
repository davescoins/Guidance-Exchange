<?php
include('includes/connect.inc.php');

if (mysqli_connect_errno()) {
    echo "Failed to connect" . mysqli_connect_errno();
}
if (mysqli_ping($con)) {
    echo "The connection to your datbase" . $dbname . " is working!";
    echo "<br> <br> <br>";
    if (isset($_POST['Register'])) {

        echo "<p>" .  print_r($_POST) . "</p>";
        // $userAccountdetail will hold userName, PW, Email and Phone
        // $userAccountdetail = array();

        // $userInfo will hold the rest of the form data for general details 
        // $userInfo = array();
        $userType = $_POST['userType'];
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $city = $_POST['userCity'];
        $state = $_POST['userState'];
        $loginUserName = $_POST['userName'];
        $loginPassword = $_POST['userPassword'];
        $email = $_POST['userEmail'];
        $phoneNumber = $_POST['userPhone'];
        $userFaceBook = $_POST['userFaceBook'];
        $userTwitter = $_POST['userTwitter'];
        $userInstagram = $_POST['userInstagram'];
        $userLinkedIn = $_POST['userLinkedIn'];
        $mentoringDetails = $_POST['mentoringDetails'];
        $aboutMe = $_POST['aboutMe'];
        $userWorkLocation = $_POST['userWork'];
        $userWork_from = $_POST['workFrom'];
        $userWork_end = $_POST['workEnd'];
        $userEducation = $_POST['userEducation'];
        $EducationFrom = $_POST['EducationFrom'];
        $EducationEnd = $_POST['EducationEnd'];
        $mentoringUpload = $_POST['mentoringUpload'];

        // Sql query to auth table return UseId

        $sql_auth = "INSERT INTO auth_t
            ( 
            username, 
            password,
            email, 
            phone_number)
        VALUES 
            ('" . $loginUserName . "', 
            '" . $loginPassword . "', 
            '" . $email . "', 
            '" . $phoneNumber . "'
            );
        
        ";

        $rStatus = $con->query($sql_auth);
        $user_id = $con->insert_id;

        $sql_userT = "
            INSERT INTO userdata_t 
                (UserID,
                MentorStatus, 
                FirstName, 
                LastName,
                LocationCity, 
                LocationState, 
                Facebook,
                Twitter,
                Instagram,
                LinkedIn,
                Mentoring,
                AboutMe,
                WorkLocation,
                WorkStartDate,
                WorkEndDate,
                EducationLocation,
                EducationStartDate,
                EducationEndDate
               )
            VALUES 
                ( '" . $user_id . "', 
                    '" . $userType . "', 
                '" . $firstName . "', 
                '" . $lastName . "', 
                '" . $city . "', 
                '" . $state . "', 
                '" . $userFaceBook . "',
                '" . $userTwitter . "',
                '" . $userInstagram . "',
                '" . $userLinkedIn . "',
                '" . $mentoringDetails . "',
                '" . $aboutMe . "',
                '" . $userWorkLocation . "',
                " . ($userWork_from ? "'" . $userWork_from  . "'" : 'NULL') . ",
                " . ($userWork_end ? "'" . $userWork_end . "'" : 'NULL') . ", 
                '" . $userEducation . "',
                " . ($EducationFrom ? "'" . $EducationFrom . "'" : 'NULL') . ", 
                " . ($EducationEnd ? "'" . $EducationEnd . "'" : 'NULL') . "
            
            );
            ";
        
            
            if ($con->query($sql_userT) === TRUE) {
                $last_id = $con->insert_id;
                echo "New record created successfully. Last inserted ID is: " . $last_id;

                    // Login
                        $errors = array('uname' => '', 'pwd' => '');
                        $uname = '';

                        $uname = htmlspecialchars($loginUserName);
                        $pwd = htmlspecialchars($loginPassword);


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
    
                        if (empty($errors['uname']) && empty($errors['pwd'])) {


                            session_start();
                        
                            $_SESSION['uname'] = $uname;
                        
                            $_SESSION['UserID'] = $user['UserID'];
                        
                            header("Location:/home.php?signup=success");
                            exit();

                                       }

                        
            } else {
                echo "Error: " . $sql_auth . "<br>" . $con->error;
            }
            

            

echo $sql_auth;

        echo " <br>";

echo  $sql_userT;
// mysqli_query($con, $sql);

        header("Location:/home.php?signup=success");

    }
} else {
    echo "Error: " . mysqli_error($con);
}
mysqli_close($con);
