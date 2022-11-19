<?php

  include_once("helper.php");
  include_once("connection.php");

  $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : false;
  $user_type = isset($_SESSION['account_type']) ? $_SESSION['account_type'] : false;

  if(!$user_id || $user_type != "admin") {
    header("Location: " . BASE_URL . "index.php");
  } else {
    $user_id = isset($_GET['user_id']) ? $_GET['user_id'] : false;
    mysqli_query($connection, "UPDATE ms_user SET account_type = 'admin' WHERE user_id = $user_id");
    echo mysqli_affected_rows($connection);
    echo mysqli_error($connection);
  
    // header("Location: " . BASE_URL . "index.php?page=signup&alert=created");
    // exit;
  }
?>