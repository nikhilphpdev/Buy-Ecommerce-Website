<?php

require_once("session.php");

require_once("include/header.php");

require_once("functions.php");

require_once("include/left_menu.php");
date_default_timezone_set('Asia/Kolkata');
?>

<?php


/*if(isset($_GET['delete']) && isset($_GET['id'])){
    $deletablevale = $_GET['id'];
    $select_datavale = "SELECT * FROM subvendor WHERE id= $deletablevale";
    $query_seltval = $conn->query($select_datavale);
   if ($query_seltval && $query_seltval->num_rows > 0) {
    $row = $query_seltval->fetch_assoc();
    $customer_emailid = $row['subvendor_email'];

    if (!empty($customer_emailid)) {
        $delete_userlogn = "DELETE FROM `userlogntable` WHERE user_email = '$customer_emailid'";
        if (!$conn->query($delete_userlogn)) {
            die("Error deleting from userlogntable: " . $conn->error);
        }
    }
    if (!empty($deletablevale)) {
        $delete_datavale = "DELETE FROM subvendor WHERE id ='$deletablevale'";
        if (!$conn->query($delete_datavale)) {
            die("Error deleting from $delete_datavale: " . $conn->error);
        }
    }

    if($delete_datavale && $delete_userlogn){
      echo "<script>alert('Successfully Deleted.');window.location.href='$url/sub-vendor';</script>";
	}else{
		echo "<script>alert('Please Try Again.');</script>"; 
    }
}
}*/

