<?php include_once 'header.php'; ?>
<div class="login-container">
  <h1>Sign Up</h1>
  <form action="includes/signup.inc.php" method="post">
    <input name="fName" type="text" placeholder="First Name*" required>
    <input name="lName" type="text" placeholder="Last Name*" required>
    <input name="age" type="number" placeholder="Age*" required>
    <input name="gender" type="text" placeholder="Gender-Male/Female/Other*" required>
    <input name="email" type="email" placeholder="Email*" required>
    <input name="pwd" type="password" placeholder="Password" required>
    <input name="pwdRepeat" type="password" placeholder="Confirm Password" required>
    <button name="submit" type="submit">Register</button>
  </form>
  <p>Already have an account?<a href="login.php"> Log In</a></p>
</div>
<script>
  function validateForm() {
    const password = document.querySelector('input[name="pwd"]').value;
    const confirmPassword = document.querySelector('input[name="pwdRepeat"]').value;

    if (password !== confirmPassword) {
      alert("Passwords do not match. Please try again.");
      return false;
    }

    alert("Form submitted successfully!");
    return true;
  }
</script>
<?php include_once 'footer.php'; ?>