<?php
session_start();
if (!isset($_SESSION['adminID'])) {
  header("Location: ../admin-login.php");
  exit();
}
require '../includes/db.inc.php';

if (isset($_GET['id'])) {
  $uId = $_GET['id'];

  // Delete user
  $sql = "DELETE FROM users WHERE uId=?";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo "SQL error";
    exit();
  }
  mysqli_stmt_bind_param($stmt, "i", $uId);
  mysqli_stmt_execute($stmt);

  header("Location: dashboard.php?delete=success");
  exit();
} else {
  header("Location: dashboard.php?error=nouser");
  exit();
}
