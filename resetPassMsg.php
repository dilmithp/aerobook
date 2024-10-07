<?php
include_once 'header.php';
if (isset($_POST['submit'])) {
  $email = $_POST['email'];
  echo "Dear $email,Contact <a href='contact.php'>Admin</a> to reset your password.";
  echo "<br><p>Back to <a href='login.php'>Login</a></p>";
} else {
  header("Location: ../forgetPass.php");
  exit();
}
include_once 'footer.php';
