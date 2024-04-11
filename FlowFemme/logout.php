<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #07bca3; 
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .logout-container {
            background-color: whitesmoke; 
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); 
            text-align: center;
            width: 300px; 
        }

        h2 {
            color: #07bca3; 
        }

        p {
            margin-top: 20px;
        }

        a {
            color: #07bca3; 
            text-decoration: none;
            font-weight: bold;
            margin-top: 20px;
            display: block;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="logout-container">
        <h2>Logout</h2>
        <p>Are you sure you want to log out?</p>
        <p>If you log out, you will be redirected to the login page.</p>
        <a href="Index.php">Yes, Logout</a>
        <a href="dashboard.php">No, Go Back to Dashboard</a>
    </div>
</body>
</html>
