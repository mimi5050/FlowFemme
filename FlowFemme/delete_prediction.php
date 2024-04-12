<?php
// Check if the request is an AJAX request
if (isset($_POST['prediction_id'])) {
    // Include connection.php to establish database connection
    include 'connection.php';

    // Get the prediction ID from the AJAX request
    $prediction_id = $_POST['prediction_id'];

    // Prepare and execute the SQL query to delete the row from the database
    $query = "DELETE FROM periodpredictions WHERE PredictionID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $prediction_id);

    // Check if the deletion was successful
    if ($stmt->execute()) {
        // Return a success message
        echo json_encode(array("success" => true));
    } else {
        // Return an error message
        echo json_encode(array("success" => false, "error" => "Failed to delete prediction."));
    }

    // Close the prepared statement and database connection
    $stmt->close();
    $conn->close();
} else {
    // If the request is not an AJAX request, return an error message
    echo json_encode(array("success" => false, "error" => "Invalid request."));
}
?>
