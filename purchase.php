<?php
  if(!$user_id) {
    header("Location: " . BASE_URL . "index.php?page=login");
  }
  $template_id = isset($_GET['id']) ? $_GET['id'] : false;
  $template_info = mysqli_query($connection, "SELECT * FROM ms_template WHERE template_id = $template_id");
  $template = mysqli_fetch_assoc($template_info);
?>

<div class="container mt-5 mb-5">
  <div class="row">
    <div class="col-md text-center">
      <img src="<?= BASE_URL . "Assets/template/images/" . $template['template_img'] ?>" alt="<?= $template['template_name']?>" class="img-fluid border rounded" style="height: 70vh;">
    </div>
    <div class="col-md mt-5 mt-md-0 ms-3 ms-md-0 d-flex flex-column justify-content-center">
      <form action="<?= BASE_URL . "functions/add-order.php" ?>" method="POST" enctype="multipart/form-data">
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
        <p>
        Payment is made by transfer to a <strong>BCA</strong> bank account with account number <strong>1234567890</strong> under the name <strong>CoSolu</strong>. Include proof of transfer in the form below.
        </p>
        <div class="mb-3">
          <label for="inputThumbnail" class="form-label">Transaction Evidence</label>
          <input type="file" class="form-control" id="inputThumbnail" name="file" required aria-describedby="evidence">
          <div id="evidence" class="form-text">Transfer with a nominal that does not match the transaction is considered failed and the money will be returned no later than 7 days after the transaction.</div>
        </div>
        <div class="mb-3">
          <label for="inputEmail" class="form-label">Active Email</label>
          <input type="email" class="form-control" id="inputEmail" name="email" aria-describedby="emailHelp" required>
          <div id="emailHelp" class="form-text">Make sure the email is active because the template file will be sent to this email. (You can't change this later)</div>
        </div>
        <input type="number" name="id" value="<?= $template['template_id'] ?>" hidden>
        <input type="submit" class="btn btn-info" value="Create Transaction">
      </form>
    </div>
  </div>
</div>