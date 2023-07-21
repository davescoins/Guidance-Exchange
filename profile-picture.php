<?php
include('includes/session.inc.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $targetDir = "upload/"; // Directory where you want to store uploaded files
  $fileName = "profilePicture_" . $userID;
  $uploadOk = 1;
  $fileType = strtolower(pathinfo($_FILES["profilePicture"]["name"], PATHINFO_EXTENSION));

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
    if (move_uploaded_file($_FILES["profilePicture"]["tmp_name"], $targetFile)) {
      echo '<p class="m-0">Your profile picture has been uploaded.</p><br><a href="edit-profile.php">Reload the page</a>';

      $sql = "UPDATE `UserData_t` SET `ProfilePicture` = '$uploadPath' WHERE `UserID` = $userID";
      mysqli_query($con, $sql);
      mysqli_close($con);
    } else {
      echo '<p style="color: red;"><em>Error: There was an error uploading your file.</em></p>';
    }
  }
}
