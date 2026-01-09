<?php

require_once("session.php");

require_once("include/header.php");

require_once("functions.php");

require_once("include/left_menu.php");
date_default_timezone_set('Asia/Kolkata');


if (isset($_GET['delete_review'])) {
    $review_id = $_GET['delete_review'];
    
    // Delete the review from the database
    $deleteQuery = "DELETE FROM reviews WHERE id = $review_id";
 //  echo'<pre>'; print_r($deleteQuery); die;
    if (mysqli_query($conn, $deleteQuery)) {
       echo "<script>alert('Review deleted successfully'); window.location.href='../product-review';</script>";
   
    } else {
        echo "<script>alert('Failed to delete review');</script>";
    }
}
?>
<style>
    .btntopadd a {
        background: #222;
        color: #FFF;
        font-size: 15px;
        font-weight: 500;
        padding: 8px 15px;
        margin-left: 10px;
    }
    a.btn.btn-info {
    margin-right: 10px;
}
.btntopadd {
    font-size: 31px;
    /* background-color: #000; */
    
}
td.colorss {
    color: red;
    font-size: medium;
}
</style>


        <!-- ============================================================== -->

        <!-- Page wrapper  -->

        <!-- ============================================================== -->

        <div class="page-wrapper">

            <!-- ============================================================== -->

            <!-- Bread crumb and right sidebar toggle -->

            <!-- ============================================================== -->
                  <div class="page-breadcrumb">

                <div class="row">

                    <div class="col-12 d-flex no-block align-items-center">

                        <h4 class="page-title"> <span class="btntopadd">Product Review</span></h4>

                    

                    </div>

                </div>

            </div>

            <!-- ============================================================== -->

            <!-- Container fluid  -->

            <!-- ============================================================== -->

            <div class="container-fluid">

                <!-- ============================================================== -->

                <!-- Vendo Terms and conditions -->

                <!-- ============================================================== -->

                <div class="row">

                    <!-- column -->

                    <div class="col-lg-12">

                        <div class="card">
                            <div class="comment-widgets scrollable">

                               <div class="mx-container">
                                <div class="row">
                                    <div class="col-lg-12 col-md-6 ">
                                        <div class="table-row">
                                            <table id="approved"  class="table table-bordered table-striped">
                                                <thead>
                                                  <tr>
                                                    <th>Customer Name</th>
                                                    <th>Product Name</th>
                                                    <th>Product Image</th>
                                                     <th>Vendor Name</th>
                                                     <th>Rating</th>
                                                    <th>Review</th>
                                                     <th>Date</th>
                                                    <th>Action</th>
                                                   <!-- <th>Action</th>-->
                                                  </tr>
                                                </thead>
                                                 <tbody>
                                                <?php
                                                    if (isset($_SESSION['vendorsessionlogin'])) {
                                                         $vendorautoid = $_SESSION['vendorsessionlogin']; 
                                                    
                                                        $sql = " SELECT  r.id, 
                                                                r.user_name, 
                                                                r.review_text, 
                                                                r.rating,
                                                                 r.created_at,
                                                                p.product_name, 
                                                                p.product_vender_id,
                                                                p.product_link,
                                                                p.product_image,
                                                                v.vendor_f_name,
                                                                v.vendor_l_name
                                                            FROM reviews r
                                                            JOIN all_product p ON r.product_id = p.product_auto_id
                                                            JOIN vendor v ON p.product_vender_id = v.vendor_auto 
                                                             WHERE p.product_vender_id = '$vendorautoid'";
                                                      
                                                        $query = $conn->query($sql);
                                                        // Process results
                                                        while ($row = $query->fetch_array()) {
                                               // echo'<pre>'; print_r($row); die;
                                                            $prod_review_Date = date("Y-m-d", strtotime($row['created_at']));
                                                            $prod_review_customer = $row['user_name'];
                                                            $prod_review_desc = $row['review_text'];
                                                            $prod_review_rating = $row['rating'];
                                                            $product_name = $row['product_name'];
                                                              $vendor_name = $row['vendor_f_name'] . ' ' . $row['vendor_l_name'];
                                                            $review_id = $row['id'];
                                                             $fixed_link = str_replace('vendor//', '', $row['product_link']);
                                                   
                                                     
                                                    ?>

                                                    <tr>
                                                        <td>
                                                           <?php echo $prod_review_customer; ?>
                                                      </td>
                                                         <td><?php echo ucfirst($product_name);?></td>
                                                     <td class="setimg">
                                                            <a href="<?php echo $fixed_link; ?>" target="_blank">
                                                                <img src="<?php echo $weburl; ?>images/<?php echo $row['product_image']; ?>" class="img-fluid" alt="Product Image">
                                                            </a>
                                                        </td>
                                                         <td><?php echo $vendor_name; ?></td>
                                                       <td><?php echo str_repeat('<i class="fa fa-star text-warning"></i>', $prod_review_rating); ?></td>
                                                      
                                                      <td><?php echo $prod_review_desc; ?></td>
                                                      <td><?php echo $prod_review_Date; ?></td>
                                                         <td class="text-center py-0 align-middle">
                                                            <div class="btn-group btn-group-sm">
                                                                <a href="?delete_review=<?php echo $review_id; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this review?');">
                                                                    <i class="fas fa-trash"></i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                              <?php  }} ?>
                                                </tbody>
                                              </table>
                                        </div>
                                    </div>
                                </div>

                                </div>

                            </div>

                        </div>

                        <!-- card new -->

                        

                    </div>

                    <!-- column -->

                </div>

                <!-- ============================================================== -->

                <!-- Recent comment and chats -->

                <!-- ============================================================== -->

            </div>

<?php

require_once("include/footer.php");

?>


<script type="text/javascript">
 $(document).ready(function() {
  $('#approved').DataTable({
    initComplete: function() {
      var searchInput = $('.dataTables_filter input');
      searchInput.attr('placeholder', 'Enter Mobile Or Email');
    }
   /* order: [[0, 'desc']],*/
    
  });
});
</script>
