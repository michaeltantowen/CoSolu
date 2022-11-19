<?php

  include_once("helper.php");
  include_once("connection.php");

  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $passwordConfirm = $_POST['passwordConfirm'];

  $passLen = strlen($password);
  $passNumber = false;

  if (preg_match('~[0-9]+~', $password)) {
    $passNumber = true;
  }

  unset($_POST['password']);
  unset($_POST['passwordConfirm']);

  $data = http_build_query($_POST);

  $cekEmail = mysqli_query($connection, "SELECT * FROM ms_user WHERE user_email='$email'");

  if(mysqli_num_rows($cekEmail) > 0) {
    header("Location: " . BASE_URL . "index.php?page=signup&alert=email&$data");
    exit;
  }

  if($password !== $passwordConfirm || !$passNumber || $passLen < 8 || $passLen > 20) {
    header("Location: " . BASE_URL . "index.php?page=signup&alert=password&$data");
    exit;
  }

  $password = password_hash($password, PASSWORD_DEFAULT);
  mysqli_query($connection, "INSERT INTO ms_user (username, user_email, password, account_type) VALUES('$username', '$email', '$password', 'bronze')");
  // echo mysqli_affected_rows($connection);
  // echo mysqli_error($connection);
  
  header("Location: " . BASE_URL . "index.php?page=signup&alert=created");
  exit;

?>