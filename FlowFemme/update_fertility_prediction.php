<?php
// Establish the connection to the database
include_once "connection.php";

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve data from the request body
    $data = json_decode(file_get_contents("php://input"), true);

    // Extract data
    $predictionID = $data['predictionID'];
    $lastPeriodDate = $data['lastPeriodDate'];
    $cycleLength = $data['cycleLength'];
    $periodLength = $data['periodLength'];
    $fertileStartDate = $data['fertileStartDate'];
    $fertileEndDate = $data['fertileEndDate'];

    // Prepare the SQL statement
    $stmt = $conn->prepare("UPDATE fertilitypredictions SET LastPeriodDate=?, AverageCycleLength=?, AveragePeriodLength=?, FertileStartDate=?, FertileEndDate=? WHERE PredictionID=?");

    // Bind parameters
    $stmt->bind_param("siiiss", $lastPeriodDate, $cycleLength, $periodLength, $fertileStartDate, $fertileEndDate, $predictionID);

    // Execute the update statement
    if ($stmt->execute()) {
        // Update successful
        echo json_encode(array("message" => "Fertility prediction updated successfully"));
    } else {
        // Update failed
        echo json_encode(array("message" => "Failed to update fertility prediction"));
    }

    // Close statement
    $stmt->close();
} else {
    // If the request method is not POST, return an error message
    echo json_encode(array("message" => "Invalid request method"));
}

// Close database connection
$conn->close();
?>
