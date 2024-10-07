<?php
include_once 'header.php';
include_once 'includes/functions.inc.php';
if (!isset($_SESSION['uId'])) { // 'uid' is used in your function.inc.php
  header("Location: login.php");
  exit();
}
?>

<div class="login-container">
  <h1>Edit Profile</h1>
  <form action="includes/update_profile.inc.php" method="POST">
    <label for="fName">First Name:</label>
    <input type="text" name="fName" value="<?php echo $_SESSION['fName']; ?>" required><br>

    <label for="lName">Last Name:</label>
    <input type="text" name="lName" value="<?php echo $_SESSION['lName']; ?>" required><br>

    <label for="email">Email:</label>
    <input type="email" name="email" value="<?php echo $_SESSION['email']; ?>" required><br>

    <label for="age">Age:</label>
    <input type="number" name="age" value="<?php echo $_SESSION['age']; ?>" required><br>

    <label for="gender">Gender:</label>
    <select name="gender" required>
      <option value="Male" <?php if ($_SESSION['gender'] == 'M') echo 'selected'; ?>>Male</option>
      <option value="Female" <?php if ($_SESSION['gender'] == 'F') echo 'selected'; ?>>Female</option>
      <option value="Other" <?php if ($_SESSION['gender'] == 'O') echo 'selected'; ?>>Other</option>
    </select><br>

    <button type="submit" name="update_profile">Update Profile</button>
  </form>
</div>

<?php include_once 'footer.php'; ?>