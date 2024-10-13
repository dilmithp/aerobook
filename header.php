<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AREO BOOK|Fly Safely</title>
  <link rel="stylesheet" href="css/webStyle.css">
  <link rel="stylesheet" href="css/contact.css">
  <link rel="icon" href="img/logo.png" type="image/png">
  <link rel="stylesheet" href="css/home_term_about.css">
  <script>
    function confirmLogout(event) {
      const confirmation = confirm("Are you sure you want to log out?");
      if (!confirmation) {
        event.preventDefault();
      }
    }


    function toggleNavbar() {
      const nav = document.getElementById("navbar");
      if (nav.className === "header-container") {
        nav.className += " responsive";
      } else {
        nav.className = "header-container";
      }
    }
  </script>

</head>

<body>
  <div class="header-container" id="navbar">
    <ul>
      <li><a href="index.php"><img src="img/logo.png" alt="home" width="40px"></a></li>
      <li><a class="active" href="index.php">Home</a></li>
      <li><a href="Flight_results.php">Pricing</a></li>
      <li><a href="seat_booking.php">Seat Book</a></li>
      <li><a href="flights.php">Flights</a></li>
      <li><a href="about.php">About</a></li>
      <li><a href="terms.php">Terms</a></li>
      <li><a href="contact.php">Contact</a></li>
      <li style="float: right;">
        <?php
        if (isset($_SESSION['fName'])) {
          echo "<a href=\"includes/logout.inc.php\" onclick=\"confirmLogout(event)\">Logout</a>";
        } else if (isset($_SESSION['adminFname'])) {
          echo "<a href=\"includes/logout.inc.php\" onclick=\"confirmLogout(event)\">Logout</a>";
        } else {
          echo "<a href=\"login.php\">Login</a>";
        } ?></li>
      <li style="float: right;">
        <?php
        if (isset($_SESSION['fName'])) {
          echo "<a href=\"profile.php\">" . $_SESSION['fName'] . '!' . "</a>";
        } else if (isset($_SESSION['adminFname'])) {
          echo "<a href=\"admin/dashboard.php\">" . 'Admin ' . $_SESSION['adminFname'] . '!' . "</a>";
        } else {
          echo "<a href=\"signup.php\">Sign Up</a>";
        } ?></li>
    </ul>
  </div>
</body>

</html>