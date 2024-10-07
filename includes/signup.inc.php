<?php
if (isset($_POST['submit'])) {
  require_once 'db.inc.php';
  require_once 'functions.inc.php';

  $fName = $_POST['fName'];
  $lName = $_POST['lName'];
  $age = (int)$_POST['age'];
  $gender = $_POST['gender'];
  $email = $_POST['email'];
  $pwd = $_POST['pwd'];
  $pwdRepeat = $_POST['pwdRepeat'];

  // Validate inputs
  $validMail = validMail($email);
  $passCheck = passCheck($pwd, $pwdRepeat);
  $uidExists = uidExists($conn, $email);

  if ($validMail) {
    header('Location: ../signup.php?error=invalidemail');
    exit();
  }
  if ($passCheck) {
    header('Location: ../signup.php?error=passwordsdontmatch');
    exit();
  }
  if ($uidExists) {
    header('Location: ../signup.php?error=UIDtaken');
    exit();
  }

  // Create user
  createUser($conn, $fName, $lName, $age, $gender, $email, $pwd);
}
