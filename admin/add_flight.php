<?php
include_once 'header.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $flight_number = $_POST['flight_number'];
  $departure_city = $_POST['departure_city'];
  $arrival_city = $_POST['arrival_city'];
  $departure_time = $_POST['departure_time'];
  $seats_available = $_POST['seats_available'];

  $stmt = $conn->prepare("INSERT INTO flights (flight_number, departure_city, arrival_city, departure_time, seats_available) VALUES (?, ?, ?, ?, ?)");
  $stmt->execute([$flight_number, $departure_city, $arrival_city, $departure_time, $seats_available]);

  header("Location: admin_dashboard.php");
}
?>

<?php include_once 'footer.php'; ?>