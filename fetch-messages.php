<?php
include('includes/session.inc.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $senderID = $_POST['senderID'];

  $sql = "SELECT R.`RecipientID`, M.`SenderID`, M.`MessageBody`, M.`SendDate`, U.`FirstName`, U.`LastName`, U.`ProfilePicture` FROM `Message_Recipient_t` R JOIN `Messages_t` M ON R.`MessageID` = M.`MessageID` JOIN `UserData_t` U ON U.`UserID` = M.`SenderID` WHERE (`RecipientID` = $senderID AND `SenderID` = $userID) OR (`RecipientID` = $userID AND `SenderID` = $senderID) ORDER BY M.`SendDate`";
  $result = mysqli_query($con, $sql);

  if ($result) {
    $messageTitleSet = false;
    $messages = '';
    $messageTitle = '';

    while ($message = mysqli_fetch_assoc($result)) {
      if (!$messageTitleSet && $message['SenderID'] != $userID) {
        $messageTitle .= '<div class="position-relative">';
        $messageTitle .= '<img src="upload/' . $message['ProfilePicture'] . '" class="rounded-circle mr-1" alt="' . $message['FirstName'] . ' ' . $message['LastName'] . '" width="40" height="40">';
        $messageTitle .= '</div>';
        $messageTitle .= '<div class="flex-grow-1 ps-3">';
        $messageTitle .= '<strong>' . $message['FirstName'] . ' ' . $message['LastName'] . '</strong>';
        $messageTitle .= '</div>';
        $messageTitle .= '<div>';
        $messageTitle .= '<button class="btn main-button me-3 btn-long">New Message</button>';
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
        $messages .= '<div class="flex-shrink-1 bg-light rounded py-2 px-3 me-3">';
        $messages .= $message['MessageBody'];
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
        $messages .= $message['MessageBody'];
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
