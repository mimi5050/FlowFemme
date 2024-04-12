<?php
// Start or resume a session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['UserID'])) {
    // Redirect the user to the login page if not logged in
    header("Location: login.php");
    exit(); // Stop script execution
}

// Include connection.php to establish database connection
include 'connection.php';

// Fetch logged-in user's ID from session
$userID = $_SESSION['UserID'];
// Fetch data from periodpredictions table for the logged-in user
// Initialize an empty array to store the fetched data
$data = array();

// Query to fetch data from periodpredictions and fertilitypredictions tables for the logged-in user
$query = "SELECT pp.*, fp.*
          FROM periodpredictions AS pp
          LEFT JOIN fertilitypredictions AS fp ON pp.UserID = fp.UserID
          WHERE pp.UserID = $userID";

// Execute the query
$result = mysqli_query($conn, $query);

// Check if the query was successful
if ($result) {
    // Fetch the rows
    while ($row = mysqli_fetch_assoc($result)) {
        // Add the row to the $data array
        $data[] = $row;
    }

    // Free result set
    mysqli_free_result($result);
} else {
    // If there's an error with the query
    echo "Error: " . mysqli_error($conn);
}

// Now the $data array contains the fetched data from both tables
?>