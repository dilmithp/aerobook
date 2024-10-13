<?php include_once 'header.php'; ?>
<div class="login-container">
  <h1>Forget Password</h1>
  <form action="resetPassMsg.php" method="post">
    <input type="text" placeholder="Email" name="email" required><br>
    <button name="submit" type="submit">Submit</button>  
    <p>Remembered your password? <a href="login.php">Login</a></p>
  </form>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    const form = document.querySelector("form");

    form.addEventListener("submit", function(event) {
      const emailInput = form.querySelector('input[name="email"]');
      const emailValue = emailInput.value.trim();

      const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailPattern.test(emailValue)) {
        alert("Please enter a valid email address.");
        event.preventDefault();
        return;
      }
    });
  });
</script>

<?php include_once 'footer.php'; ?>