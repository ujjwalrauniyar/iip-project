<html>
<head>
</head>
<body>
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

// Retrieve the form data
$email = $_POST['email'];
$password = $_POST['password'];

// Check if the user is already registered
$sql = "SELECT * FROM storeb WHERE email='$email' AND password='$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // User is already registered, continue to the next step
    // ...
} else {
    // User is not registered, ask them to sign up first
    echo '<script type="text/javascript">';
    echo 'alert("You are not registered yet. Please sign up first to proceed further.");';
    echo '</script>';
    header("Location: indexgpt.html");
    exit;
}
$conn->close();
?>
</body>
</html>