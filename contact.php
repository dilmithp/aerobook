<?php include_once 'header.php'; ?>
<?php
// Database connection details
require_once 'includes/db.inc.php';

$message = '';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Sanitize and validate input data
  $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
  $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
  $subject = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_STRING);
  $message_text = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

  // Prepare and execute the SQL query
  $stmt = $conn->prepare("INSERT INTO contact_submissions (name, email, subject, message) VALUES (?, ?, ?, ?)");
  $stmt->bind_param("ssss", $name, $email, $subject, $message_text);

  if ($stmt->execute()) {
    $message = "<div class='success-message'>Thank you for your message. We'll get back to you soon!</div>";
  } else {
    $message = "<div class='error-message'>Oops! Something went wrong. Please try again later.</div>";
  }

  $stmt->close();
}

$conn->close();
?>
<main class="contact-container">
  <div class="contact-left">
    <img src="img/3.jpg" alt="Customer Support" class="contact-image">
    <div class="contact-info">
      <h2>Get in Touch</h2>
      <p><strong>Address:</strong> 123 Aviation Street, Sky City, SC 12345</p>
      <p><strong>Phone:</strong> +1 (555) 123-4567</p>
      <p><strong>Email:</strong> support@areobook.com</p>
      <p><strong>Hours:</strong> Monday - Friday, 9am - 6pm</p>
    </div>
  </div>
  <div class="contact-right">
    <h2>Contact Us</h2>
    <div id="message-container"></div>
    <form id="contact-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
      </div>
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
      </div>
      <div class="form-group">
        <label for="subject">Subject:</label>
        <input type="text" id="subject" name="subject" required>
      </div>
      <div class="form-group">
        <label for="message">Message:</label>
        <textarea id="message" name="message" required></textarea>
      </div>
      <button type="submit">Send Message</button>
    </form>
  </div>
</main>
<?php include_once 'footer.php'; ?>