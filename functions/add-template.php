<?php
  
  include_once("helper.php");
  include_once("connection.php");

  $title = $_POST['title'];
  $price = $_POST['price'];
  $file_name = $_FILES['file']['name'];

  move_uploaded_file($_FILES['file']['tmp_name'], "../Assets/template/images/" . $file_name);

  mysqli_query($connection, "INSERT INTO ms_template (template_name, template_price, template_img) VALUES('$title', $price, '$file_name')");
  header("Location: " . BASE_URL . "index.php?page=template&alert=added");
  
?>