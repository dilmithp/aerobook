<?php
session_start();
require 'db.inc.php';

if (isset($_POST['delete_user'])) {
  // Get the user's ID from the session
  $userId = $_SESSION['uId'];

  // SQL query to delete the user from the database
  $sql = "DELETE FROM users WHERE uId=?"; // Replace 'id' with the correct column name for user ID if different
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql)) {
    // SQL statement preparation failed
    header("Location: ../profile.php?error=sqlerror");
    exit();
  } else {
    // Bind the user ID to the prepared statement
    mysqli_stmt_bind_param($stmt, "i", $userId);

    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
      // If successful, destroy the session and log out the user
      session_unset();
      session_destroy();

      // Redirect to a goodbye or login page after deletion
      header("Location: ../goodbye.php?delete=success");
      exit();
    } else {
      // If the execution failed, redirect with an error
      header("Location: ../profile.php?error=deletefailed");
      exit();
    }
  }
} else {
  // If the form was not submitted, redirect back to the profile page
  header("Location: ../profile.php");
  exit();
}
