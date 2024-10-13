<?php
include_once 'header.php';
include_once 'includes/db.inc.php';

if (isset($_GET['booking_id'])) {
    $booking_id = $_GET['booking_id'];

    // Delete booking
    $sql = "DELETE FROM managebook WHERE fid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $booking_id);

    if ($stmt->execute()) {
        header('location:Manage_booking.php');
    } else {
        echo "<p>Error deleting booking.</p>";
    }

    $stmt->close();
}

include_once 'footer.php';
