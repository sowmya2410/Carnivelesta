<?php
// Update ticket count for a specific event (Replace with your database connection details)
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

$event_id = $_GET['event_id']; // Get the event ID from the URL parameter
$sql = "UPDATE events SET total_tickets = total_tickets - 1 WHERE event_id = $event_id";

if ($conn->query($sql) === TRUE) {
    header("location:indexlogged.php");
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
?>
