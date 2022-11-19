<?php

  session_start();
  include_once("helper.php");
  include_once("connection.php");

  $email = $_POST['email'];
  $password = $_POST['password'];

  unset($_POST['password']);

  $data = http_build_query($_POST);

  $cekEmail = mysqli_query($connection, "SELECT * FROM ms_user WHERE user_email='$email'");

  if(mysqli_num_rows($cekEmail) === 1) {
    $getData = mysqli_fetch_assoc($cekEmail);
    if(password_verify($password, $getData['password'])) {
      $_SESSION['user_id'] = $getData['user_id'];
      $_SESSION['account_type'] = $getData['account_type'];
      header("Location: ".BASE_URL."index.php");
      exit;
    } else {
      header("Location: ".BASE_URL."index.php?page=login&alert=password&$data");
    }
  } else {
      header("Location: ".BASE_URL."index.php?page=login&alert=email");
      exit;
  }
  
  // echo mysqli_affected_rows($connection);
  // echo mysqli_error($connection);
?>