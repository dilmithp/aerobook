<?php
include_once 'db.inc.php';

if (isset($_POST['add_booking'])) {

  $origin = $_POST['origin'];
  $destination = $_POST['destination'];
  $price = $_POST['price'];


  if (empty($origin) || empty($destination) || empty($price)) {
    echo "All fields are required!";
  } else {

    $sql = "INSERT INTO managebook (origin, destination, price) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
      echo "Error in SQL query preparation: " . $conn->error;
      exit();
    }


    $stmt->bind_param("ssd", $origin, $destination, $price);


    if ($stmt->execute()) {

      header("Location: ../Manage_booking.php?booking=success");
      exit();
    } else {
      echo "Error: " . $stmt->error;
    }


    $stmt->close();
  }
} else {

  echo "Invalid access.";
}

$conn->close();
