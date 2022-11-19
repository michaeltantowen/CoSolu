<?php
  $alert = isset($_GET['alert']) ? $_GET['alert'] : false;
  $email = isset($_GET['email']) ? $_GET['email'] : false;
  $username = isset($_GET['username']) ? $_GET['username'] : false;
?>

<div class="container mt-5 mb-5 d-flex flex-column align-items-center">
  <?php if($alert == "password"): ?>
    <div class="alert alert-danger" role="alert">
      Password doesn't valid, Please try again!
    </div>
  <?php elseif($alert == "email"): ?>
    <div class="alert alert-danger" role="alert">
      Email already been used, Please use other emails
    </div>
  <?php elseif($alert == "created"): ?>
    <div class="alert alert-success" role="alert">
      Account Created!
    </div>
  <?php endif ?>
  <div class="h2 mb-5 text-info text-uppercase" id="title">Sign Up</div>
  <form action="<?= BASE_URL . "functions/function-signup.php" ?>" method="POST" class="col-lg-6">
    <div class="mb-3">
      <label for="inputEmail" class="form-label">Email address</label>
      <input type="email" class="form-control" id="inputEmail" name="email" aria-describedby="emailHelp" required value="<?= $email ?>">
      <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
    </div>
    <div class="mb-3">
      <label for="inputUsername" class="form-label">Username</label>
      <input type="text" class="form-control" id="inputUsername" name="username" required value="<?= $username ?>">
    </div>
    <div class="mb-3">
      <label for="inputPassword" class="form-label">Password</label>
      <input type="password" id="inputPassword" name="password" class="form-control" aria-describedby="passwordHelpBlock" required>
      <div id="passwordHelpBlock" class="form-text">
        Your password must be 8-20 characters long, contain letters and numbers.
      </div>
    </div>
    <div class="mb-3">
      <label for="inputPasswordConfirmation" class="form-label">Confirm Password</label>
      <input type="password" id="inputPasswordConfirmation" name="passwordConfirm" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-info">Create Account</button>

    <div class="text-center">
      Already have an account?
      <a href="<?= BASE_URL . "index.php?page=login" ?>">Login Here!</a>
    </div>
  </form>
</div>