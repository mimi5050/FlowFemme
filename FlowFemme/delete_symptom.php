<?php
// Start session
session_start();

// Database connection
include "connection.php";

// Check if the symptom ID is set and not empty
if (isset($_POST['symptom_id']) && !empty($_POST['symptom_id'])) {
    // Get the symptom ID from the POST data
    $symptom_id = $_POST['symptom_id'];

    // Prepare and execute the SQL query to delete the symptom
    $query = "DELETE FROM symptoms WHERE SymptomID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $symptom_id);

    if ($stmt->execute()) {
        // If deletion is successful, send a success response
        echo "success";
    } else {
        // If deletion fails, send an error response
        echo "Error deleting record: " . $conn->error;
    }

    // Close the statement
    $stmt->close();
} else {
    // If symptom ID is not set or empty, send an error response
    echo "Symptom ID is missing";
}

// Close the database connection
$conn->close();
?>
