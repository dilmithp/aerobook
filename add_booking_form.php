<?php
include_once 'header.php';
include_once 'includes/db.inc.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage Booking - AreoBook</title>
  <style>
    /* Keep your existing styles */
    /* Add new styles for the add-booking form */
    .add-booking-form {
      max-width: 600px;
      margin: 20px auto;
      padding: 20px;
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    .add-booking-form input {
      width: 100%;
      padding: 10px;
      margin-bottom: 10px;
      border-radius: 6px;
      border: 1px solid #ddd;
    }

    .add-booking-form button {
      width: 100%;
      padding: 10px;
      background-color: #28a745;
      color: white;
      font-size: 16px;
      border-radius: 6px;
      cursor: pointer;
      border: none;
    }

    .add-booking-form button:hover {
      background-color: #218838;
    }
  </style>
</head>

<body>

  <main>
    <h1>Manage Booking</h1>
    <div class="add-booking-form">
      <h2>Add New Booking</h2>
      <form action="includes/add_booking.inc.php" method="POST">
        <input type="text" name="origin" placeholder="Origin" required>
        <input type="text" name="destination" placeholder="Destination" required>
        <input type="number" step="0.01" name="price" placeholder="Price" required>
        <button type="submit" name="add_booking">Add Booking</button>
      </form>
    </div>

  </main>

</body>

</html>