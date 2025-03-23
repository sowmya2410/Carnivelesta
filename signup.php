<?php
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
    // Retrieve form data
    $name = $_POST['name'];
    $username = $_POST['username'];
    $contact = $_POST['contact'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

}
    $min = 1001;
    $max = 10000;
    $randomNumber = mt_rand($min, $max);

    $retryLimit = 5; // Set a limit for retries
    $retryCount = 0;

    // Check if username already exists
    $check_query = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($check_query);

    if ($result->num_rows > 0) {
        // Username already exists
        header("location:signuperror.html");
    } elseif ($password !== $confirm_password) {
        // Passwords do not match
        echo "Error: Passwords do not match.";
    } else {
        // Hash the password before storing in the database (use appropriate hashing algorithm)
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);


       do{ 

        // Prepare and bind the SQL statement
        $stmt = $conn->prepare("INSERT INTO users (name, username, contact, password,userid) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss",$name, $username, $contact, $hashed_password,$randomNumber);
        $_SESSION['userid']=$randomNumber;

        // Execute the statement
        if ($stmt->execute() === TRUE) {
            header("Location:login.html");
            exit();
            break;
        } else {
            if ($conn->errno == 1062) {
                // MySQL error code 1062 is for duplicate entry (primary key violation)
                $randomNumber = mt_rand($min, $max);
        
            } else {
                echo "Error: " . $stmt->error;
                
                break;
            }
        }
        $retryCount++;
} while ($retryCount < $retryLimit);
    
        // Close statement and connection
        $stmt->close();
       
     }

// Close connection
$conn->close();
?>
