<?php
include('includes/session.inc.php');

    // Assuming you have a database connection, update the connection details accordingly

    // Connect to the database
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "guidance_exhange";
$port = 3306; 

include('includes/connect.inc.php');
include('includes/session.inc.php');


$conn = new mysqli($servername, $username, $password, $dbname, $port);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $userID = $_SESSION['UserID'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Retrieve form data
    $communityName = $_POST['communityName'];
    $communityDesc = $_POST['communityDesc'];
    $activeFlg = 0;
// ... Rest of your code

// Prepare and execute the SQL query for community_data table
$sql_community_data = "INSERT INTO community_data (community_name, community_desc, active_flg) VALUES (?, ?, ?)";
$stmt_community_data = $conn->prepare($sql_community_data);
$stmt_community_data->bind_param("ssi", $communityName, $communityDesc, $activeFlg);

// Variable to track the success of the first insert
$community_data_inserted = false;

if ($stmt_community_data->execute()) {
    // Community data inserted successfully
    $community_id = $conn->insert_id; // Retrieve the newly inserted community_id
    $community_data_inserted = true; // Set the flag to true

    // Debug: Check if the userID is being received correctly
    echo "User ID: " . $userID . "<br>";

    // ... Rest of your code
}

// Check if the first insert was successful before proceeding to the next insert
if ($community_data_inserted) {
    // Prepare and execute the SQL query for CommunityRequests_t table
    $sql_community_requests = "INSERT INTO CommunityRequests_t (CommunityID, UserID, CommunityName, CommunityDescription) VALUES (?, ?, ?, ?)";
    $stmt_community_requests = $conn->prepare($sql_community_requests);
    $stmt_community_requests->bind_param("iiss", $community_id, $userID, $communityName, $communityDesc);

    // Check if the second insert was successful
    if ($stmt_community_requests->execute()) {
        // Redirect to a success page or perform any other necessary actions
        header("Location: communities.php");
        exit();
    } else {
        // Error inserting data into CommunityRequests_t table, handle the error as needed
        header("Location: create_community.php?error=1&message=Error creating community");
        exit();
    }
} else {
    // Error inserting community data, redirect back to the form with an error message
    header("Location: create_community.php?error=1&message=Error creating community");
    exit();
}

// Close the database connection
$conn->close();

}
