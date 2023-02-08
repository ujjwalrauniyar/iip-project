<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "track";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form data has been sent
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve the form data
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    
    // Validate the form data
    $errors = array();
    
    if (empty($email)) {
        $errors[] = "Email field is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email address.";
    }
    
    if (empty($password)) {
        $errors[] = "Password field is required.";
    } elseif (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters long.";
    }
    
    if (empty($confirm_password)) {
        $errors[] = "Confirm password field is required.";
    } elseif ($password !== $confirm_password) {
        $errors[] = "Password and confirm password do not match.";
    }
    
    // If there are no errors, insert the data into the database
    if (empty($errors)) {
        $sql = "INSERT INTO storeb(email, password, confirm_password)
        VALUES ('$email', '$password','$confirm_password')";
        
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('New record created successfully.');</script>";
        } else {
            echo "<script>alert('Error: " . $conn->error . "');</script>";
        }
    } else {
        // If there are errors, display them to the user
        echo "<script>alert('" . implode("\\n", $errors) . "');</script>";
    }
}

$conn->close();
?>