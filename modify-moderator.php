<?php
include('includes/session.inc.php');

if (isset($_POST['remove'])) {
  $moderatorID = $_POST['userID'];
  $sql = "UPDATE `Auth_t` SET `ModeratorStatus` = 0 WHERE `UserID` = $moderatorID";
  mysqli_query($con, $sql);
}

if (isset($_POST['username'])) {
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $phoneNumber = $_POST['tel'];
  $firstName = $_POST['firstName'];
  $lastName = $_POST['lastName'];
  $sqlAuth = "INSERT INTO `Auth_t` (`username`, `password`, `email`, `phone_number`, `ModeratorStatus`) VALUES ('$username', '$password', '$email', '$phoneNumber', 1)";
  mysqli_query($con, $sqlAuth);
  $sqlFetchUserID = "SELECT `UserID` FROM `Auth_t` WHERE `username` = '$username'";
  $sqlFetchUserIDResult = mysqli_query($con, $sqlFetchUserID);
  while ($row = mysqli_fetch_assoc($sqlFetchUserIDResult)) {
    $userID = $row['UserID'];
    $sqlUserData = "INSERT INTO `UserData_t` (`UserID`, `FirstName`, `LastName`, `ProfilePicture`, `ProfilePictureBorder`, `ProfilePictureBackground`, `Rating`, `LocationCity`, `LocationState`, `Facebook`, `Instagram`, `Twitter`, `LinkedIn`, `Mentoring`, `AboutMe`, `WorkTitle`, `WorkLocation`, `WorkStartDate`, `WorkEndDate`, `WorkDescription`, `EducationDegree`, `EducationLocation`, `EducationStartDate`, `EducationEndDate`, `EducationDescription`, `Associations`) VALUES ('$userID', '$firstName', '$lastName', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null)";
    mysqli_query($con, $sqlUserData);
  }
}

mysqli_close($con);

header('Location: admin-dashboard.php?profileID=' . $userID);
exit();
