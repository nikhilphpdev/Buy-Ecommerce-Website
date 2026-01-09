<?php
date_default_timezone_set('Asia/Kolkata');
require_once("session.php");

require_once("include/header.php");

require_once("functions.php");

require_once("include/left_menu.php");

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

                        <h4 class="page-title">Products <span class="btntopadd"><a href="<?php echo $url; ?>addnewsubproduct">Add New Product</a></span></h4>

                        <div class="ml-auto text-right">

                            <nav aria-label="breadcrumb">

                                <ol class="breadcrumb">

                                    <li class="breadcrumb-item"><a href="<?php echo $url; ?>">Home</a></li>

                                    <li class="breadcrumb-item active" aria-current="page">Products</li>

                                </ol>

                            </nav>

                        </div>

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

                            <!-- <div class="card-body">

                                <h4 class="card-title">Your approved product lists</h4>
$_SESSION['vendorsessionlogin']
                            </div> -->



                            <div class="comment-widgets scrollable">

                               <div class="mx-container">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 ">
                                        <div class="table-row">
                                            <table id="approved-pro" class="table table-bordered table-striped">
                                                <thead>
                                                  <tr>
                                                    <th>Image</th>
                                                    <th>Name</th>
                                                    <th>SKU</th>
                                                     <th>Categories</th>
                                                      <th>MRP</th>
                                                    <th>Price</th>
                                                    <th>Date / Time</th>
                                                    <th>View</th>
                                                  </tr>
                                                </thead>
                                                <tbody>
                                                 <?php
                                                 
                                                  if (isset($_SESSION['subvendorsessionlogin'])) {
                                                     $subvendorautoid = $_SESSION['subvendorsessionlogin']; 
                                      
                                               //      $productData = GetProductDataValTab($vendorautoid);
                                                    $get_product = "SELECT * FROM all_product WHERE product_subvender_id='$subvendorautoid' ORDER BY id  DESC";
                                                     $query_getprodut = $conn->query($get_product);
                                                 
                                                    while($productdetils = $query_getprodut->fetch_array()){
                                                                
                                                       $category = $productdetils['product_catger'];
                                                  ?>
                                                    <tr>
                                                      <td class="setimg">
                                                        <img src="<?php echo $weburl; ?>images/<?php echo $productdetils['product_image']; ?>" class="img-fluid">
                                                      </td>
                                                      <td><?php echo $productdetils['product_name']; ?></td>
                                                      <td><?php echo $productdetils['product_sku']; ?></td>
                                                      <td><?php  echo rtrim($category,","); ?></td>
                                                       <td><?php echo GetProductMrpPoriceVal($productdetils['product_auto_id']) ?></td>
                                                  <td><?php echo GetProductPriceVal($productdetils['product_auto_id']); ?> </td>
                                                     
                                                      <td><?php echo $productdetils['product_date']; ?> / <?php echo $productdetils['product_time']; ?></td>
                                                      <td class="text-right py-0 align-middle">
                                                        <div class="btn-group btn-group-sm">
                                                            <?php
                                                            if($productdetils['product_status'] == "1"){
                                                            ?>
                                                          <a href="<?php echo $weburl; ?><?php echo $productdetils['product_page_name']; ?>"  target="_blank" class="btn btn-info"><i class="fa fa-eye"></i></a>
                                                          <?php } ?>
                                                          <a href="<?php echo $url; ?>addnewsubproduct/?pageid=<?php echo $productdetils['id']; ?>&autoid=<?php echo $productdetils['product_auto_id']; ?>" target="_blank" class="btn btn-info"><i class="fa fa-pencil"></i></a>
                                                        </div>
                                                      </td>
                                                  <?php } } ?>
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
    $('#approved-pro').DataTable();
  });
</script>

