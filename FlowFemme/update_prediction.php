<?php
// Start or resume a session
session_start();

// Include connection.php to establish database connection
include 'connection.php';

// Check if the prediction ID is set and not empty
if (isset($_POST['prediction_id']) && !empty($_POST['prediction_id'])) {
    // Sanitize the prediction ID
    $predictionID = mysqli_real_escape_string($conn, $_POST['prediction_id']);
    
    // Retrieve other form data
    $lastPeriodDate = mysqli_real_escape_string($conn, $_POST['editLastPeriodDate']);
    $cycleLength = mysqli_real_escape_string($conn, $_POST['editCycleLength']);
    $averagePeriodLength = mysqli_real_escape_string($conn, $_POST['editAveragePeriodLength']);
    
    // Prepare and execute the SQL update statement
    $query = "UPDATE periodpredictions 
              SET LastPeriodDate = '$lastPeriodDate', 
                  AverageCycleLength = '$cycleLength', 
                  AveragePeriodLength = '$averagePeriodLength' 
              WHERE PredictionID = $predictionID";
    
    $result = mysqli_query($conn, $query);
    
    if ($result) {
        // If the update was successful, return success message
        echo "success";
    } else {
        // If there was an error with the update, return the error message
        echo "Error updating prediction: " . mysqli_error($conn);
    }
} else {
    // If prediction ID is not set or empty, return an error message
    echo "Prediction ID is missing.";
}

// Close database connection
mysqli_close($conn);
?>
