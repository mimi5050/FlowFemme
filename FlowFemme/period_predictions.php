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
<html>
<head>
  <title>Dashboard | FlowFemme</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap');
        :root {
    --primary-color: #07bca3; 
    --text-color: black; 
    --bg-color: whitesmoke; 
  }

    body {
      font-family: 'Roboto', sans-serif;
      margin: 0;
      padding: 0;
      background-color: whitesmoke;
    }
    .sidenav {
        height: 100%;
        width: 23%;
        position: fixed;
        z-index: 1;
        top: 0;
        left: 0;
        background-color: white;
        overflow-x: hidden;
        padding-top: 80px;
        padding-left: 10px;
        margin-top: 0;
      }

      .sidenav ul {
        list-style: none; 
        padding: 0;
        margin: 0;
      }

      .sidenav a {
        padding: 20px 8px 6px 16px;
        text-decoration: none;
        font-size: 18px;
        color: #818181;
        display: block;
        margin-bottom:15px;

      }

      .sidenav a:hover {
        color:  #dedab6;  
        background-color:#07bca3; 
        border-radius: 10px; 
        padding: 12px 20px; 
      }

      a.active {
        background-color: #07bca3; 
        color: white;
        border-radius: 4px;
        font-weight: 900;
      }


    .topnav a {
      float: left;
      color: #333;
      text-align: center;
      padding: 14px 16px;
      text-decoration: none;
      font-size: 14px;

    }

    .topnav a:hover {
      background-color: #ebdfd3;
      color: #555;
    }

    .topnav a.active {
      background-color: #07bca3; 
      color: white;
      border-radius: 16px;
    }

    .topnav a.signup {
      float: right;
      background-color: #07bca3; 
      color: whitesmoke;
      border-radius: 16px;
    }
    .topnav a.signup:hover {
      color: whitesmoke;
      background-color: #07bca3; 
    }

    .topnav a.split {
      float: right;
      background-color: #ebdfd3;
      color: #333;
    }

    .topnav a.split:hover{
      color: #555;
    }

    .topnav-centered a.title {
      float: left;
      position: absolute;
      font-family: Longhaul;
      font-weight: lighter;
      top: 0%;
      color: black;
    }

    .topnav-centered a.title:hover {
      background-color: white;
    }

    .topnav a.title {
      font-family: Longhaul;
      font-size: x-large;
      font-weight: bold;
    }

    .container {
      display: flex;
      width:85%;
      flex-direction: column;
      height: 100vh;
      margin-left:150px;
      margin-right:0;
    }

    .topnav {
      background-color: white;
      color: #07bca3; 
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 20px;
      margin-left: 160px;
      padding: 20px 10px;
      position: fixed;
      width: 100%;
      overflow: hidden;
    }

    .topnav h1 {
      margin: 0;
      font-weight: bolder;
      font-size: large;
      margin-left: 100px;
    }
    .topnav-centered {
        margin-top: -80px; 
    }


    .sidenav.topnav-centered a {
      float: none;
      position: absolute;
      left: 50%;
      transform: translate(-50%);
    }

    .dashboard {
      margin-top: 80px;
      display: flex;
      flex-direction: row;
      flex-wrap: wrap;
      justify-content: space-between;
      margin-left: 160px;
      padding: 20px 20px;
    }

    .welcome {
      width: 100%;
      margin-left:40px;
      margin-bottom:-60px;
      
    }

    .welcome h1{
      padding-left: 40px;

    }

    .welcome p{
      padding-left: 40px;
      font-weight: bolder;
      color: #818181;
    }

    main {
    padding: 50px 20px;
    text-align: center;
  }

  .form-container {
    max-width: 600px;
    margin: 0 auto;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
  }

  .form-group {
    margin-bottom: 20px;
    text-align: left;
  }

  .form-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
  }

  .form-group input[type="date"],
  .form-group input[type="number"] {
    width: calc(100% - 20px); 
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-bottom: 10px;
    margin-right: 20px; 
  }

  .form-group input[type="number"]::placeholder {
    color: #999; 
  }

  .form-group small {
    color: #888;
  }

  button[type="submit"] {
    background-color: #07bca3;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
    width: 100%;
  }

  button[type="submit"]:hover {
    background-color: grey;
  }

 
  .action-button {
        background-color: #07bca3; 
        color: white;
        border: none;
        border-radius: 5px;
        padding: 8px 16px;
        cursor: pointer;
        transition: background-color 0.3s;
        margin-right: 5px;
        font-size:12px;
        margin: left 0;
    }

    .action-button:hover {
        background-color: #05a393; 
    }

    table{
      width:80%;
      margin-left:20%;
      font-size:12px;
    
    }
   
    table tr {
        background-color: #f2f2f2; 
    }

    
    table th {
        background-color: #07bca3; 
        color: white; 
        padding: 10px; 
    }

  
    table tbody {
        color: #333; 
        font-size:12px;
    }

  
    table td {
        padding: 10px; 
    }

     /* Styling for the popup */
     .popup {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #fff;
        border: 1px solid #ccc;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        padding: 20px;
        max-width: 300px;
        text-align: center;
        z-index: 1000;
    }

    .popup div {
        margin-bottom: 20px;
    }

    .popup button {
        background-color: #07bca3;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
        margin: 0 10px;
    }

    .popup button:hover {
        background-color: #05a393;
    }
  
    </style>


    <div class="container">
        <div class="topnav">
          <h1>Dashboard</h1>
        </div>

        <div class="sidenav">
        <div class="topnav-centered">
            <img src="Images/logo.png" alt="Logo" style="height: 50px; margin-bottom:20px; margin-top:10px;">
        </div>
        <ul> 
            <li><a href="dashboard.php"><i class="fas fa-home"></i>Overview </a></li>
            <li><a href="cycle_tracking.php"><i class="fas fa-calendar-alt"></i>Menstrual Cycle Tracking</a></li>
            <li><a class="active" href="#"><i class="fas fa-chart-line"></i>Period Predictions</a></li>
            <li><a href="fertility_prediction.php"><i class="fas fa-chart-line"></i> Fertility Predictions</a></li>
            <li><a href="symptomLogging.php"><i class="fas fa-notes-medical"></i> Symptom Logging</a></li>
            <li><a href="User_profile.php"><i class="fas fa-user-edit"></i> Edit my profile</a></li>
            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul> 
    </div>


    <div class="dashboard">
        <div class = "welcome">
            <h1>Hey Pretty!</h1>
            <p>Ready to track your circle? Even when you don't know how, worry less! We got you!</p>
        </div>
  </div>
  <main>
    <div class="Predict_Your_Next_Period" style="margin-left:240px;text-align:left;">
        <h2 >Predict Your Next Period</h2>
        <p>For those tracking their menstrual cycles, our platform offers period prediction tools based on your previous cycle data. Fill out the form below to get started:</p>
    </div>
    <div class="form-container">
    <form id="periodPredictionForm" action="periods_save_data.php" method="POST">
            <div class="form-group">
                <label for="lastPeriodDate">Last Period Date:</label>
                <input type="date" id="lastPeriodDate" name="lastPeriodDate" required>
            </div>
            <div class="form-group">
                <label for="cycleLength"> Enter Cycle Length:</label>
                <input type="number" id="cycleLength" name="cycleLength" placeholder="Enter average cycle length">
                <small>(Leave it blank if you are not sure!)</small>
            </div>
            <div class="form-group">
                <label for="averagePeriodLength">Period Length (in days):</label>
                <input type="number" id="averagePeriodLength" name="averagePeriodLength" placeholder="Enter average period length">
                <small>(Leave it blank if you are not sure!)</small>
            </div>
            <button type="submit">Predict Period</button>
        </form>
        </div>
        <div style="margin-top: 30px;">
    <h2 style="color: #07bca3;">Period Predictions</h2>
    <table cellpadding="10" style="border-collapse: collapse;">
        <thead>
            <tr>
                <th>Last Period Date</th>
                <th>Average Cycle Length</th>
                <th>Average Period Length</th>
                <th>Next Period Start Date</th>
                <th>Next Period End Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Fetch period prediction data from the database
            $query = "SELECT * FROM periodpredictions WHERE UserID = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $userID);
            $stmt->execute();
            $result = $stmt->get_result();

            // Check if there is data available
            if ($result->num_rows > 0) {
                // Loop through each row of the result set
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $row['LastPeriodDate'] . '</td>';
                    echo '<td>' . $row['AverageCycleLength'] . '</td>';
                    echo '<td>' . $row['AveragePeriodLength'] . '</td>';
                    echo '<td>' . $row['NextPeriodStartDate'] . '</td>';
                    echo '<td>' . $row['NextPeriodEndDate'] . '</td>';
                    // Action buttons for each row
                    echo '<td>';
                    echo '<button class="action-button" onclick="updatePrediction(' . $row['PredictionID'] . ')">Update</button>';
                    echo '<button class="action-button" onclick="deletePrediction(' . $row['PredictionID'] . ')">Delete</button>';
                    echo '</td>';
                    echo '</tr>';
                }
            } else {
                // If no data found, display a message
                echo '<tr><td colspan="6">No period predictions available.</td></tr>';
            }

            // Close the prepared statement and database connection
            $stmt->close();
            $conn->close();
            ?>
        </tbody>
    </table>
