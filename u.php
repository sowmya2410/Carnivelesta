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
    <h1>Upcoming events</h1><br>
    <form method="post" action="">
        <label for="eventDate">Select Date:</label>
        <input type="date" id="eventDate" name="eventDate">
        <input type="submit" value="Get Events">
    </form><br><br>
    <?php
     if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $selectedDate = $_POST['eventDate'];
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
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $selectedDate = $_POST['eventDate'];}

    // Fetch participant details registered by the logged-in user
    $registration_query = "SELECT * FROM events WHERE event_date = '$selectedDate'";
    $registration_result = $conn->query($registration_query);

    if ($registration_result->num_rows > 0) {
        // Output registration details
        while ($reg_row = $registration_result->fetch_assoc()) {
            


$organizerid=$reg_row['organizer_id'];
                   $scheduleid=$reg_row['SCHEDULEID'];
                   $venueid=$reg_row['VENUE_ID'];
                  $categoryid=$reg_row['category_id'];


                  $sql = "SELECT name, contact, email FROM organizer WHERE organizer_id = '$organizerid'";
                  $result = $conn->query($sql);
                  
                  if ($result->num_rows > 0) {
                      $row = $result->fetch_assoc();
                      $orgname = $row['name'];
                      $orgcontact = $row['contact'];
                      $orgmail = $row['email'];}
                  
                  
                      $sql = "SELECT STARTTIME, ENDTIME FROM schedule WHERE SCHEDULE_ID = '$scheduleid'";
                  $result = $conn->query($sql);
                  
                  if ($result->num_rows > 0) {
                      $row = $result->fetch_assoc();
                      $sttime = $row['STARTTIME'];
                      $endtime = $row['ENDTIME'];}
                  
                  
                      $sql = "SELECT category_name FROM category WHERE category_id = '$categoryid'";
                      $result = $conn->query($sql);
                      
                      if ($result->num_rows > 0) {
                          $row = $result->fetch_assoc();
                         
                          $catname = $row['category_name'];}
                  
                          $sql = "SELECT venue_name FROM venue WHERE VENUE_ID= '$venueid'";
                          $result = $conn->query($sql);
                          
                          if ($result->num_rows > 0) {
                              $row = $result->fetch_assoc();
                             
                              $venuename = $row['venue_name'];}
                  
            
            
            
            
            echo '<div class="profile">';
            echo "
                        <h2>{$reg_row['event_name']}</h2>
                        <p><strong>Description:</strong> {$reg_row['description']}</p>
                        <p><strong>Date:</strong> {$reg_row['event_date']}</p>
                       
                        <p><strong>Event-Category:</strong> $catname</p>
                        <p><strong>Venue:</strong> $venuename</p>
                        <p><strong>Start-time:</strong> $sttime</p>
                        <p><strong>End-time:</strong> $endtime</p>
                        <p><strong>Organizer-Name:</strong> $orgname</p>
                        <p><strong>Organizer-contact:</strong> $orgcontact</p>
                        <p><strong>organizer-email:</strong> $orgmail</p>
                        <p><strong>Tickets Available:</strong> {$reg_row['total_tickets']}</p>
                        
                        <hr>
                    ";
            
            echo '</div>';










           
        }
    }

   

    // Close connection
    $conn->close();
}

    
    ?>
    </body>
    </html>