<?php
  $host = "localhost";
  $user = "root";
  $password = "root";
  $database_name = "cosolu";
  $connection = mysqli_connect($host, $user, $password, $database_name);

  if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
 }

?>