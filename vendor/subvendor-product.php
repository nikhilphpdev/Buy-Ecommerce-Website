<?php
/*  ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);*/

require_once("session.php");

require_once("include/header.php");

require_once("functions.php");

require_once("include/left_menu.php");

   $vendor_id = $session_data;
?>
<style type="text/css">
  img.img-responsive {
    width: 100% !important;
}
p.form-group.p-tag {
    width: 100%;
}
p.form-group.p-tag {
    width: 100%;
}
.setimg {
    width: 10%;
}
.quick-edit i {
    background: #17a2b8;
    padding: 8px 10px;
    font-size: 16px;
    color: #FFF;
    border-radius: 4px;
    cursor: pointer;
}
</style>

  <!-- Content Wrapper. Contains page content -->

  <div class="page-wrapper">

    <!-- Content Header (Page header) -->

   <div class="page-breadcrumb">

                <div class="row">

                    <div class="col-12 d-flex no-block align-items-center">

                <!--        <h4 class="page-title"> <span class="btntopadd"><a href="<?php echo $url; ?>subvendor">Sub Vendor Product</a></span></h4>-->

                        <div class="ml-auto text-right">

                            <nav aria-label="breadcrumb">

                                <ol class="breadcrumb">

                                    <li class="breadcrumb-item"><a href="<?php echo $url; ?>">Home</a></li>

                                    <li class="breadcrumb-item active" aria-current="page">Sub Vendor Product</li>

                                </ol>

                            </nav>

                        </div>

                    </div>

                </div>

            </div>



    <!-- Main content -->

    <section class="container-fluid">

      <div class="row">
        <!-- left box -->
        <!-- right Box -->
        <div class="col-md-12">

          <div class="card card-primary">

            <div class="card-header">

              <h3 class="card-title">Sub Vendor Products</h3>
              <form role="form" method="get" class="float-right">
              <div class="row">
                <div class="col-md-8">
                  <select name="filter" class="form-control">
                    <option value="">Select one</option>
                        <?php
                     
                          foreach(GetSubVenderDatavale() as $subvendername){
                          
                            foreach(GetPermissionvalData($subvendername['subvendor_auto']) as $vendorpermision){
                              if($vendorpermision['user_p_block'] == "0"){
                                
                                if($product_data['product_vender_id'] == $subvendername['subvendor_auto']){
                        ?>
                          <option value="<?php echo $subvendername['subvendor_auto']; ?>" selected><?php echo $subvendername['subvendor_fname']; ?> <?php echo $subvendername['subvendor_lname']; ?></option>
                        <?php
                          }else{
                        ?>
                          <option value="<?php echo $subvendername['subvendor_auto']; ?>"><?php echo $subvendername['subvendor_fname']; ?> <?php echo $subvendername['subvendor_lname']; ?></option>
                        <?php
                          }
                        }}}
                        ?>
                  </select>
                </div>
                <div class="col-md-4">
                  <button type="submit" class="btn btn-primary">Search</button>
                </div>
              </div>
              </form>

            </div>

            <div class="card-body">

              <table id="exam" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>SKU</th>
                    <th>Price</th>
                    <th>Date / Time</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    foreach(GetProductDataValsubvendor(0,$_GET['filter']) as $productdetils){
                       
                         // Remove "vendor" from the URL
                      $img_url = str_replace("/vendor", "", $url);
                  ?>
                    <tr>
                      <td class="setimg">
                        <img src="<?php echo $img_url; ?>images/<?php echo $productdetils['product_image']; ?>" class="img-fluid">
                      </td>
                      <td><?php echo $productdetils['product_name']; ?></td>
                      <td><?php echo $productdetils['product_sku']; ?></td>
                      <td><?php
                        echo GetProductPriceVal($productdetils['product_auto_id']);
                      ?></td>
                      <td><?php echo USATimeZoneSettime($productdetils['product_date']); ?> / <?php echo $productdetils['product_time']; ?></td>
                      <td class="text-right py-0 align-middle">
                        <div class="btn-group btn-group-sm">
                          <a href="<?php echo $url; ?>/addnewproduct/?pageid=<?php echo $productdetils['id']; ?>&autoid=<?php echo $productdetils['product_auto_id']; ?>"  target="_blank" class="btn btn-info"><i class="fa fa-pencil"></i></a>
                        </div>
                      </td>
                    </tr>
                  <?php } ?>
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

require_once("include/footer.php");

?>


<script type="text/javascript">
  $(document).ready(function() {
    
    $('#exam').DataTable();
  });
</script>