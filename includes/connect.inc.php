<?php
$hostname = "localhost"; //your hostname
$username = "root"; // your DB username
$password = ''; // your DB password
$dbname = "guidance_exchange"; // your DB name

$con = mysqli_connect($hostname, $username, $password, $dbname) or die("Unable to connect to MySQL");
