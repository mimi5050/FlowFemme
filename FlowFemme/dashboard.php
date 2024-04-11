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

      .main {
        margin-left: 160px;
        padding: 0px 10px;
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
      margin-left:30px;
    }

    .welcome h1{
      padding-left: 40px;

    }

    .welcome p{
      padding-left: 40px;
      font-weight: bolder;
      color: #818181;
    }

    .intro {
      padding: 20px;
      text-align: left;
      background: #07bca3;
      color: white;
      font-size: 30px;
      margin-bottom: 40px;
      border-radius: 40px;
      margin-left:45px;
      width: 100%; 
      height:15%;
       
    }

    .intro h1 {
      margin: 0;
      font-weight: bolder;
      font-size: larger;
    }

    .intro p {
      font-size: 16px;
      width: 80%;
      text-align:justify;
    }

    button {
      background-color: #dedab6;
      color: black;
      padding: 20px;
      border: none;
      border-radius: 34px;
      cursor: pointer;
      transition: background-color 0.3s ease;
      font-size: 18px;
      margin-left:300px;
    }


    .cycle-overview {
      background-color: white;
      border-radius: 12px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      padding: 20px;
      margin-bottom: 20px;
      width: 100%;
      display: block;
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      margin-left: 40px;
      margin-top:-10px;

    }

    .cycle-overview h2{
      width: 100%;
      height:7%;
      text-align:left;
      margin-bottom:20px;
      margin-top:20px;
      color: white;
    
    }

    .cycle-overview a {
      text-decoration: none;
      color: black;
      font-weight: bold;
    }

    .symptom_monitoring {
      background-color: white;
      border-radius: 12px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      padding: 30px;
      margin-bottom: 20px;
      width: 100%;
      display: block;
      justify-content: space-between;
      margin-left: 16px;
    }

    .symptom_monitoring a {
      text-decoration: none;
      color: #333;
      font-weight: bolder;
    }

    .card {
      background-color: whitesmoke;
      border-radius: 4px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      padding: 20px;
      width: 25%;
      margin-bottom:20px;
  
    }

    .card h3 {
      padding: 10%;
      width:100%;
      margin: 0;
      font-weight: bold;
      font-size: 17px;
      color: #555;
    }

    .card p{
      padding-left: 10%;
      font-weight: 900;
      font-size: large;
    }

    table {
      border-collapse: collapse;
      width: 100%;
    }

    th, td {
      text-align: left;
      padding: 8px;
    }

    tr:nth-child(even){background-color: #f2f2f2}

    th {
      background-color: #07bca3;
      color: white;
    }
    tr:hover {background-color: #e6e3cd;}

    li{
        list-style-type: none;
    }

      td.moderate{
        background-color: rgba(128, 128, 128, 0.5); 
    }
    td.severe{
        background-color: rgba(218, 112, 214, 0.5); 
    }
    td.mild{
        background-color: rgba(255, 182, 193, 0.5); 
    }
    td.mild_moderate{
        background-color: rgba(173, 216, 230, 0.5); 
    }
      
      .active a{
        background-color: #07bca3; 
        color: white;
        border-radius: 4px
      }

      .active a {
        color: white;
      }
      .card i {
        color: #07bca3;
      }

      .card:hover {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
        transform: translateY(-12px);
        background-color:#07bca3;
      }
      .card:hover i {
        color: white;
      }
      .card:hover p {
        color: white;
      }
      .card:hover h3 {
      color: white !important;
    }
 
    #editPopup {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: 999;
      background-color: rgba(0, 0, 0, 0.5);
  
    }
    .popup-content {
    background-color: #fff;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    max-width: 400px;
    width: 80%;
    color: #333; 
    font-family: Arial, sans-serif; 
}

.popup-content input,
.popup-content textarea {
    width: 80%;
    padding: 10px;
    margin-bottom:40px;
    margin-top:10px;
    margin-left:30px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.popup-content button {
    background-color: #07bca3;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    width: 45%;
    height: 10px; 
    margin-right: 5%; 
    text-align:center;
}

.popup-content button.close {
    background-color: #ccc;
    color: #333;
    width: 45%; 
    margin-right: 0;
    margin-left:120px;
}


    </style>

    <div class="container">
        <div class="topnav">
          <h1>Dashboard</h1>
        </div>

        <div class="sidenav">
            <div class="topnav-centered">
            <img src="images/logo.png" alt="Logo" style="height: 50px; margin-bottom:20px; margin-top:10px;">
        </div>
          <a class="active" href="#"><i class="fas fa-home"></i> Overview</a>
          <li><a href="cycle_tracking.php"><i class="fas fa-calendar-alt"></i> Menstrual Cycle Tracking</a></li>
          <li><a href="period_predictions.php"><i class="fas fa-chart-line"></i> Period Predictions</a></li>
          <li><a href="fertility_prediction.php"><i class="fas fa-chart-line"></i> Fertility Predictions</a></li>
          <li><a href="symptomLogging.php"><i class="fas fa-notes-medical"></i> Symptom Logging</a></li>
          <li><a href="User_profile.php"><i class="fas fa-user-edit"></i> Edit my profile</a></li>
          <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
          </div>

    <div class="dashboard">
        <div class = "welcome">
            <h1>Hey Pretty!</h1>
            <p>Ready to track your circle? Even when you don't know how, worry less! We got you!</p>
        </div>

        <div class="intro">
            <h1>Get Started</h1>
            <p>We care about you and provide you with your menstrual cycle information. During your menstrual cycle, your hormone levels fluctuate, affecting your mood, energy levels, and more.
              Keeping track of your cycle can help you anticipate changes and better manage your well-being.</p>
            <button onclick="document.location='period_predictions.php'" >Comfirm your Period start date here</button>
            
        </div>

        <div class="cycle-overview">
        <h2><a href="#">Cycle Summary</a></h2>
            <div class="card">
            <h3><i class="fas fa-infinity"></i> Cycle Length</h3>
            <?php
        // Query to fetch AverageCycleLength for the user
          $query = "SELECT AverageCycleLength FROM periodpredictions WHERE UserID = ?";

          $stmt = $conn->prepare($query);

          $stmt->bind_param("i", $userID); // Bind user ID to the query

          $stmt->execute();

          $result = $stmt->get_result();

          if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $averageCycleLength = $row['AverageCycleLength'];

            // Display AverageCycleLength within a paragraph tag with labels
            echo "<p> <strong>" . $averageCycleLength . " days</strong></p>";
          } else {
            echo "No AverageCycleLength data found.";
          }

          $stmt->close();
                
          ?>

          </div>
          <div class="card">
            <h3><i class="fas fa-tint"></i> Period Length</h3>
            <?php
            // Query to fetch AveragePeriodLength for the user
            $query = "SELECT AveragePeriodLength FROM periodpredictions WHERE UserID = ?";

            $stmt = $conn->prepare($query);

            $stmt->bind_param("i", $userID); // Bind user ID to the query

            $stmt->execute();

            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $averagePeriodLength = $row['AveragePeriodLength'];

                // Display AveragePeriodLength within a paragraph tag with labels
                echo "<p> <strong>" . $averagePeriodLength . " days</strong></p>";
            } else {
                echo "No AveragePeriodLength data found.";
            }

            $stmt->close();
            ?>

          </div>
            <div class="card">
            <h3><i class="fas fa-heartbeat"></i> Ovulation Date</h3>
            <?php
          // Assuming you already have a database connection

          // Query to fetch the start date of the period for the user
          $query = "SELECT LastPeriodDate FROM periodpredictions WHERE UserID = ?";
          $stmt = $conn->prepare($query);
          $stmt->bind_param("i", $userID);
          $stmt->execute();
          $result = $stmt->get_result();

          if ($result->num_rows > 0) {
              $row = $result->fetch_assoc();
              $lastPeriodDate = new DateTime($row['LastPeriodDate']);

              // Calculate ovulation date
              $ovulationDate = clone $lastPeriodDate;
              $ovulationDate->add(new DateInterval("P14D"));

              // Display ovulation date
              echo "<p><strong>" . $ovulationDate->format('Y-m-d') . "</strong></p>";
          } else {
              echo "<p>No data found for the user.</p>";
          }

          $stmt->close();
          ?>

        </div>
        <div class="card">
            <h3><i class="fas fa-baby"></i> Probability of Pregnancy</p>
            <?php
            // Assuming you already have a database connection

            // Query to fetch the start date of the period for the user
            $query = "SELECT LastPeriodDate FROM periodpredictions WHERE UserID = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $userID);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $lastPeriodDate = new DateTime($row['LastPeriodDate']);

                // Calculate ovulation date
                $ovulationDate = clone $lastPeriodDate;
                $ovulationDate->add(new DateInterval("P14D"));

                // Calculate the number of days since ovulation
                $now = new DateTime();
                $interval = $now->diff($ovulationDate);
                $countdown = $interval->days;

                // If the countdown is negative or exceeds the day of ovulation, set it to 0
                if ($countdown < 0 || $countdown > 14) {
                    $countdown = 0;
                } else {
                    // If the countdown is within the ovulation window, calculate the countdown from the ovulation day
                    $countdown = 14 - $countdown;
                }

                // Calculate the probability of pregnancy
                $probability = ($countdown / 14) * 100;

                // Display the probability of pregnancy
                echo "<p><strong>" . round($probability, 2) . "%</strong></p>";
            } else {
                echo "<p>No data found for the user.</p>";
            }

            $stmt->close();
            ?>


        </div>
        <div class="card">
            <h3><i class="fas fa-hourglass-half"></i> Countdown to Ovulation</h3>
            <?php


            // Query to fetch the start date of the period for the user
            $query = "SELECT LastPeriodDate FROM periodpredictions WHERE UserID = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $userID);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $lastPeriodDate = new DateTime($row['LastPeriodDate']);

                // Calculate ovulation date
                $ovulationDate = clone $lastPeriodDate;
                $ovulationDate->add(new DateInterval("P14D"));

                // Calculate countdown to ovulation
                $now = new DateTime();
                $interval = $now->diff($ovulationDate);
                $countdown = $interval->days;

                // If the countdown is negative or exceeds the day of ovulation, adjust it
                if ($countdown < 0 || $countdown > 14) {
                    $countdown = 14;
                }

                // Display countdown to ovulation
                echo "<p><strong>" . $countdown . " days</strong></p>";
            } else {
                echo "<p>No data found for the user.</p>";
            }

            $stmt->close();
            ?>

        </div>
        <div class="card">     
            <h3><i class="fas fa-hourglass-start"></i> Countdown to Next Period</h3>
            <?php
            // Query to fetch NextPeriodStartDate and AverageCycleLength for the user
            $query = "SELECT NextPeriodStartDate, AverageCycleLength FROM periodpredictions WHERE UserID = ?";

            $stmt = $conn->prepare($query);

            if ($stmt) {
                $stmt->bind_param("i", $userID); // Bind user ID to the query

                if ($stmt->execute()) {
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $nextPeriodStartDate = $row['NextPeriodStartDate'];
                        $averageCycleLength = $row['AverageCycleLength'];

                        // Calculate countdown to next period
                        $now = new DateTime();
                        $nextPeriod = new DateTime($nextPeriodStartDate);
                        $interval = $now->diff($nextPeriod);
                        $countdown = $interval->days;

                        // Ensure countdown is within the range of the average cycle length
                        $countdown = min($countdown, $averageCycleLength);

                        // Display countdown within a paragraph tag with labels
                        echo "<p> <strong>" . $countdown . " days</strong></p>";
                    } else {
                        echo "No NextPeriodStartDate data found.";
                    }
                } else {
                    echo "Error executing query: " . $stmt->error;
                }

                $stmt->close();
            } else {
                echo "Error preparing statement: " . $conn->error;
            }
            ?>



        </div>
      </div>
      
        <div class="symptom_monitoring">
    <h2><a href="#">Symptom Monitoring</a></h2>
    <table>
  
      <tbody>
        <?php
      
      // Check if the user is logged in
      if (isset($_SESSION['UserID'])) {
          // Fetch symptoms for the logged-in user
          $query = "SELECT * FROM symptoms WHERE UserID = " . $_SESSION['UserID'];
          $result = mysqli_query($conn, $query);
      
          // Check if the query was successful
          if ($result) {
              // If symptoms are recorded for the user
              if (mysqli_num_rows($result) > 0) {
                  echo "<table>";
                  echo "<thead>";
                  echo "<tr>";
                  echo "<th>Symptom Name</th>";
                  echo "<th>Severity</th>";
                  echo "<th>Frequency</th>";
                  echo "<th>Date Recorded</th>";
                  echo "<th>Notes</th>";
                  echo "<th>Action</th>"; // New column for action buttons
                  echo "</tr>";
                  echo "</thead>";
                  echo "<tbody>";
      
                  // Loop through symptoms and populate table rows
                  while ($row = mysqli_fetch_assoc($result)) {
                      echo "<tr>";
                      echo "<td>" . $row['SymptomName'] . "</td>";
                      echo "<td>" . $row['Severity'] . "</td>";
                      echo "<td>" . $row['Frequency'] . "</td>";
                      echo "<td>" . $row['DateRecorded'] . "</td>";
                      echo "<td>" . $row['Notes'] . "</td>";
                      echo "<td>";
                      // Pass symptom data to openEditPopup() function
                      echo "<button onclick=\"openEditPopup('" . $row['SymptomID'] . "','" . $row['SymptomName'] . "','" . $row['Severity'] . "','" . $row['Frequency'] . "','" . $row['DateRecorded'] . "','" . $row['Notes'] . "')\" style='background-color:#07bca3; padding:5px; color:white; display:inline-block;margin-left:0px;margin-right:10px;'>Edit</button>";
                      // Pass symptom ID to deleteSymptom() function with confirmation
                      echo "<button onclick=\"displayDeleteMessage(" . $row['SymptomID'] . ")\" style='background-color:#07bca3; padding:5px; color:white; display:inline-block; margin-left:0px;'>Delete</button>";
                      echo "</td>";
                      echo "</tr>";
                  }
      
                  echo "</tbody></table>";
              } else {
                  // If no symptoms are recorded for the user
                  echo "No symptoms recorded.";
              }
          } else {
              // If there's an error with the query
              echo "Error: " . mysqli_error($conn);
          }
      
          // Close the database connection
          mysqli_close($conn);
      } else {
          // If the user is not logged in, redirect them to the login page
          header("Location: login.php");
          exit();
      }
      ?>
      
      <!-- Rest of your HTML code -->
      
      <div id="editPopup" class="popup">
        <div class="popup-content">
          <!-- Form fields to edit the symptom -->
          <form id="editForm">
            <!-- Add your form fields here -->
            <input type="hidden" id="symptom_id" name="symptom_id" value="">
            <input type="text" id="editSymptomName" name="editSymptomName" placeholder="Symptom Name" required>
            <input type="text" id="editSeverity" name="severity" placeholder="Severity" required>
            <input type="text" id="editFrequency" name="frequency" placeholder="Frequency" required>
            <input type="date" id="editDateRecorded" name="editDateRecorded" required>
            <textarea id="editNotes" name="notes" placeholder="Notes"></textarea>
            <!-- Move the button to its desired position -->
            <button type="button" onclick="saveChanges()" style="margin-bottom:20px; margin-left:-250px; margin-top:-80px;">Save Changes</button>
          </form>
      
          <button class="close" onclick="closeEditPopup()">Close</button>
        </div>
      </div>
      
      <!-- Delete confirmation message -->
      <div id="deleteConfirmation" style="display: none;">
          <p>Are you sure you want to delete this symptom?</p>
          <button onclick="deleteSymptom()" style="margin-right: 10px;">Yes</button>
          <button onclick="hideDeleteMessage()">No</button>
      </div>
      
      <script>
        // Function to open the edit popup
        function openEditPopup(symptomId, symptomName, severity, frequency, dateRecorded, notes) {
          // Populate form fields with existing data
          document.getElementById("symptom_id").value = symptomId;
          document.getElementById("editSymptomName").value = symptomName;
          document.getElementById("editSeverity").value = severity;
          document.getElementById("editFrequency").value = frequency;
          document.getElementById("editDateRecorded").value = dateRecorded;
          document.getElementById("editNotes").value = notes;
          
          // Show the popup
          document.getElementById("editPopup").style.display = "block";
        }
      
        // Function to close the edit popup
        function closeEditPopup() {
          // Hide the popup
          document.getElementById("editPopup").style.display = "none";
        }
      
        // Function to save changes using AJAX
        function saveChanges() {
          // Get form data
          var formData = new FormData(document.getElementById("editForm"));
      
          // Send AJAX request
          var xhr = new XMLHttpRequest();
          xhr.open("POST", "edit_symptom.php", true);
          xhr.onload = function () {
            if (xhr.status === 200) {
              // Check if the update was successful
              if (xhr.responseText.trim() === "success") {
                // Reload the page to reflect changes
                location.reload();
              } else {
                alert("Error updating record: " + xhr.responseText);
              }
            } else {
              alert("Error: " + xhr.statusText);
            }
          };
          xhr.onerror = function () {
            alert("Network Error");
          };
          xhr.send(formData);
        }
      
        // Function to display delete confirmation message
        function displayDeleteMessage(symptomId) {
          var deleteConfirmation = document.getElementById("deleteConfirmation");
          deleteConfirmation.style.display = "block";
      
          // Store the symptom ID to be deleted
          deleteConfirmation.setAttribute("data-symptom-id", symptomId);
        }
      
        // Function to hide delete confirmation message
        function hideDeleteMessage() {
          var deleteConfirmation = document.getElementById("deleteConfirmation");
          deleteConfirmation.style.display = "none";
        }
      
        // Function to delete symptom with confirmation
        function deleteSymptom() {
          // Get the symptom ID to be deleted
          var symptomId = document.getElementById("deleteConfirmation").getAttribute("data-symptom-id");
      
          // Send AJAX request to delete_symptom.php
          var xhr = new XMLHttpRequest();
          xhr.open("POST", "delete_symptom.php", true);
          xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
          xhr.onreadystatechange = function() {
              if (xhr.readyState == 4 && xhr.status == 200) {
                  // Reload the page after deletion
                  location.reload();
              }
          };
          // Send symptom ID as data to delete_symptom.php
          xhr.send("symptom_id=" + symptomId);
      
          // Hide delete confirmation message
          hideDeleteMessage();
        }
      </script>
    
</body>
</html>