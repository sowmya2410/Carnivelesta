<!DOCTYPE html>
<html>
<head>
    <title>Wishlist</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        .event-card {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 15px;
        }

        .event-card h3 {
            margin-top: 0;
        }

        .event-card p {
            margin-bottom: 0;
        }

        .wishlist-heading {
            font-size: 24px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <h1 class="wishlist-heading">Wishlisted Events</h1>


<?php
session_start();

// Replace with your database credentials
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

// If 'add' parameter is present in URL, add event to wishlist
if (isset($_GET['add']) && $_GET['add'] === 'true' && isset($_GET['event_id'])) {
    $event_id = $_GET['event_id'];
    echo $event_id ;
    $participant_id =$_SESSION['participantid']; // Replace with the participant ID (you can get this from the session)

 
    $check_query = "SELECT * FROM wishlist WHERE event_id = '$event_id' AND participant_id = '$participant_id'";
$result = $conn->query($check_query);

if ($result->num_rows > 0) {
    
    // Perform any action or logic if the event is already in the wishlist
} else {
    // Proceed with the insertion into the wishlist table'
    $insert_query = "INSERT INTO wishlist (event_id, participant_id) VALUES ('$event_id', '$participant_id')";
    if ($conn->query($insert_query) === TRUE) {
        
        // Perform any further action after successful insertion
    } else {
        echo "Error: " . $insert_query . "<br>" . $conn->error;
    }
}
}
if (isset($_GET['add']) && $_GET['add'] === 'false' && isset($_GET['event_id'])) {
    $event_id = $_GET['event_id'];
    $participant_id =$_SESSION['participantid']; // Replace with the participant ID (you can get this from the session)

    // Insert event into wishlist table
    $delete_query = "DELETE FROM  wishlist WHERE event_id = '$event_id'";
    $conn->query($delete_query);
    
}






// Fetch wishlisted events for the logged-in participant
$participant_id =$_SESSION['participantid'];// Replace with the participant ID
$select_query = "SELECT e.event_name, e.description 
                 FROM wishlist w 
                 INNER JOIN events e ON w.event_id = e.event_id 
                 WHERE w.participant_id = '$participant_id'";
$result = $conn->query($select_query);

if ($result->num_rows > 0) {
    // Display wishlisted events
    while ($row = $result->fetch_assoc()) {
        echo '<div class="event-card">';
        echo "<h3>" . $row["event_name"] . "</h3>";
        echo "<p>" . $row["description"] . "</p>";
        echo '</div>';
        echo"<a href='indexlogged.php'>redirect to home page</a>";
    }
} else {
    echo "No events in your wishlist.";
}

$conn->close();
?>
</body>
</html>