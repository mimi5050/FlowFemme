<?php
// Start the session
session_start();

// Include the connection file
include 'connection.php';

// Check if user is logged in and user_id is set in session
if(isset($_SESSION['user_id'])) {
    // Assuming you have a logged-in user ID stored in $user_id
    $user_id = $_SESSION['user_id'];

    // Query to fetch the average cycle length for the logged-in user
    $query_cycle_length = "SELECT AverageCycleLength FROM periodpredictions WHERE UserID = $user_id";

    // Execute the query
    $result_cycle_length = mysqli_query($connection, $query_cycle_length);
    

    // Check if the query executed successfully
    if ($result_cycle_length) {
        // Fetch the average cycle length from the result
        $row_cycle_length = mysqli_fetch_assoc($result_cycle_length);
        $average_cycle_length = $row_cycle_length['AverageCycleLength'];
    } else {
        // Handle error if the query fails
        $average_cycle_length = 28; // Assuming a default value of 28 days
    }

    // Query to fetch the average period length for the logged-in user
    $query_period_length = "SELECT AveragePeriodLength FROM periodpredictions WHERE UserID = $user_id";

    // Execute the query
    $result_period_length = mysqli_query($conn, $query_period_length);

    // Check if the query executed successfully
    if ($result_period_length) {
        // Fetch the average period length from the result
        $row_period_length = mysqli_fetch_assoc($result_period_length);
        $average_period_length = $row_period_length['AveragePeriodLength'];
    } else {
        // Handle error if the query fails
        $average_period_length = 5; // Assuming a default value of 5 days
    }

    // Assuming $day contains the current day, calculate the cycle day
    $day = 1; // Assuming day 1 for demonstration
    $cycleDay = ($day % $average_cycle_length) + 1;

    // Use the fetched values in your code as needed
    echo "Average Cycle Length: $average_cycle_length<br>";
    echo "Average Period Length: $average_period_length<br>";
    echo "Cycle Day: $cycleDay<br>";
} else {
    // Handle case where user is not logged in or session variable is not set
    echo "User is not logged in.";
}

// Close the database connection
mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
<head>
  <title>Dashboard | TalentHub</title>
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
  
    .calender_container {
    width: 80%;
    min-height: 80vh;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-left:150px;
    background-color:whitesmoke;
  }
  .calendar {
    width: 100%;
    max-width: 600px;
    background: var(--bg-color);
    padding: 30px 20px;
    border-radius: 10px;
    margin-top:20px;
    margin-right:100px;
   
  }
  .calendar .header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    padding-bottom: 20px;
    border-bottom: 2px solid #ccc;
  }
  .calendar .header .month {
    display: flex;
    align-items: center;
    font-size: 25px;
    font-weight: 600;
    color: var(--text-color);
  }
  .calendar .header .btns {
    display: flex;
    gap: 10px;
  }
  .calendar .header .btns .btn {
    width: 40px;
    height: 30px;
    background: var(--primary-color);
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 5px;
    color: #fff;
    font-size: 16px;
    cursor: pointer;
    transition: all 0.3s;
  }
  .calendar .header .btns .btn:hover {
    background: white; 
    transform: scale(1.05);
    color:black;
  }
  .calendar .weekdays {
    display: flex;
    gap: 10px;
    margin-bottom: 10px;
  }
  .calendar .weekdays .day {
    width: calc(100% / 7 - 10px);
    text-align: center;
    font-size: 16px;
    font-weight: 600;
  }
  .calendar .days {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
  }
  .calendar .days .day {
    width: calc(100% / 7 - 10px);
    height: 50px;
    background: #fff;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 5px;
    font-size: 16px;
    font-weight: 400;
    color: var(--text-color);
    transition: all 0.3s;
    user-select: none;
  }
  .calendar .days .day:not(.next):not(.prev):hover {
    color: #fff;
    background: #ff4d6d; 
    transform: scale(1.05);
  }
  .calendar .days .day.next,
  .calendar .days .day.prev {
    color: #ccc;
  }
  .calendar .days .day.today {
    color: #fff;
    background: var(--primary-color);
  }
  .credits a {
    position: absolute;
    bottom: 10px;
    left: 50%;
    transform: translateX(-50%);
    font-size: 14px;
    color: #aaa;
  }
  .credits span {
    color: var(--primary-color);
  }
  h3{
      text-align: center;
      margin-top:100px;
    }

 .popup {
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
}

