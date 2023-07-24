<?php
include('includes/session.inc.php');

if (isset($_POST['firstName'])) {
  $firstName = mysqli_real_escape_string($con, $_POST['firstName']);
} else {
  $firstName = null;
};
if (isset($_POST['lastName'])) {
  $lastName = mysqli_real_escape_string($con, $_POST['lastName']);
} else {
  $lastName = null;
};
if (isset($_POST['city']) && $_POST['city'] !== "") {
  $city = mysqli_real_escape_string($con, $_POST['city']);
} else {
  $city = null;
}
if (isset($_POST['state']) && $_POST['state'] !== "") {
  $state = mysqli_real_escape_string($con, $_POST['state']);
} else {
  $state = null;
}
if (isset($_POST['email']) && $_POST['email'] !== "") {
  $email = mysqli_real_escape_string($con, $_POST['email']);
} else {
  $email = null;
}
if (isset($_POST['facebook']) && $_POST['facebook'] !== "") {
  $facebook = mysqli_real_escape_string($con, $_POST['facebook']);
} else {
  $facebook = null;
}
if (isset($_POST['twitter']) && $_POST['twitter'] !== "") {
  $twitter = mysqli_real_escape_string($con, $_POST['twitter']);
} else {
  $twitter = null;
}
if (isset($_POST['instagram']) && $_POST['instagram'] !== "") {
  $instagram = mysqli_real_escape_string($con, $_POST['instagram']);
} else {
  $instagram = null;
}
if (isset($_POST['linkedIn']) && $_POST['linkedIn'] !== "") {
  $linkedIn = mysqli_real_escape_string($con, $_POST['linkedIn']);
} else {
  $linkedIn = null;
}
if (isset($_POST['aboutMe']) && $_POST['aboutMe'] !== "") {
  $aboutMe = mysqli_real_escape_string($con, $_POST['aboutMe']);
} else {
  $aboutMe = null;
}
if (isset($_POST['mentoring']) && $_POST['mentoring'] !== "") {
  $mentoring = mysqli_real_escape_string($con, $_POST['mentoring']);
} else {
  $mentoring = null;
}
if (isset($_POST['jobTitle']) && $_POST['jobTitle'] !== "") {
  $jobTitle = mysqli_real_escape_string($con, $_POST['jobTitle']);
} else {
  $jobTitle = null;
}
if (isset($_POST['workLocation']) && $_POST['workLocation'] !== "") {
  $workLocation = mysqli_real_escape_string($con, $_POST['workLocation']);
} else {
  $workLocation = null;
}
if (isset($_POST['workStartMonth']) && $_POST['workStartMonth'] !== "null") {
  $workStartMonth = $_POST['workStartMonth'];
} else {
  $workStartMonth = null;
}
if (isset($_POST['workStartDay']) && $_POST['workStartDay'] !== "null") {
  $workStartDay = $_POST['workStartDay'];
} else {
  $workStartDay = null;
}
if (isset($_POST['workStartYear']) && $_POST['workStartYear'] !== "null") {
  $workStartYear = $_POST['workStartYear'];
} else {
  $workStartYear = null;
}
if (isset($_POST['workEndMonth']) && $_POST['workEndMonth'] !== "null") {
  $workEndMonth = $_POST['workEndMonth'];
} else {
  $workEndMonth = null;
}
if (isset($_POST['workEndDay']) && $_POST['workEndDay'] !== "null") {
  $workEndDay = $_POST['workEndDay'];
} else {
  $workEndDay = null;
}
if (isset($_POST['workEndYear']) && $_POST['workEndYear'] !== "null") {
  $workEndYear = $_POST['workEndYear'];
} else {
  $workEndYear = null;
}
if (isset($_POST['workDescription']) && $_POST['workDescription'] !== "") {
  $workDescription = mysqli_real_escape_string($con, $_POST['workDescription']);
} else {
  $workDescription = null;
}
if (isset($_POST['degreeTitle']) && $_POST['degreeTitle'] !== "") {
  $degreeTitle = mysqli_real_escape_string($con, $_POST['degreeTitle']);
} else {
  $degreeTitle = null;
}
if (isset($_POST['educationLocation']) && $_POST['educationLocation'] !== "") {
  $educationLocation = mysqli_real_escape_string($con, $_POST['educationLocation']);
} else {
  $educationLocation = null;
}
if (isset($_POST['educationStartMonth']) && $_POST['educationStartMonth'] !== "null") {
  $educationStartMonth = $_POST['educationStartMonth'];
} else {
  $educationStartMonth = null;
}
if (isset($_POST['educationStartDay']) && $_POST['educationStartDay'] !== "null") {
  $educationStartDay = $_POST['educationStartDay'];
} else {
  $educationStartDay = null;
}
if (isset($_POST['educationStartYear']) && $_POST['educationStartYear'] !== "null") {
  $educationStartYear = $_POST['educationStartYear'];
} else {
  $educationStartYear = null;
}
if (isset($_POST['educationEndMonth']) && $_POST['educationEndMonth'] !== "null") {
  $educationEndMonth = $_POST['educationEndMonth'];
} else {
  $educationEndMonth = null;
}
if (isset($_POST['educationEndDay']) && $_POST['educationEndDay'] !== "null") {
  $educationEndDay = $_POST['educationEndDay'];
} else {
  $educationEndDay = null;
}
if (isset($_POST['educationEndYear']) && $_POST['educationEndYear'] !== "null") {
  $educationEndYear = $_POST['educationEndYear'];
} else {
  $educationEndYear = null;
}
if (isset($_POST['educationDescription']) && $_POST['educationDescription'] !== "") {
  $educationDescription = mysqli_real_escape_string($con, $_POST['educationDescription']);
} else {
  $educationDescription = null;
}
if (isset($_POST['overlay']) && $_POST['overlay'] !== "") {
  $overlay = mysqli_real_escape_string($con, $_POST['overlay']);
} else {
  $overlay = null;
}
if (isset($_POST['profilePictureBorder']) && $_POST['profilePictureBorder'] !== "") {
  $profilePictureBorder = $_POST['profilePictureBorder'];
} else {
  $profilePictureBorder = null;
}
if (isset($_POST['skills']) && $_POST['skills'] !== "null") {
  $skills = $_POST['skills'];
} else {
  $skills = null;
}

