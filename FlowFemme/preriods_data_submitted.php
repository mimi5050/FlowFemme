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
// Fetch data from periodpredictions table for the logged-in user
// Initialize an empty array to store the fetched data
$data = array();

// Query to fetch data from periodpredictions and fertilitypredictions tables for the logged-in user
$query = "SELECT pp.*, fp.*
          FROM periodpredictions AS pp
          LEFT JOIN fertilitypredictions AS fp ON pp.UserID = fp.UserID
          WHERE pp.UserID = $userID";

// Execute the query
$result = mysqli_query($conn, $query);

// Check if the query was successful
if ($result) {
    // Fetch the rows
    while ($row = mysqli_fetch_assoc($result)) {
        // Add the row to the $data array
        $data[] = $row;
    }

    // Free result set
    mysqli_free_result($result);
} else {
    // If there's an error with the query
    echo "Error: " . mysqli_error($conn);
}

// Now the $data array contains the fetched data from both tables


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Submission Successful</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: whitesmoke;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding: 0;
        }
        
        .message-container {
            text-align: center;
        }

        h1 {
            color: #07bca3;
        }

        p {
            color: #666666;
            margin-top: 20px;
        }

        a {
            color: #07bca3;
            text-decoration: none;
            font-weight: bold;
            font-size:20px;
        }

        a:hover {
            text-decoration: underline;
        }

        .prediction {
            margin-top: 30px;
            border: 2px solid #07bca3;
            padding: 10px;
            width: 80%;
            margin-left: auto;
            margin-right: auto;
            background-color: #ffffff;
        }

        .prediction h2 {
            color: #07bca3;
            margin-bottom: 10px;
        }

        .prediction p {
            color: #666666;
        }

        .prediction ul {
            list-style-type: none;
            padding: 0;
        }

        .prediction li {
            margin-bottom: 10px;
            display: flex;
            align-items: center;
        }

        .highlight {
            color: #07bca3;
        }

        .icon {
            font-size: 20px;
            margin-right: 5px;
            color: #07bca3;
        }

        .icon-1::before {
            content: "\1F4C5";
        }

        .icon-2::before {
            content: "\1F525";
        }

        .icon-3::before {
            content: "\1F60A";
        }
    </style>
</head>
<body>
    <div class="message-container">
        <h1>Your Data Submission Successful!</h1>
        <p>Your data has been successfully submitted to the database.</p>
        <p>Proceed to <a href="dashboard.php">dashboard</a>.</p>

        <div class="prediction">
            <h2>Prediction for Menstrual Cycle</h2>
            <p>Based on the submitted data, we predict the following trends for upcoming menstrual cycles:</p>
            <ul>

                <?php
                    // Query to fetch the start date of the period for the user
                    $query = "SELECT LastPeriodDate, NextPeriodStartDate FROM periodpredictions WHERE UserID = ?";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("i", $userID);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $lastPeriodDate = new DateTime($row['LastPeriodDate']);
                        $nextPeriodStartDate = new DateTime($row['NextPeriodStartDate']);

                        // Calculate regular cycle length
                        $regularCycleLength = $lastPeriodDate->diff($nextPeriodStartDate)->days;

                        // Display regular cycle length
                        echo '<li><span class="icon-1"></span> Regular cycle length: <span class="highlight">';
                        echo $regularCycleLength . ' days';
                        echo '</span></li>';
                    } else {
                        echo "<li><span class='icon-1'></span> Regular cycle length: <span class='highlight'>Not available</span></li>";
                    }

                    $stmt->close();
                    ?>

                </span></li>

                <?php
                    // Query to fetch the average cycle length for the user
                    $query = "SELECT AverageCycleLength FROM periodpredictions WHERE UserID = ?";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("i", $userID);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $averageCycleLength = $row['AverageCycleLength'];

                        // Calculate the expected ovulation period
                        $ovulationDay = floor($averageCycleLength / 2);

                        // Display expected ovulation period
                        echo '<li><span class="icon-2"></span> Expected ovulation period: <span class="highlight">';
                        echo 'Days ' . ($ovulationDay - 3) . '-' . ($ovulationDay + 3); // Ovulation usually occurs around day 14, so we subtract and add 3 days for the ovulation period
                        echo '</span></li>';
                    } else {
                        echo "<li><span class='icon-2'></span> Expected ovulation period: <span class='highlight'>Not available</span></li>";
                    }

                    $stmt->close();
                    ?>


                </span></li>
                    <?php
                        // Query to fetch the symptoms recorded for the user
                        $query = "SELECT SymptomName, Severity, Frequency FROM symptoms WHERE UserID = ?";
                        $stmt = $conn->prepare($query);
                        $stmt->bind_param("i", $userID);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        if ($result->num_rows > 0) {
                            // Initialize variables to store potential symptoms and their severity
                            $potentialSymptoms = [];
                            $potentialSeverity = 0;

                            // Loop through each recorded symptom
                            while ($row = $result->fetch_assoc()) {
                                $symptomName = $row['SymptomName'];
                                $severity = $row['Severity'];
                                $frequency = $row['Frequency'];

                                // Determine if the symptom is expected based on severity and frequency
                                if ($severity > 5 && $frequency > 10) {
                                    // Add the symptom to the list of potential symptoms
                                    $potentialSymptoms[] = $symptomName;
                                    // Aggregate severity to calculate the overall severity of potential symptoms
                                    $potentialSeverity += $severity;
                                }
                            }

                            // Determine the overall severity of potential symptoms
                            $overallSeverity = count($potentialSymptoms) > 0 ? $potentialSeverity / count($potentialSymptoms) : 0;

                            // Display potential symptoms and their overall severity
                            echo "<li><span class='icon-3'></span> Potential symptoms expected: ";
                            if (count($potentialSymptoms) > 0) {
                                echo implode(", ", $potentialSymptoms);
                                echo " (Severity: " . round($overallSeverity, 2) . ")";
                            } else {
                                echo "None";
                            }
                            echo "</li>";
                        } else {
                            echo "<li><span class='icon-3'></span> Potential symptoms expected: Not available</li>";
                        }

                        $stmt->close();
                        ?>

                </span></li>
            </ul>
        </div>
    </div>
</body>
</html>
