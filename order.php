<?php

  $alert = isset($_GET['alert']) ? $_GET['alert'] : false;
  $order_info = mysqli_query($connection, "SELECT * FROM ms_transaction WHERE user_id = $user_id");
  $orders = [];
  while($row = mysqli_fetch_assoc($order_info)) {
    $orders[] = $row;
  }
?>

<div class="container">
 <!-- Album -->
 <div class="album py-5">
    <div class="container text-center">
      <div class="h2 mb-5 text-info text-uppercase" id="title">Order</div>
      <?php if($alert == "process"): ?>
        <div class="alert alert-success" role="alert">
          Order will be process!
        </div>
      <?php endif ?>
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