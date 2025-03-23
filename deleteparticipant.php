<?php
session_start();
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

$id = $_SESSION['participantid'];

// sql to delete a record
$sql = "DELETE FROM participant_details WHERE participant_id ='$id'";

if ($conn->query($sql) === TRUE) {
  header("location:displaydelete.php");
} else {
  echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>