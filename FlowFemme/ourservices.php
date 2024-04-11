<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Our Services - TalentHub</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f8f8f8;
      padding-top: 80px; 
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

    h3 {
      text-align: center;
      margin-top: 20px;
    }
    p {
      color: #666666;
      margin-bottom: 15px;
      text-align: justify;
      margin-left: 0px;
      margin-right: 0px;
      line-height: 1.5;
      font-size: 18px;
    }


    .service-category {
      background-color: #fff;
      padding: 50px 0;
      margin-top:-120px;
    }

    .service-category h2 {
      text-align: center;
    }

    .service-list {
      display: flex;
      justify-content: space-around;
      flex-wrap: wrap;
      margin-top: 40px;
    }

    .service-item {
      width: 25%;
      padding: 20px;
      margin-bottom: 30px;
      background-color: #f2f2f2;
      border-radius: 8px;
      text-align: justify; 
      transition: transform 0.3s ease-in-out;
      margin-left: 20px;
      margin-right: 20px;
    }

    .service-item:hover {
      transform: scale(1.05);
    }

    .service-item img {
      width: 80%;
      height: auto;
    }

    .cta-section {
      background-color: #f9dfe3;
      color:#07bca3;
      padding: 50px 0;
      text-align: center;
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
    h1{
      text-align:center;
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

  <div class="container">
    <div class="service-category">
      <h1 style="background-color: #07bca3; color: #dedab6;">Our Services</h1>
      <div class="service-list">
        <div class="service-item">
          <img src="Images/service1.png" alt="TalentHub Connect Proposal">
          <h3>Periods Tracker and Menstrual Cycle Tracking</h3>
          <p>
            Our intuitive tracking system offers seamless monitoring of your menstrual cycle,
            allowing you to effortlessly log period details and predict future cycles with precision.
            With user-friendly interfaces and insightful analytics,
            staying on top of your reproductive health has never been easier.
            Whether you're planning a pregnancy, managing your fertility,
            or simply keeping track of your cycle for personal health reasons.

          </p>
        </div>
        <div class="service-item">
          <img src="Images/service2.png" alt="Problem Statement">
          <h3>Menstrual Symptom Tracking logging</h3>
          <p>
            Our comprehensive platform enables you to log and track your symptoms throughout your menstrual cycle,
            providing invaluable insights into your hormonal health and helping you better understand your unique patterns.
            By recording symptoms such as mood swings, cramps, bloating, and energy levels at different phases of your cycle,
            you can identify recurring patterns and potential triggers.
            With this data at your fingertips, you'll be empowered to make informed decisions about your health and well-being.
            
          </p>
        </div>
        <div class="service-item">
          <img src="Images/service3.png" alt="Employer Services">
          <h3>Menstual Period Predictions</h3>
          <p>
            Our platform goes beyond basic tracking by providing personalized predictions for your upcoming menstrual cycles based on the data you've diligently logged.
            With advanced algorithms analyzing your historical cycle data and symptom patterns, you'll receive tailored forecasts that empower you to plan and prepare with confidence.
            Whether you're anticipating your next period, tracking ovulation for fertility purposes, or simply staying ahead of hormonal fluctuations,
            our predictive capabilities ensure you're always one step ahead. Say goodbye to surprises and hello to proactive menstrual cycle management.
          </p>
        </div>
      </div>
    </div>

    <div class="cta-section">
      <h2>Ready to Experience Our Services?</h2>
      <p>Take the first step towards better talents worlds today.</p>
      <a href="Index.php" class="cta-btn">Join Us Today</a>
    </div>
  </div>
</body>

</html>
