<?php include_once 'header.php'; ?>
<div class="profile-container">
  <h1>Profile</h1>
  <img src="img/profile.png" alt="profile" width="150px">

  <table border="1px" style="margin-left: auto; margin-right:auto;">
    <legend>User Details</legend>
    <tr>
      <td>User ID:</td>
      <td><?php echo isset($_SESSION['uId']) ? $_SESSION['uId'] : ''; ?></td>
    </tr>
    <tr>
      <td>First Name:</td>
      <td><?php echo isset($_SESSION['fName']) ? $_SESSION['fName'] : ''; ?></td>
    </tr>
    <tr>
      <td>Last Name: </td>
      <td><?php echo isset($_SESSION['lName']) ? $_SESSION['lName'] : ''; ?></td>
    </tr>
    <tr>
      <td>Email: </td>
      <td><?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?></td>
    </tr>
    <tr>
      <td>Age: </td>
      <td><?php echo isset($_SESSION['age']) ? $_SESSION['age'] : ''; ?></td>
    </tr>
    <tr>
      <td>Gender:</td>
      <td><?php echo isset($_SESSION['gender']) ? $_SESSION['gender'] : ''; ?></td>
    </tr>
  </table>

  <button style="margin-bottom: 10px; margin-top: 10px;">
    <a href="edit_profile.php">Edit Profile</a>
  </button>
  <button style="margin-bottom: 10px; margin-top: 10px;">
    <a href="includes/logout.inc.php">Logout</a>
  </button>
</div>

<form action="includes/delete_user.inc.php" method="POST" onsubmit="return confirm('Are you sure you want to delete your account?');">
  <button style="background-color: red;margin-bottom:20px" type="submit" name="delete_user">Delete Account</button>
</form>

<?php include_once 'footer.php'; ?>