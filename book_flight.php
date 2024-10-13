<?php
include_once 'includes/db.inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $flightNumber = htmlspecialchars($_POST['flightNumber']);
    $origin = htmlspecialchars($_POST['origin']);
    $destination = htmlspecialchars($_POST['destination']);
    $price = htmlspecialchars($_POST['price']);


    $sql = "INSERT INTO managebook (fid, origin, destination, price) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);


    $stmt->bind_param("isss", $flightNumber, $origin, $destination, $price);


    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }


    $stmt->close();
}
$conn->close();
