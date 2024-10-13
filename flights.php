<?php
session_start();
require_once 'includes/db.inc.php';
// Flight data (normally this would come from a database)
$flights = [
  ['id' => 1, 'from' => 'New York', 'to' => 'London', 'date' => '2023-07-15', 'time' => '10:00', 'price' => 450, 'airline' => 'AeroJet', 'duration' => '7h 30m', 'img' => 'flight1'],
  ['id' => 2, 'from' => 'Paris', 'to' => 'Tokyo', 'date' => '2023-07-16', 'time' => '14:30', 'price' => 780, 'airline' => 'SkyWings', 'duration' => '12h 15m', 'img' => 'flight2'],
  ['id' => 3, 'from' => 'Los Angeles', 'to' => 'Sydney', 'date' => '2023-07-17', 'time' => '23:45', 'price' => 920, 'airline' => 'PacificAir', 'duration' => '15h 20m', 'img' => 'flight3'],
  ['id' => 4, 'from' => 'Dubai', 'to' => 'New York', 'date' => '2023-07-18', 'time' => '08:15', 'price' => 680, 'airline' => 'EagleWays', 'duration' => '14h 05m', 'img' => 'flight3'],
  ['id' => 5, 'from' => 'London', 'to' => 'Hong Kong', 'date' => '2023-07-19', 'time' => '19:20', 'price' => 590, 'airline' => 'AsiaExpress', 'duration' => '11h 55m', 'img' => 'flight1'],
  ['id' => 6, 'from' => 'Singapore', 'to' => 'San Francisco', 'date' => '2023-07-20', 'time' => '01:30', 'price' => 850, 'airline' => 'PacificJet', 'duration' => '14h 40m', 'img' => 'flight2'],
  ['id' => 7, 'from' => 'Berlin', 'to' => 'Moscow', 'date' => '2023-07-21', 'time' => '11:45', 'price' => 320, 'airline' => 'EuroWings', 'duration' => '3h 10m', 'img' => 'flight1'],
  ['id' => 8, 'from' => 'Toronto', 'to' => 'Rio de Janeiro', 'date' => '2023-07-22', 'time' => '16:00', 'price' => 710, 'airline' => 'AmericaSky', 'duration' => '10h 25m', 'img' => 'flight3']
];

