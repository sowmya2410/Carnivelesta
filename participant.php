<?php
// Database connection details
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

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $department = $_POST['department'];
    $college_name = $_POST['college_name'];
    $college_reg_number = $_POST['college_reg_number'];
    $year_of_studying = $_POST['year_of_studying'];
    $participant_id = $_POST['participant_id'];
    $userid=$_SESSION['userid'];}
    // Assuming this is generated in the form

    // Check if registration number already exists
    $check_query = "SELECT college_registration_number FROM participant_details WHERE participant_id = '$participant_id'";
    
    $query = "SELECT COUNT(*) as count FROM participant_details WHERE userid = ?";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $userid);
    $stmt->execute();
    $result1 = $stmt->get_result();
    $row = $result1->fetch_assoc();
    


    $result = $conn->query($check_query);

    if ($result->num_rows > 0) {
        // Registration number already exists;
        
        header("Location: participanterror.php");
        exit();
    } elseif ($row['count'] > 0)  {


        
            header("Location: participanterror2.php");
            exit();
        } else {
        // Prepare and bind the SQL statement for insertion
        $stmt = $conn->prepare("INSERT INTO participant_details (name, contact_number, email_id, department, college_name, college_registration_number, year_of_studying, participant_id,userid) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssiss", $name, $contact, $email, $department, $college_name, $college_reg_number, $year_of_studying, $participant_id,$userid);

        // Execute the statement
        if ($stmt->execute() === TRUE) {
            header("Location: indexlogged.php");
            exit();
        } else {
            header("Location: participanterror.php?check=1");
            exit();
        }

        // Close statement
        $stmt->close();
    }


// Close connection
$conn->close();
?>
