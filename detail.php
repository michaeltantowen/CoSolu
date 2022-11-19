<?php
  $template_id = isset($_GET['id']) ? $_GET['id'] : false;
  if(!$template_id) {
    header("Location: " . BASE_URL . "index.php?page=template");
  }
  $template_info = mysqli_query($connection, "SELECT * FROM ms_template WHERE template_id = $template_id");
  $template = mysqli_fetch_assoc($template_info);
  
?>

<div class="container mt-5 mb-5">
  <div class="row">
    <div class="col-md text-center">
      <img src="<?= BASE_URL . "Assets/template/images/" . $template['template_img'] ?>" alt="<?= $template['template_name']?>" class="img-fluid border rounded" style="height: 70vh;">
    </div>
    <div class="col-md mt-5 mt-md-0 ms-3 ms-md-0 d-flex flex-column justify-content-center">
      <h3 class="template-title"><?= $template['template_name'] ?></h3>
      <p class="mt-3">Rp. <?= $template['template_price'] ?></p>
      <a href="<?= BASE_URL . "index.php?page=purchase&id=$template_id" ?>" class="btn btn-info" style="width: 40% !important;">Purchase Template</a>
    </div>
  </div>
</div>