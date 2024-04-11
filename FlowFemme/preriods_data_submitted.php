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
                <li><span class="icon icon-1"></span> Regular cycle length: <span class="highlight">28 days</span></li>
                <li><span class="icon icon-2"></span> Expected ovulation period: <span class="highlight">Day 14</span></li>
                <li><span class="icon icon-3"></span> Potential symptoms expected: <span class="highlight">Bloating, cramping, mood changes</span></li>
            </ul>
        </div>
    </div>
</body>
</html>
