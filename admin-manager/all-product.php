<?php

date_default_timezone_set('Asia/Kolkata');
include_once('admin_dist/includes/uper-header.php');

include_once('admin_dist/includes/main-header.php');

include_once('admin_dist/includes/top-bar.php');

include_once('admin_dist/includes/left-menu.php');

?>
<style type="text/css">
  img.img-responsive {
    width: 100% !important;
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

th.cust-wid {
    width: 50px !important;
}
.pagination {
    justify-content: flex-end;
}
div#status h5 {
    font-weight: 600;
    color: #015a7a;
    font-size: 21px;
    /* text-underline-offset: 14px; */
}
</style>

<?php



/*if(isset($_GET['pageid']) && isset($_GET['duplicate'])){
  $bucateid = uniqid();
  foreach(GetProductDataValTab($_GET['duplicate']) as $valuesetdata){
    $product_name = addslashes($valuesetdata['product_name']).'-'.$bucateid;
    $makeurlpd = makeurl($product_name);*/

    /*foreach(GetProductSmallImage($_GET['duplicate']) as $valuesetmitlig){
        $rand_id = rand();
        $rowname_protimg = "produt_img,produt_auto_id,produt_id";
        $rowvalues_produt = "'".$valuesetmitlig['produt_img']."','".$rand_id."','".$bucateid."'";
        $insetinto = GllInsertDataAllTable('product_mutli_image',$rowname_protimg,$rowvalues_produt);
    }*/

