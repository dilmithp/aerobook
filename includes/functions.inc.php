<?php
require_once 'db.inc.php';

function validMail($email)
{
  return filter_var($email, FILTER_VALIDATE_EMAIL) ? false : true;
}

function passCheck($pwd, $pwdRepeat)
{
  return ($pwd !== $pwdRepeat) ? true : false;
}

function uidExists($conn, $email)
{
  $sql = "SELECT * FROM users WHERE email=?;";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../signup.php?error=stmtfailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "s", $email);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  mysqli_stmt_close($stmt);
  if ($row = mysqli_fetch_assoc($result)) {
    return $row;
  } else {
    return false;
  }
}

function createUser($conn, $fName, $lName, $age, $gender, $email, $pwd)
{
  $sql = "INSERT INTO users (fName, lName, age, gender, email, uPwd) VALUES (?, ?, ?, ?, ?, ?);";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../signup.php?error=stmtfailed");
    exit();
  }

  $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
  mysqli_stmt_bind_param($stmt, "ssisss", $fName, $lName, $age, $gender, $email, $hashedPwd);

  if (!mysqli_stmt_execute($stmt)) {
    echo "Execution failed: " . mysqli_error($conn);
    exit();
  }

  mysqli_stmt_close($stmt);
  header("location: ../login.php?error=none");
  exit();
}
function loginUsers($conn, $email, $pwd)
{
  $uidExists = uidExists($conn, $email);
  if ($uidExists === false) {
    header("location: ../signup.php?error=noUserSignUP");
    exit();
  }
  $pwdHashed = $uidExists["uPwd"];
  $checkPwd = password_verify($pwd, $pwdHashed);
  if ($checkPwd === false) {
    header("location: ../login.php?error=wrongPassword");
    exit();
  } else if ($checkPwd === true) {
    session_start();
    $_SESSION['uId'] = $uidExists['uId'];
    $_SESSION['fName'] = $uidExists['fName'];
    $_SESSION['lName'] = $uidExists['lName'];
    $_SESSION['age'] = $uidExists['age'];
    $_SESSION['gender'] = $uidExists['gender'];
    $_SESSION['email'] = $uidExists['email'];
    header("location: ../index.php");
    exit();
  }
}
function adminuidExists($conn, $email)
{
  $sql = "SELECT * FROM admin WHERE adminEmail=?;";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../signup.php?error=stmtfailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "s", $email);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  mysqli_stmt_close($stmt);
  if ($row = mysqli_fetch_assoc($result)) {
    return $row;
  } else {
    return false;
  }
}
function longinAdmin($conn, $email, $pwd)
{
  $uidExists = adminuidExists($conn, $email);
  if ($uidExists === false) {
    header("location: ../admin-login.php?error=noUserSignUP");
    exit();
  }
  $dbpwd = $uidExists["adminPwd"];
  if ($pwd === $dbpwd) {
    $checkPwd = true;
  } else {
    $checkPwd = false;
  }
  if ($checkPwd === false) {
    header("location: ../admin-login.php?error=wrongAdminPassword");
    exit();
  } else if ($checkPwd === true) {
    session_start();
    $_SESSION['adminID'] = $uidExists['adminID'];
    $_SESSION['adminFname'] = $uidExists['adminFname'];
    $_SESSION['adminLname'] = $uidExists['adminLname'];
    $_SESSION['adminEmail'] = $uidExists['adminEmail'];
    header("location: ../admin/dashboard.php");
    exit();
  }
}
