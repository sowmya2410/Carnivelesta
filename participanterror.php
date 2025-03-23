<!DOCTYPE html>
<html>
<head>
    <title>Participant Registration</title>
    <style>
        /* Basic styling, you can customize this further */
        body {
            font-family: Arial, sans-serif;
            background-image: url(https://i.pinimg.com/564x/cc/4f/e2/cc4fe24c8b5a56a50ecb9b0902cd0d19.jpg);
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
    </style>
</head>
<body>

<?php
$check=$_GET['check'];
?>

    <div class="container">
    <h2 style="text-align:center;">Participant Registration</h2>
    <form action="participant.php" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br>

        <label for="contact">Contact Number:</label>
        <input type="text" id="contact" name="contact" required><br>

        <label for="email">Email ID:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="department">Department:</label>
        <input type="text" id="department" name="department" required><br>

        <label for="college_name">College Name:</label>
        <input type="text" id="college_name" name="college_name" required><br>

        <label for="college_reg_number">College Registration Number:</label>
        <input type="text" id="college_reg_number" name="college_reg_number" value=<?php echo $check;
?> required><br>

        <label for="year_of_studying">Year of Studying:</label>
        <input type="number" id="year_of_studying" name="year_of_studying" min="1" required><br>

        <!-- Participant ID will be generated automatically -->
        <label for="participant_id">Participant ID:</label>
        <input type="text" id="participant_id" name="participant_id" readonly><br>

        <input type="submit" value="Register">

        <div class="popup" id="popup">
            Register Number Already Exists
        </div>
    </form>
</div>
    <script>
       // Function to show the popup message
       function showPopup() {
            var popup = document.getElementById('popup');
            popup.innerHTML = 'Register number already exists';
            popup.style.display = 'block';
            setTimeout(function() {
                popup.style.display = 'none';
            }, 5000); // Display for 10 seconds
        }

        // Show the popup when the page loads
        window.onload = showPopup;
        

          // Generate a unique 3-digit participant ID upon loading the page
          document.addEventListener('DOMContentLoaded', function() {
            let participantIdField = document.getElementById('participant_id');
            participantIdField.value = generateParticipantId();
        });

        // Function to generate a random unique 3-digit participant ID
        function generateParticipantId() {
            let participantId = Math.floor(100 + Math.random() * 9000); // Generates a number between 100 and 999
            return 'CARNIVAL' + participantId.toString();
        }
 
  
    </script>
</body>
</html>