.popup-title {
    text-align: center;
    margin-bottom: 20px;
    margin-top:-10px;
    color: #07bca3;
    }

.close {
  color: #aaa;
  position: absolute;
  top: 10px;
  right: 10px;
  font-size: 24px;
  font-weight: bold;
  cursor: pointer;
}

.close:hover {
  color: #555;
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
            <li><a class="active" href="#"><i class="fas fa-calendar-alt"></i>Menstrual Cycle Tracking</a></li>
            <li><a href="period_predictions.php"><i class="fas fa-chart-line"></i> Period Predictions</a></li>
            <li><a href="fertility_prediction.php"><i class="fas fa-chart-line"></i>Fertility Predictions</a></li>
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
  <div class="Predict_Your_Next_Period" style="margin-left:250px;text-align:left;">
        <h2 >Menstrual Cycle Tracking</h2>
        <p>For those tracking their menstrual cycles, our platform offers menstrual cycle tracking tools, including predictions of fertile windows and period predictions based on your previous cycle data. Fill out the form below to get started:</p>
    </div>
  <div class="calender_container">
  <div class="calendar">
    <div class="header">
      <div class="month">July 2021</div>
      <div class="btns">
        <!-- today -->
        <div class="btn today">
          <i class="fas fa-calendar-day"></i>
        </div>
        <!-- previous month -->
        <div class="btn prev">
          <i class="fas fa-chevron-left"></i>
        </div>
        <!-- next month -->
        <div class="btn next">
          <i class="fas fa-chevron-right"></i>
        </div>
      </div>
    </div>
    <div class="weekdays">
      <div class="day">Sun</div>
      <div class="day">Mon</div>
      <div class="day">Tue</div>
      <div class="day">Wed</div>
      <div class="day">Thu</div>
      <div class="day">Fri</div>
      <div class="day">Sat</div>
    </div>
    <div class="days">
      <!-- render days with js -->
    </div>
  </div>
</div>
<!-- Popup for adding notes -->
<div id="notePopup" class="popup">
  <div class="popup-content">
    <span class="close">&times;</span>
    <h2 class="popup-title">Add Note</h2>
    <form id="noteForm" action="save_notes.php" method="POST">
        <input type="text" id="noteTitle" name="noteTitle" placeholder="Note Title">
        <textarea id="noteText" name="noteText" rows="4" cols="50" placeholder="Add your notes here..."></textarea>
        <button id="saveNoteBtn" style="background-color:#07bca3; margin-top:20px;font-size:18px;color:white; margin-left:150px; padding:10px;">Save</button>
    </form>

  </div>
</div>

<script>
// Function to determine the phase of the cycle based on the day
function getPhase(day) {
  const cycleLength = 28; // Assuming a standard 28-day menstrual cycle
  const menstruationLength = 5; // Assuming menstruation lasts for 5 days

  // Calculate the day of the cycle (assuming day 1 is the first day of menstruation)
  const cycleDay = (day % cycleLength) + 1;

  // Determine the phase based on the cycle day
  if (cycleDay <= menstruationLength) {
    return "menstruation";
  } else if (cycleDay > menstruationLength && cycleDay <= 14) {
    return "follicular";
  } else if (cycleDay === 15) {
    return "ovulation";
  } else {
    return "luteal";
  }
}

const daysContainer = document.querySelector(".days");
const nextBtn = document.querySelector(".next");
const prevBtn = document.querySelector(".prev");
const todayBtn = document.querySelector(".today");
const month = document.querySelector(".month");

const months = [
  "January", "February", "March", "April", "May", "June",
  "July", "August", "September", "October", "November", "December"
];

const days = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];

const date = new Date();
let currentMonth = date.getMonth();
let currentYear = date.getFullYear();

