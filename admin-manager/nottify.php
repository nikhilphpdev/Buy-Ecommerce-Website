<?php

include_once('admin_dist/includes/uper-header.php');
include_once('admin_dist/includes/main-header.php');
include_once('admin_dist/includes/top-bar.php');
include_once('admin_dist/includes/left-menu.php');

$url ='https://testing.buyjee.com/';
 ?>
 <style>
     .noti-img{
         max-width:15%;
     }
 </style>

  <!-- Content Wrapper. Contains page content -->

  <div class="content-wrapper">

    <!-- Content Header (Page header) -->

    <section class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-6">

            <h1>Notification</h1>

          </div>

          <div class="col-sm-6">

            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="<?php echo $url; ?>/admin-manager/index/">Home</a></li>

              <li class="breadcrumb-item active">All Notification</li>

            </ol>

          </div>

        </div>

      </div><!-- /.container-fluid -->

    </section>



    <!-- Main content -->
 <div class="container-fluid">

                <!-- ============================================================== -->

                <!-- Vendo Terms and conditions -->

                <!-- ============================================================== -->

                <div class="row">

                    <!-- column -->

                    <div class="col-lg-12">

                        <div class="card-body">
                            <div class="comment-widgets scrollable">

                               <div class="mx-container">
                                <div class="row">
                                    <div class="col-lg-12 ">
                                        <div class="table-row">
    <table id="notify" class=" table-bordered table-striped">
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
              
             $notifications = getNotifications();

// Loop through notifications and display rows
foreach ($notifications as $row) {
    if ($row['noti_status'] == 0) {
        $notify_Fname = ucfirst($row['customer_fname']);
        $notify_Lname = ucfirst($row['customer_lname']);
        $fullName = $notify_Fname . ' ' . $notify_Lname;
        ?>
        <tr>
            <td><?php echo $fullName; ?></td>
            <td class="setimg">
                <a href="<?php echo $row['product_link']; ?>" target="_blank">
                    <img src="<?php echo $url; ?>images/<?php echo $row['product_image']; ?>" class="img-fluid noti-img" alt="Product Image">
                </a>
            </td>
            <td><?php echo $row['product_name']; ?></td>
            <td><?php echo $notify_Fname; ?> is interested in this product</td>
            <td class="colorss">
                <p>Out of Stock</p>
            </td>
            <td class="text-right py-0 align-middle">
                <?php if($row['product_stock'] !=0 && $row['product_status'] !=0){ ?>
                <div class="btn-group btn-group-sm">
                    <button class="btn btn-success changge-status" 
                            data-id="<?php echo $row['noti_prd_id']; ?>" 
                            data-status="1">
                        Change Status
                    </button>
                </div>
                <?php } ?>
            </td>
        </tr>
        <?php
    }
}

             ?>
         </tbody>
    </table>
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


    <!-- /.content -->

  </div>


<?php
  include_once('admin_dist/includes/footer.php');
?>

<script>
$(document).ready(function() {
    $('#notify').DataTable({
        order: [[3, 'desc']], // Sort by the 4th column (index 3)
        paging: true,        // Enable pagination
        searching: true,     // Enable search functionality
        responsive: true     // Make the table responsive
    });
});

/********notify functionality code*************/



$(document).on('click', '.changge-status', function () {
    const productId = $(this).data('id');
    const newStatus = $(this).data('status');
    // Send an AJAX request to update the status
    $.ajax({
       url: "https://testing.buyjee.com/admin-manager/ajax-data-file.php",
        type: 'POST',
        data: {
             actionn: 'notify', 
            id: productId,
            status: newStatus
        },
        success: function (response) {
            // Handle success response
       alert(response.message);
            location.reload(); // Optionally reload the page to reflect changes
        },
        error: function (xhr, status, error) {
            // Handle error
            console.error(error);
            alert('Error updating status');
        }
    });
});
</script>



