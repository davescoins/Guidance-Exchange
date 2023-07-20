<?php
include('includes/session.inc.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $messageID = $_POST['messageID'];

  $deleteQuery = "UPDATE `Message_Recipient_t` SET `IsDeleted` = 1 WHERE `MessageID` = $messageID";

  $deleteResult = mysqli_query($con, $deleteQuery);

  if ($deleteResult) {
    $response = array('success' => true);
  } else {
    $response = array('success' => false);
    echo "Error: " . mysqli_error($con);
  }

  mysqli_close($con);

  echo json_encode($response);
} else {
  // Invalid request method
  $response = array('success' => false);
  echo json_encode($response);
}
