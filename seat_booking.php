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
    <title>Select Your Seat - AreoBook</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f7fa;
        }

        main {
            padding: 40px 20px;
            background-color: #fff;
            max-width: 1200px;
            margin: 0 auto;
            text-align: center;
        }

        h1 {
            text-align: center;
            margin-bottom: 40px;
            font-size: 32px;
            color: #333;
            letter-spacing: 1.5px;
        }

        .seat-grid {
            display: grid;
            grid-template-columns: repeat(10, 60px);
            gap: 10px;
            justify-content: center;
            margin-top: 20px;
        }

        .seat {
            position: relative;
            width: 60px;
            height: 60px;
            background-color: #f0f0f0;
            border: 2px solid #ccc;
            border-radius: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 20px;
            cursor: pointer;
            transition: background-color 0.3s, border 0.3s;
        }

        .seat.selected {
            background-color: #28a745;
            border-color: #218838;
            color: white;
        }

        .seat.occupied {
            background-color: #dc3545;
            color: white;
            cursor: not-allowed;
        }

        .confirm-btn {
            display: inline-block;
            margin-top: 30px;
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

        @media (max-width: 768px) {
            .seat-grid {
                grid-template-columns: repeat(5, 60px);
            }
        }
    </style>
</head>

<body>

    <main>
        <h1>Select Your Seat</h1>


        <form id="seatForm" action="seat_details.php" method="POST">

            <?php

            $selectedSeats = isset($_SESSION['selectedSeats']) ? $_SESSION['selectedSeats'] : array();
            ?>
            <div class="seat-grid">
                <?php

                $occupiedSeats = ['A2', 'A7', 'B4', 'C1', 'C9', 'D3', 'D8'];


                for ($row = 'A'; $row <= 'D'; $row++) {
                    for ($num = 1; $num <= 10; $num++) {
                        $seat = $row . $num;
                        $isOccupied = in_array($seat, $occupiedSeats) ? 'occupied' : '';
                        $isSelected = isset($_SESSION['selectedSeats']) && in_array($seat, $_SESSION['selectedSeats']) ? 'selected' : '';
                        echo "<div class='seat $isOccupied $isSelected' data-seat='$seat'></div>";
                    }
                }
                ?>
            </div>
            <input type="hidden" name="selectedSeats" id="selectedSeats">
            <button type="submit" class="confirm-btn">Confirm Selection</button>
        </form>
    </main>

    <script>
        const seats = document.querySelectorAll('.seat');
        const selectedSeatsInput = document.getElementById('selectedSeats');

        seats.forEach(seat => {
            seat.addEventListener('click', () => {
                if (seat.classList.contains('occupied')) {
                    alert('This seat is already booked. Please select another seat.');
                } else {
                    seat.classList.toggle('selected');
                    updateSelectedSeats();
                }
            });
        });

        function updateSelectedSeats() {
            const selectedSeats = [...document.querySelectorAll('.seat.selected')].map(seat => seat.getAttribute('data-seat'));
            selectedSeatsInput.value = selectedSeats.join(',');
        }
    </script>

</body>

</html>

<?php include_once 'footer.php'; ?>