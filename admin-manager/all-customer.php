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
.pagination-container{
    float: inline-end;
}
div#status h5 {
    font-weight: 600;
    color: #015a7a;
    font-size: 21px;
    /* text-underline-offset: 14px; */
}
</style>
<?php
if(isset($_GET['delete']) && isset($_GET['id'])){
    $deletablevale = "id='".$_GET['id']."'";
    $delete_vale = DeleteALlDataCustomer('customer',$deletablevale);
    if($delete_vale == true){
      echo "<script>alert('Customer Account Delete Successfully .');window.location.href='$url/admin-manager/all-customer/';</script>";
	}else{
		echo "<script>alert('Please Try Again.');</script>"; 
    }
}

// Active && Inactive code

if(isset($_GET['block']) && isset($_GET['blockcation'])){
  $actionvlock = $_GET['blockcation'];
  if($actionvlock == "1"){
    $active_customer = "0";
  }else{
    $active_customer = "1";
  }
  $customerid = $_GET['block'];
  $update_permission = UpdateAllDataCustomer("customer","customer_active='$active_customer'","id='$customerid'");

   if ($update_permission == true) {
    if ($active_customer == "0") {
      echo "<script>alert('Customer account has been blocked successfully.');window.location.href='$url/admin-manager/all-customer/';</script>";
    } else {
      echo "<script>alert('Customer account has been unblocked successfully.');window.location.href='$url/admin-manager/all-customer/';</script>";
    }
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

            <h1>All Customer</h1>

          </div>

          <div class="col-sm-6">

            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="<?php echo $url; ?>/admin-manager/index/">Home</a></li>

              <li class="breadcrumb-item active">All Customer</li>

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

              <h3 class="card-title">All Customer</h3>
              <a id="exportcustomer"  class="float-right btn btn-success" href="<?php echo $url; ?>/admin-manager/export-csv/?pagename=customer">Export to CSV</a>

            </div>

            <div class="card-body">
           <div id="status"></div>

            <div class="mb-5">
                     <form action="" method="POST" id="customerfilter">
                          <div class="row">
                            <div class="col">
                                 <label for="Name"  class="form-label">Name</label>
                              <input type="text" class="form-control" placeholder="Enter Customer Name" name="name" id="name">
                            </div>
                            <div class="col">
                                 <label for="email" name="email"  class="form-label">Email Id</label>
                              <input type="text" class="form-control" name="sku" placeholder="Enter emailId" id="email">
                            </div>
                            <div class="col">
                                 <label for="phone" name="phone"  class="form-label">Phone No.</label>
                              <input type="nubmer" class="form-control" name="phone" placeholder="Enter Phone No" id="phone" maxlength="10">
                            </div>
                             <div class="col">
                         <div class="form-group">
                          <label for="customertype">Customer Type</label>
                          <select class="form-control" id="customertype" name="customertype">
                            <option value="" disabled selected>Choose Customer Type</option>
                            <option value=" Retail Customer"> Retail Customer</option>
                            <option value="Wholesale Buyer"> Wholesale Buyer</option>
                            <option value="Corporate Buyer"> Corporate Buyer</option>
                            <option value="Reseller/Distributor"> Reseller/Distributor</option>
                            <option value="Institutional Buyer"> Institutional Buyer</option>
                            <option value="Government Buyer"> Government Buyer</option>
                            <option value="Online Seller"> Online Seller</option>
                            <option value=" Export Buyer"> Export Buyer</option>
                            <option value="franchiseinquiry"> Franchise Inquiry</option>
                            <option value=" Event Organizer / Bulk Order Customer"> Event Organizer / Bulk Order Customer</option>
                          </select>
                        </div>

                                 </div>
                            <div class="col">
                                 <label for="status" class="form-label">Status</label>
                              <select id="Status_cust" class="form-control Stat_cust">
                                <option selected>All</option>
                                <option value="1">Active</option>
                                <option value="0">InActive</option>
                              </select>
                            </div>
                            
                            <div class="col pt-4">
                                    <button id="customerSearchBtn" class="btn btn-success btn-sm me-2 mt-2">Search</button>
                                    <button id="customerclearBtn" class="btn btn-secondary btn-sm mt-2">Clear</button>
                                </div>
                             </div>
                             
                              </form>
              </div>
              
               <table id="customerTableBody" class="table-bordered table-striped dataTable no-footer">
     
    </table>
      
<div id="customerPagination" class="pagination-container"></div>
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


/**************Filter Form ***************/


<script>
$(document).ready(function () {
    $('#name').on('keypress', function (e) {
        let char = String.fromCharCode(e.which);
        if (!/^[a-zA-Z\s]*$/.test(char)) {
            e.preventDefault(); // Block non-alphabet input
        }
    });
   
    
    $('#phone').on('keypress', function (e) {
    let char = String.fromCharCode(e.which);
    // Allow digits only
    if (!/^[0-9]*$/.test(char)) {
        e.preventDefault(); // Block non-numeric input
    }
});
  function loadCustomer(page = 1) {
    const data = {
      customerfilter: "customerfilterform",
      name: $("#name").val(),
      email: $("#email").val(),
      phone: $("#phone").val(),
      status: $("#Status_cust").val(),
      customertype: $("#customertype").val(),
    
      page: page
    };
    
console.log(data);
    $.ajax({
       url: "<?php echo $url; ?>/admin-manager/ajax-data-file.php",
      type: "POST",
      data: data,
      dataType: "json",
      success: function (response) {
          console.log(response.totalcustomer);
        if (response.success) {
          $("#customerTableBody").html(response.html);
          $("#customerPagination").html(response.pagination);
        } if (response.totalcustomer) {
           console.log(response.totalcustomer);
           let statusText = `<h5>Manage Customers (${response.totalcustomer})</h5>`;
          $('#status').html(statusText);

        }
      },
      error: function () {
        alert("AJAX error occurred.");
      }
    });
  }

 
  $("#customerfilter").on("submit", function (e) {
    e.preventDefault();
    loadCustomer();
  });

  $("#customerSearchBtn").click(function (e) {
    e.preventDefault();
    loadCustomer();
  });

  $("#customerclearBtn").click(function () {
    $("#customerfilter")[0].reset();
    loadCustomer();
  });

  $(document).on("click", ".page-link ", function (e) {
    e.preventDefault();
    const page = $(this).data("page");
    loadCustomer(page);
  });

  loadCustomer(); // Load on page ready
});


/*************************Export data usig filter*****************/

  $('.Stat_cust').on('change', function () {
    var selectedStatus = $(this).val(); 
    var exportUrl = "<?php echo $url; ?>/admin-manager/export-csv/?pagename=customer";

    if (selectedStatus !== '') {
        exportUrl += "&status=" + selectedStatus;
    }
//alert(exportUrl); 
    $('#exportcustomer').attr('href', exportUrl);
});
</script>











