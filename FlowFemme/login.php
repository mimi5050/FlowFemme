<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FlowFemme - Login</title>
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

        .login-container {
            background-color: whitesmoke;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 300px; 
            position: relative; 
        }

        h2 {
            color: #07bca3; 
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc; 
            border-radius: 25px;
            outline: none;
        }

        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: #ff69b4; 
        }

        button {
            background-color: #07bca3; 
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            width: 100%;
            margin-top: 20px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #05a793; 
        }

        p {
            margin-top: 15px;
        }

        a {
            color: #07bca3; 
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .left-image,
        .right-image {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            height: 250px; 
        }

        .left-image {
            left: 100px; 
        }

        .right-image {
            right: 200px; 
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Welcome to FlowFemme</h2>
        <form id="login-form" action="login_backend.php" method="post">
            <input type="email" name="email" id="email" placeholder="Email" required>
            <input type="password" name="password" id="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="signup.php">Sign up</a></p>
    </div>
</body>
</html>
