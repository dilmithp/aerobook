<?php

include_once 'header.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Selected Seats - AeroBook</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f7fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .seat-details-container {
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            text-align: center;
        }

        h1 {
            font-size: 32px;
            color: #007bff;
            margin-bottom: 20px;
            letter-spacing: 1.5px;
        }

        .seat-list {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .seat-item {
            background-color: #28a745;
            color: white;
            margin: 5px;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 18px;
            font-weight: 600;
        }

        .message {
            font-size: 18px;
            margin-bottom: 20px;
        }

        .confirm-btn {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            transition: background-color 0.3s ease;
            cursor: pointer;
        }

        .confirm-btn:hover {
            background-color: #0056b3;
        }

        .back-btn {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #333;
        }

        .back-btn:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="seat-details-container">
        <h1>Your Selected Seats</h1>

        <div class="seat-list" id="seatList">
            <?php
            if (isset($_POST['selectedSeats'])) {
                $_SESSION['selectedSeats'] = explode(',', $_POST['selectedSeats']);
                foreach ($_SESSION['selectedSeats'] as $seat) {
                    echo "<div class='seat-item'>$seat</div>";
                }
            } else {
                echo "<p class='message'>No seats selected.</p>";
            }
            ?>
        </div>

        <a href="javascript:history.back()" class="back-btn">Go Back to Seat Selection</a>
    </div>

</body>

</html>

<?php include_once 'footer.php'; ?>