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

        .edit-button {
            background-color: #4CAF50; /* Green background */
            border: none; /* Remove borders */
            color: white; /* White text */
            padding: 10px 20px; /* Padding */
            text-align: center; /* Center text */
            text-decoration: none; /* Remove underline */
            display: inline-block; /* Display as block */
            font-size: 16px; /* Font size */
            cursor: pointer; /* Cursor on hover */
            border-radius: 5px; /* Rounded corners */
        }
        .primary {
            background-color: #545454; /* Green background */
            border: none; /* Remove borders */
            color: white; /* White text */
            padding: 10px 20px; /* Padding */
            text-align: center; /* Center text */
            text-decoration: none; /* Remove underline */
            display: inline-block; /* Display as block */
            font-size: 16px; /* Font size */
            cursor: pointer; /* Cursor on hover */
            border-radius: 5px; /* Rounded corners */
            margin-left:20px;
        }
        .secondary {
            background-color: #545454; /* Green background */
            border: none; /* Remove borders */
            color: white; /* White text */
            padding: 10px 20px; /* Padding */
            text-align: center; /* Center text */
            text-decoration: none; /* Remove underline */
            display: inline-block; /* Display as block */
            font-size: 16px; /* Font size */
            cursor: pointer; /* Cursor on hover */
            border-radius: 5px; /* Rounded corners */
            margin-left:20px;
        }
        .primary:hover{
            background-color:red;
        }
        .secondary:hover{
            background-color:red;
        }

        .popup {
  
    
    position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 15px;
            background-color: #f44336;
            color: white;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            display: none;}

           
            .modal {
      display: none; /* Hidden by default */
      position: fixed; /* Stay in place */
      z-index: 1; /* Sit on top */
      left: 0;
      top: 0;
      width: 100%; /* Full width */
      height: 100%; /* Full height */
      overflow: auto; /* Enable scroll if needed */
      background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    }
    .modal-content {
      background-color: #fefefe;
      margin: 15% auto;
      padding: 20px;
      border: 1px solid #888;
      width: 80%;
      text-align: center;
    }
/* Black w/ opacity */
    
    
    </style>
    
</head>
<body>
    <h1>Your Tickets</h1>
    <?php
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

    // Assuming you have the logged-in user's username stored in a session variable
    session_start();
    $logged_in_user = $_SESSION['username'];
    $userid=$_SESSION['userid'];
   
    $name_query = "SELECT participant_id FROM participant_details WHERE userid = '$userid'";
$name_result = $conn->query($name_query);

if ($name_result->num_rows > 0) {
    $row = $name_result->fetch_assoc();
    $participant_id = $row['participant_id'];
       }
else{
    echo "NOT TICKETS REGISTERED";
}

    // Fetch participant details registered by the logged-in user
    $registration_query = "SELECT * FROM registration WHERE participant_id = '$participant_id'";
    $registration_result = $conn->query($registration_query);

    if ($registration_result->num_rows > 0) {
        // Output registration details
        while ($reg_row = $registration_result->fetch_assoc()) {
            

$ticketid=$reg_row['ticketid'];
$eventid=$reg_row['event_id'];
$paymentid=$reg_row['paymentid'];



            $sql = "SELECT ticket_cost FROM ticket WHERE ticketid = '$ticketid'";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $ticket_amount = $row['ticket_cost'];}
            
            
                $sql_participant = "SELECT name FROM participant_details WHERE participant_id = '$participant_id'";
            $result_participant = $conn->query($sql_participant);
            $participant_name = ($result_participant->num_rows > 0) ? $result_participant->fetch_assoc()['name'] : 'Unknown';
            
            $sql = "SELECT ticket_type FROM ticket WHERE ticketid ='$ticketid' ";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $ticket_type = $row['ticket_type'];}
            
            
            $sql = "SELECT event_name FROM events WHERE event_id = '$eventid' ";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $eventname = $row['event_name'];}
            
            $sql = "SELECT registration_date FROM registration WHERE paymentid = '$paymentid'";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $regdate = $row['registration_date'];}
            
                $sql = "SELECT registration_id FROM registration WHERE paymentid = '$paymentid'";
                $result = $conn->query($sql);
            
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $regid = $row['registration_id'];}
            
                    $sql = "SELECT paymentmode FROM payments WHERE paymentid = '$paymentid'";
                    $result = $conn->query($sql);
                
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $paymentmode = $row['paymentmode'];}
            
            
            
            
            
            
            echo '<div class="profile">';
            echo '<h2>Registration id:'.$regid.'</h2>';
            echo '<p><strong>Participant Name:</strong> '.$participant_name.'</p>';
            echo '<p><strong>Event name:</strong> '.$eventname.'</p>';
            echo '<p><strong>ticket Type:</strong> '.$ticket_type.'</p>';
            echo '<p><strong>Amount:</strong> '.$ticket_amount.'</p>';
            echo '<p><strong>Payment Mode:</strong> '.$paymentmode.'</p>';
            echo '<p><strong>Registration Date:</strong> '.$regdate.'</p>';
            
            echo '</div>';










           
        }
    }
else{
    echo "user not found";
}
    // Close connection
    $conn->close();

    
    ?>