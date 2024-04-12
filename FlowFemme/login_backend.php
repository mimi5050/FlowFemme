<?php
// Start session
session_start();
// Include connection.php to establish a database connection
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Retrieve user data from the database
    $query = "SELECT UserID, Username, Password FROM users WHERE Email = '$email'";
    $result = $conn->query($query);
    
    if ($result->num_rows > 0) {
        // User found, verify password
        $row = $result->fetch_assoc();
        $hashed_password = $row["Password"];
        
        if (password_verify($password, $hashed_password)) {
            // Password correct, set session variables
            $_SESSION["UserID"] = $row["UserID"];
            $_SESSION["Username"] = $row["Username"];
            
            // Redirect user to dashboard
            header("Location: dashboard.php");
            exit();
        } else {
            // Invalid password, set error message
            $_SESSION["error_message"] = "Invalid email or password";
            // Redirect back to login page
            header("Location: login.php");
            exit();
        }
    } else {
        // User not found, set error message
        $_SESSION["error_message"] = "User not found";
        // Redirect back to login page
        header("Location: login.php");
        exit();
    }
}

// Close database connection
$conn->close();
?>
