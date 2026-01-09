<?php

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
#vendorPagination {
   display: flex
;
    padding-left: 0;
    list-style: none;
    border-radius: .25rem;
    flex-direction: row-reverse;
}
#gstno{
/*text-transform: uppercase;
*/}
div#status h5 {
    font-weight: 600;
    color: #015a7a;
    font-size: 21px;
    /* text-underline-offset: 14px; */
}
</style>

<?php
if(isset($_GET['action']) && isset($_GET['id']) && isset($_GET['eandid'])){
  if($_GET['action'] == "delete"){
    $deletablevale = "id='".$_GET['id']."' AND vendor_auto='".$_GET['eandid']."'";
    $deletepermision = "user_p_id='".$_GET['eandid']."' AND user_p_type='vendor'";
    $deleteprodt = "product_vender_id='".$_GET['eandid']."'";
    $delete_vandr = DeleteALlDataVlae('vendor',$deletablevale);
    $delete_permison = DeleteALlDataVlae('userpermission',$deletepermision);
    $delete_product = DeleteALlDataVlae('all_product',$deleteprodt);
    $delete_login = DeleteALlDataVlae('userlogntable',"user_auto='".$_GET['eandid']."'");
    if($delete_login == true){
      if(isset($_GET['request'])){
        echo "<script>alert('Successfully Deleted.');window.location.href='$url/admin-manager/vendors/';</script>";
      }else{
        echo "<script>alert('Successfully Deleted.');window.location.href='$url/admin-manager/vendors/';</script>";
      }
    }else{
      echo "<script>alert('Please Try Again.');</script>"; 
    }
  }else{
    echo "<script>alert('Please Try Again.');window.location.href='$url/admin-manager/vendors/';</script>";
  }
}

if(isset($_GET['block']) && isset($_GET['blockcation'])){
  $actionvlock = $_GET['blockcation'];
  if($actionvlock == "1"){
    $active_vendor = "0";
  }else{
    $active_vendor = "1";
  }
  $vendorid = $_GET['block'];  
  $update_permission = UpdateAllDataFileds("userpermission","user_p_block='$active_vendor'","user_p_id='$vendorid'");
   $update_vendorper = UpdateAllDataVendor("userlogntable","user_status='$active_vendor'","user_auto='$vendorid'");
    $update_subvendorper =UpdateAllDatasubVendor("subvendor","subvedor_status='$active_vendor'","session_auto='$vendorid'");

  if( $update_vendorper  && $update_vendorper && $update_subvendorper == true ){
    echo "<script>alert('Successfully Updated.');window.location.href='$url/admin-manager/vendors/';</script>"; 
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

            <h1>All Vendors</h1>

          </div>

          <div class="col-sm-6">

            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="<?php echo $url; ?>/admin-manager/index/">Home</a></li>

              <li class="breadcrumb-item active">All Vendors</li>

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

              <h3 class="card-title">All Vendors</h3>
              <a id="exportVendor" class="float-right btn btn-success" href="<?php echo $url; ?>/admin-manager/export-csv/?pagename=vendor">Export to CSV</a>

            </div>

            <div class="card-body">
                  <div id="status"></div>

               <div class="mb-5">
                     <form action="" method="POST" id="vendorfilter">
                          <div class="row">
                            <div class="col">
                                 <label for="Name"  class="form-label">Name</label>
                              <input type="text" class="form-control" placeholder="Enter Vendor Name" name="name" id="name">
                            </div>
                            <div class="col">
                                 <label for="email" name="email"  class="form-label">Email Id</label>
                              <input type="text" class="form-control" name="sku" placeholder="Enter emailId" id="email">
                            </div>
                            <div class="col">
                                 <label for="phone" name="phone"  class="form-label">Phone No.</label>
                              <input type="nubmer" class="form-control" name="phone" placeholder="Enter Phone No." id="phone" maxlength='10'>
                            </div>
                             <div class="col">
                              <label for="gstno" name="gstno"  class="form-label">GST No.</label>
                              <input type="text" class="form-control" name="gstno" placeholder="Enter GstNo." id="gstno" maxlength="15">
                              <span id="gsterror" style="color:red; display:none;"></span>
                                 </div>
                            <div class="col">
                                 <label for="status" class="form-label">Status</label>
                              <select id="Status_vend" class="form-control venodr_status">
                                <option value="" selected>All</option>
                                <option value="0">Active</option>
                                <option value="1">InActive</option>
                              </select>
                            </div>
                            
                            <div class="col pt-4">
                                    <button id="vendorSearchBtn" class="btn btn-success btn-sm me-2 mt-2">Search</button>
                                    <button id="vendorclearBtn" class="btn btn-secondary btn-sm mt-2">Clear</button>
                                </div>
                             </div>
                                 <input type="hidden" name="page" id="page" value="1">

                              </form>
              </div>
              
               <table id="vendorTableBody" class="table-bordered table-striped tableexportcsv dataTable no-footer">
     
    </table>
      
<div id="vendorPagination" class="pagination-container"></div>
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
<script>
/**************Vendor Filter Form ***************/


$(document).ready(function () {
   $('#name').on('keypress', function (e) {
        let char = String.fromCharCode(e.which);
        if (!/^[a-zA-Z\s]*$/.test(char)) {
            e.preventDefault(); // Block non-alphabet input
        }
    });
    // Validate GST number on blur
      $('#gstno').keypress(function (e) {
       if (!String.fromCharCode(e.keyCode).match(/[a-zA-Z0-9]/)) {
    e.preventDefault(); // block all non-alphanumeric keys
  }
      });
    
    $('#phone').on('keypress', function (e) {
    let char = String.fromCharCode(e.which);
    if (!/^[0-9]*$/.test(char)) {
        e.preventDefault(); // Block non-numeric input
    }
});
  function loadVendor(page = 1) {
    const data = {
      vendorfilter: "vendorfilterform",
      name: $("#name").val(),
      email: $("#email").val(),
      phone: $("#phone").val(),
      status: $("#Status_vend").val(),
      gstno: $("#gstno").val(),
      page: page
    };
    
console.log(data);
    $.ajax({
       url: "<?php echo $url; ?>/admin-manager/ajax-data-file.php",
      type: "POST",
      data: data,
      dataType: "json",
      success: function (response) {
        //  alert(response);
          console.log(response);
        if (response.success) {
          $("#vendorTableBody").html(response.html);
          $("#vendorPagination").html(response.pagination);
        } 
         if (response.total) {
           console.log(response.total);
           let statusText = `<h5>Manage Vendors (${response.total})</h5>`;
          $('#status').html(statusText);

        }
      },
      error: function () {
        alert("AJAX error occurred.");
      }
    });
  }

 
  $("#vendorfilter").on("submit", function (e) {
    e.preventDefault();
    loadVendor();
  });

  $("#vendorSearchBtn").click(function (e) { 
    e.preventDefault();
    loadVendor();
  });

  $("#vendorclearBtn").click(function () {
    $("#vendorfilter")[0].reset();
    loadVendor();
  });

  $(document).on("click", ".vendorpage-link ", function (e) {
    e.preventDefault();
    const page = $(this).data("page");
    loadVendor(page);
  });
  loadVendor();
});


/*************************Export data usig filter*****************/

  $('.venodr_status').on('change', function () {
    var selectedStatus = $(this).val(); 
    var exportUrl = "<?php echo $url; ?>/admin-manager/export-csv/?pagename=vendor";

    if (selectedStatus !== '') {
        exportUrl += "&status=" + selectedStatus;
    }
//alert(exportUrl); 
    $('#exportVendor').attr('href', exportUrl);
});
</script>