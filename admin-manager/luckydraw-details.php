<?php
date_default_timezone_set('Asia/Kolkata');
include_once('admin_dist/includes/uper-header.php');

include_once('admin_dist/includes/main-header.php');

include_once('admin_dist/includes/top-bar.php');

include_once('admin_dist/includes/left-menu.php');

?>
<style>

    .billImage:hover { 
    border: 1px solid #000;
    cursor: zoom-in;
    
}
.table {
    display: revert !important;
}
.pagination{
    float: right;
}
div#luckdrwastatus h5 {
    font-weight: 600;
    color: #015a7a;
    font-size: 21px;
    /* text-underline-offset: 14px; */
}

.remark-box {
    min-height: 80px;        /* initial height */
    max-height: 150px;       /* fixed max height */
    overflow-y: auto;        /* scrollbar when content exceeds */
    resize: vertical;        /* user can resize (optional) */
}
</style>

<div class="content-wrapper">

    <section class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-6">

            <h1>All Luckydraw Users</h1>

          </div>

          <div class="col-sm-6">

            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="<?php echo $url; ?>/admin-manager/index/">Home</a></li>

              <li class="breadcrumb-item active">All Luckydraw Users</li>

            </ol>

          </div>

        </div>

      </div><!-- /.container-fluid -->

    </section>
    <!-- Main content -->
   <section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card card-primary">
           <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">Luckydraw Users</h3>
      </div>
        <div class="card-body">
<div id="luckdrwastatus"></div>
          <div class="row mb-3">
            <div class="col-md-2"><label for="Name" class="form-label">Name</label><input type="text" id="filter_name" class="form-control" placeholder="Name" maxlength="50"></div>
            <div class="col-md-2"><label for="eamil" class="form-label">Email</label><input type="text" id="filter_email" class="form-control" placeholder="Email" minlength="5" maxlength="100" pattern="^[^\s@]+@[^\s@]+\.[^\s@]+$" title="Enter a valid email (5–100 characters, no spaces)"></div>
            <div class="col-md-2"><label for="mobile" class="form-label">Mobile No.</label><input type="text" id="filter_mobile" class="form-control" maxlength="10" placeholder="Mobile"></div>
            <div class="col-md-2"><label for="bill" class="form-label">Bill No.</label><input type="text" id="filter_bill" class="form-control" placeholder="Bill No"></div>
            <div class="col-md-2"><label for="Name" class="form-label">Luckydraw code</label><input type="text" id="filter_lucky" class="form-control" placeholder="Lucky Draw Code" maxlength="10"></div>
            <div class="col-md-2">
                <label for="status" class="form-label">Status</label>
              <select id="filter_status" class="form-control">
                <option value="">All Status</option>
                <option value="1">Approved</option>
                <option value="2">Reject</option>
                <option value="3">Re-apply</option>
              </select>
            </div>
          <div class="col-md-2 mt-2">
                <label for="filter_date_from" class="form-label">From Date</label>
                <input type="date" id="filter_date_from" class="form-control">
            </div>
            
            <div class="col-md-2 mt-2">
                <label for="filter_date_to" class="form-label">To Date</label>
                <input type="date" id="filter_date_to" class="form-control" max="">
            </div>

            <div class="col-md-2 mt-4">
              <button class="btn btn-success btn-sm me-2 mt-3" id="customersearchBtn">Search</button>
              <button id="customerclearBtn" class="btn btn-secondary btn-sm mt-3">Clear</button>
            </div>
          </div>

          <div id="status" class="mb-2"></div>
<div class="table-responsive">
         <table class='table table-bordered tableexportcsv' id="customerTableData">
              </table>
              </div>

          <div id="customerPagination" class="mt-2"></div>
        </div>
      </div>
    </div>
  </div>