const renderCalendar = () => {
  date.setDate(1);
  const firstDay = new Date(currentYear, currentMonth, 1);
  const lastDay = new Date(currentYear, currentMonth + 1, 0);
  const lastDayIndex = lastDay.getDay();
  const lastDayDate = lastDay.getDate();
  const prevLastDay = new Date(currentYear, currentMonth, 0);
  const prevLastDayDate = prevLastDay.getDate();
  const nextDays = 7 - lastDayIndex - 1;

  month.innerHTML = `${months[currentMonth]} ${currentYear}`;

  let daysHtml = "";

  for (let x = firstDay.getDay(); x > 0; x--) {
    daysHtml += `<div class="day prev">${prevLastDayDate - x + 1}</div>`;
  }

  for (let i = 1; i <= lastDayDate; i++) {
    let phase = getPhase(i);
    let color = getPhaseColor(phase);
    let dayElement = `<div class="day" style="background-color: ${color};"><a class="date-link" href="#" data-day="${i}">${i}</a></div>`;
    daysHtml += dayElement;
  }

  for (let j = 1; j <= nextDays; j++) {
    daysHtml += `<div class="day next">${j}</div>`;
  }

  daysContainer.innerHTML = daysHtml;
  hideTodayBtn();
};

const getPhaseColor = (phase) => {
  const phaseColors = {
    menstruation: "red",
    follicular: "grey",
    ovulation: "green",
    luteal: "pink"
  };
  return phaseColors[phase] || "whitesmoke";
};


// Event listener for clicks on each date
document.addEventListener('click', function(e) {
  if (e.target && e.target.classList.contains('date-link')) {
    e.preventDefault();
    const day = e.target.dataset.day;
    const monthYear = document.querySelector(".month").innerText.trim();
    // Show popup for adding notes and pass the date information
    openNotePopup(day, monthYear);
  }
});

function openNotePopup(day, monthYear) {
  // Display the popup
  document.getElementById('notePopup').style.display = "block";
  // Set the day and monthYear in the popup
  document.getElementById('notePopup').setAttribute('data-day', day);
  document.getElementById('notePopup').setAttribute('data-month-year', monthYear);
}

// Save the note when clicking on the save button
document.getElementById('saveNoteBtn').addEventListener('click', function() {
    // Disable the button to prevent multiple submissions
    this.disabled = true;

    // Get the day and month_year values
    const day = document.getElementById('notePopup').getAttribute('data-day');
    const monthYear = document.querySelector(".month").textContent.trim();

    // Add day and month_year values to form data
    const formData = new FormData();
    formData.append('noteTitle', document.getElementById('noteTitle').value);
    formData.append('noteText', document.getElementById('noteText').value);
    formData.append('day', day);
    formData.append('monthYear', monthYear);

    // Send form data to PHP script
    fetch('save_notes.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (response.ok) {
            // Redirect to success page
            window.location.href = 'success.php';
        } else {
            throw new Error('Network response was not ok');
        }
    })
    .catch(error => {
        console.error('There was a problem with the fetch operation:', error);
    });
});



// Close the popup when clicking on the close button
document.addEventListener('click', function(e) {
  if (e.target && e.target.classList.contains('close')) {
    closeNotePopup();
  }
});

// Close the popup when clicking outside of it
window.addEventListener('click', function(event) {
  const notePopup = document.getElementById('notePopup');
  if (event.target == notePopup) {
    closeNotePopup();
  }
});

// Save the note when clicking on the save button
document.getElementById('saveNoteBtn').addEventListener('click', function() {
  const day = document.getElementById('notePopup').getAttribute('data-day');
  const note = document.getElementById('noteTextarea').value;
  // Here you can handle saving the note, for example, send it to a server or store it locally
  console.log("Note for day", day, ":", note);
  // Close the popup after saving the note
  closeNotePopup();
});

// Save the note when clicking on the save button
document.getElementById('saveNoteBtn').addEventListener('click', function() {
  // Submit the form
  document.getElementById('noteForm').submit();
});

function closeNotePopup() {
  document.getElementById('notePopup').style.display = "none";
}

nextBtn.addEventListener("click", () => {
  currentMonth++;
  if (currentMonth > 11) {
    currentMonth = 0;
    currentYear++;
  }
  renderCalendar();
});

prevBtn.addEventListener("click", () => {
  currentMonth--;
  if (currentMonth < 0) {
    currentMonth = 11;
    currentYear--;
  }
  renderCalendar();
});

todayBtn.addEventListener("click", () => {
  currentMonth = date.getMonth();
  currentYear = date.getFullYear();
  renderCalendar();
});

function hideTodayBtn() {
  if (
    currentMonth === new Date().getMonth() &&
    currentYear === new Date().getFullYear()
  ) {
    todayBtn.style.display = "none";
  } else {
    todayBtn.style.display = "flex";
  }
}

renderCalendar();
</script>

</body>
</html>