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
</main>
</body>
</html>
