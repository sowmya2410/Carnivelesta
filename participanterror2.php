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
            background-color: blue;
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
    <h1>Participant Profile</h1>
    <?php
    session_start();
    
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
    
    $userid=$_SESSION['userid'];

    

    // Fetch participant details registered by the logged-in user
    $sql = "SELECT * FROM participant_details WHERE userid = '$userid'";
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
        header("location:displaydelete.php");
    }

    // Close connection
    $conn->close();

    
    ?>
     <a href="Updateparticipantform.php" class="edit-button">Edit Details</a>
     <button onclick="confirmDelete()" class="primary">Delete Participant</button>

  <!-- Modal for confirmation -->
  <div id="deleteModal" class="modal">
    <div class="modal-content">
      <p>Are you sure you want to delete?</p>
      <button onclick="deleteItem()" class="primary">Yes, Delete</button>
      <button onclick="cancelDelete()" class="secondary">Cancel</button>
    </div>
  </div>
     
  <div class="popup" id="popup">
            ONLY ONE REGISTRATION PER USER IS ALLOWED!
        </div>
 


<script>
        
        function showPopup() {
            var popup = document.getElementById('popup');
            popup.innerHTML = 'Only One Registration Per User is Allowed';
            popup.style.display = 'block';
            setTimeout(function() {
                popup.style.display = 'none';
            }, 5000); // Display for 10 seconds
        }

        // Show the popup when the page loads
        window.onload = showPopup;


  function confirmDelete() {
      // Display the modal
      document.getElementById('deleteModal').style.display = 'block';
    }

    function deleteItem() {
      // Redirect to another page after deletion
      
      window.location.href = 'deleteparticipant.php'; // Replace with your redirection URL
    }

    function cancelDelete() {
      // Hide the modal if cancel is clicked
      document.getElementById('deleteModal').style.display = 'none';
    }
</script>
</body>
</html>

