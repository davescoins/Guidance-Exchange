<?php
include('includes/session.inc.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  date_default_timezone_set("America/New_York");
  $message = $_POST['message'];
  $dateTime = date("Y-m-d H:i:s");
  $recipientID = $_POST['recipientID'];

  $messagesQuery = "INSERT INTO `Messages_t` (`SenderID`, `MessageBody`, `SendDate`) VALUES ('$userID', '$message', '$dateTime')";

  $messageResult = mysqli_query($con, $messagesQuery);

  if ($messageResult) {
    $messageID = mysqli_insert_id($con);
    $messageRecipientQuery = "INSERT INTO `Message_Recipient_t` (`MessageID`, `RecipientID`, `IsRead`) VALUES ('$messageID', '$recipientID', 0)";

    $recipientResult = mysqli_query($con, $messageRecipientQuery);

    if ($recipientResult) {
      $response = array('success' => true);
    } else {
      $response = array('success' => false);
    }
  } else {
    echo "Error: " . mysqli_error($con);
  }

  mysqli_close($con);

  header('Location: messages.php');
  exit();
} else {
  header('Location: messages.php');
  exit();
}