if (isset($_GET['block']) && isset($_GET['blockcation'])) {

    $actionvlock = $_GET['block'];
    $blockcation = $_GET['blockcation'];

    $select_datavale = "SELECT * FROM subvendor WHERE id = $actionvlock";
    $query_seltval = $conn->query($select_datavale);
    if ($query_seltval && $query_seltval->num_rows > 0) {
             $row = $query_seltval->fetch_assoc();
        $subvendor_email = $row['subvendor_email'];
        if ($blockcation == "1") {
            $active_subvendor = "0"; // Block the subvendor
        } else {
            $active_subvendor = "1"; // Unblock the subvendor
        }
        $update_userlognn = "UPDATE subvendor SET subvedor_status = '$active_subvendor' WHERE id = $actionvlock";

        $update_permission = $conn->query($update_userlognn); 
       if(!empty($subvendor_email)){
         $update_userlogn = "UPDATE  `userlogntable` SET user_status = '$active_subvendor' WHERE user_email = '$subvendor_email'";
        
         if (!$conn->query($update_userlogn)) {
            die("Error deleting from userlogntable: " . $conn->error);
        }
    }
       if ($update_permission && $update_userlogn ) { 
            echo "<script>alert('Successfully Updated.');window.location.href='$url/sub-vendor';</script>";
        } else {
            echo "<script>alert('Update Failed.');</script>";
        }
    } else {
        echo "<script>alert('Subvendor not found.');</script>";
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
.model-sub{
    background-color: rgb(0 130 161);
    color: #fff;

}
.model-upsub{
    background-color: rgb(117 126 159);
    color: #fff;

}

.cust-eye{
    margin-top:10px;
}
.eye-custom-input{
    background: #b1aeae;
    text-align: center;
}
.error{
    color:red;
}
        .cust-borders{
          border-radius: 5px;
        }
        
.text-success { color: green; }
.text-danger { color: red; }

#page-loader {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(255,255,255,0.7);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 9999;
}
.spinner {
  width: 50px;
  height: 50px;
  border: 5px solid #ccc;
  border-top: 5px solid #2a9fd6;
  border-radius: 50%;
  animation: spin 1s linear infinite;
}
@keyframes spin {
  to { transform: rotate(360deg); }
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

                        <h4 class="page-title"> <button type="button" class="btn btn-cyan pull-right" data-toggle="modal" data-target="#mySubvendor">Add New Sub Vendor</button></h4>

                        <div class="ml-auto text-right">

                            <nav aria-label="breadcrumb">

                                <ol class="breadcrumb">

                                    <li class="breadcrumb-item"><a href="<?php echo $url; ?>">Home</a></li>

                                    <li class="breadcrumb-item active" aria-current="page">Sub Vendor</li>

                                </ol>

                            </nav>

                        </div>

                    </div>
                     <!-- The Modal -->
                            <div class="modal" id="mySubvendor" >
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" >
            <!-- Modal Header -->
            <div class="modal-header model-sub">
                <h4 class="modal-title">Add New Sub Vendor</h4>
               
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div id="page-loader" style="display: none;">
              <div class="spinner"></div>
            </div>
             <div id="form-message" style=" padding-left: 30px; font-size: 20px;"></div>
           <form  action="" enctype="multipart/form-data" class="custsub-vendor p-3" id="password-form">
                              
                                                        <div class="form-group col-md-12">
                                                          <label for="inputEmail4">First Name</label>
                                                          <input type="text" class="form-control cust-borders" name="fname" id="fname">
                                                          <div class="error-msg"  style="color:red; display:none;"></div>
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                          <label for="inputPassword4">Last Name</label>
                                                          <input type="text" class="form-control cust-borders" name='lname' id="lname" >
                                                          <div class="error-msg"  style="color:red; display:none;"></div>
                                                        </div>
                                                    
                                                      <div class="form-group col-md-12">
                                                        <label for="inputAddress">Email</label>
                                                        <input type="text" class="form-control cust-borders" name='email' id="email" >
                                                        <div class="error-msg" style="color:red; display:none;"></div>
                                                      </div>
                                                       <div class="form-group col-md-12">
                                                        <label for="inputAddress">Mobile No</label>
                                                        <input type="text" class="form-control cust-borders" name='mobileno' id="mobileno"   maxlength="10">
                                                        <div class="error-msg"  style="color:red; display:none;"></div>
                                                      </div>
                                                      
                                                       <div class="form-group col-md-12">
                                                        <label for="inputAddress">Password</label>
                                                         <div class="input-group eye-custom-input cust-borders" id="show_hide_pass">
                                                        <input type="password" class="form-control cust-borders" name="password" id="password">
                                                       <div class="input-group-addon " style=" width: 34px;">
                                                            <a href="javascript:void(0)"><i class="fa fa-eye-slash cust-eye " aria-hidden="true"></i></a>
                                                          </div>
                                                          </div>
                                                           <div id="password-status" class="error"></div>
                                                      </div>
                                                      <div class="form-group col-md-12">
                                                       <input type="submit" class="btn btn-success cust-borders" value="Submit" name="subvendor">
                                                     <!--  <button type="button" class="btn btn-primary"  name="subvendor">Submit</button>-->
                                                       </div>
                                    </form>
        </div>
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
                            <div class="comment-widgets scrollable">

                               <div class="mx-container">
                                <div class="row">
                                    <div class="col-lg-12 col-md-6 ">
                                        <div class="table-row">
                                            <table id="approved"  class="table table-bordered table-striped">
                                                <thead>
                                                  <tr>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Mobile No</th>
                                                    <th>Date / Time</th>
                                                    <th>status</th>
                                                   <th>Action</th>
                                                  </tr>
                                                </thead>
                                                <tbody>
                                                 <?php
                                                        if (isset($_SESSION['vendorsessionlogin'])) {
                                                            $subvendorautoid = $_SESSION['vendorsessionlogin'];
                                                        
                                                        $sql = "SELECT s.id AS subv_id, u.id AS user_id, s.*, u.*
                                                                    FROM subvendor s
                                                                    INNER JOIN userlogntable u 
                                                                        ON s.subvendor_auto = u.subvendor_id
                                                                    WHERE s.session_auto = '$subvendorautoid'
                                                                      AND u.subtye = 'subvendor'";
                                                          
                                                            $result = $conn->query($sql);
                                                            
                                                            if ($result && $result->num_rows > 0) {
                                                                    while ($subvendortdetils = $result->fetch_assoc()) {
                                                             //   echo $subvendortdetils['subv_id']; die;
                                                                $subpvdval = $subvendortdetils['subvedor_status'] == "0" 
                                                                    ? "<a href='$url/sub-vendor/?block=" . $subvendortdetils['id'] . "&blockcation=0' title='Click to   Block'><i class='fa fa-eye'></i></a>" 
                                                                    : "<a href='$url/sub-vendor/?block=" . $subvendortdetils['id'] . "&blockcation=1' title='Click to Un Block'><i class='fa fa-eye-slash'></i></a>";
                                                                ?>
                                                                <tr class="<?php echo $subvendortdetils['subvedor_status'] == '0' ? 'blockvendor' : 'unblockvendor'; ?>">
                                                                    <td><?php echo $subvendortdetils['subvendor_fname'] . ' ' . $subvendortdetils['subvendor_lname']; ?></td>
                                                                    <td><?php echo $subvendortdetils['subvendor_email']; ?></td>
                                                                    <td><?php echo $subvendortdetils['subvendor_phone']; ?></td>
                                                                   <td> <?php $date = date('d-m-Y', strtotime($subvendortdetils['created_at']));echo $date;  ?> / <?php echo $subvendortdetils['subvendor_time']; ?>
                                                                   </td>
                                                                    <td><?php echo $subpvdval; ?></td>
                                                                    <td>
                                                                     
                                                                    <button type="button" 
                                                                        class="btn-sm btn btn-outline-info editSubBtn"
                                                                        data-id="<?php echo $subvendortdetils['subv_id']; ?>"
                                                                        data-fname="<?php echo $subvendortdetils['subvendor_fname']; ?>"
                                                                        data-lname="<?php echo $subvendortdetils['subvendor_lname']; ?>"
                                                                        data-email="<?php echo $subvendortdetils['subvendor_email']; ?>"
                                                                        data-mobile="<?php echo $subvendortdetils['subvendor_phone']; ?>"
                                                                        data-password="<?php echo $subvendortdetils['subvendor_password']; ?>"
                                                                        data-toggle="modal" 
                                                                        data-target="#editSubvendorModal">
                                                                        <i class="fa fa-edit"></i> Edit
                                                                    </button>
                                                                    
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                            }
                                                        }
                                                        }
                                                        ?>
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
            
            <!-- Edit Subvendor Modal -->
<div class="modal fade" id="editSubvendorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header model-upsub">
        <h5 class="modal-title" id="exampleModalLabel">Update Subvendor<?php echo $subvendortdetils['subvendor_fname'] . ' ' . $subvendortdetils['subvendor_lname'];  ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     <div id="page-uploader" style="display: none;">
              <div class="spinner"></div>
            </div>
             <div id="upform-message"  style=" padding-left: 30px; font-size: 20px;"></div>
           <form  action="" enctype="multipart/form-data" class="custsub-vendor" id="uppassword-form">
                              <input type="hidden" name="id" id="subvendorId">
                                                        <div class="form-group col-md-12">
                                                          <label for="inputEmail4">First Name</label>
                                                          <input type="text" class="form-control cust-borders" name="upfname" id="upfname" >
                                                          <div class="error-msg"  style="color:red; display:none;"></div>
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                          <label for="inputPassword4">Last Name</label>
                                                          <input type="text" class="form-control cust-borders" name='uplname' id="uplname" >
                                                          <div class="error-msg"  style="color:red; display:none;"></div>
                                                        </div>
                                                    
                                                      <div class="form-group col-md-12">
                                                        <label for="inputAddress">Email</label>
                                                        <input type="text" class="form-control cust-borders" name='upemail' id="upemail" >
                                                        <div class="error-msg" style="color:red; display:none;"></div>
                                                      </div>
                                                       <div class="form-group col-md-12">
                                                        <label for="inputAddress">Mobile No</label>
                                                        <input type="text" class="form-control cust-borders" name='upmobileno' id="upmobileno"   maxlength="10">
                                                        <div class="error-msg"  style="color:red; display:none;"></div>
                                                      </div>
                                                      
                                                      <!-- <div class="form-group col-md-12">-->
                                                      <!--  <label for="inputAddress">Password</label>-->
                                                      <!--   <div class="input-group eye-custom-input cust-borders" id="show_hide_pass">-->
                                                      <!--  <input type="password" class="form-control cust-borders" name="uppassword" id="uppassword">-->
                                                      <!-- <div class="input-group-addon " style=" width: 34px;">-->
                                                      <!--      <a href="javascript:void(0)"><i class="fa fa-eye-slash cust-eye " aria-hidden="true"></i></a>-->
                                                      <!--    </div>-->
                                                      <!--    </div>-->
                                                      <!--     <div id="password-upstatus" class="error"></div>-->
                                                      <!--</div>-->
                                                      <div class="form-group col-md-12">
                                                       <input type="submit" class="btn btn-success cust-borders" value="Update" name="upsubvendor">
                                                     <!--  <button type="button" class="btn btn-primary"  name="subvendor">Submit</button>-->
                                                       </div>
                                    </form>
      </div>
      
    </div>
  </div>
</div>

<?php

require_once("include/footer.php");

?>


<script>
$(document).ready(function() {
  $('#upmobileno').keypress(function (e) {
        if (String.fromCharCode(e.keyCode).match(/[^0-9]/g)) return false;
    });

 function validateField(selector, regex, errorMsg) {
    const $el = $(selector);
    const val = $el.val().trim();
    $el.removeClass('is-invalid');
    $el.next('.invalid-feedback').remove();

    if (!regex.test(val)) {
      $el.addClass('is-invalid');
      $el.after(`<div class="invalid-feedback">${errorMsg}</div>`);
      return false;
    }
    return true;
  }
  $('.editSubBtn').on('click', function() {
let btn = $(this);
    $('#subvendorId').val(btn.data('id'));
    $('#upfname').val(btn.data('fname'));
    $('#uplname').val(btn.data('lname'));
    $('#upemail').val(btn.data('email'));
    $('#upmobileno').val(btn.data('mobile'));
  
    
      $('#uppassword-form').on('submit', function(e) {
      e.preventDefault();
    /*  $('#page-uploader').show();
      $('#vendor').prop('disabled', true);*/

      // validation
      let isValid = true;
      if (!validateField('#upfname', /^[a-zA-Z]+$/, 'First name must contain only alphabets.')) {
        isValid = false;
      }
      if (!validateField('#uplname', /^[a-zA-Z]+$/, 'Last name must contain only alphabets.')) {
        isValid = false;
      }
      if (!validateField('#upemail', /^[^\s@]+@[^\s@]+\.[^\s@]+$/, 'Enter a valid email address.')) {
        isValid = false;
      }
      if (!validateField('#upmobileno', /^\d{10}$/, 'Enter a valid 10-digit mobile number.')) {
        isValid = false;
      }

      if (!isValid) {
        $('#page-loader').hide();
        $('#vendor').prop('disabled', false);
        return;
      }

     /* setTimeout(function () {
        $('#page-uploader').hide();
        $('#vendor').prop('disabled', false);
      }, 5000);*/
  let formData = {
    id: $('#subvendorId').val(),
    upfname: $('#upfname').val(),
    uplname: $('#uplname').val(),
    upemail: $('#upemail').val(),
    upmobileno: $('#upmobileno').val(),
    uppassword: $('#uppassword').val(),
    upsubvendor: true 
   
  };
 var url = '<?php echo get_template_directory(); ?>';
  $.ajax({
  url: url+'aadsubvendor.php',
    type: 'POST',
    data: formData,
    success: function(response) {
     
    if (response.status === 'success') {
        $('#upform-message').removeClass('text-danger').addClass('text-success').text(response.message).show();
        setTimeout(() => location.reload(), 1000);
    }
    else if (response.status === 'warning') {
    $('#upform-message').removeClass('text-success text-danger').addClass('text-warning').text(response.msg).show();
    setTimeout(() => location.reload(), 3000);
     }
    else {
        $('#upform-message').removeClass('text-success').addClass('text-danger').text(response.msg).show();
    }
}
  });
});

});

$('#editSubvendorModal').on('hidden.bs.modal', function () {
  // Reset the form
  $('#uppassword-form')[0].reset();

  // Remove validation styles and error messages
  $('#uppassword-form .is-invalid').removeClass('is-invalid');
  $('#uppassword-form .invalid-feedback').remove();

  // Optionally clear any messages
  $('#form-message').html('');
});

});
</script>


<script type="text/javascript">

$(document).ready(function() {
  $('#approved').DataTable({

    "order": [[3, "desc"]] // change 2 to the column index of 'created_at'
  });
});


$(document).ready(function () {
    // Only allow numbers in Mobile No
    $('#mobileno').keypress(function (e) {
        if (String.fromCharCode(e.keyCode).match(/[^0-9]/g)) return false;
    });

    // Basic input validation
    function validateField(selector, pattern, errorMessage) {
        let value = $(selector).val().trim();
        if (!pattern.test(value)) {
            $(selector).next('.error-msg').text(errorMessage).show();
            return false;
        } else {
            $(selector).next('.error-msg').hide();
            return true;
        }
    }
// Show/hide password toggle
    $('#show_hide_pass a').on('click', function (event) {
        event.preventDefault();
        let passwordInput = $('#password');
        let icon = $(this).find('i');
        if (passwordInput.attr('type') === 'password') {
            passwordInput.attr('type', 'text');
            icon.removeClass('fa-eye-slash').addClass('fa-eye');
        } else {
            passwordInput.attr('type', 'password');
            icon.removeClass('fa-eye').addClass('fa-eye-slash');
        }
    });
    $('#password-form').on('submit', function (e) {
     
        e.preventDefault();
 // Show loader and disable vendor dropdown
    $('#page-loader').show();
    $('#vendor').prop('disabled', true);

    // Simulate a delay (like AJAX or server-side processing)
    setTimeout(function () {
        $('#page-loader').hide();
        $('#vendor').prop('disabled', false);
    }, 5000);
        let isValid = true;
      if (!validateField('input[name="fname"]', /^[a-zA-Z]+$/, 'First name must contain only alphabets.')) {
            isValid = false;
        }
        if (!validateField('#lname', /^[a-zA-Z]+$/, 'Last name must contain only alphabets.')) {
            isValid = false;
        }
        if (!validateField('#email', /^[^\s@]+@[^\s@]+\.[^\s@]+$/, 'Enter a valid email address.')) {
            isValid = false;
        }
        if (!validateField('#mobileno', /^\d{10}$/, 'Enter a valid 10-digit mobile number.')) {
            isValid = false;
        }
         let password = $('input[name="password"]').val().trim();
            let passwordStatus = $('#password-status');
            
            // Regular expression for validation
            let passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/;
            
            if (!passwordRegex.test(password)) {
                passwordStatus.text(
                    'Password must be at least 8 characters long and include an uppercase letter, a lowercase letter, a number, and a special character.'
                ).show();
                isValid = false;
            } else {
                passwordStatus.hide();  // Hide error if password is valid
            }

        if (!isValid) return;
    var url = '<?php echo get_template_directory(); ?>';
      var formData = new FormData(this);        
    formData.append('subvendor', true);
        $.ajax({
            url: url+'aadsubvendor.php',
            type: 'POST',
              contentType: false,
                  processData: false,
               data: formData,
             
             success: function (response) {
                if (response.status === 'success') {
                    $('#form-message').removeClass('text-danger').addClass('text-success').text(response.message).show();
                    setTimeout(function () {
                        location.reload(); // Refresh after 2 sec
                    }, 2000);
                    
                } else {
                    $('#form-message').removeClass('text-success').addClass('text-danger').text(response.msg).show();
                }
            },
            error: function () {
                $('#form-message').addClass('text-danger').text('An error occurred.').show();
            }
        });
    });

    // Hide error message when user starts typing
    $('input').on('input', function () {
        $(this).next('.error-msg').hide();
    });
});
$('#mySubvendor').on('hidden.bs.modal', function () {
    $('#password-form')[0].reset(); // Reset the form
    $('#form-message').hide().removeClass('text-danger text-success').text(''); // Clear messages if any
    $('.error-msg').hide().text(''); // Clear field error messages if you're using them editSubvendorModal
});

$('#editSubvendorModal').on('hidden.bs.modal', function () {
    $('#uppassword-form')[0].reset(); // Reset the form
    $('#upform-message').hide().removeClass('text-danger text-success').text(''); // Clear messages if any
    $('.error-msg').hide().text(''); // Clear field error messages if you're using them 
});
</script>


