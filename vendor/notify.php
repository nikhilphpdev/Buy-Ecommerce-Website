<?php

require_once("session.php");

require_once("include/header.php");

require_once("functions.php");

require_once("include/left_menu.php");
date_default_timezone_set('Asia/Kolkata');
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

                        <h4 class="page-title"> <span class="btntopadd">Notifications</span></h4>

                    

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
                                                    <th>Product Image</th>
                                                    <th>Product Name</th>
                                                    <th>Message</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                   <!-- <th>Action</th>-->
                                                  </tr>
                                                </thead>
                                                 <tbody>
                                                <?php
                                                    if (isset($_SESSION['vendorsessionlogin'])) {
                                                         $vendorautoid = $_SESSION['vendorsessionlogin']; 
                                                    
                                                        // Optimized query using JOIN
                                                        $sql = "
                                                            SELECT 
                                                                n.noti_prd_id,
                                                                n.noti_customerd,
                                                                n.noti_date,
                                                                n.noti_time,
                                                                n.noti_status,
                                                                p.product_vender_id,
                                                                p.product_stock,
                                                                p.product_status,
                                                                 p.product_image,
                                                                 p.product_link,
                                                                 p.product_name,
                                                                c.customer_ui_id,
                                                                c.customer_fname,
                                                                c.customer_lname
                                                            FROM 
                                                                notifytbl_table n
                                                            LEFT JOIN 
                                                                all_product p
                                                            ON 
                                                                n.noti_prd_id = p.id
                                                            LEFT JOIN 
                                                                customer c
                                                            ON 
                                                                n.noti_customerd = c.customer_ui_id
                                                        ";
                                                        
                                                        $query = $conn->query($sql);
                                                    
                                                        // Process results
                                                        while ($row = $query->fetch_array()) {
                                              
                                                            $notify_product_id = $row['noti_prd_id'];
                                                            $notify_customer_id = $row['noti_customerd'];
                                                            $notify_vendor_id = $row['product_vender_id'];
                                                            $notify_customers = $row['customer_ui_id'];
                                                            $notify_Fname = $row['customer_fname'];
                                                            $notify_Lname = $row['customer_lname'];
                                                             $product_stock = $row['product_stock'];
                                                               $product_status =$row['product_status'];
                                                               
                                                     if(trim($vendorautoid) == trim($notify_vendor_id) && $row['noti_status'] == 0 ){
                                                     
                                                    ?>

                                                    <tr>
                                                         <td><?php echo ucfirst($notify_Fname.' '.$notify_Lname);?></td>
                                                     <td class="setimg">
                                                            <a href="<?php echo $row['product_link']; ?>" target="_blank">
                                                                <img src="<?php echo $weburl; ?>images/<?php echo $row['product_image']; ?>" class="img-fluid" alt="Product Image">
                                                            </a>
                                                        </td>

                                                      <td><?php echo $row['product_name']; ?></td>
                                                      <td><?php echo ucfirst($notify_Fname);?> Interested in This Product</td>
                                                      <td class="colorss">
                                                            <p> Out of Stock </p>
                                                      </td>
                                                        <td class="text-right py-0 align-middle">
                                                           <?php if($product_stock != 0  && $product_status != 0){ ?>
                                                        <div class="btn-group btn-group-sm">
                                                            <button class="btn btn-success change-status" data-id="<?php echo $row['noti_prd_id']; ?>" data-status="1">Change Status </button>
                                                        </div>
                                                        <?php }?>
                                                      </td>
                                                  <?php } }} ?>
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
