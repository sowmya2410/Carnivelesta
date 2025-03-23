<?php
ob_start();
session_start();

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "carnival";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];}


    $check_query = "SELECT userid FROM users WHERE username = '$username'";
    $result = $conn->query($check_query);
    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();
        $user_id = $row['userid'];
        $_SESSION['userid']=$user_id;

    // Check if username exists in the database
    $check_query = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($check_query);

    if ($result->num_rows > 0) {
        // Username exists, verify password
        $row = $result->fetch_assoc();
        $hashed_password = $row['password'];

        if (password_verify($password, $hashed_password)) {
            header("Location: indexlogged.php");// Password is correct, redirect to a new page (replace 'welcome.php' with your desired page)
            $_SESSION['username'] = $username; // Store username in session for future use
            
            exit();
        } else {
            // Incorrect password
            header("location: loginerror.html");
            exit();
        }
    } else {
        // Username doesn't exist
        header("location: loginerror.html");
            exit();
       
    }
}

// Close connection
$conn->close();
ob_end_flush();
?>
