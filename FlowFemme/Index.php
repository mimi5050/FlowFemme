<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome to FlowFemme</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      overflow: hidden;
      background-color: #fff; 
    }

    header {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 80px; 
      background-color: white;
      display: flex;
      align-items: center;
      padding: 0 20px;
      z-index: 1000;
    }

    .logo {
      width: 200px;
      height:18px;
      height: auto;
    }


    .navigation {
      margin-left: auto; 
      margin-left:705px;
    }

    .navigation a {
      color: #07bca3; 
      text-decoration: none;
      margin-right: 30px;
      font-size: 18px;
      font-weight: bold;
    }

    .landing-container {
      position: relative;
      height: 100vh;
      overflow: hidden;
      margin-top: 80px;
    }

    .slide {
      width: 100%;
      height: 100%;
      position: absolute;
      transition: opacity 1s ease-in-out;
      opacity: 1;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      background-image: url("Images/slide1.png");
      background-size: cover;
    }

    .content {
      text-align: center;
      z-index: 1;
      background-color: whitesmoke; 
      padding: 20px;
      border-radius: 10px; 
    }

    .content h1, .content p {
      margin: 0; 
    }

    .button-container {
      margin-top: 20px;
    }

    .button {
      padding: 10px 20px;
      background-color: #07bca3;
      color: #fff;
      border: none;
      border-radius: 5px;
      font-size: 16px;
      cursor: pointer;
      margin-right: 10px;
    }
  </style>
</head>

<body>
<header>
  <img class="logo" src="Images/Logo.png" alt="Logo">
    <div class="container">
      <div class="navigation">
        <a href="Index.php"> Home</a>
        <a href="AboutUs.php">About Us</a>
        <a href="ourservices.php">Our Services</a>
      </div>
    </div>
  </header>

  <div class="landing-container">
    <div class="slide active">
      <div class="content">
        <h1><strong>Welcome to FlowFemme</strong></h1>
        <p>Explore the amazing services we offer.</p> 
        <div class="button-container">
          <button class="button" onclick="window.location.href='login.php'">Login here!</button>
          <button class="button" onclick="window.location.href='signUp.php'">Register here!</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    let currentSlide = 0;
    const slides = document.querySelectorAll('.slide');

    function showSlide(index) {
      slides.forEach((slide, i) => {
        slide.classList.toggle('active', i === index);
      });
    }

    showSlide(currentSlide);

    // Collapsible
var coll = document.getElementsByClassName("collapsible");

for (let i = 0; i < coll.length; i++) {
    coll[i].addEventListener("click", function () {
        this.classList.toggle("active");

        var content = this.nextElementSibling;

        if (content.style.maxHeight) {
            content.style.maxHeight = null;
        } else {
            content.style.maxHeight = content.scrollHeight + "px";
        }

    });
}

function getTime() {
    let today = new Date();
    hours = today.getHours();
    minutes = today.getMinutes();

    if (hours < 10) {
        hours = "0" + hours;
    }

    if (minutes < 10) {
        minutes = "0" + minutes;
    }

    let time = hours + ":" + minutes;
    return time;
}

// Gets the first message
function firstBotMessage() {
    let firstMessage = "How's it going?"
    document.getElementById("botStarterMessage").innerHTML = '<p class="botText"><span>' + firstMessage + '</span></p>';

    let time = getTime();

    $("#chat-timestamp").append(time);
    document.getElementById("userInput").scrollIntoView(false);
}

firstBotMessage();

// Retrieves the response
function getHardResponse(userText) {
    let botResponse = getBotResponse(userText);
    let botHtml = '<p class="botText"><span>' + botResponse + '</span></p>';
    $("#chatbox").append(botHtml);

    document.getElementById("chat-bar-bottom").scrollIntoView(true);
}

//Gets the text text from the input box and processes it
function getResponse() {
    let userText = $("#textInput").val();

    if (userText == "") {
        userText = "Welcome to the new housing experience!";
    }

    let userHtml = '<p class="userText"><span>' + userText + '</span></p>';

    $("#textInput").val("");
    $("#chatbox").append(userHtml);
    document.getElementById("chat-bar-bottom").scrollIntoView(true);

    setTimeout(() => {
        getHardResponse(userText);
    }, 1000)

}

// Handles sending text via button clicks
function buttonSendText(sampleText) {
    let userHtml = '<p class="userText"><span>' + sampleText + '</span></p>';

    $("#textInput").val("");
    $("#chatbox").append(userHtml);
    document.getElementById("chat-bar-bottom").scrollIntoView(true);

    
    setTimeout(() => {
         getHardResponse(sampleText);
     }, 2000)
}

function sendButton() {
    getResponse();
}

function heartButton() {
    buttonSendText("Love!")
}

// Press enter to send a message
$("#textInput").keypress(function (e) {
    if (e.which == 13) {
        getResponse();
    }
});
  </script>
</body>

</html>
