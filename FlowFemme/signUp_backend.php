<?php
// Include connection.php to establish a database connection
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    // Insert user data into the database
    $insert_query = "INSERT INTO users (Username, Email, Password) VALUES ('$username', '$email', '$hashed_password')";
    
    if ($conn->query($insert_query) === TRUE) {
        // Redirect user after successful registration
        header("Location: signup_success.php");
        exit();
    } else {
        echo "Error: " . $insert_query . "<br>" . $conn->error;
    }
}

// Close database connection
$conn->close();
?>