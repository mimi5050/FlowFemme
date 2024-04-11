<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us - FlowFemme</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      background-color: #f9dfe3;
      overflow-x: hidden;
    }
    .container {
      margin: 0 auto;
      padding: 20px;
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
      margin-left:600px;
    }

    .navigation a {
      color: #07bca3; 
      text-decoration: none;
      margin-right: 30px;
      font-size: 18px;
      font-weight: bold;
    }

    .content-container {
      display: flex;
      justify-content: center;
      align-items: flex-start; 
      padding: 20px;
  
    }

    .content {
      background-color: #ffffff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      width: 80%; 
      margin-top:125px;
      margin-right:-100px;
    }

    .content-text {
      width: 80%; 
      margin-top:100px;
      font-size:18px;
    }

    .content-image {
      float: left; 
      width: 25%; 
      margin-right: -100px; 
      margin-top:150px;
      margin-left:80px;
    }

    h1 {
      color: #07bca3;
      text-align: center; 
      background-color: #dedab6;
      padding: 2px 0; 
      margin-left:80px;
      margin-top:-80px;
    }


    p {
      color: #666666;
      margin-bottom: 15px; 
      text-align:justify;
      margin-left:60px;
      margin-right:-60px;
      
    }
    
    .cta-section {
      background-color: #f9dfe3;
      padding: 20px;
      text-align: center;
      margin-top: 50px;
    }

    .cta-section h2 {
      color: #07bca3;
      text-align:center;
    }

    .cta-section p {
      color: #666666;
      margin-bottom: 20px;
      text-align:center;
    }

    .cta-btn {
      padding: 10px 20px;
      background-color: #07bca3;
      color: #fff;
      text-decoration: none;
      border-radius: 5px;
      font-weight: bold;
      transition: background-color 0.3s ease;

    }

    .cta-btn:hover {
      background-color: #05a793;
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
  </div>
  <div class="content-image">
    <img src="Images/Naomi.png" alt="About Us Image" style="max-width: 100%;">
  </div>
  <div class="content-container">
    <div class="content">
      <div class="content-text">
      <h1 style="background-color: #07bca3; color: #dedab6;">About Us</h1>
        <p>Welcome to FlowFemme, your trusted platform for tracking your menstrual cycle and promoting feminine wellness. At FlowFemme, we strive to empower women with knowledge and resources to manage their health confidently.</p>
        <p>Our team is dedicated to providing accurate, reliable information and innovative tools to support women throughout their reproductive journey. Join us in embracing your feminine health with FlowFemme.</p>
        <p>FlowFemme was founded by Naomi Johnson, a passionate advocate for women's health and wellness. With a background in healthcare and a mission to improve women's lives, Naomi leads our team in delivering exceptional services and empowering women worldwide.</p>
        <p>Thank you for choosing FlowFemme as your partner in achieving optimal feminine health. We're here to support you every step of the way.</p>
      </div>
    </div>
  </div>
  <div class="cta-section">
    <h2>Ready to Experience Our Services?</h2>
    <p>Take the first step towards better talents worlds today.</p>
    <a href="Index.php" class="cta-btn">Join Us Today</a>
  </div>
</body>

</html>
