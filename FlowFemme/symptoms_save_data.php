<?php
// Start the session 
session_start();

// Check if the user is logged in
if (!isset($_SESSION['UserID'])) {
    // Redirect the user to the login page or display an error message
    header("Location: login.php");
    exit();
}

//  establishes the database connection
include 'connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $date = $_POST['date'];
    $symptom = $_POST['symptom'];
    $severity = isset($_POST['severity']) ? $_POST['severity'] : null; 
    $frequency = isset($_POST['frequency']) ? $_POST['frequency'] : null; 
    $notes = $_POST['notes'];

    // Retrieve the UserID of the logged-in user from the session
    $userID = $_SESSION['UserID'];

    try {
        
        $stmt = $conn->prepare("INSERT INTO symptoms (UserID, SymptomName, Severity, Frequency, DateRecorded, Notes) VALUES (?, ?, ?, ?, ?, ?)");
        if (!$stmt) {
            throw new Exception("Error preparing SQL statement: " . $conn->error);
        }
        $stmt->bind_param("isiiis", $userID, $symptom, $severity, $frequency, $date, $notes);

        // Execute the SQL statement
        $result = $stmt->execute();
        if (!$result) {
            throw new Exception("Error executing SQL statement: " . $conn->error);
        }

        header("Location: confirmation_page.php");
        exit();
    } catch(Exception $e) {
        // Handle errors
        echo "Error: " . $e->getMessage();
    }
}

$conn->close();
?>
