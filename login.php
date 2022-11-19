<?php
  $alert = isset($_GET['alert']) ? $_GET['alert'] : false;
  $email = ($alert == "password") ? $_GET['email'] : false;
?>

<div class="container mt-5 mb-5 d-flex flex-column align-items-center">
  <?php if($alert == "password"): ?>
    <div class="alert alert-danger" role="alert">
      Password doesn't valid, Please try again!
    </div>
  <?php elseif($alert == "email"): ?>
    <div class="alert alert-danger" role="alert">
      Email hasn't been registered!
    </div>
  <?php endif ?>
  <div class="h2 mb-5 text-info text-uppercase" id="title">Login</div>
  <form action="<?= BASE_URL . "functions/function-login.php" ?>" method="POST" class="col-lg-6">
    <div class="mb-3">
      <label for="inputEmail" class="form-label">Email address</label>
      <input type="email" class="form-control" id="inputEmail" name="email" required value="<?= $email ?>">
    </div>
    <div class="mb-3">
      <label for="inputPassword" class="form-label">Password</label>
      <input type="password" id="inputPassword" name="password" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-info">Login</button>

    <div class="text-center">
      Didn't have an account?
      <a href="<?= BASE_URL . "index.php?page=signup" ?>">Sign Up Here!</a>
    </div>
  </form>
</div>