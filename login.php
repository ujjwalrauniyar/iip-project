<?php

// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "track";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the entered email and password
$email = $_POST['email'];
$password = $_POST['password'];

// Prepare and execute the SQL statement
$sql = "SELECT * FROM storeb WHERE email = '$email' AND password = '$password'";
$result = $conn->query($sql);

// If there is a match, start a new session and redirect to the protected page
if ($result->num_rows > 0) {
    session_start();
    $_SESSION['logged_in'] = true;
    header("Location: mayank.html");
} else {
    // If the email and password don't match a record, show an error message
    // echo 'alert("You are not registered yet. Please sign up first to proceed further.");';
    // header("Location: indexgpt.html");
    // exit;
    echo "Incorrect email or password";
}

// Close the connection
$conn->close();

?>