<?php
include('includes/session.inc.php');

// Get the search query from the AJAX request
if (isset($_POST['query'])) {
  $query = $_POST['query'];

  // Perform a search query using the user input
  if (!$userSystemAdministratorStatus) {
    $userSql = "SELECT U.`UserID`, U.`FirstName`, U.`LastName`, U.`ProfilePicture`, A.`MentorStatus`, A.`ModeratorStatus`, A.`SystemAdministratorStatus`
  FROM `UserData_t` U
  JOIN `Auth_t` A ON U.`UserID` = A.`UserID`
  WHERE U.`FullName` LIKE '%$query%'
    AND A.`SystemAdministratorStatus` <> '1' AND U.`UserID` <> $userID
  ORDER BY U.`LastName`";
  } else {
    $userSql = "SELECT U.`UserID`, U.`FirstName`, U.`LastName`, U.`ProfilePicture`, A.`MentorStatus`, A.`ModeratorStatus`, A.`SystemAdministratorStatus`
  FROM `UserData_t` U
  JOIN `auth_t` A ON U.`UserID` = A.`UserID`
  WHERE U.`FullName` LIKE '%$query%' AND U.`UserID` <> $userID
  ORDER BY U.`LastName`";
  }
  $userQueryResult = mysqli_query($con, $userSql);

  if (mysqli_num_rows($userQueryResult) > 0) {
    while ($row = mysqli_fetch_assoc($userQueryResult)) {
      echo '<li><a class="dropdown-item" data-userid="' . $row['UserID'] . '"><img class="me-2" src="upload/' . $row['ProfilePicture'] . '" alt="' . $row['FirstName'] . ' ' . $row['LastName'] . '" width="40" height="40">' . $row['FirstName'] . ' ' . $row['LastName'] . '</a></li>';
    }
  } else {
    echo '<li><a class="dropdown-item">No results found</a></li>';
  }

  mysqli_close($con);
}
