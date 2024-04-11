<?php
session_start();
// Include connection.php to establish a database connection
include 'connection.php';

// Check if the user is logged in
if (!isset($_SESSION["UserID"])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}

// Check if the form is submitted for updating email or password
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the email or password is being updated
    if (isset($_POST["email"]) && isset($_POST["password"])) {
        $userID = $_SESSION["UserID"];
        $newEmail = $_POST["email"];
        $newPassword = $_POST["password"];

        // Update the user's email and password in the database
        $sql = "UPDATE users SET Email = ?, Password = ? WHERE UserID = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("ssi", $newEmail, $newPassword, $userID);
            if ($stmt->execute()) {
                // Email and password updated successfully
                // You can redirect the user or show a success message here
            } else {
                // Error updating email and password
                echo "Error updating email and password.";
            }
            $stmt->close();
        } else {
            // Error in preparing the SQL statement
            echo "Error preparing statement.";
        }
    }
    exit(); // Prevent further execution of the script
}

// Retrieve user information from the database
$userID = $_SESSION["UserID"];
$sql = "SELECT Email, Password FROM users WHERE UserID = ?";
if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("i", $userID);
    $stmt->execute();
    $stmt->bind_result($email, $password);
    $stmt->fetch();
    $stmt->close();
} else {
    // Error in preparing the SQL statement
    echo "Error preparing statement.";
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Dashboard | FlowFemme</title>
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
    .account-settings {
        background-color: #f9f9f9;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-left:5%;
        margin-top:80px;
        width:100%;
        }

        .account-settings h2 {
        color: #333;
        font-size: 24px;
        margin-bottom: 20px;
        }

        .account-settings p {
        color: #555;
        font-size: 16px;
        margin-bottom: 10px;
        
        }

        .account-settings strong {
        color: #333;
        font-weight: bold;
        }

        .editable {
        cursor: pointer;
        border-bottom: 1px dashed #07bca3;
        transition: border-bottom 0.3s;
        width:60%;
        }

        .editable:hover {
        border-bottom: 1px dashed #07bca3;
        }

        .edit-input {
        border: none;
        outline: none;
        font-size: inherit;
        font-family: inherit;
        background-color: transparent;
        width: calc(100% - 5px);
        padding: 2px;
        width:60%;
        }
        .profile-picture-upload input[type="file"] {
    display: none;
  }

  .profile-picture-upload label {
    background-color: #07bca3;
    color: white;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
  }

  .profile-picture-upload label:hover {
    background-color: #05a392;
  }

  
  .profile-picture {
    width: 200px;
    height: 200px;
    border-radius: 50%;
    overflow: hidden;
    margin-bottom: 20px;
  }

  .profile-picture img {
    width: 100%;
    height: 100%;
    object-fit: cover;
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
        <ul> 
            <li><a href="dashboard.php"><i class="fas fa-home"></i>Overview </a></li>
            <li><a href="cycle_tracking.php"><i class="fas fa-calendar-alt"></i>Menstrual Cycle Tracking</a></li>
            <li><a href="period_predictions.php"><i class="fas fa-chart-line"></i>Period Predictions</a></li>
            <li><a href="fertility_prediction.php"><i class="fas fa-chart-line"></i> Fertility Predictions</a></li>
            <li><a href="symptomLogging.php"><i class="fas fa-notes-medical"></i> Symptom Logging</a></li>
            <li><a class="active" href="#"><i class="fas fa-user-edit"></i>Edit my profile</a></li>
            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul> 
    </div>


    <div class="dashboard">
    <div class="welcome">
      <h1>Hey Pretty!</h1>
      <p>Ready to track your circle? Even when you don't know how, worry less! We got you!</p>
    </div>

    <div class="account-settings">
    <h2>Account Settings</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      <p><strong>Email:</strong> <span id="email" class="editable" onclick="editField(this)"><?php echo $email; ?></span></p>
      <p><strong>Password:</strong> <span id="password" class="editable" onclick="editField(this)"><?php echo $password; ?></span></p>
      <!-- Add input fields for editing email and password -->
      <input type="text" name="email" id="edit-email" style="display: none;">
      <input type="text" name="password" id="edit-password" style="display: none;">
      <p><strong>Profile Picture:</strong></p>
      <div class="profile-picture">
        <img src="Images\Naomi.png" alt="Profile Picture">
      </div>
      <div class="profile-picture-upload">
        <input type="file" id="profile-picture" accept="image/*">
        <label for="profile-picture">Upload Picture</label>
      </div>
      <button type="submit" style="margin-top:40px; width:150px; color:white; height:40px; background-color:#07bca3;">Save Changes</button>
    </form>
  </div>

  <script>
    function editField(element) {
      var value = element.textContent.trim();
      var input = document.createElement('input');
      input.value = value;
      input.setAttribute('name', 'temp');
      element.textContent = '';
      element.appendChild(input);
      input.focus();

      input.addEventListener('blur', function() {
        element.textContent = input.value;
        if (element.id === 'email') {
          document.getElementById('edit-email').value = input.value;
        } else if (element.id === 'password') {
          document.getElementById('edit-password').value = input.value;
        }
      });
    }
  </script>
</body>
</html>