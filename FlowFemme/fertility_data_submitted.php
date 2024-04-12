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
    <title>Fertility Prediction Submitted</title>
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
            font-size: 20px;
        }

        a:hover {
            text-decoration: underline;
        }

        .prediction {
            margin-top: 30px;
            border: 2px solid #07bca3;
            padding: 10px;
            width: 100%;
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
        <h1>Fertility Prediction Submitted!</h1>
        <p>Your fertility prediction has been successfully submitted.</p>
        <p>Proceed to <a href="dashboard.php">dashboard</a>.</p>

        <div class="prediction">
            <h2>Prediction for Fertility</h2>
            <p>Based on the submitted data, we predict the following trends:</p>
            <ul>
            <ul>
                <li><span class="icon icon-1"></span> Ovulation expected around: <span class="highlight">
                <?php
                // Query to fetch the start date of the period for the user
                $query = "SELECT LastPeriodDate, AverageCycleLength FROM periodpredictions WHERE UserID = ?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("i", $userID);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $lastPeriodDate = new DateTime($row['LastPeriodDate']);
                    $averageCycleLength = $row['AverageCycleLength'];

                    // Calculate ovulation date
                    $ovulationDate = clone $lastPeriodDate;
                    $ovulationDate->add(new DateInterval("P" . ($averageCycleLength / 2) . "D")); 

                    // Display ovulation date
                    echo $ovulationDate->format('Y-m-d');
                } else {
                    echo "No data found for the user.";
                }

                $stmt->close();
                ?>

                </span></li>
                <?php
                    // Query to fetch the start date of the period for the user
                    $query = "SELECT LastPeriodDate, AverageCycleLength FROM periodpredictions WHERE UserID = ?";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("i", $userID);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $lastPeriodDate = new DateTime($row['LastPeriodDate']);
                        $averageCycleLength = $row['AverageCycleLength'];

                        // Calculate ovulation date
                        $ovulationDay = floor($averageCycleLength / 2);
                        $ovulationDate = clone $lastPeriodDate;
                        $ovulationDate->add(new DateInterval("P" . $ovulationDay . "D"));

                        // Calculate fertile window
                        $fertileWindowStart = clone $ovulationDate;
                        $fertileWindowStart->sub(new DateInterval("P6D")); // Fertile window starts 6 days before ovulation
                        $fertileWindowEnd = clone $ovulationDate;
                        $fertileWindowEnd->add(new DateInterval("P1D")); // Fertile window ends 1 day after ovulation

                        // Display fertile window
                        echo '<li><span class="icon icon-2"></span> Fertile window: <span class="highlight">';
                        echo 'Days ' . $fertileWindowStart->format('d') . '-' . $fertileWindowEnd->format('d');
                        echo '</span></li>';
                    } else {
                        echo "<li><span class='icon icon-2'></span> Fertile window: <span class='highlight'>Not available</span></li>";
                    }

                    $stmt->close();
                    ?>


                </span></li>
                <?php
                // Query to fetch the start date of the period for the user
                $query = "SELECT LastPeriodDate, AverageCycleLength FROM periodpredictions WHERE UserID = ?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("i", $userID);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $lastPeriodDate = new DateTime($row['LastPeriodDate']);
                    $averageCycleLength = $row['AverageCycleLength'];

                    // Calculate recommended conception timing
                    $conceptionTimingStart = clone $lastPeriodDate;
                    $conceptionTimingStart->add(new DateInterval("P" . round($averageCycleLength * 0.25) . "D")); // Recommended timing starts around 25% into the cycle
                    $conceptionTimingEnd = clone $lastPeriodDate;
                    $conceptionTimingEnd->add(new DateInterval("P" . round($averageCycleLength * 0.75) . "D")); // Recommended timing ends around 75% into the cycle

                    // Display recommended conception timing
                    echo '<li><span class="icon icon-3"></span> Recommended conception timing: <span class="highlight">';
                    echo $conceptionTimingStart->format('Y-m-d') . ' to ' . $conceptionTimingEnd->format('Y-m-d');
                    echo '</span></li>';
                } else {
                    echo "<li><span class='icon icon-3'></span> Recommended conception timing: <span class='highlight'>Not available</span></li>";
                }

                $stmt->close();
                ?>
                </span></li>
            </ul>
        </div>
    </div>
</body>
</html>
