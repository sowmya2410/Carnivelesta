<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Events by Category</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.container {
    width: 80%;
    margin: 0 auto;
    padding: 20px;
}

h1 {
    text-align: center;
    margin-bottom: 20px;
}

.categories ul {
    list-style: none;
    padding: 0;
}

.categories li {
    margin-bottom: 5px;
}

.categories a {
    text-decoration: none;
    color: #333;
    display: block;
    padding: 5px;
    border: 1px solid #ccc;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.categories a:hover {
    background-color: #ddd;
}

.events {
    margin-top: 20px;
    border-top: 1px solid #ccc;
    padding-top: 20px;
}

/* Style event details as needed */
.events .event {
    margin-bottom: 20px;
    padding: 10px;
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 5px;
}

        </style>
</head>
<body>
    <div class="container">
        <h1></h1>
        

        <div class="events">
            
            <!-- Event details will be displayed here -->
            <?php
// Establish a database connection (Replace with your database credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "carnival";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch events based on a specific category ID
$category_id = $_GET['category_id']; // Assuming you pass the category ID via URL
$sql = "SELECT category_name FROM category WHERE category_id = '$category_id'";
                  $result = $conn->query($sql);
                  
                  if ($result->num_rows > 0) {
                      $row = $result->fetch_assoc();
                     
                      $catname = $row['category_name'];}
                      echo "<h1> $catname </h1>";

$registration_query = "SELECT * FROM events WHERE category_id = $category_id";
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
                   
                    
                    <p><strong>Venue:</strong> $venuename</p>
                    <p><strong>Start-time:</strong> $sttime</p>
                    <p><strong>End-time:</strong> $endtime</p>
                    <p><strong>Organizer-Name:</strong> $orgname</p>
                    <p><strong>Organizer-contact:</strong> $orgcontact</p>
                    <p><strong>organizer-email:</strong> $orgmail</p>
                    <p><strong>Tickets Available:</strong> {$reg_row['total_tickets']}</p>
                    <a href='checkregistration.php?event_id={$reg_row['event_id']}'>register now</a>
                    <hr>
                ";
        
        echo '</div>';










       
    }
}


$conn->close();
?>
        </div>
    </div>
   

</body>
</html>
