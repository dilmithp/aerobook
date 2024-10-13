<?php include_once 'header.php'; ?>
<div class="login-container">
  <h1>Admin Login</h1>
  <form action="includes/admin-login.inc.php" method="post">
    <input type="text" placeholder="Email" name="uid" required><br>
    <input type="password" placeholder="Password" name="pwd" required><br>
    <button name="submit" type="submit">Login</button>  
    <br>
    <a href="fogetPass.php">Forget Password</a>
  </form>
</div>
<?php include_once 'footer.php'; ?>