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
        $mentoringStatement = $_POST['mentoringStatement'];
        $mentoringUpload = NULL;

        if (isset($_POST['skills'])) {
            $skills = array();
            $skills = $_POST['skills'];
        } else {
            $skills = null;
        }


        // $ModeratorStatus = 0;
        // $SystemAdministratorStatus = 0;


        // Sql query to auth table return UseId

        $sql_auth = "INSERT INTO auth_t
            ( 
            username, 
            password,
            email, 
            phone_number
            -- MentorStatus
            -- ModeratorStatus, 
            -- SystemAdministratorStatus
            )
        VALUES 
            ('" . $loginUserName . "', 
            '" . $loginPassword . "', 
            '" . $email . "', 
            '" . $phoneNumber . "'


            );
        
        ";

        echo "<br> this is the auth query" . $sql_auth;

        $rStatus = $con->query($sql_auth);
        $user_id = $con->insert_id;

        $sql_userT = "
            INSERT INTO userdata_t 
                (UserID,
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

        if ($skills != null) {
            foreach ($skills as $skillData) {
                $skillsSQL = "INSERT INTO `Qualifications_t` (`UserID`, `SkillID`) VALUES ('$user_id', '$skillData')";
                mysqli_query($con, $skillsSQL);
            }
        }

        if ($userType) {


            $sql_mentorrequests = "INSERT INTO mentorrequests_t
    ( 
        UserID, 
        ResumeLocation,
        MentorStatement

    )
VALUES 
    ('" . $user_id . "', 
    '" . $mentoringUpload . "', 
    '" .  $mentoringStatement . "'

    );

";

            echo "<br> this is the auth query" .  $sql_mentorrequests;

            $rStatus = $con->query($sql_mentorrequests);

            if (isset($_FILES["mentoringUpload"])) {
                $targetDir = "upload/"; // Directory where you want to store uploaded files
                $fileName = "mentoringUpload_" . $user_id;
                $uploadOk = 1;
                $fileType = strtolower(pathinfo($_FILES["mentoringUpload"]["name"], PATHINFO_EXTENSION));

                $targetFile = $targetDir . $fileName . '.' . $fileType;
                $uploadPath = $fileName . '.' . $fileType;

                // Remove the existing file if it exists
                if (file_exists($targetFile)) {
                    if (!unlink($targetFile)) {
                        echo '<p style="color: red;"><em>Error: Cannot remove the existing file.</em></p>';
                        $uploadOk = 0;
                    }
                }

                // If no errors, move the file to the specified directory
                if ($uploadOk == 1) {
                    if (move_uploaded_file($_FILES["mentoringUpload"]["tmp_name"], $targetFile)) {
                        $sqlResume = "UPDATE `MentorRequests_t` SET `ResumeLocation` = '$uploadPath' WHERE `UserID` = $user_id";
                        mysqli_query($con, $sqlResume);
                    } else {
                        echo 'error';
                    }
                }
            }
        };




        echo "<br> <br>this is for user table" . $sql_userT;

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

                // $_SESSION['uname'] = $uname;

                $_SESSION['UserID'] = $user['UserID'];

                $_SESSION['MentorStatus'] = $user['MentorStatus'];

                $_SESSION['ModeratorStatus'] = $user['ModeratorStatus'];

                $_SESSION['SystemAdministratorStatus'] = $user['SystemAdministratorStatus'];

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
