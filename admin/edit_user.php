<?php
include_once 'header.php';
if (!isset($_SESSION['adminID'])) {
  header("Location: ../admin-login.php");
  exit();
}
require '../includes/db.inc.php';

if (isset($_GET['id'])) {
  $uId = $_GET['id'];

  // Fetch user data
  $sql = "SELECT * FROM users WHERE uId=?";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo "SQL error";
    exit();
  }
  mysqli_stmt_bind_param($stmt, "i", $uId);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  $user = mysqli_fetch_assoc($result);
}

if (isset($_POST['submit'])) {
  $fName = $_POST['fName'];
  $lName = $_POST['lName'];
  $email = $_POST['email'];
  $age = $_POST['age'];
  $gender = $_POST['gender'];
  $uId = $_POST['uId'];
  $password = $_POST['password']; // New password input

  // Update user data
  $sql = "UPDATE users SET fName=?, lName=?, email=?, age=?, gender=?";

  // Check if password is provided and hash it
  if (!empty($password)) {
    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
    $sql .= ", uPwd=? WHERE uId=?";
  } else {
    $sql .= " WHERE uId=?";
  }

  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo "SQL error";
  } else {
    if (!empty($password)) {
      mysqli_stmt_bind_param($stmt, "sssissi", $fName, $lName, $email, $age, $gender, $hashedPwd, $uId);
    } else {
      mysqli_stmt_bind_param($stmt, "sssisi", $fName, $lName, $email, $age, $gender, $uId);
    }
    mysqli_stmt_execute($stmt);
    header("Location: dashboard.php?update=success");
    exit();
  }
}
?>


<form action="edit_user.php?id=<?= $user['uId'] ?>" method="post">
  <h1>Edit User</h1>
  <input type="hidden" name="uId" value="<?= $user['uId'] ?>">
  <label for="fName">First Name:</label>
  <input type="text" name="fName" value="<?= $user['fName'] ?>" required><br>
  <label for="lName">Last Name:</label>
  <input type="text" name="lName" value="<?= $user['lName'] ?>" required><br>
  <label for="email">Email:</label>
  <input type="email" name="email" value="<?= $user['email'] ?>" required><br>
  <label for="age">Age:</label>
  <input type="number" name="age" value="<?= $user['age'] ?>" required><br>
  <label for="gender">Gender:</label>
  <select name="gender">
    <option value="Male" <?= $user['gender'] == 'Male' ? 'selected' : '' ?>>Male</option>
    <option value="Female" <?= $user['gender'] == 'Female' ? 'selected' : '' ?>>Female</option>
  </select><br>
  <label for="password">New Password (leave blank to keep current password):</label>
  <input type="password" name="password" placeholder="Leave blank if not changing"><br>
  <button type="submit" name="submit">Update User</button>
</form>
</body>

</html>