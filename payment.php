<!DOCTYPE html>
<html>
<head>
    <title>Payments</title>
    <style>
       body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f0f0;
            margin: 0;
        }

        .ticket-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        
        .ticket {
            width: 400px;
            padding: 20px;
            border-radius: 10px;
            background: linear-gradient(135deg, #3498db, #2980b9);
            color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        
        .ticket-title {
            font-size: 28px;
            margin-bottom: 20px;
        }
        
        .ticket-info {
            font-size: 18px;
            margin-bottom: 15px;
        }
        
        .ticket-details {
            font-size: 16px;
            margin-bottom: 10px;
        }
        
        .ticket-qrcode {
            margin-top: 20px;
            width: 150px;
            height: 150px;
            border: 3px solid #fff;
            border-radius: 8px;
        }

        .heading-text {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .bottom-text {
            font-size: 16px;
            color: #555;
            margin-top: 20px;
        }

        .popup {
  
    
         text-align:center;
          margin-right:auto;
          margin-left:auto;
          display:block;
          width:50%;
          padding: 10px;
          background-color: blue;
          color: white;
          border-radius: 5px;
          box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);}
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
    $payment_mode = $_POST['payment_mode']; // Selected payment mode
    $current_date = $_POST['date'];
    $current_time = $_POST['time'];}

    $min = 1;
    $max = 10000;
    $randomNumber = mt_rand($min, $max);

    $retryLimit = 3; // Set a limit for retries
    $retryCount = 0;
    
    // Fetch ticket amount from the tickets table based on ticket ID
    $sql = "SELECT ticket_cost FROM ticket WHERE ticketid = '$ticket_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $ticket_amount = $row['ticket_cost'];}
    
        $reg_date = date("Y-m-d");


        $check_query = "SELECT * FROM registration WHERE participant_id = '$participant_id' AND event_id = '$event_id'";
        $result = $conn->query($check_query);
        
        if ($result->num_rows > 0) {
           header("location:indexlogged.php?check=1");
        } else {
        



        // Insert payment details into the payments table with separate date and time columns
        $sql_insert = "INSERT INTO payments (paymentmode, participantid,AMOUNT,date,time)
                       VALUES ('$payment_mode', '$participant_id', '$ticket_amount', '$current_date','$current_time')";

        if ($conn->query($sql_insert) === TRUE) {
            $last_inserted_id = $conn->insert_id;
    do{
            $sql_insert1 = "INSERT INTO registration (registration_id, participant_id,event_id,registration_date,ticketid,paymentid)
            VALUES ('$randomNumber', '$participant_id', '$event_id', '$reg_date','$ticket_id','$last_inserted_id')";

if ($conn->query($sql_insert1) === TRUE) {
     
    $sql_participant = "SELECT name FROM participant_details WHERE participant_id = '$participant_id'";
    $result_participant = $conn->query($sql_participant);
    $participant_name = ($result_participant->num_rows > 0) ? $result_participant->fetch_assoc()['name'] : 'Unknown';

    $sql = "SELECT ticket_type FROM ticket WHERE ticketid = '$ticket_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $ticket_type = $row['ticket_type'];}


        $sql = "SELECT event_name FROM events WHERE event_id = '$event_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $eventname = $row['event_name'];}
        echo "<div class='ticket-container'>";
        echo"<div class='heading-text'>Please Take a Screenshot for future References!</div>";
        echo'<div class="ticket">';
        
        // PHP code to fetch ticket information from the database
        // ...

        // Displaying ticket information
        echo "<h1 class='ticket-title'>Event Ticket</h1>";
        echo "<p class='ticket-info'>Registration id:$randomNumber </p>";
        echo "<p class='ticket-info'>Participant Name:$participant_name</p>";
        echo "<p class='ticket-info'>Registration-date:$reg_date</p>";
        echo "<p class='ticket-info'>Event-Name:$eventname</p>";
        echo "<p class='ticket-info'>Ticket_type:$ticket_type</p>";
        echo "<p class='ticket-info'>Amount:$ticket_amount</p><br><br>";
        echo "<p class='ticket-info'>payment-Status:</p><p class='popup'>Payment Successful</p><br><br>";
       
        
    echo'</div>';


    echo "<div class='bottom-text'><a href='updatetickets.php?event_id=$event_id'>Click to Go back to Home Page</a></div>";
 echo'</div>';





     break;
 // Additional actions after successful payment
} else {

    if ($conn->errno == 1062) {
        // MySQL error code 1062 is for duplicate entry (primary key violation)
        $randomNumber = mt_rand($min, $max);

    } else {
        echo "Error: " . $sql_insert1 . "<br>" . $conn->error;
        
        break;
    }
}

$retryCount++;
} while ($retryCount < $retryLimit);



 
}




            // Additional actions after successful payment
         else {
            echo "Error: " . $sql_insert . "<br>" . $conn->error;
        }
    
}
$conn->close();
?>
</body>
</html>