// Booking logic
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['book_flight'])) {
  $flight_id = $_POST['flight_id'];
  $emergency_contact = $_POST['emergency_contact'];
  $emergency_phone = $_POST['emergency_phone'];
  $user_name = $_POST['user_name'];
  $user_email = $_POST['user_email'];
  $user_phone = $_POST['user_phone'];
  $user_address = $_POST['user_address'];
  $card_number = $_POST['card_number'];
  $expiry_month = $_POST['expiry_month'];
  $expiry_year = $_POST['expiry_year'];
  $cvv = $_POST['cvv'];

  $sql = "INSERT INTO bookings (flight_id, user_name, user_email, user_phone, user_address, emergency_contact, emergency_phone, card_number, expiry_month, expiry_year, cvv) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

  $stmt = $conn->prepare($sql);
  $stmt->bind_param("issssssssss", $flight_id, $user_name, $user_email, $user_phone, $user_address, $emergency_contact, $emergency_phone, $card_number, $expiry_month, $expiry_year, $cvv);

  if ($stmt->execute()) {
    $booking_id = $stmt->insert_id;
    $booking_success = true;
  } else {
    $booking_error = "Error: " . $stmt->error;
  }

  $stmt->close();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AREO BOOK|Fly Safely</title>
  <link rel="stylesheet" href="css/webStyle.css">
  <link rel="stylesheet" href="css/flight.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="icon" href="img/logo.png" type="image/png">
  <style>
    .popup {
      display: none;
      position: fixed;
      z-index: 1;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(0, 0, 0, 0.4);
    }

    .popup-content {
      background-color: #fefefe;
      margin: 15% auto;
      padding: 20px;
      border: 1px solid #888;
      width: 80%;
      display: flex;
    }

    .popup-left,
    .popup-right {
      flex: 1;
      padding: 20px;
    }

    .close {
      color: #aaa;
      float: right;
      font-size: 28px;
      font-weight: bold;
    }

    .close:hover,
    .close:focus {
      color: black;
      text-decoration: none;
      cursor: pointer;
    }

    .form-section {
      margin-bottom: 20px;
    }

    .form-section h3 {
      margin-bottom: 10px;
    }

    .form-section input,
    .form-section select {
      width: 100%;
      padding: 8px;
      margin-bottom: 10px;
    }

    .expiry-cvv {
      display: flex;
      justify-content: space-between;
    }

    .expiry-cvv select,
    .expiry-cvv input {
      width: 30%;
    }
  </style>
</head>

<body>
  <div class="header-container">
    <ul>
      <li><a href="index.php"><img src="img/logo.png" alt="home" width="40px"></a></li>
      <li><a class="active" href="index.php">Home</a></li>
      <li><a href="Flight_results.php">Pricing</a></li>
      <li><a href="flights.php">Flights</a></li>
      <li><a href="about.php">About</a></li>
      <li><a href="terms.php">Terms</a></li>
      <li><a href="contact.php">Contact</a></li>
      <li style="float: right;">
        <?php
        if (isset($_SESSION['fName'])) {
          echo "<a href=\"includes/logout.inc.php\">Logout</a>";
        } else if (isset($_SESSION['adminFname'])) {
          echo "<a href=\"includes/logout.inc.php\">Logout</a>";
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
          echo "<a href=\"signup.php\">Sign Up</a>";
        } ?></li>
    </ul>
  </div>
  <main>
    <section class="search-section">
      <h2>Search Flights</h2>
      <form id="flight-search-form">
        <input type="text" id="from" placeholder="From">
        <input type="text" id="to" placeholder="To">
        <input type="date" id="date">
        <button type="submit">Search</button>
      </form>
    </section>

    <section class="filter-section">
      <h3>Filters</h3>
      <div class="filter-options">
        <label>
          Price Range:
          <input type="range" id="price-filter" min="0" max="1000" step="50">
          <span id="price-value"></span>
        </label>
        <label>
          Airline:
          <select id="airline-filter">
            <option value="">All Airlines</option>
            <?php
            $airlines = array_unique(array_column($flights, 'airline'));
            foreach ($airlines as $airline) {
              echo "<option value=\"$airline\">$airline</option>";
            }
            ?>
          </select>
        </label>
      </div>
    </section>

    <section class="flights-grid">
      <?php foreach ($flights as $flight): ?>
        <div class="flight-card" data-price="<?php echo $flight['price']; ?>" data-airline="<?php echo $flight['airline']; ?>">
          <img src="img/<?php echo $flight['img']; ?>.jpg" alt="Flight <?php echo $flight['id']; ?>">
          <div class="flight-details">
            <h3><?php echo $flight['from']; ?> to <?php echo $flight['to']; ?></h3>
            <p>Date: <?php echo $flight['date']; ?></p>
            <p>Time: <?php echo $flight['time']; ?></p>
            <p>Price: $<?php echo $flight['price']; ?></p>
            <p>Airline: <?php echo $flight['airline']; ?></p>
            <p>Duration: <?php echo $flight['duration']; ?></p>
            <button class="book-now" data-flight-id="<?php echo $flight['id']; ?>">Book Now</button>
          </div>
        </div>
      <?php endforeach; ?>
    </section>
  </main>

  <div id="booking-popup" class="popup">
    <div class="popup-content">
      <span class="close">×</span>
      <div class="popup-left">
        <img id="selected-flight-image" src="" alt="Flight Image">
        <div id="selected-flight-details"></div>
      </div>
      <div class="popup-right">
        <h2>Flight Booking</h2>
        <form id="booking-form" method="POST">
          <input type="hidden" name="flight_id" id="flight_id">
          <div class="form-section">
            <h3>Emergency Contact</h3>
            <input type="text" name="emergency_contact" placeholder="Emergency Contact Name" required>
            <input type="tel" name="emergency_phone" placeholder="Emergency Contact Phone" required>
          </div>
          <div class="form-section">
            <h3>User Details</h3>
            <input type="text" name="user_name" placeholder="Your Name" required>
            <input type="email" name="user_email" placeholder="Your Email" required>
            <input type="tel" name="user_phone" placeholder="Your Phone" required>
            <input type="text" name="user_address" placeholder="Your Address" required>
          </div>
          <div class="form-section">
            <h3>Payment</h3>
            <input type="text" name="card_number" placeholder="Card Number" required>
            <div class="expiry-cvv">
              <select name="expiry_month" required>
                <option value="">Month</option>
                <?php for ($i = 1; $i <= 12; $i++) echo "<option value='$i'>$i</option>"; ?>
              </select>
              <select name="expiry_year" required>
                <option value="">Year</option>
                <?php for ($i = date('Y'); $i <= date('Y') + 10; $i++) echo "<option value='$i'>$i</option>"; ?>
              </select>
              <input type="text" name="cvv" placeholder="CVV" required>
            </div>
          </div>
          <button type="submit" name="book_flight">Confirm Booking</button>
        </form>
      </div>
    </div>
  </div>

  <?php if (isset($booking_success)): ?>
    <div id="booking-success" class="popup">
      <div class="popup-content">
        <span class="close">×</span>
        <h2>Booking Successful!</h2>
        <p>Your flight has been booked successfully.</p>
      </div>
    </div>
  <?php endif; ?>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const flightCards = document.querySelectorAll('.flight-card');
      const bookingPopup = document.getElementById('booking-popup');
      const bookingForm = document.getElementById('booking-form');
      const closeButtons = document.querySelectorAll('.close');
      const priceFilter = document.getElementById('price-filter');
      const priceValue = document.getElementById('price-value');
      const airlineFilter = document.getElementById('airline-filter');
      const searchForm = document.getElementById('flight-search-form');

      // Search functionality
      searchForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const from = document.getElementById('from').value.toLowerCase();
        const to = document.getElementById('to').value.toLowerCase();
        const date = document.getElementById('date').value;

        flightCards.forEach(card => {
          const cardFrom = card.querySelector('h3').textContent.split(' to ')[0].toLowerCase();
          const cardTo = card.querySelector('h3').textContent.split(' to ')[1].toLowerCase();
          const cardDate = card.querySelector('p:nth-child(2)').textContent.split(': ')[1];

          if ((from === '' || cardFrom.includes(from)) &&
            (to === '' || cardTo.includes(to)) &&
            (date === '' || cardDate === date)) {
            card.style.display = 'block';
          } else {
            card.style.display = 'none';
          }
        });
      });

      // Price filter
      priceFilter.addEventListener('input', function() {
        const maxPrice = this.value;
        priceValue.textContent = `${maxPrice}`;

        flightCards.forEach(card => {
          const price = parseInt(card.dataset.price);
          if (price <= maxPrice) {
            card.style.display = 'block';
          } else {
            card.style.display = 'none';
          }
        });
      });

      // Airline filter
      airlineFilter.addEventListener('change', function() {
        const selectedAirline = this.value;

        flightCards.forEach(card => {
          if (selectedAirline === '' || card.dataset.airline === selectedAirline) {
            card.style.display = 'block';
          } else {
            card.style.display = 'none';
          }
        });
      });

      // Booking popup
      flightCards.forEach(card => {
        const bookButton = card.querySelector('.book-now');
        bookButton.addEventListener('click', function() {
          const flightId = this.dataset.flightId;
          const flightDetails = card.querySelector('.flight-details').innerHTML;
          const flightImage = card.querySelector('img').src;
          document.getElementById('selected-flight-details').innerHTML = flightDetails.replace('<button class="book-now" data-flight-id="' + flightId + '">Book Now</button>', '');
          document.getElementById('selected-flight-image').src = flightImage;
          document.getElementById('flight_id').value = flightId;
          bookingPopup.style.display = 'block';
        });
      });

      // Close popup
      closeButtons.forEach(button => {
        button.addEventListener('click', function() {
          this.closest('.popup').style.display = 'none';
        });
      });

      // Close popup when clicking outside
      window.addEventListener('click', function(event) {
        if (event.target === bookingPopup) {
          bookingPopup.style.display = 'none';
        }
      });

      // Initialize price filter value
      priceFilter.value = 1000;
      priceValue.textContent = `${priceFilter.value}`;

      // Booking form submission
      bookingForm.addEventListener('submit', function(e) {
        // Form submission is handled by PHP, so we don't prevent the default action here
      });

      // Close success popup
      const successPopup = document.getElementById('booking-success');
      if (successPopup) {
        const closeSuccessPopup = successPopup.querySelector('.close');
        closeSuccessPopup.addEventListener('click', function() {
          successPopup.style.display = 'none';
        });
      }
    });
  </script>