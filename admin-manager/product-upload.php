<?php

include_once('admin_dist/includes/uper-header.php');

include_once('admin_dist/includes/main-header.php');

include_once('admin_dist/includes/top-bar.php');

include_once('admin_dist/includes/left-menu.php');
?>

<div class="content-wrapper">

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="card card-primary">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">Product Upload System</h3>
      </div>
    </div>
  </section>

  <body class="p-4">
    <div class="container">
      <h2 class="mb-4">Upload Product Excel Sheet</h2>

      <form method="post" enctype="multipart/form-data">
        <div class="form-row align-items-end">
          
          <!-- File Input -->
          <div class="col-md-4">
            <label for="product_file">Select Excel File</label>
            <input type="file" name="product_file" id="product_file" class="form-control" required>
          </div>

          <!-- Upload Button -->
          <div class="col-md-2">
            <button type="submit" name="upload" class="btn btn-primary btn-block">Upload</button>
          </div>

          <!-- Run Button -->
          <div class="col-md-3">
            <button type="submit" name="execute" class="btn btn-warning btn-block">Run (Execute)</button>
          </div>

          <!-- Download Button -->
          <div class="col-md-3">
            <button type="submit" name="download" class="btn btn-success btn-block">Download</button>
          </div>

        </div>
      </form>
    </div>
</div>

 <?php
include_once('admin_dist/includes/footer.php');
?>