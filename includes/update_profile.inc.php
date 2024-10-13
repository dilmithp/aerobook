<?php
session_start();
require 'db.inc.php';

if (isset($_POST['update_profile'])) {
  $fName = $_POST['fName'];
  $lName = $_POST['lName'];
  $email = $_POST['email'];
  $age = $_POST['age'];
  $gender = $_POST['gender'];
  $userId = $_SESSION['uId'];

  // Prepare the update query to update user details in the database
  $sql = "UPDATE users SET fName=?, lName=?, email=?, age=?, gender=? WHERE uId=?";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql)) {
    // SQL statement preparation failed
    header("Location: edit_profile.php?error=sqlerror");
    exit();
  } else {
    // Bind the parameters to the prepared statement
    mysqli_stmt_bind_param($stmt, "sssisi", $fName, $lName, $email, $age, $gender, $userId);

    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
      // Update session variables after successful update
      $_SESSION['fName'] = $fName;
      $_SESSION['lName'] = $lName;
      $_SESSION['email'] = $email;
      $_SESSION['age'] = $age;
      $_SESSION['gender'] = $gender;

      // Redirect back to profile page with success message
      header("Location: ../profile.php?update=success");
      exit();
    } else {
      // Execution failed
      header("Location: edit_profile.php?error=updatefailed");
      exit();
    }
  }
} else {
  // If the form was not submitted, redirect back to the edit profile page
  header("Location: edit_profile.php");
  exit();
}
