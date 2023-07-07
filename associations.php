<?php
include('includes/session.inc.php');

$query = $_POST['query'];
$association = $_POST['association'];
$update = $_POST['update'];

// Get other user's associations
$sqlAssociations = "SELECT `Associations` FROM `UserData_t` WHERE `UserID` = $association";
$resultAssociations = mysqli_query($con, $sqlAssociations);

if (mysqli_num_rows($resultAssociations) > 0) {
  while ($profile = mysqli_fetch_assoc($resultAssociations)) {
    $otherAssociations = $profile['Associations'];
    $otherAssociationsArray = explode(";", $otherAssociations ?? '');
  }
} else {
  $otherAssociationsArray = null;
}

if ($update == 'add') {
  if ($associationsArray == null) {
    $associationsArray = array();
  }
  $associationsArray[] = $association;
  $otherAssociationsArray[] = $userID;
  $associationsPrep = implode(';', $associationsArray);
  $otherAssociationsPrep = implode(';', $otherAssociationsArray);
  $sqlSelf = "UPDATE `UserData_t` SET `Associations` = '$associationsPrep' WHERE `UserID` = $userID";
  $sqlOther = "UPDATE `UserData_t` SET `Associations` = '$otherAssociationsPrep' WHERE `UserID` = $association";
} else {
  $indexSelf = array_search($association, $associationsArray);
  $indexOther = array_search($userID, $otherAssociationsArray);
  if ($indexSelf !== false) {
    unset($associationsArray[$indexSelf]);
  }
  if ($indexOther !== false) {
    unset($otherAssociationsArray[$indexOther]);
  }
  $associationsPrep = implode(';', $associationsArray);
  $otherAssociationsPrep = implode(';', $otherAssociationsArray);
  $sqlSelf = "UPDATE `UserData_t` SET `Associations` = '$associationsPrep' WHERE `UserID` = $userID";
  $sqlOther = "UPDATE `UserData_t` SET `Associations` = '$otherAssociationsPrep' WHERE `UserID` = $association";
}

$_SESSION['Associations'] = $associationsArray;

mysqli_query($con, $sqlSelf);
mysqli_query($con, $sqlOther);

mysqli_close($con);

header("Location: search.php?query=" . $query);
exit();
