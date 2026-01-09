<?php

include_once('admin_dist/includes/uper-header.php');

include_once('admin_dist/includes/main-header.php');

include_once('admin_dist/includes/top-bar.php');

include_once('admin_dist/includes/left-menu.php');


if (isset($_GET['delete_review'])) {
    $review_id = $_GET['delete_review'];
    
    // Delete the review from the database
    $deleteQuery = "DELETE FROM reviews WHERE id = $review_id";
    //echo'<pre>'; print_r($deleteQuery); die;
    if (mysqli_query($contdb, $deleteQuery)) {
        echo "<script>alert('Review deleted successfully'); window.location.href='product-review.php';</script>";
    } else {
        echo "<script>alert('Failed to delete review');</script>";
    }
}
?>


  <!-- Content Wrapper. Contains page content -->

  <div class="content-wrapper">

    <!-- Content Header (Page header) -->

    <section class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-6">

            <h1>Product Review</h1>

          </div>

          <div class="col-sm-6">

            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="<?php echo $url; ?>/admin-manager/index/">Home</a></li>

              <li class="breadcrumb-item active">Product Review</li>

            </ol>

          </div>

        </div>

      </div><!-- /.container-fluid -->

    </section>



    <!-- Main content -->

    <section class="content">

      <div class="row">
        <!-- left box -->
        <!-- right Box -->
        <div class="col-md-12">

          <div class="card card-primary">
  <div class="card-header">
              <h3 class="card-title">Products Review</h3>
            </div>
            <div class="card-body">

              <table id="review" class=" table-bordered table-striped" style=" width: 100%;">
                <thead>
                  <tr>
                    <th>Product Name</th>
                    <!-- <th>Product Image</th>-->
                    <th>Customer Name</th>
                        <th>Vendor Name</th>
                    <th>Review</th>
                    <th>Date</th>
                      <th>Rating</th>
                     <th>Action</th>
                  </tr>
                </thead>
                <tbody>
              <?php echo adminProductReview(); ?>
                </tbody>
              </table>

            </div>

            <!-- /.card-body -->

          </div>

          <!-- /.card -->

        </div>
        <!-- right Box -->

      </div>

    </section>

    <!-- /.content -->

  </div>

  <!-- /.content-wrapper -->

</div>

<!-- ./wrapper -->

 

 <?php

include_once('admin_dist/includes/footer.php');

?>