<?php
require 'header.php';
if (!isset($_SESSION['adminID'])) {
  header("Location: ../admin-login.php");
  exit();
}
require '../includes/db.inc.php';

if (isset($_POST['submit'])) {
  $fName = $_POST['fName'];
  $lName = $_POST['lName'];
  $email = $_POST['email'];
  $age = $_POST['age'];
  $gender = $_POST['gender'];
  $pwd = $_POST['pwd'];

  $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
  $sql = "INSERT INTO users (fName, lName, email, age, gender, uPwd) VALUES (?, ?, ?, ?, ?, ?)";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo "SQL error";
    exit();
  }
  mysqli_stmt_bind_param($stmt, "sssiss", $fName, $lName, $email, $age, $gender, $hashedPwd);
  mysqli_stmt_execute($stmt);
  header("Location: dashboard.php?add=success");
}
?>

<form action="add_user.php" method="post">
  <h1>Add New User</h1>
  <label for="fName">First Name:</label>
  <input type="text" name="fName" required><br>
  <label for="lName">Last Name:</label>
  <input type="text" name="lName" required><br>
  <label for="email">Email:</label>
  <input type="email" name="email" required><br>
  <label for="age">Age:</label>
  <input type="number" name="age" required><br>
  <label for="gender">Gender:</label>
  <select name="gender" required>
    <option value="Male">Male</option>
    <option value="Female">Female</option>
  </select><br>
  <label for="pwd">Password:</label>
  <input type="password" id="pwd" name="pwd" required><br>
  <button type="submit" name="submit">Add User</button>
</form>
</body>

</html>