</section>
</div>
<!-- Remark Modal -->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><label>Update Status & Add Remark</label></h5>
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="alert alert-success d-none" id="remarkMsg" role="alert" style="margin: 0px 15px; background:#d4edda;"></div>
      <form id="remarkForm">
        <div class="modal-body">
           <input type="hidden" name="luckydraw_id" id="luckydraw_id">

        <label>Status <span class="text-danger">*</span></label> &nbsp;&nbsp;
        <label>
            <input type="radio" name="status" value="1" required> Approve
        </label>
        &nbsp;&nbsp;
        <label>
            <input type="radio" name="status" value="2" required> Reject
        </label>

        <br>
          <label>Remark <span class="text-danger">*</span></label>
          <textarea name="remark" id="remark" class="form-control remark-box" required></textarea>
        </div>
     
    <div class="modal-footer">
        <input type="hidden" name="action" value="update_remark">
        <button type="submit" class="btn btn-primary">Save</button>
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    
  </div>
       </form>
    </div>
  </div>
</div>

 <?php
include_once('admin_dist/includes/footer.php');
?>

<script>
$(document).ready(function () {
document.querySelectorAll('input[type="date"]').forEach(function(input) {
    input.addEventListener('click', function () {
        this.showPicker();
    });
});

$("#filter_mobile").on("input", function () {
    this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);
}); 

$('#filter_name').on('input', function () {
    this.value = this.value.replace(/[^a-zA-Z\s]/g, '');
});


let today = new Date().toISOString().split('T')[0];

const fromDate = document.getElementById("filter_date_from");
const toDate = document.getElementById("filter_date_to");

// max date = today
fromDate.setAttribute("max", today);
toDate.setAttribute("max", today);

toDate.disabled = true;


fromDate.addEventListener("change", function () {
    if (this.value) {
        toDate.disabled = false;           // enable To Date
        toDate.setAttribute("min", this.value); // To >= From
        toDate.value = "";                 // reset old value
    } else {
        toDate.disabled = true;
        toDate.value = "";
    }
});

function resetToDate() {
    const toDate = document.getElementById("filter_date_to");
    toDate.value = "";
    toDate.disabled = true;
    toDate.removeAttribute("min");
}

document.getElementById("customerclearBtn").addEventListener("click", function () {
    document.getElementById("filter_date_from").value = "";
    resetToDate();
});

    
    function loadCustomers(page = 1) {
        const data = {
            luckydrawfilter: "luckydrawfilterform",
            name: $("#filter_name").val(),
            email: $("#filter_email").val(),
            mobile: $("#filter_mobile").val(),
            bill: $("#filter_bill").val(),
            lucky: $("#filter_lucky").val(),
            status: $("#filter_status").val(),
            date_from: $("#filter_date_from").val(),
            date_to: $("#filter_date_to").val(),
            page: page
        };

        $.ajax({
            // url: "<?php echo $url; ?>/admin-manager/luckydraw_remark.php",
            url: "luckydraw_list.php",
            type: "POST",
            data: data,
            dataType: "json",
            success: function(response) {
                   console.log(response);
                if (response.success) {
                    $("#customerTableData").html(response.table);
                    $("#customerPagination").html(response.pagination);
                }
                if (response.totalluckydrawcustomer) {
           console.log(response.totalluckydrawcustomer);
           let statusText = `<h5>Manage Luckydraw Users (${response.totalluckydrawcustomer})</h5>`;
          $('#luckdrwastatus').html(statusText);

        }
            },
            error: function(xhr, status, error) {
                $("#customerTableData").html("<p class='text-danger text-center'>AJAX Error: " + error + "</p>");
            }
        });
    }

    // Initial load
    loadCustomers();

    // Search button
    $("#customersearchBtn").click(function() {
        loadCustomers(1);
    });

    // Clear filters
    $("#customerclearBtn").click(function() {
        $("input, select").val("");
        loadCustomers(1);
    });

    // Pagination click
    $(document).on("click", ".page-link", function(e) {
        e.preventDefault();
        const page = $(this).data("page");
        loadCustomers(page);
    });
});

</script>