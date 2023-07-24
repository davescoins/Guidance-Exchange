<?php
include('includes/session.inc.php');

if (isset($_POST['mentor'])) {
  $mentorApproval = $_POST['mentor'];
} else {
  $mentorApproval = null;
};
if (isset($_POST['community'])) {
  $communityApproval = $_POST['community'];
} else {
  $communityApproval = null;
};

if ($mentorApproval != null) {
  $mentorApprovalArray = explode("-", $mentorApproval);
} else {
  $mentorApprovalArray = null;
}

if ($mentorApprovalArray != null) {
  if ($mentorApprovalArray[0] === "approve") {
    $sqlAuthUpdate = "UPDATE `Auth_t` SET MentorStatus=1 WHERE `UserID`=$mentorApprovalArray[1]";
    mysqli_query($con, $sqlAuthUpdate);
    $requestRemoveQuery = "DELETE FROM `MentorRequests_t` WHERE `UserID` = $mentorApprovalArray[1]";
    mysqli_query($con, $requestRemoveQuery);
  } else {
    $requestRemoveQuery = "DELETE FROM `MentorRequests_t` WHERE `UserID` = $mentorApprovalArray[1]";
    mysqli_query($con, $requestRemoveQuery);
  }
}

if ($communityApproval != null) {
  $communityApprovalArray = explode("-", $communityApproval);
} else {
  $communityApprovalArray = null;
}

if ($communityApprovalArray != null) {
  if ($communityApprovalArray[0] === "approve") {
    $requestRemoveQuery = "DELETE FROM `CommunityRequests_t` WHERE `CommunityRequestID` = $communityApprovalArray[1]";
    $communityAddQuery = "UPDATE `community_data` SET `active_flg` = 1 WHERE `community_id` = $communityApprovalArray[2]";
    mysqli_query($con, $requestRemoveQuery);
    mysqli_query($con, $communityAddQuery);
  } else {
    $requestRemoveQuery = "DELETE FROM `CommunityRequests_t` WHERE `CommunityRequestID` = $communityApprovalArray[1]";
    $communityRemoveQuery = "DELETE FROM `community_data` WHERE `community_id` = $communityApprovalArray[2]";
    mysqli_query($con, $requestRemoveQuery);
    mysqli_query($con, $communityRemoveQuery);
  }
}

mysqli_close($con);

header('Location: moderator-dashboard.php?profileID=' . $userID);
exit();
