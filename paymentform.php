<!DOCTYPE html>
<html>
<head>
    <title>Participant Profiles</title>
    <style>
        /* Basic styling for the profile page */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .profile {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .profile h2 {
            margin-top: 0;
            font-size: 24px;
            color: #333;
            margin-bottom: 10px;
        }
        .profile p {
            margin: 5px 0;
            color: #666;
        }
        .profile p strong {
            font-weight: bold;
            color: #333;
        }
        /* Hover effect */
        .profile:hover {
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        }
        </style>
        </head>
        <body>
<?php
session_start();

// Database connection (Replace with your credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "carnival";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ticket_id = $_POST['ticket_id']; // Retrieve ticket ID from the form
    // Retrieve participant ID and event ID from session variables
    $participant_id = $_POST['participantid'];
    $event_id = $_POST['event_id'];
}



   




    // Fetch participant name from participants table
    $sql_participant = "SELECT name FROM participant_details WHERE participant_id = '$participant_id'";
    $result_participant = $conn->query($sql_participant);
    $participant_name = ($result_participant->num_rows > 0) ? $result_participant->fetch_assoc()['name'] : 'Unknown';

    // Fetch event name from events table
    $sql_event = "SELECT event_name FROM events WHERE event_id = $event_id";
    $result_event = $conn->query($sql_event);
    $event_name = ($result_event->num_rows > 0) ? $result_event->fetch_assoc()['event_name'] : 'Unknown';

    // Fetch ticket name and amount from tickets table
    $sql_ticket = "SELECT ticket_type, ticket_cost FROM ticket WHERE ticketid = '$ticket_id'";
    $result_ticket = $conn->query($sql_ticket);

    if ($result_ticket->num_rows > 0) {
        $row_ticket = $result_ticket->fetch_assoc();
        $ticket_type = $row_ticket['ticket_type'];
        $ticket_amount = $row_ticket['ticket_cost'];
    }
        // Get current date and time separately

        date_default_timezone_set('Asia/Kolkata');

        $current_date = date("Y-m-d");
        $current_time = date("H:i:s");

        echo '<div class="profile">';
        echo '<h2> Welcome '.$participant_name.'</h2>';
        echo '<p><strong>Event-name:</strong> '.$event_name.'</p>';
        echo '<p><strong>Ticket type:</strong> '.$ticket_type.'</p>';
        echo '<p><strong>Ticket Amount:</strong> '.$ticket_amount.'</p>';
        echo "<form action='payment.php' method='post'>";
        echo "<input type='hidden' name='ticket_id' value='$ticket_id'>";
        echo "<input type='hidden' name='event_id' value='$event_id'>";
        echo "<input type='hidden' name='participantid' value='$participant_id'>";
        echo" <label for='payment_mode'>Payment Mode:</label><br>
        <select id='payment_mode' name='payment_mode'>
            <option value='Cash'>Cash</option>
            <option value='Card'>Debit Card/ Credit Card</option>
            <option value='upi'>Upi payments</option>
        </select><br><br>";
        echo "<input type='hidden' name='date' value='$current_date'>";
        echo "<input type='hidden' name='time' value='$current_time'>";
        echo "<button type='submit'>Proceed to Payment</button>";
        echo "</form>";
        echo '</div>';


    
       
$conn->close();
?>
</body>
</html>