<!DOCTYPE html>
<html>
<head>
  <title>Event Hub</title>
  <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet'>

  <style>/* Styles for Navigation Bar */
    nav {
      background-color: #283968;
      color: white;
      padding: 10px 20px;
    }
    
    nav ul {
      list-style-type: none;
      margin: 0;
      padding: 0;
    }
    
    nav ul li {
      display: inline;
      margin-right: 20px;
    }
    
    nav ul li a {
      text-decoration: none;
      color: white;
      font-weight: bold;
    }
    
    nav ul li a:hover {
      color: #a8d7f9; /* Change hover color as desired */
    }
    
    /* Styles for Homepage */
    body {
      background-image:url(_43ef7aca-87c4-4cce-8621-a6a008bd9d3f.jpeg); 
      /* Warm background color */
      font-family: 'Lato';
    }
    
    .containers {
      text-align: center;
      margin-top: 40px;
    }
    
    .containers h1 {
      font-size: 48px;
      color: #0e0e0e; /* Text color */
      

    }
    .whole{
        background-color:white;
        padding:15px;
        margin:30px;

    }



    .dropdown {
            position: relative;
            display: inline-block;
        }
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 120px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }
        .dropdown:hover .dropdown-content {
            display: block;
        }
        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }
        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }






        .container {
    width: 80%;
    margin: 20px auto;
}

h1 {
    text-align: center;
}

.events-container {
    display: flex;
    overflow-x: hidden;
}

.event {
    width: 70%;
    min-width: 300px;
    margin-right: 20px;
    border-radius: 8px;
    background-size: cover;
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    color: white;
    transition: transform 0.3s ease-in-out;
    cursor: pointer;
}

.event:hover {
    transform: scale(1.05);
}

.event .event-details {
    padding: 20px;
    background-color: rgba(0, 0, 0, 0.6);
    border-bottom-left-radius: 8px;
    border-bottom-right-radius: 8px;
    text-align: center;
}

.event h2 {
    margin-bottom: 5px;
}

.event p {
    font-size: 14px;
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

          .heart-icon {
            cursor: pointer;
            font-size: 24px;
             /* Initial color */
        }
a{
   
   color:black;
}
    </style>
</head>
<body>
<div class="whole">
    <div class="containers">
        <h1>Carnival'esta</h1>
        <!-- Display featured events or any other content -->
      </div>
  <!-- Navigation bar -->
  <nav>
    <ul>
      <li><a href="events.html">Event Categories</a></li>
      <li><a href="u.php">Upcoming Events</a></li>
      <!--<li><a href="wishlist.php">Wishlist</a></li>-->
      <li><a href="displayparticipants.php">Profile</a></li>
      <li><a href="displaytickets.php">My Tickets</a></li>
      <div class="dropdown" style="float:right;">
      
      <!-- Add other navigation links -->
    
      <?php
        session_start();
        if (isset($_SESSION['username'])) {
            echo '<li style="text-align:right;float:right;">'. $_SESSION['username'].'</li>';
            echo '<div class="dropdown-content" style="float:right;">';

                echo '<a href="new2.html">Logout</a>'; // Assuming logout.php handles logout
                echo '</div>';
            // Other content for logged-in users
        } else {
            echo '<a href="login.php">Login</a>';
                echo '<a href="signup.php">Sign Up</a>';
        }


        if(isset($_SESSION['totaltickets'])) {
          $totaltickets = $_SESSION['totaltickets'];}
          

          $servername = "localhost";
$username = "root";
$password = "";
$dbname = "carnival";
if (isset($_GET['check'])){
    $check=$_GET['check'];
    if($check==1){
        echo"<div class='popup' id='popup'>";
        
    echo"</div>";}
}

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//if(isset($_SESSION['userid'])) {
  //  $userid = $_SESSION['userid'];}

// Query to fetch total_tickets for event_id = 1
$event_id1 = 101; // Replace with the actual event ID

$sql = "SELECT total_tickets FROM events WHERE event_id = $event_id1";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        $_SESSION['totaltickets101']= $row["total_tickets"];
        
        
    }
} else {
    echo "No results found for Event ID " . $event_id1;
}

 





$event_id2 = 102; // Replace with the actual event ID
$sql = "SELECT total_tickets FROM events WHERE event_id = $event_id2";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        $_SESSION['totaltickets102']= $row["total_tickets"];
    }
} else {
    echo "No results found for Event ID " . $event_id2;
}

$event_id3 = 103; // Replace with the actual event ID
$sql = "SELECT total_tickets FROM events WHERE event_id = $event_id3";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        $_SESSION['totaltickets103']= $row["total_tickets"];
       
        
    }
} else {
    echo "No results found for Event ID " . $event_id2;
}

