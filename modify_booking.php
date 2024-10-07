<?php
include_once 'header.php';
include_once 'includes/db.inc.php';

if (isset($_GET['booking_id'])) {
    $booking_id = htmlspecialchars($_GET['booking_id']);


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $origin = htmlspecialchars($_POST['origin']);
        $destination = htmlspecialchars($_POST['destination']);
        $price = floatval($_POST['price']);


        $sql = "UPDATE managebook SET origin = ?, destination = ?, price = ? WHERE fid = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssdi", $origin, $destination, $price, $booking_id);
        if ($stmt->execute()) {
            header("location:Manage_booking.php");
        } else {
            echo "<p>Error updating booking: " . $stmt->error . "</p>";
        }

        $stmt->close();
    }


    $sql = "SELECT origin, destination, price FROM managebook WHERE fid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $booking_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Modify Booking - AreoBook</title>
            <style>
                body {
                    font-family: 'Poppins', sans-serif;
                    margin: 0;
                    padding: 0;
                    background-color: #f4f7fa;
                }

                main {
                    padding: 40px 20px;
                    max-width: 600px;
                    margin: 0 auto;
                    background-color: #f0f4f8;
                    border-radius: 8px;
                    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
                }

                h1 {
                    text-align: center;
                    margin-bottom: 20px;
                    color: #333;
                }

                label {
                    display: block;
                    margin: 10px 0 5px;
                }

                input {
                    width: 100%;
                    padding: 10px;
                    margin-bottom: 15px;
                    border: 1px solid #ddd;
                    border-radius: 4px;
                }

                button {
                    padding: 10px 15px;
                    background-color: #28a745;
                    color: white;
                    border: none;
                    border-radius: 4px;
                    cursor: pointer;
                }

                button:hover {
                    background-color: #218838;
                }
            </style>
        </head>

        <body>

            <main>
                <h1>Modify Booking</h1>

                <form action="" method="post">
                    <label for="origin">Origin:</label>
                    <input type="text" name="origin" id="origin" value="<?php echo htmlspecialchars($row['origin']); ?>" required>

                    <label for="destination">Destination:</label>
                    <input type="text" name="destination" id="destination" value="<?php echo htmlspecialchars($row['destination']); ?>" required>

                    <label for="price">Price:</label>
                    <input type="number" step="0.01" name="price" id="price" value="<?php echo htmlspecialchars($row['price']); ?>" required>

                    <button type="submit">Update Booking</button>
                </form>
            </main>

        </body>

        </html>

<?php
    } else {
        echo "<p>Booking not found.</p>";
    }

    $stmt->close();
} else {

    echo "<p>No booking ID provided.</p>";
}

include_once 'footer.php';
?>