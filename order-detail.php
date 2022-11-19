<?php
  $order_id = $_GET['id'];
  $detail = mysqli_query($connection, "SELECT * FROM ms_transaction WHERE transaction_id = $order_id");
  $order = mysqli_fetch_assoc($detail);
  $template_id = $order['template_id'];
  $template_info = mysqli_query($connection, "SELECT * FROM ms_template WHERE template_id = $template_id");
  $template = mysqli_fetch_assoc($template_info);
  $status = isset($_GET['status']) ? $_GET['status'] : false;

  if($status) {
    mysqli_query($connection, "UPDATE ms_transaction SET tr_status = '$status' WHERE transaction_id = $order_id");
    header("Location: " . BASE_URL . "index.php?page=order-detail&id=$order_id");
  }
?>


<div class="container mt-5 mb-5">
  <div class="row">
    <div class="col-md text-center">
      <img src="<?= BASE_URL . "Assets/template/images/" . $template['template_img'] ?>" alt="<?= $template['template_name']?>" class="img-fluid border rounded" style="height: 70vh;">
    </div>
    <div class="col-md mt-5 mt-md-0 ms-3 ms-md-0 d-flex flex-column justify-content-center">
      <form>
        <div class="mb-3">
          <label for="inputTitle" class="form-label">Template Title</label>
          <input type="text" class="form-control" id="inputTitle" name="title" value="<?= $template['template_name'] ?>" disabled>
        </div>
        <label for="">Template Price</label>
        <div class="input-group mb-3">
          <span class="input-group-text">Rp.</span>
          <div class="form-floating">
            <label for="inputPrice"><?= $template['template_price'] ?></label>
            <input type="number" class="form-control" id="inputPrice" name="price" disabled>
          </div>
        </div>
        <div class="mb-3">
          <label for="inputTime" class="form-label">Transaction Created</label>
          <input type="email" class="form-control" id="inputTime" name="time" value="<?= $order['transaction_time'] ?>" disabled>
        </div>
        <div class="mb-3">
          <label for="inputEmail" class="form-label">Active Email</label>
          <input type="email" class="form-control" id="inputEmail" name="email" value="<?= $order['email'] ?>" disabled>
        </div>
        <div class="mb-3">
          <label for="inputStatus" class="form-label">Order Status</label>
          <input type="text" class="form-control" id="inputStatus" name="status" class="text-uppercase" value="<?= $order['tr_status'] ?>" disabled>
        </div>
        <?php if($user_type == "admin"): ?>
          <a href="<?= BASE_URL . "functions/download.php?image=$order[tf_evidence]" ?>" class="btn btn-info">Payment Evidence</a>
          <?php if($order['tr_status'] == "processing"): ?>
            <a href="<?= BASE_URL . "index.php?page=order-detail&id=$order_id&status=done" ?>" class="btn btn-info">Set Status As Done</a>
          <?php else: ?>    
            <a href="<?= BASE_URL . "index.php?page=order-detail&id=$order_id&status=processing" ?>" class="btn btn-info">Set Status As Processing</a>
          <?php endif ?>
        <?php endif ?>
      </form> 
    </div>
  </div>
</div>