<?php
  $alert = isset($_GET['alert']) ? $_GET['alert'] : false;

  $template_data = mysqli_query($connection, "SELECT * FROM ms_template");
  $rows = [];
  while($row = mysqli_fetch_assoc($template_data)) {
    $rows[] = $row;
  }
?>

  <?php if($alert == "added"): ?>
    <div class="container text-center mt-5">
      <div class="alert alert-success" role="alert">
        Template Added!
      </div>  
    </div>
  <?php endif ?>

  <?php if($user_type == "admin"): ?>
  <!-- Add Button -->
  <div class="container d-grid gap-2 mt-5">
    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addTemplateModal">
      Add New Template
    </button>
  </div>
  <!-- End Add Button -->

  <!-- Modal -->
  <div class="modal fade" id="addTemplateModal" tabindex="-1" aria-labelledby="AddTemplateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="AddTemplateModalLabel">Add Template</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="<?= BASE_URL . "functions/add-template.php" ?>" method="POST" enctype=multipart/form-data>
          <div class="modal-body">
            <div class="mb-3">
              <label for="inputThumbnail" class="form-label">Thumbnail Picture</label>
              <input type="file" class="form-control" id="inputThumbnail" name="file" required>
            </div>
            <div class="mb-3">
              <label for="inputTitle" class="form-label">Template Title</label>
              <input type="text" class="form-control" id="inputTitle" name="title" required>
            </div>
            <div class="mb-3">
              <label for="inputPrice" class="form-label">Template Price</label>
              <input type="number" class="form-control" id="inputPrice" name="price" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-info">Add Template</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- End Modal -->
  <?php endif ?>
  
  

  <!-- Album -->
  <div class="album py-5 bg-light">
    <div class="container text-center">
      <div class="h2 mb-5 text-info text-uppercase" id="title">Website Template</div>
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
      <?php foreach($rows as $detail): ?>
        <div class="col">
          <div class="card shadow-sm p-2">
            <img src="<?= BASE_URL . "Assets/template/images/" . $detail['template_img'] ?>" alt="<?= $detail['template_name'] ?>" class="img-fluid border rounded" style="height: 50vh;">
            <div class="card-body">
              <p class="card-text"><?= $detail['template_name'] ?></p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <a href="<?= BASE_URL . "index.php?page=detail&id='$detail[template_id]'" ?>" class="btn btn-info">See Detail ></a>
                </div>
                <small class="text-muted">Rp.<?= $detail['template_price'] ?></small>
              </div>
            </div>
          </div>
        </div>
        <?php endforeach ?>
      </div>
    </div>
  </div>
  <!-- End Album -->