$sqlAuthUpdate = "UPDATE `Auth_t` SET email='$email' WHERE `UserID`=$userID";
mysqli_query($con, $sqlAuthUpdate);

if ($workStartYear === null || $workStartMonth === null || $workStartDay === null) {
  $workStartDate = null;
} else {
  $workStartDate = $workStartYear . '-' . $workStartMonth . '-' . $workStartDay;
}

if ($workEndYear === null || $workEndMonth === null || $workEndDay === null) {
  $workEndDate = null;
} else {
  $workEndDate = $workEndYear . '-' . $workEndMonth . '-' . $workEndDay;
}

if ($educationStartYear === null || $educationStartMonth === null || $educationStartDay === null) {
  $educationStartDate = null;
} else {
  $educationStartDate = $educationStartYear . '-' . $educationStartMonth . '-' . $educationStartDay;
}

if ($educationEndYear === null || $educationEndMonth === null || $educationEndDay === null) {
  $educationEndDate = null;
} else {
  $educationEndDate = $educationEndYear . '-' . $educationEndMonth . '-' . $educationEndDay;
}

$sqlUserDataUpdate = "UPDATE `UserData_t` SET FirstName='$firstName', LastName='$lastName', ";
if ($overlay === null) {
  $sqlUserDataUpdate .= "ProfilePictureBackground = NULL, ";
} else {
  $sqlUserDataUpdate .= "ProfilePictureBackground = '$overlay', ";
}
if ($profilePictureBorder === null) {
  $sqlUserDataUpdate .= "ProfilePictureBorder = NULL, ";
} else {
  $sqlUserDataUpdate .= "ProfilePictureBorder = '$profilePictureBorder', ";
}
if ($city === null) {
  $sqlUserDataUpdate .= "LocationCity = NULL, ";
} else {
  $sqlUserDataUpdate .= "LocationCity = '$city', ";
}
if ($state === null) {
  $sqlUserDataUpdate .= "LocationState = NULL, ";
} else {
  $sqlUserDataUpdate .= "LocationState = '$state', ";
}
if ($facebook === null) {
  $sqlUserDataUpdate .= "Facebook = NULL, ";
} else {
  $sqlUserDataUpdate .= "Facebook = '$facebook', ";
}
if ($twitter === null) {
  $sqlUserDataUpdate .= "Twitter = NULL, ";
} else {
  $sqlUserDataUpdate .= "Twitter = '$twitter', ";
}
if ($linkedIn === null) {
  $sqlUserDataUpdate .= "LinkedIn = NULL, ";
} else {
  $sqlUserDataUpdate .= "LinkedIn = '$linkedIn', ";
}
if ($aboutMe === null) {
  $sqlUserDataUpdate .= "AboutMe = NULL, ";
} else {
  $sqlUserDataUpdate .= "AboutMe = '$aboutMe', ";
}
if ($mentoring === null) {
  $sqlUserDataUpdate .= "Mentoring = NULL, ";
} else {
  $sqlUserDataUpdate .= "Mentoring = '$mentoring', ";
}
if ($jobTitle === null) {
  $sqlUserDataUpdate .= "WorkTitle = NULL, ";
} else {
  $sqlUserDataUpdate .= "WorkTitle = '$jobTitle', ";
}
if ($workLocation === null) {
  $sqlUserDataUpdate .= "WorkLocation = NULL, ";
} else {
  $sqlUserDataUpdate .= "WorkLocation = '$workLocation', ";
}
if ($workStartDate === null) {
  $sqlUserDataUpdate .= "WorkStartDate = NULL, ";
} else {
  $sqlUserDataUpdate .= "WorkStartDate = '$workStartDate', ";
}
if ($workEndDate === null) {
  $sqlUserDataUpdate .= "WorkEndDate = NULL, ";
} else {
  $sqlUserDataUpdate .= "WorkEndDate = '$workEndDate', ";
}
if ($workDescription === null) {
  $sqlUserDataUpdate .= "WorkDescription = NULL, ";
} else {
  $sqlUserDataUpdate .= "WorkDescription = '$workDescription', ";
}
if ($degreeTitle === null) {
  $sqlUserDataUpdate .= "EducationDegree = NULL, ";
} else {
  $sqlUserDataUpdate .= "EducationDegree = '$degreeTitle', ";
}
if ($educationLocation === null) {
  $sqlUserDataUpdate .= "EducationLocation = NULL, ";
} else {
  $sqlUserDataUpdate .= "EducationLocation = '$educationLocation', ";
}
if ($educationStartDate === null) {
  $sqlUserDataUpdate .= "educationStartDate = NULL, ";
} else {
  $sqlUserDataUpdate .= "educationStartDate = '$educationStartDate', ";
}
if ($educationEndDate === null) {
  $sqlUserDataUpdate .= "educationEndDate = NULL, ";
} else {
  $sqlUserDataUpdate .= "educationEndDate = '$educationEndDate', ";
}
if ($educationDescription === null) {
  $sqlUserDataUpdate .= "EducationDescription = NULL ";
} else {
  $sqlUserDataUpdate .= "EducationDescription = '$educationDescription' ";
}
$sqlUserDataUpdate .= "WHERE `UserID`=$userID";

