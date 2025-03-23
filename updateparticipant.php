<?php
// Establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "carnival";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}





if ($_SERVER["REQUEST_METHOD"] == "POST") {
// Get form data
$participant_id = $_POST['participant_id'];
$name = $_POST['name'];
$contact = $_POST['contact'];
$email = $_POST['email'];
$department = $_POST['department'];
$college_name = $_POST['college_name'];
$college_reg_number = $_POST['college_reg_number'];
$year_of_studying = $_POST['year_of_studying'];

// Update participant details in the database
$sql = "UPDATE participant_details SET name='$name', contact_number='$contact', email_id='$email', department='$department', college_name='$college_name', college_registration_number='$college_reg_number', year_of_studying='$year_of_studying' WHERE participant_id='$participant_id'";

if ($conn->query($sql) === TRUE) {
        header("Location: displayparticipants.php"); // Redirect to the profile page with updated details
        exit(); }
    
} else {
    echo "Error updating participant details: " . $conn->error;
}

$conn->close();
?>
