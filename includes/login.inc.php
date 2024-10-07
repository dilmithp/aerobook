<?php
if (isset($_POST['submit'])) {
  require_once 'db.inc.php';
  require_once 'functions.inc.php';
  $email = $_POST['uid'];
  $pwd = $_POST['pwd'];
  loginUsers($conn, $email, $pwd);
} else {
  header('Location: ../login.php');
  exit();
}