/*    $select_active_attbut = "SELECT * FROM product_active_attbut WHERE attbut_productid='".$_GET['duplicate']."'";
    $query_active_attbut = $contdb->query($select_active_attbut);
    if($query_active_attbut->num_rows > 0){
      while($row_active_attbut = $query_active_attbut->fetch_array()){
        $insert_active_attbut = GllInsertDataAllTable('product_active_attbut',"attbut_id,attbut_productid","'".$row_active_attbut['attbut_id']."','".$bucateid."'");
      }
    }

    $select_variationsdata = "SELECT * FROM product_variationsdata WHERE proval_trm_seeionid='".$_GET['duplicate']."'";
    $query_variationsdata = $contdb->query($select_variationsdata);
    if($query_variationsdata->num_rows > 0){
      while($row_variationsdata = $query_variationsdata->fetch_array()){
        $insert_variationsdata = GllInsertDataAllTable('product_variationsdata',"proval_trm_value,proval_trm_attid,proval_trm_seeionid,proval_trm_postion","'".$row_variationsdata['proval_trm_value']."','".$row_variationsdata['proval_trm_attid']."','".$bucateid."','".$row_variationsdata['proval_trm_postion']."'");
      }
    }

    $rowname = "product_vender_id,product_name,product_page_name,product_destion,product_short_des,product_regular_price,product_sale_price,product_catger,product_catger_ids,product_stock,product_sku,product_color,product_date,product_time,product_status,product_discount,product_dis_type,product_approve_stmp,product_shppin_domst,product_shppin_inters,product_recomateprd,product_auto_id";
    $blank = "";
    
    $rowvalues = "'".$valuesetdata['product_vender_id']."','".$blank."','".$blank."','".addslashes($valuesetdata['product_destion'])."','".addslashes($valuesetdata['product_short_des'])."','".$valuesetdata['product_regular_price']."','".$valuesetdata['product_sale_price']."','".addslashes($valuesetdata['product_catger'])."','".$valuesetdata['product_catger_ids']."','".$valuesetdata['product_stock']."','".$blank."','".$valuesetdata['product_color']."','$date','$time','0','".$valuesetdata['product_discount']."','".$valuesetdata['product_dis_type']."','1','".$valuesetdata['product_shppin_domst']."','".$valuesetdata['product_shppin_inters']."','".$valuesetdata['product_recomateprd']."','".$bucateid."'";

      $insert_data = dublicateprodut_value("all_product",$rowname,$rowvalues);
      echo "<script>alert('Successfully Created.');window.location.href='$url/admin-manager/product/?pageid=$insert_data&autoid=$bucateid';</script>";
  }
}*/
$chkingdelteprodt = "SELECT * FROM all_product";
$querydeleteprodt = $contdb->query($chkingdelteprodt);
while($rowvalertdata = $querydeleteprodt->fetch_array()){
    if($rowvalertdata['product_name'] == ""){
        $rundeletequery = "DELETE FROM all_product WHERE product_name=''";
        $queryrundelete = $contdb->query($rundeletequery);
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

            <h1>All Products</h1>

          </div>

          <div class="col-sm-6">

            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="<?php echo $url; ?>/admin-manager/index/">Home</a></li>

              <li class="breadcrumb-item active">All Products</li>

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

              <h3 class="card-title">All Products</h3>
               <a  id="exportBtn" class="float-right btn btn-success" href="<?php echo $url; ?>/admin-manager/export-csv/?pagename=all-product">Export to CSV</a>
                 <!-- <a class="float-right btn btn-success"  id="productExportcsv">Export to CSV</a>-->
           <!--      <button type="button" id="exportExcel" class="btn btn-primary btn-sm mt-2">Export Excel</button>-->

            </div>
          
            <div class="card-body">
                <div id="status"></div>
                <div class="mb-5">
             <form action="" method="POST" id="filterform">
                  <div class="row">
                    <div class="col-3">
                         <label for="productName"  class="form-label">Product Name</label>
                      <input type="text" class="form-control" placeholder="Product name" name="pname" id="pname">
                    </div>
                    <div class="col-2">
                         <label for="sku" name="sku"  class="form-label">SKU</label>
                      <input type="text" class="form-control" name="sku" placeholder="sku" id="sku">
                    </div>
                    <div class="col-3">
                         <label for="category"  class="form-label">Category</label>
                       <select class="form-control" id="category">
                                    <option>All Categories</option>
                                    <?php $validCategories = hasProductsInCategory();
                              
                        FiltercategoryTree("0", 0, '', $validCategories);
                         ?>
                       </select>
                    </div>
                    <div class="col-2">
                         <label for="vendor"  class="form-label">Vendors Name</label>
                       <select name="vendor-filter" id="vfilter" class="form-control vendor_name">
                    <option value="">Select one</option>
                        <?php
                    foreach (GetVenderDatavale() as $vendername) {
                        foreach (GetPermissionvalData($vendername['vendor_auto']) as $vendorpermision) {
                            if ($vendorpermision['user_p_email_ap'] == "1") {
                                ?>
                                <option value="<?= $vendername['vendor_auto']; ?>">
                                    <?= $vendername['vendor_f_name']; ?> <?= $vendername['vendor_l_name']; ?>
                                </option>
                                <?php
                            }
                        }
                    }
                    ?>
                        </select>
                    </div>
                    <div class="col-2">
                         <label for="status" class="form-label">Status</label>
                      <select id="Status" class="form-control exc_status">
                        <option value="" selected>All</option>
                        <option value="1">Active</option>
                        <option value="0">InActive</option>
                        <option value="2">Soft Deleted</option>
                      </select>
                    </div>
                    <div class="col-md-3 col-sm-4">
                        <label for="date" class="form-label">From Added / To Added Date</label>
                        <input type="text" id="demo-5" placeholder="From Added / To Added Date" class="form-control" readonly>
                        
                        <!--<input type="text" id="filter_date_range" name="added_date_range" 
                               placeholder=" From Added / To Added Date" class="form-control">-->
                    </div>
                  
                    <div class="col pt-4">
                            <button id="searchBtn" class="btn btn-success btn-sm me-2 mt-2">Search</button>
                            <button id="clearBtn" class="btn btn-secondary btn-sm mt-2">Clear</button>
                        </div>
                       
                     </div>
                     
                      </form>
              </div>
            <div class="table-responsive">
    <table id="myallproduct" class="table table-bordered table-striped cistommer">
     
    </table>
</div>
<div id="pagination" class="pagination-container"></div>

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
<!-- Delete Confirmation Modal -->
<!-- Modal -->
<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteConfirmModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="deleteConfirmModalLabel">Confirm Delete</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <!-- X Button -->
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        Are you sure you want to delete this item?
       <!-- <br>
        <label>
          <input type="checkbox" id="permanentDeleteCheckbox"> Permanently Delete
        </label>-->
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button> <!-- Cancel Button -->
        <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
      </div>

    </div>
  </div>
</div>


<!-- Modal -->
<!--<div id="quickedit" class="modal fade" role="dialog">
  <div class="modal-dialog modal-xl">


    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data" action="">
        <div class="modal-header">
          <h4 class="modal-title">Quick Edit</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
         <div class="row" id="quickval">
         </div>
        </div>
        <div class="modal-footer">
          <div class="updatetbn">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          <button type="submit" name="eidtupdtae" id="eidtupdtae" class="btn btn-primary">Update</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>-->
<script type="text/javascript">
/*$(".quick-edit").click(function(){
    var get_quckid = $(this).data('id');
    //alert(get_quckid);
    $.ajax({
        type: "POST",
        url: "<?php echo $url; ?>/admin-manager/ajax-data-file.php",
        data : {quickedivl:1, quickid:get_quckid},
        success : function(response){
            $("#quickval").html(response);
        }
    });
});*/

/*delete and soft delete code*/
let deleteId = null;
let deleteEandid = null;

$(document).on('click', '.deletebtn', function () {
    deleteId = $(this).data('id');
    deleteEandid = $(this).data('eandid');
    $('#permanentDeleteCheckbox').prop('checked', false); // Reset
    $('#deleteConfirmModal').modal('show');
});

$('#confirmDeleteBtn').click(function () {
    const isPermanent = $('#permanentDeleteCheckbox').is(':checked');
    $.ajax({
        url: "<?php echo $url; ?>/admin-manager/ajax-data-file.php",
        type: 'POST',
        dataType: 'json',
        data: {
            action: isPermanent ? 'delete' : 'soft_delete',
            id: deleteId,
            eandid: deleteEandid
        },
        success: function (response) {
            if (response.success) {
                $("button[data-id='" + deleteId + "']").closest("tr").remove();
                alert(response.message);
            } else {
                alert("Error: " + response.message);
            }
        },
        error: function (xhr, status, error) {
            console.error('AJAX Error:', error);
        },
        complete: function () {
            $('#deleteConfirmModal').modal('hide');
        }
    });
});




/*Product Status code */

$(document).on('click', '.toggle-visibility', function() {
    const button = $(this);
    const productId = button.data('id');
    const autoId = button.data('eandid');
    const currentStatus = button.data('status');
    const newStatus = currentStatus === 1 ? 0 : 1;

    $.ajax({
        url: "<?php echo $url; ?>/admin-manager/ajax-data-file.php",
        method: 'POST',
        dataType: 'json',
        data: {
            action: 'togglle', // Updated to match PHP
            id: productId,
            eandid: autoId,
            vt: newStatus
        },
        success: function(response) {
          console.log(response);
            if (response.success) {
                alert(response.message);
                button
                    .toggleClass('btn-danger btn-info')
                    .attr('title', newStatus === 1 ? 'Click to hide' : 'Click to show')
                    .html(newStatus === 1 ? '<i class="fa fa-eye"></i>' : '<i class="fa fa-eye-slash"></i>')
                    .data('status', newStatus); // Update status
                 
            } else {
                alert('Error: ' + (response.message || 'Failed to update status'));
            }
        },
        error: function(xhr, status, error) {
            console.error('Toggle Error:', error, 'Response:', xhr.responseText);
            alert('An unexpected error occurred while toggling status.');
        }
    });
});



/**************Filter Form ***************/
$(document).ready(function () {

let selectedDateRange = ''; 
var picker = new Lightpick({
    field: document.getElementById('demo-5'),
    singleDate: false,
    numberOfMonths: 2,
    numberOfColumns: 2,
    maxDate: moment(),
    footer: true,

    onSelect: function (start, end) {
        if (start && !end) end = start.clone();
    },

    onClose: function () {
        selectedDateRange = document.getElementById('demo-5').value || '';
       
    }
});


 
    function loadProducts(page = 1) {
        const pname = $("#pname").val();
        const sku = $("#sku").val();
        const category = $("#category").val();
        const vfilter = $("#vfilter").val();
        const status = $("#Status").val();
       
        $.ajax({
            url: "<?php echo $url; ?>/admin-manager/ajax-data-file.php",
            type: "POST",
            dataType: "json", // Expect JSON response
            data: {
                action: "filterform",
                pname: pname,
                sku: sku,
                category: category,
                status: status,
                vfilter: vfilter,
                added_date_range: selectedDateRange,
                page: page
            },
            success: function(response) {
             console.log(response.ProductData);
                 if (response.output) {
            $('#myallproduct').html(response.output);
        }
        if (response.pagination) {
            $('#pagination').html(response.pagination);
            
            $(".pagination .page-item").removeClass("active"); 
              $(".pagination .page-item a[data-page='" + page + "']").parent().addClass("active"); 


        }
        if (response.ProductData) {
           console.log(response.ProductData);
           let statusText = `<h5>Manage Product (${response.ProductData.total_products})</h5>`;
          $('#status').html(statusText);

        }
        
            }
        });
    }

    // Submit event for the form
    $("#filterform").on("submit", function (e) {
        e.preventDefault();
        loadProducts(); // Load with filters
    });

    // Search button click
    $("#searchBtn").click(function (e) {
        e.preventDefault();
        loadProducts();
    });
    $("#clearBtn").click(function (e) {
        e.preventDefault();
        $("#filterform")[0].reset();
         selectedDateRange = '';
    picker.setDate(null);
    picker.hide();

        loadProducts();
    });

    // Pagination Click
    $(document).on("click", ".page-link", function (e) {
        e.preventDefault();
        var page = $(this).data("page");
        loadProducts(page);
    });

    // Initial load
    loadProducts();
    
});

/*************************Export data usig filter*****************/

$(document).on('change', '.exc_status, .vendor_name', function () {
    var selectedStatus = $('.exc_status').val();   // status
    var selectedVendor = $('.vendor_name').val();  // vendor id
    var exportUrl = "<?php echo $url; ?>/admin-manager/export-csv/?pagename=all-product";
    if (selectedStatus !== '') {
        exportUrl += "&status=" + selectedStatus;
    }
    if (selectedVendor !== '') {
        exportUrl += "&vendor_id=" + selectedVendor;
    }
    $('#exportBtn').attr('href', exportUrl);
});


</script>