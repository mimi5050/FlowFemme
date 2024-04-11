<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Symptom Data Recorded</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
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

        .back-button {
            margin-top: 30px;
            background-color: #07bca3;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            text-decoration: none;
        }

        .back-button:hover {
            background-color: #05a091;
        }
    </style>
</head>
<body>
    <div class="message-container">
        <h1>Symptom Data Recorded!</h1>
        <p>Your symptom data has been successfully recorded.</p>
        <p>Click <a href="dashboard.php">here</a> to return to the dashboard.</p>

        <a href="dashboard.php" class="back-button">Back to Dashboard</a>
    </div>
</body>
</html>
