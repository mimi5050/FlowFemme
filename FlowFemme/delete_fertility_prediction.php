<?php
// Include your database connection file
include 'connection.php';

// Check if the delete icon is clicked and if the prediction ID is set
if(isset($_GET['id'])) {
    // Sanitize the prediction ID to prevent SQL injection
    $predictionID = mysqli_real_escape_string($conn, $_GET['id']);

    // Prepare a DELETE statement
    $sql = "DELETE FROM fertilitypredictions WHERE PredictionID = $predictionID";

    // Execute the DELETE statement
    if(mysqli_query($conn, $sql)) {
        // If the record is successfully deleted, redirect back to the dashboard or any desired page
        header("Location: fertility_prediction.php");
        exit();
    } else {
        // If there is an error in executing the DELETE statement, display an error message
        echo "Error deleting record: " . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
?>
