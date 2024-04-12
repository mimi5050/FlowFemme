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

// Check if the prediction ID is provided in the POST request
if(isset($_POST['prediction_id'])) {
    $predictionID = $_POST['prediction_id'];

    // Fetch updated data from the form
    $updatedLastPeriodDate = $_POST['updatedLastPeriodDate'];
    $updatedCycleLength = $_POST['updatedCycleLength'];
    $updatedPeriodLength = $_POST['updatedPeriodLength'];

    // Prepare and execute the update query
    $query = "UPDATE periodpredictions 
              SET LastPeriodDate = ?, AverageCycleLength = ?, AveragePeriodLength = ? 
              WHERE PredictionID = ? AND UserID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("siiii", $updatedLastPeriodDate, $updatedCycleLength, $updatedPeriodLength, $predictionID, $userID);

    if ($stmt->execute()) {
        // If update was successful, send success response
        $response = array("success" => true);
        echo json_encode($response);
    } else {
        // If an error occurred during update, send error response
        $response = array("success" => false, "error" => "Failed to update prediction.");
        echo json_encode($response);
    }

    // Close the prepared statement and database connection
    $stmt->close();
    $conn->close();
} else {
    // If prediction ID is not provided in the POST request, send error response
    $response = array("success" => false, "error" => "Prediction ID not provided.");
    echo json_encode($response);
}
?>