$event_id4 = 104; // Replace with the actual event ID
$sql = "SELECT total_tickets FROM events WHERE event_id = $event_id4";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        $_SESSION['totaltickets104']= $row["total_tickets"];
        
    }
} else {
    echo "No results found for Event ID " . $event_id2;
}

$event_id5 = 105; // Replace with the actual event ID
$sql = "SELECT total_tickets FROM events WHERE event_id = $event_id5";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        $_SESSION['totaltickets105']= $row["total_tickets"];
        
    }
} else {
    echo "No results found for Event ID " . $event_id5;
}

$event_id6 = 106; // Replace with the actual event ID
$sql = "SELECT total_tickets FROM events WHERE event_id = $event_id6";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        $_SESSION['totaltickets106']= $row["total_tickets"];
        
    }
} else {
    echo "No results found for Event ID " . $event_id2;
}


$userid=$_SESSION['userid'];


$conn->close();




?>
  </div>
  </ul>
  </nav>
  
        
        

     
       <p><a href="participant.html" style="text-align:center;margin-right:auto;margin-left:auto;display:block;border:1px solid black;border-radius:5px;color:black;font-size:25px;background-image:url(https://i.pinimg.com/564x/ad/a0/84/ada08441ae7df11b8b1c6daead5b9d98.jpg);text-decoration:none;">Register as Participant</a></p>
       <div class="container">
        <h1> Trending Events</h1>
        <div class="events-container" id="eventsContainer">
            <div class="event" style="background-image: url('https://i.pinimg.com/736x/0d/c1/e4/0dc1e431949fd815d6470cc951ccbacd.jpg')">
                <div class="event-details">
                    <h2>Concert</h2>
                    
                    <p>Total tickets:<?php echo $_SESSION['totaltickets101']?></p>
                  <a href="checkregistration.php?event_id=<?php echo $event_id1; ?>">register now</a>
                 
                    <!-- Add more event details -->
                </div>
            </div>
            <div class="event" style="background-image: url('https://i.pinimg.com/736x/0d/c1/e4/0dc1e431949fd815d6470cc951ccbacd.jpg')">
                <div class="event-details">
                    <h2>Dj night</h2>
                    
                    <p>Total tickets:<?php echo $_SESSION['totaltickets102']?></p>
                  <a href="checkregistration.php?event_id=<?php echo $event_id2; ?>">register now</a>
                 
                    <!-- Add more event details -->
                </div>
            </div>
            
            <div class="event" style="background-image: url('https://i.pinimg.com/736x/0d/c1/e4/0dc1e431949fd815d6470cc951ccbacd.jpg')">
                <div class="event-details">
                    <h2>Carnival Awards</h2>
                    <p>Total tickets:<?php echo $_SESSION['totaltickets103']?></p>
                    <a href='tickets.php?event_id=<?php echo $event_id3; ?>'>register now</a>
                    <!-- Add more event details -->
                </div>
            </div>
            <!-- Add more events -->
            

            
        </div>
        <div class="events-container" style="margin-top:20px;" id="eventsContainer">
            <div class="event" style="background-image: url('https://i.pinimg.com/736x/0d/c1/e4/0dc1e431949fd815d6470cc951ccbacd.jpg')">
                <div class="event-details">
                    <h2>Dancers Blaze</h2>
                    
                    <p>Total tickets:<?php echo $_SESSION['totaltickets104']?></p>
                  <a href="checkregistration.php?event_id=<?php echo $event_id4; ?>">register now</a>
                 
                    <!-- Add more event details -->
                </div>
            </div>
            <div class="event" style="background-image: url('https://i.pinimg.com/736x/0d/c1/e4/0dc1e431949fd815d6470cc951ccbacd.jpg')">
                <div class="event-details">
                    <h2>Coding QUest</h2>
                    
                    <p>Total tickets:<?php echo $_SESSION['totaltickets105']?></p>
                  <a href="checkregistration.php?event_id=<?php echo $event_id5; ?>">register now</a>
                 
                    <!-- Add more event details -->
                </div>
            </div>
            
            <div class="event" style="background-image: url('https://i.pinimg.com/736x/0d/c1/e4/0dc1e431949fd815d6470cc951ccbacd.jpg')">
                <div class="event-details">
                    <h2>Web designing</h2>
                    <p>Total tickets:<?php echo $_SESSION['totaltickets106']?></p>
                    <a href='tickets.php?event_id=<?php echo $event_id6; ?>'>register now</a>
                    <!-- Add more event details -->
                </div>
            </div>
            <!-- Add more events -->
            

            
        </div>
    </div>
      </div>
</div>
  
<script>
    function showPopup() {
            var popup = document.getElementById('popup');
            popup.innerHTML = 'only one registration per event is allowed';
            popup.style.display = 'block';
            setTimeout(function() {
                popup.style.display = 'none';
            }, 5000); // Display for 10 seconds
            
        }

        // Show the popup when the page loads
        window.onload = showPopup;




</script>
  
</body>
</html>