</div>

</main>
<script>
    function deletePrediction(predictionID) {
        // Create a div element for the popup
        var popup = document.createElement('div');
        popup.classList.add('popup');

        // Create a confirmation message
        var message = document.createElement('div');
        message.innerHTML = "Are you sure you want to delete this prediction?";
        popup.appendChild(message);

        // Create buttons for confirmation and cancellation
        var confirmButton = document.createElement('button');
        confirmButton.innerText = "Confirm";
        confirmButton.onclick = function() {
            // Send an AJAX request to the server to delete the prediction
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "delete_prediction.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Parse the JSON response
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        // If deletion was successful, reload the page to reflect changes
                        location.reload();
                    } else {
                        // If an error occurred, display an error message
                        alert("Failed to delete prediction: " + response.error);
                    }
                }
            };
            // Send the prediction ID as data in the POST request
            xhr.send("prediction_id=" + predictionID);

            // Remove the popup from the DOM
            document.body.removeChild(popup);
        };
        popup.appendChild(confirmButton);

        var cancelButton = document.createElement('button');
        cancelButton.innerText = "Cancel";
        cancelButton.onclick = function() {
            // Remove the popup from the DOM
            document.body.removeChild(popup);
        };
        popup.appendChild(cancelButton);

        // Add the popup to the body
        document.body.appendChild(popup);
    }
``
</script>

</body>
</html>
