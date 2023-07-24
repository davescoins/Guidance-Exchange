<?php
include('includes/session.inc.php');
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "guidance_exhange";
$port = 3306;

// Include the database connection file
include('includes/connect.inc.php');
include('includes/session.inc.php');
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$userID = $_SESSION['UserID'];


// Check if the community ID is provided in the URL

// Get the community ID from the URL

// Now you have the community ID, you can use it as needed
// For example, display it somewhere on the page



// ... Rest of your code using the community ID


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming you have a database connection, update the connection details accordingly

    // Handle the form submission
    $postTitle = isset($_POST['postTitle']) ? $_POST['postTitle'] : '';
    $postContent = isset($_POST['postContent']) ? $_POST['postContent'] : '';
    $activeFlg = isset($_POST['activeFlg']) ? 1 : 0;
    $communityId = $_POST['community_id'];

    // Your existing code here...

    // Debugging: Let's check the values received from the form


    // Prepare and execute the SQL query
    $sql = "INSERT INTO community_data_info (community_id, user_id, title, content, active_flg) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Check if the prepare statement was successful
    if ($stmt) {
        // Bind the parameters with the correct data types
        // Assuming 'community_id' is an integer type, 'user_id' is an integer type, 'title' is a string type,
        // 'content' is a string type, and 'active_flg' is an integer type (assuming 1 or 0 values)
        $stmt->bind_param("iissi", $communityId, $userID, $postTitle, $postContent, $activeFlg);

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect to community_info.php upon successful form submission


            header("Location: community_info.php?community_id=" . $communityId);
            exit();
        } else {
            // Close the database connection
            $conn->close();
            // Refresh the page with an error message
            echo "<script>alert('Form not properly completed, please try again!'); window.location.href = 'new_discussion.php';</script>";
            exit();
        }
    } else {
        // Handle prepare statement error
        // Close the database connection
        $conn->close();
        // Refresh the page with an error message
        echo "<script>alert('Prepare statement error, please try again!'); window.location.href = 'new_discussion.php';</script>";
        exit();
    }
}
