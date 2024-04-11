<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["UserID"])) {
    // Redirect to the login page if the user is not logged in
    header("Location: login.php");
    exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize the input
    $noteTitle = isset($_POST['noteTitle']) ? trim($_POST['noteTitle']) : '';
    $noteText = isset($_POST['noteText']) ? trim($_POST['noteText']) : '';
    $day = isset($_POST['day']) ? $_POST['day'] : '';
    $monthYear = isset($_POST['monthYear']) ? $_POST['monthYear'] : '';
    // You can perform additional validation here if needed

    // Include the database connection
    include_once "connection.php";

    // Prepare and bind the SQL statement
    $stmt = $conn->prepare("INSERT INTO form_notes (user_id, note_title, note_text, day, month_year) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $_SESSION["UserID"], $noteTitle, $noteText, $day, $monthYear);

    // Execute the statement
    if ($stmt->execute() === TRUE) {
        // Note saved successfully, redirect to a success page or do further processing
        header("Location: success.php");
        exit();
    } else {
        // Handle the error gracefully
        header("Location: error.php");
        exit();
    }

    // Close the connection
    $stmt->close();
    $conn->close();
} else {
    // If the form is not submitted, redirect to an error page or handle the situation accordingly
    header("Location: error.php");
    exit();
}
?>