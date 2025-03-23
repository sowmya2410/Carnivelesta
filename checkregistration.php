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
$userid = $_SESSION['userid'];
$event_id = $_GET['event_id'];


$sql = "SELECT participant_id FROM participant_details WHERE userid = $userid";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        $_SESSION['participantid']= $row["participant_id"];
        
    }
} else {
    echo "No results found for Event ID " . $event_id2;
}



$query = "SELECT COUNT(*) as count FROM participant_details WHERE userid = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $userid); // assuming user_id is an integer, change "i" to "s" for a string type
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($row['count'] > 0) {
  header("location:tickets.php?event_id=$event_id");
} else {
  header("location:participant.html");
    
}





    $conn->close();
?>