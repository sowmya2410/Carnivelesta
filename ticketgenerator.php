<!DOCTYPE html>
<html>
<head>
    <title>Generated Ticket</title>
    <style>
        /* Basic styling for the ticket */
         /* Ticket styling */
         body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f5f5f5;
        }
        .ticket {
            background-color: white;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 300px;
            text-align: center;
        }
        .ticket h2 {
            margin-top: 0;
        }
        .ticket p {
            margin: 5px 0;
        }
        .ticket .event-name {
            font-weight: bold;
            font-size: 18px;
        }
        .ticket .ticket-type {
            font-style: italic;
            color: #888;
        }


        .code-container {
            text-align: center;
            margin-top: 20px;
        }
        #barcode, #qrcode {
            display: none;}
    </style>
</head>
<body>

<div class="ticket">
    <h2>Your Ticket</h2>
    <?php
    // Process form data and generate ticket
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $event_name = $_POST['event_name'];
        $ticket_type = $_POST['ticket_type'];

        echo "<p>Event Name: $event_name</p>";
        echo "<p>Ticket Type: $ticket_type</p>";

        // Generate other ticket details as needed
        // Example: barcode, QR code, ticket number, etc.
    }
    ?>

<div class="code-container">
    
    <h3>QR Code:</h3>
    <div id="qrcode"></div>
</div>



</div>



</body>
</html>
