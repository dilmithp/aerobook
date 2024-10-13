<?php
include_once 'includes/db.inc.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $booking_id = htmlspecialchars($_POST['booking_id']);
    $flight_date = htmlspecialchars($_POST['flight_date']);
    $seat_preference = htmlspecialchars($_POST['seat_preference']);
    $meal_preference = htmlspecialchars($_POST['meal_preference']);
    $flight_number = htmlspecialchars($_POST['fid']);


    $query = "UPDATE bookings SET flight_date = ?, seat_preference = ?, meal_preference = ?, flight_number = ? WHERE fid = ?";
    $stmt = $conn->prepare($query);

    $stmt->bind_param('ssssi', $flight_date, $seat_preference, $meal_preference, $flight_number, $booking_id);

    if ($stmt->execute()) {
        header("Location: Manage_booking.php");
        exit();
    } else {
        echo "Error updating booking!";
    }

    $stmt->close();
}
