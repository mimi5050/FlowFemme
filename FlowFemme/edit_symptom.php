<?php
// Start session
session_start();

// database connection
include "connection.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the required fields are set
    if (isset($_POST['symptom_id']) && isset($_POST['editSymptomName']) && isset($_POST['severity']) && isset($_POST['frequency']) && isset($_POST['editDateRecorded']) && isset($_POST['notes'])) {
        // Get form data
        $symptom_id = $_POST['symptom_id'];
        $symptom_name = $_POST['editSymptomName'];
        $severity = $_POST['severity'];
        $frequency = $_POST['frequency'];
        $date_recorded = $_POST['editDateRecorded'];
        $notes = $_POST['notes'];

        // Update the symptom in the database
        $query = "UPDATE symptoms SET SymptomName='$symptom_name', Severity='$severity', Frequency='$frequency', DateRecorded='$date_recorded', Notes='$notes' WHERE SymptomID='$symptom_id'";
        $result = mysqli_query($conn, $query);

        // Check if the update was successful
        if ($result) {
            echo "success";
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    } else {
        echo "Required fields are missing";
    }
} else {
    echo "Invalid request method";
}
?>
