<?php

  session_start();
  
  include_once("functions/helper.php");
  include_once("functions/connection.php");

  $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : false;
  $user_type = isset($_SESSION['account_type']) ? $_SESSION['account_type'] : false;
  $page = isset($_GET['page']) ?  $_GET['page'] : false;

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">

  <!-- Our CSS -->
  <link rel="stylesheet" href="css/style.css">

  <title>CoSolu</title>
</head>
<body>
  
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg bg-none shadow-sm">
    <div class="container">
      <a class="navbar-brand text-info" href="<?= BASE_URL ?>">CoSolu</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav mx-auto">
          <a class="nav-link text-info <?php if(!$page) echo "active" ?>" aria-current="page" href="<?= BASE_URL ?>">Home</a>
          <a class="nav-link text-info ms-lg-3 <?php if($page == "template") echo "active" ?>" href="<?= BASE_URL . "index.php?page=template" ?>">Template</a>
          <a class="nav-link text-info ms-lg-3 <?php if($page == "price") echo "active" ?>" href="<?= BASE_URL . "index.php?page=price" ?>">Pricing</a>
          <?php if($user_id): ?>
            <a class="nav-link text-info ms-lg-3 <?php if($page == "order" || $page == "order-detail") echo "active" ?>" href="<?= BASE_URL . "index.php?page=order" ?>">Order</a>
          <?php endif ?>
          <?php if($user_id && $user_type == "admin"): ?>
            <a class="nav-link text-info ms-lg-3 <?php if($page == "manage") echo "active" ?>" href="<?= BASE_URL . "index.php?page=manage" ?>">Manage</a>
          <?php endif ?>
        </div>
        <?php if(!$user_id): ?>
          <a href="<?= BASE_URL . "index.php?page=login" ?>" class="btn btn-info">Login</a>
        <?php else: ?>
            <a href="<?= BASE_URL . "index.php?page=logout" ?>" class="btn btn-outline-danger">Logout</a>
        <?php endif ?>
      </div>
    </div>
  </nav>
  <!-- End Navbar -->

  <!-- Content -->
  <?php
    if($page) {
      $targetFile = $page . ".php";
      if(file_exists($targetFile)) {
        include_once($targetFile);
      } else {
        echo "
          <div class='alert alert-danger text-center' role='alert'>
            Not Found
          </div>
        ";
      }
    } else {
      include_once("main.php");
    }
  ?>
  <!-- End Content -->

  <!-- Footer -->
  <div class="border-top">
    <footer class="container d-flex flex-wrap justify-content-between align-items-center py-3 my-4">
      <div class="col-md-4 d-flex align-items-center">
        <a href="<?= BASE_URL ?>?" id="footer-brand" class="mb-3 me-2 mb-md-0 text-info text-decoration-none lh-1">
          CoSolu
        </a>
        <span class="mb-3 mb-md-0 text-muted">© 2022 Company, Inc</span>
      </div>
  
      <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
        <li class="text-muted me-3 h4">
          Join Us
        </li>
        <li>
          <a href="https://www.instagram.com/co_solu/">
            <img src="Assets/footer-instagram.png" alt="CoSolu's Instagram" class="img-fluid" width="24" height="24">
          </a>
        </li>
        <li>
          <a href="https://discord.gg/gtVc6Ug6">
            <img src="Assets/footer-discord.png" alt="CoSolu's Instagram" class="img-fluid ms-3" width="30" height="30">
          </a>
        </li>
      </ul>
    </footer>
  </div>
  <!-- End Footer -->

  <!-- Bootstrap Script -->
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery-3.6.0.min.js"></script>
  <script src="js/popper.min.js"></script>
</body>
</html>