<?php
include_once 'header.php';
include_once 'includes/db.inc.php';

if (isset($_GET['fid'])) {
    $booking_id = intval($_GET['fid']);


    $sql = "SELECT fid, origin, destination, price FROM bookingsmanage WHERE fid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $booking_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "<p>Booking not found.</p>";
    }

    $stmt->close();
} else {
    echo "<p>No booking ID provided.</p>";
}

include_once 'footer.php';
