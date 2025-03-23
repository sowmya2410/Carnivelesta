<!DOCTYPE html>
<html>
<head>
    <title>Available Tickets</title>
    <style>
        /* Basic styling */
        body {
            font-family: Arial, sans-serif;
        }
        .ticket-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            max-width: 800px;
            margin: 0 auto;
        }
        .ticket {
            border: 1px solid #ccc;
            padding: 20px;
            margin: 10px;
            text-align: center;
        }
        .ticket h2 {
            margin-top: 0;
        }
        .ticket button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="ticket-container">
    <?php
    session_start();
    $event_id = $_GET['event_id'];

    if(isset($_SESSION['participantid'])) {
        $participantid = $_SESSION['participantid'];
         // Display or use the received data
    } else{
        
    }

    
   
    // Sample ticket types (Replace this with data from your database)
    $tickets = [
        ['ticket_id' => 't2', 'ticket_type' => 'silver', 'price' => 50],
        ['ticket_id' =>'t3', 'ticket_type' => 'gold', 'price' => 100],
        ['ticket_id' => 't4', 'ticket_type' => 'Platinum', 'price' => 150],
        
    ];

    // Display available tickets
    foreach ($tickets as $ticket) {
        echo "<div class='ticket'>";
        echo "<h2>{$ticket['ticket_type']}</h2>";
        echo "<p>Price: Rs.{$ticket['price']}</p>";
        echo "<form action='paymentform.php' method='post'>";
        echo "<input type='hidden' name='ticket_id' value='{$ticket['ticket_id']}'>";
        echo "<input type='hidden' name='event_id' value='$event_id'>";
        echo "<input type='hidden' name='participantid' value='$participantid'>";
        echo "<button type='submit'>Proceed to Payment</button>";
        echo "</form>";
        echo "</div>";
    }
    ?>
</div>

</body>
</html>
