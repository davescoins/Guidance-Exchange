<?php
include("includes/connect.inc.php");
session_start();
if (!isset($_SESSION['UserID'])) {
  header('location:home.php');
}

$userID = $_SESSION['UserID'];
