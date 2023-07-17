<?php
include('includes/session.inc.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $senderID = $_POST['senderID'];

  $sql = "SELECT R.`RecipientID`, R.`IsDeleted`, M.`MessageID`, M.`SenderID`, M.`MessageBody`, M.`SendDate`, U.`FirstName`, U.`LastName`, U.`ProfilePicture` FROM `Message_Recipient_t` R JOIN `Messages_t` M ON R.`MessageID` = M.`MessageID` JOIN `UserData_t` U ON U.`UserID` = M.`SenderID` WHERE (`RecipientID` = $senderID AND `SenderID` = $userID) OR (`RecipientID` = $userID AND `SenderID` = $senderID) ORDER BY M.`SendDate`";
  $result = mysqli_query($con, $sql);

  // Get the all messages where user is recipient or sender
  $sqlMessages = "SELECT R.`RecipientID`, M.`SenderID` FROM `Message_Recipient_t` R JOIN `Messages_t` M ON R.`MessageID` = M.`MessageID` WHERE `RecipientID` = $userID OR `SenderID` = $userID ORDER BY M.`SendDate`";
  $resultMessages = mysqli_query($con, $sqlMessages);

  if (mysqli_num_rows($resultMessages) > 0) {
    $messagesArray = array();
    while ($messages = mysqli_fetch_assoc($resultMessages)) {
      $messagesArray[] = array('RecipientID' => $messages['RecipientID'], 'SenderID' => $messages['SenderID']);
    }

    $uniqueUsers = array();
    foreach ($messagesArray as $message) {
      $test = $message['SenderID'];
      $recipientID = $message['RecipientID'];
      if ($test != $userID && !in_array($test, $uniqueUsers)) {
        $uniqueUsers[] = $test;
      }
      if ($recipientID != $userID && !in_array($recipientID, $uniqueUsers)) {
        $uniqueUsers[] = $recipientID;
      }
    }

    $senderData = array();
    foreach ($uniqueUsers as $user) {
      $sqlSender = "SELECT `UserID`, `FirstName`, `LastName`, `ProfilePicture` FROM `UserData_t` WHERE `UserID` = $user";
      $resultSender = mysqli_query($con, $sqlSender);
      while ($row = mysqli_fetch_assoc($resultSender)) {
        $senderData[$row['UserID']] = array('FirstName' => $row['FirstName'], 'LastName' => $row['LastName'], 'ProfilePicture' => $row['ProfilePicture']);
      }
    }
  } else {
    $messagesArray = null;
  }

  if ($result) {
    $messageTitleSet = false;
    $messages = '';
    $messageTitle = '';

    while ($message = mysqli_fetch_assoc($result)) {
      if (!$messageTitleSet) {
        $messageTitle .= '<div class="position-relative">';
        $messageTitle .= '<img src="upload/' . $senderData[$senderID]['ProfilePicture'] . '" class="rounded-circle mr-1" alt="' . $senderData[$senderID]['FirstName'] . ' ' . $senderData[$senderID]['LastName'] . '" width="40" height="40">';
        $messageTitle .= '</div>';
        $messageTitle .= '<div class="flex-grow-1 ps-3">';
        $messageTitle .= '<strong>' . $senderData[$senderID]['FirstName'] . ' ' . $senderData[$senderID]['LastName'] . '</strong>';
        $messageTitle .= '</div>';

        $messageTitleSet = true;
      }

      if ($message['SenderID'] == $userID) {
        $messages .= '<div class="message-right pb-4">';
        $messages .= '<div>';
        $messages .= '<img src="upload/' . $message['ProfilePicture'] . '" class="rounded-circle me-1" alt="' . $message['FirstName'] . ' ' . $message['LastName'] . '" width="40" height="40">';
        $messages .= '<div class="text-muted small text-nowrap mt-2">' . date_format(date_create($message['SendDate']), "g:i a") . '</div>';
        $messages .= '<div class="text-muted small text-nowrap mt-2">' . date_format(date_create($message['SendDate']), "n/j/y") . '</div>';
        $messages .= '</div>';
        $messages .= '<div class="flex-shrink-1 bg-light rounded py-2 px-3 me-3 message-body-right">';
        if ($message['IsDeleted']) {
          $messages .= '<p class="deleted"><em>Message has been deleted!</em></p>';
        } else {
          $messages .= $message['MessageBody'];
          $messages .= '<form action="delete-message.php" method="POST" class="d-flex justify-content-end delete-form">';
          $messages .= '<input id="messageID" type="hidden" name="messageID" value="' . $message['MessageID'] . '">';
          $messages .= '</form>';
        }
        $messages .= '</div>';
        $messages .= '</div>';
      } else {
        $messages .= '<div class="message-left pb-4">';
        $messages .= '<div>';
        $messages .= '<img src="upload/' . $message['ProfilePicture'] . '" class="rounded-circle me-1" alt="' . $message['FirstName'] . ' ' . $message['LastName'] . '" width="40" height="40">';
        $messages .= '<div class="text-muted small text-nowrap mt-2">' . date_format(date_create($message['SendDate']), "g:i a") . '</div>';
        $messages .= '<div class="text-muted small text-nowrap mt-2">' . date_format(date_create($message['SendDate']), "n/j/y") . '</div>';
        $messages .= '</div>';
        $messages .= '<div class="flex-shrink-1 bg-light rounded py-2 px-3 ms-3">';
        if ($message['IsDeleted']) {
          $messages .= '<p class="deleted"><em>Message has been deleted!</em></p>';
        } else {
          $messages .= $message['MessageBody'];
        }
        $messages .= '</div>';
        $messages .= '</div>';
      }
    }

    $response = array('success' => true, 'messages' => $messages, 'messageTitle' => $messageTitle);
  } else {
    $response = array('success' => false);
  }
  mysqli_close($con);
  echo json_encode($response);
} else {
  // Invalid request method
  $response = array('success' => false);
  mysqli_close($con);
  echo json_encode($response);
}
