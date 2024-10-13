<?php include_once 'header.php'; ?>

<!-- Main Homepage Section -->
<div class="homepage-container">

  <!-- Hero Section with Background Image -->
  <section class="hero-section" style="background-image: url('img/indexpic.webp'); background-size: cover; background-position: center; height: 500px;">
    <div class="hero-content" style="text-align: center; padding-top: 150px; color: white;">
      <h1>Welcome to AREO BOOK</h1>
      <p>Your one-stop platform to find and book flights quickly and conveniently.</p>
      <br>

      <!-- Flight Search Button -->
      <a href="flights.php" class="search-btn" id="search-btn" style="background-color: blue; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none;">Search Flights</a>
    </div>
  </section>

  <!-- About Us Section -->
  <section class="about-us-section" id="about">
    <h2>About Us</h2>
    <div class="about-content">
      <p>AREO BOOK is designed to make your travel planning as smooth as possible. Whether you're booking a business trip, a family vacation, or a quick getaway, our platform helps you find the best flights, manage reservations, and access special offers.</p>
      <a href="about.php" class="learn-more-btn" id="learn-more-btn">Learn More</a>
    </div>
  </section>

  <!-- Featured Destinations Section -->
  <section class="featured-section" id="featured">
    <h2>Featured Destinations</h2>
    <div class="featured-grid">
      <div class="featured-item" id="paris">
        <img src="img/paris.jpg" alt="Paris, France">
        <h3>Paris, France</h3>
        <p>Experience the city of lights with exclusive discounts on flights to Paris.</p>
        <a href="flights.php" class="promo-btn">View Flights</a>
      </div>
      <div class="featured-item" id="tokyo">
        <img src="img/tokyo.jpg" alt="Tokyo, Japan">
        <h3>Tokyo, Japan</h3>
        <p>Discover the vibrant culture and culinary delights of Tokyo with special offers.</p>
        <a href="flights.php" class="promo-btn">View Flights</a>
      </div>
      <div class="featured-item" id="newyork">
        <img src="img/newyork.jpg" alt="New York, USA">
        <h3>New York, USA</h3>
        <p>Visit the Big Apple and explore its iconic landmarks at unbeatable prices.</p>
        <a href="flights.php" class="promo-btn">View Flights</a>
      </div>
    </div>
  </section>

  <!-- Promotional Offers Section -->
  <section class="promo-section" id="promotions">
    <h2>Special Offers</h2>
    <div class="promo-grid">
      <div class="promo-item">
        <img src="img/business_class.jpg" alt="Business Class Upgrade">
        <h3>Business Class Upgrade</h3>
        <p>Enjoy special discounts on business class upgrades for your next trip!</p>
        <a href="offers.php?offer=business_class" class="promo-btn">View Details</a>
      </div>
      <div class="promo-item">
        <img src="img/last_minute.jpg" alt="Last-Minute Deals">
        <h3>Last-Minute Deals</h3>
        <p>Get incredible discounts on last-minute flights to your favorite destinations.</p>
        <a href="offers.php?offer=last_minute" class="promo-btn">View Details</a>
      </div>
      <div class="promo-item">
        <img src="img/family_package.jpg" alt="Family Travel Package">
        <h3>Family Travel Package</h3>
        <p>Book for your family and enjoy exclusive group discounts and extra baggage allowance.</p>
        <a href="offers.php?offer=family_package" class="promo-btn">View Details</a>
      </div>
    </div>
  </section>
</div>

<!-- Link to JavaScript File -->
<script src="index.js"></script>
<?php include_once 'footer.php'; ?>