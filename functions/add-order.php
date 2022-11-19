<?php

  session_start();
  include_once("helper.php");
  include_once("connection.php");

  $user_id = $_SESSION['user_id'];
  $id = $_POST['id'];
  $email = $_POST['email'];
  $file_name = $_FILES['file']['name'];

  move_uploaded_file($_FILES['file']['tmp_name'], "../Assets/evidence/" . $file_name);
  

  mysqli_query($connection, "INSERT INTO ms_transaction (user_id, template_id, email, tf_evidence, tr_status) VALUES ($user_id, $id, '$email', '$file_name', 'processing');");
  // echo mysqli_affected_rows($connection);
  // echo mysqli_error($connection);
  header("Location: " . BASE_URL . "index.php?page=order&alert=process");