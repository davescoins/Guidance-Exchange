<?php
include("includes/connect.inc.php");
session_start();
if (!isset($_SESSION['UserID'])) {
  header('location:home.php');
}

$userID = $_SESSION['UserID'];
$userMentorStatus = $_SESSION['MentorStatus'];
$userModeratorStatus = $_SESSION['ModeratorStatus'];
$userSystemAdministratorStatus = $_SESSION['SystemAdministratorStatus'];
$associationsArray = $_SESSION['Associations'];
$profileArray = $_SESSION['Profile'];
