<!DOCTYPE html>
<html>
<head>
    <title>Participant Registration</title>
    <style>
        /* Basic styling, you can customize this further */
        body {
            font-family: Arial, sans-serif;
            background-image: url(https://i.pinimg.com/564x/20/bf/c5/20bfc5ee83157cc640fd24130cc1dc2f.jpg);
            padding: 40px;
        }
        form {
            max-width: 430px;
            margin: 0 auto;
            width:50%;
            background-color: #fff;
            padding: 50px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        input[type="text"], input[type="email"], input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
       
    </style>
</head>
<body>

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




if(isset($_SESSION['participantid'])) {
    $participant_id = $_SESSION['participantid'];
     // Display or use the received data


     $sql = "SELECT * FROM participant_details WHERE participant_id = '$participant_id'";
     $result = $conn->query($sql);
 
     if ($result->num_rows > 0) {
         // Output data of each row as a profile
         while($row = $result->fetch_assoc()) {
             
             $name= $row["name"];
             $contactnum=$row["contact_number"];
            $mailid=$row["email_id"];
             $dept=$row["department"];
             $clgname=$row["college_name"];
             $regno=$row["college_registration_number"];
             $year=$row["year_of_studying"];
             echo '</div>';
            
         }
     }
     $conn->close();
} 
?>
    <div class="container">
    <h2 style="text-align:center;">Update Participant Registration</h2>
    <form action="updateparticipant.php" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $name?>" required><br>

        <label for="contact">Contact Number:</label>
        <input type="text" id="contact" name="contact"   value="<?php echo $contactnum?>"required><br>

        <label for="email">Email ID:</label>
        <input type="email" id="email" name="email"   value="<?php echo $mailid?>"required><br>

        <label for="department">Department:</label>
        <input type="text" id="department" name="department"  value="<?php echo $dept?>" required><br>

        <label for="college_name">College Name:</label>
        <input type="text" id="college_name" name="college_name"  value="<?php echo $clgname?>" required><br>

        <label for="college_reg_number">College Registration Number:</label>
        <input type="text" id="college_reg_number" name="college_reg_number"  value="<?php echo $regno?>" required><br>

        <label for="year_of_studying">Year of Studying:</label>
        <input type="number" id="year_of_studying" name="year_of_studying" min="1"   value="<?php echo $year?>"required><br>


        <label for="participant_id">Participant ID:</label>
        <input type="text" id="participant_id" name="participant_id" value="<?php echo $participant_id?>" readonly><br>

       
       
        <input type="submit" value="Register">
    </form>
</div>
    <script>
       
    </script>
</body>
</html>
