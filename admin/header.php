<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AREO BOOK|Fly Safely</title>
  <link rel="stylesheet" href="../css/webStyle.css">
  <link rel="stylesheet" href="style.css">
  <link rel="icon" href="../img/logo.png" type="image/png">
</head>

<body>
  <div class="header-container">
    <ul>
      <li><a href="index.php"><img src="../img/logo.png" alt="home" width="40px"></a></li>
      <li><a href="dashboard.php">Dashboard</a></li>
      <li><a href="add_user.php">Add User</a></li>
      <li><a href="../Manage_booking.php">Manage booking</a></li>
      <li style="float: right;">
        <?php
        if (isset($_SESSION['fName'])) {
          echo "<a href=\"../includes/logout.inc.php\">Logout</a>";
        } else if (isset($_SESSION['adminFname'])) {
          echo "<a href=\"../includes/logout.inc.php\">Logout</a>";
        } else {
          echo "<a href=\"login.php\">Login</a>";
        } ?></li>
      <li style="float: right;">
        <?php
        if (isset($_SESSION['fName'])) {
          echo "<a href=\"profile.php\">" . $_SESSION['fName'] . '!' . "</a>";
        } else if (isset($_SESSION['adminFname'])) {
          echo "<a href=\"#\">" . 'Admin ' . $_SESSION['adminFname'] . '!' . "</a>";
        } else {
          echo "<a href=\"../signup.php\">Sign Up</a>";
        } ?></li>
    </ul>
  </div>