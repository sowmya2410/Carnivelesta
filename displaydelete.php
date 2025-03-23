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

       
       

        

           
           
/* Black w/ opacity */
    
    
    </style>
    
</head>
<body>
    <h1>Participant Profile</h1>
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

    $name_query = "SELECT name FROM users WHERE username = '$logged_in_user'";
$name_result = $conn->query($name_query);

if ($name_result->num_rows > 0) {
    $row = $name_result->fetch_assoc();
    $user_name = $row['name'];

    // Fetch participant details registered by the logged-in user
    $sql = "SELECT * FROM participant_details WHERE name = '$user_name'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row as a profile
        while($row = $result->fetch_assoc()) {
            echo '<div class="profile">';
            echo '<h2>'.$row["name"].'</h2>';
            echo '<p><strong>Contact:</strong> '.$row["contact_number"].'</p>';
            echo '<p><strong>Email:</strong> '.$row["email_id"].'</p>';
            echo '<p><strong>Department:</strong> '.$row["department"].'</p>';
            echo '<p><strong>College Name:</strong> '.$row["college_name"].'</p>';
            echo '<p><strong>Registration Number:</strong> '.$row["college_registration_number"].'</p>';
            echo '<p><strong>Year of Studying:</strong> '.$row["year_of_studying"].'</p>';
            echo '<p><strong>Participant ID:</strong> '.$row["participant_id"].'</p>';
            echo '</div>';
            $_SESSION['participantid']=$row["participant_id"];
        }
    } else {
        echo "No participant details found for this user.";
    }
}else{
    echo "user not found";
}
    // Close connection
    $conn->close();

    
    ?>
   


</body>
</html>