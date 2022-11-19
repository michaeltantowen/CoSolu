<?php

  if(!$user_id || $user_type != "admin") {
    header("Location: " . BASE_URL . "index.php");
  } 
  $module = isset($_GET['module']) ? $_GET['module'] : false;

  if($module == "setadmin") {
    $user_id = $_GET['user_id'];
    mysqli_query($connection, "UPDATE ms_user SET account_type = 'admin' WHERE user_id = $user_id");
    header("Location: " . BASE_URL . "index.php?page=manage&module=user");
  }
  if($module == "setnonadmin") {
    $user_id = $_GET['user_id'];
    mysqli_query($connection, "UPDATE ms_user SET account_type = 'bronze' WHERE user_id = $user_id");
    header("Location: " . BASE_URL . "index.php?page=manage&module=user");
  }
  if($module == "delete") {
    $user_id = $_GET['user_id'];
    mysqli_query($connection, "DELETE FROM ms_user WHERE user_id = $user_id");
    header("Location: " . BASE_URL . "index.php?page=manage&module=user");
  }
?>

<div class="container mt-5 mb-5">
  <div class="row">
    <div class="col">
      <a href="<?= BASE_URL . "index.php?page=manage&module=user" ?>" class="btn btn-info" style="width: 100%;">Manage User</a>
    </div>
    <div class="col">
      <a href="<?= BASE_URL . "index.php?page=manage&module=order" ?>" class="btn btn-info" style="width: 100%;">Manage Order</a>
    </div>
  </div>
</div>

<?php if($module == "user"): ?>
  <div class="container">
    <div class="text-center">
      <div class="h2 mb-5 text-info text-uppercase" id="title">User</div>
    </div>
    <table class="table table-striped mb-5">
      <thead>
        <tr>
          <th scope="col">Nooo.</th>
          <th scope="col">Username</th>
          <th scope="col">Email</th>
          <th scope="col" class="text-center">Roles</th>
          <th scope="col" class="text-center">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $data = mysqli_query($connection, "SELECT * FROM ms_user");
          $rows = [];
          while($row = mysqli_fetch_assoc($data)) {
            $rows[] = $row;
          }
        ?>
        <?php $no = 1; foreach($rows as $info) : ?>
          <tr>
            <th scope="row"><?= $no ?></th>
            <td><?= $info['username'] ?></td>
            <td><?= $info['user_email'] ?></td>
            <td class="text-center text-uppercase"><?= $info['account_type'] ?></td>
            <td class="text-center">
              <?php if($info['account_type'] == "admin"): ?>
                <a href="<?= BASE_URL . "index.php?page=manage&module=setnonadmin&user_id='$info[user_id]'" ?>" class="text-warning">Set As Non Admin</a>
              <?php else: ?>
                <a href="<?= BASE_URL . "index.php?page=manage&module=setadmin&user_id='$info[user_id]'" ?>" class="text-warning">Set As Admin</a>
              <?php endif ?>
              |
              <a href="<?= BASE_URL . "index.php?page=manage&module=delete&user_id='$info[user_id]'" ?>" class="text-danger">Delete</a>
            </td>
          </tr>
          <?php $no++; ?>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>
<?php endif ?>

<?php if($module == "order"): ?>
  <?php
    $order_info = mysqli_query($connection, "SELECT * FROM ms_transaction");
    $orders = [];
    while($row = mysqli_fetch_assoc($order_info)) {
      $orders[] = $row;
    }
  ?>

  <div class="container">
  <!-- Album -->
  <div class="album">
      <div class="container text-center">
        <div class="h2 mb-5 text-info text-uppercase" id="title">Order</div>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        <?php foreach($orders as $detail): ?>
          <?php
            $template_detail = mysqli_query($connection, "SELECT * FROM ms_template WHERE template_id=$detail[template_id]");
            $template_info = mysqli_fetch_assoc($template_detail); 
          ?>
          <div class="col">
            <div class="card shadow-sm p-2">
              <img src="<?= BASE_URL . "Assets/template/images/" . $template_info['template_img'] ?>" alt="<?= $template_info['template_name'] ?>" class="img-fluid border rounded" style="height: 50vh;">
              <div class="card-body">
                <p class="card-text"><?= $template_info['template_name'] ?></p>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="btn-group">
                    <a href="<?= BASE_URL . "index.php?page=order-detail&id=$detail[transaction_id]" ?>" class="btn btn-info">See Detail ></a>
                  </div>
                  <small class="text-muted"><?= $detail['transaction_time'] ?></small>
                </div>
              </div>
            </div>
          </div>
          <?php endforeach ?>
        </div>
      </div>
    </div>
    <!-- End Album -->
  </div>
<?php endif ?>