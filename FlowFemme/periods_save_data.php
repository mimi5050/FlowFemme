<?php
session_start();
include 'connection.php';

if (!isset($_SESSION["UserID"])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userID = $_SESSION["UserID"];
    $lastPeriodDate = $_POST['lastPeriodDate'];
    $cycleLength = isset($_POST['cycleLength']) ? $_POST['cycleLength'] : NULL;
    $averagePeriodLength = isset($_POST['averagePeriodLength']) ? $_POST['averagePeriodLength'] : NULL;

    $nextPeriodStartDate = date('Y-m-d', strtotime($lastPeriodDate . " + $cycleLength days"));
    $nextPeriodEndDate = date('Y-m-d', strtotime($nextPeriodStartDate . " + $averagePeriodLength days"));

    $insert_query = "INSERT INTO periodpredictions (UserID, LastPeriodDate, AverageCycleLength, AveragePeriodLength, NextPeriodStartDate, NextPeriodEndDate) 
                     VALUES ('$userID', '$lastPeriodDate', '$cycleLength', '$averagePeriodLength', '$nextPeriodStartDate', '$nextPeriodEndDate')";

    if ($conn->query($insert_query) === TRUE) {
        header("Location: preriods_data_submitted.php");
        exit();
    } else {
        echo "Error: " . $insert_query . "<br>" . $conn->error;
    }
}

$conn->close();
?>
