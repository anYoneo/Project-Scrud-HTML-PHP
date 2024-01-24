<?php
if (isset($_POST['password']) && isset($_POST['confirm_password'])) {
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm_password'];

  if ($password == $confirm_password) {
    // Passwords match, continue with further processing
  } else {
    // Display error message that passwords do not match
    echo "Passwords do not match!";
  }
}
?>