mysqli_query($con, $sqlUserDataUpdate);

$qualificationsSql = "SELECT * FROM `Qualifications_t` WHERE `UserID` = $userID";
$qualificationsResult = mysqli_query($con, $qualificationsSql);
$qualificationsArray = array();
while ($qualifications = mysqli_fetch_assoc($qualificationsResult)) {
  $qualificationsArray[] = $qualifications['SkillID'];
}

if ($skills === null) {
  foreach ($qualificationsArray as $skill) {
    $skillRemoveQuery = "DELETE FROM `Qualifications_t` WHERE `UserID` = $userID AND `SkillID` = $skill";
    mysqli_query($con, $skillRemoveQuery);
  }
} else {

  $skillsToAdd = array_diff($skills, $qualificationsArray);
  $skillsToRemove = array_diff($qualificationsArray, $skills);

  foreach ($skillsToAdd as $skill) {
    $skillAddQuery = "INSERT INTO `Qualifications_t` (`UserID`, `SkillID`) VALUES ($userID, $skill)";
    mysqli_query($con, $skillAddQuery);
  }

  foreach ($skillsToRemove as $skill) {
    $skillRemoveQuery = "DELETE FROM `Qualifications_t` WHERE `UserID` = $userID AND `SkillID` = $skill";
    mysqli_query($con, $skillRemoveQuery);
  }
}

mysqli_close($con);

header('Location: profile.php?profileID=' . $userID);
exit();
