<?php

require_once("session.php");

require_once("include/header.php");

require_once("include/left_menu.php");

require_once("functions.php");
$session_data = $_SESSION['vendorsessionlogin'];

if(isset($_POST['adddetilas'])){
    $bank_name = $_POST['bankname'];
    $bank_ac_name = $_POST['bankacname'];
    $bank_ac_number = $_POST['bankacnumber'];
    $bank_rotingnumb = $_POST['rotingnumber'];
    $session_data = $_SESSION['vendorsessionlogin'];
    $insertdata = vendorbankadd($bank_name,$bank_ac_name,$bank_ac_number,$bank_rotingnumb,$session_data);
    if($insertdata == true){
        echo "<script>alert('Successfully Added.');</script>";
    }else{
        echo "<script>alert('Please Try Again');</script>";
    }
}

$get_bankdetal = "SELECT * FROM vendorbank WHERE vbank_vid='$session_data'";
$queryval = mysqli_query($conn,$get_bankdetal);
while($row = mysqli_fetch_array($queryval)){
    $get_bank_name = $row['vbank_name'];
    $get_bank_acname = $row['vbank_acname'];
    $get_bank_acnumber = $row['vbank_acnumber'];
    $get_bank_roting = $row['vbank_roting'];
}

?>

<style>
 .form-group i {
    color: red;
}
.error-message {
    color:red;
}
</style>

<!-- ========= main banner section ========== -->
<div class="page-wrapper">

            <!-- ============================================================== -->

            <!-- Bread crumb and right sidebar toggle -->

            <!-- ============================================================== -->

             <div class="page-breadcrumb">

                <div class="row">

                    <div class="col-12 d-flex no-block align-items-center">

                        <h4 class="page-title"> Bank Details </h4>

                        <div class="ml-auto text-right">

                            <nav aria-label="breadcrumb">

                                <ol class="breadcrumb">

                                    <li class="breadcrumb-item"><a href="<?php echo $url; ?>">Home</a></li>

                                    <li class="breadcrumb-item active" aria-current="page"> Add Bank Details </li>

                                </ol>

                            </nav>

                        </div>

                    </div>

                </div>

            </div>


  <div class="main-content w-100 p-tb-60">
    <div class="mx-container">
        <div class="bank-detail">
        <div class="row">
            <div class="col-lg-12 order-lg-2">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a href="" data-target="#profile" data-toggle="tab" class="nav-link active"> Bank Details </a>
                    </li>
                    <li class="nav-item">
                        <a href="" data-target="#messages" data-toggle="tab" class="nav-link">Edit Bank Details </a>
                    </li>
                </ul>
                <div class="tab-content py-4">
                    <div class="tab-pane active" id="profile">
                        <h5 class="mb-3">Bank Details</h5>
                        <?php echo $msg; ?>
                        <table class="table table-bordered table-striped">
                            <!-- <thead>
                              <tr>
                                <th colspan="2"><h6>Contact Information</h6></th>
                                <th>Lastname</th>                            
                              </tr>
                            </thead> -->
                            <tbody>
                              <tr>
                                <td>Bank Name</td>
                                <td><?php echo $get_bank_name; ?></td>                            
                              </tr>
                              <tr>
                                <td>Account Holder Name</td>
                                <td><?php echo $get_bank_acname; ?></td>                            
                              </tr>
                              <tr>
                                <td>Bank A/C Number</td>
                                <td><?php echo $get_bank_acnumber; ?></td>                            
                              </tr>
                              <tr>
                                <td>Routing Number</td>
                                <td><?php echo $get_bank_roting; ?></td>                            
                              </tr>
                            </tbody>
                          </table>
                        <!--/row-->
                    </div>
                    <div class="tab-pane" id="messages">
                        <h5 class="mb-3">Edit Bank Details</h5>
                      <form role="form" method="post" action="" enctype="multipart/form-data" id="bankDetailsForm">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Bank Name<i>*</i></label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" name="bankname" value="<?php echo $get_bank_name; ?>" required id="bankname" maxlength="50">
                                     <small id="banknameError" class="error-message"></small>
                                </div>
                                
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Account Holder Name<i>*</i></label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" name="bankacname" value="<?php echo $get_bank_acname; ?>" required id="bankacname" maxlength="40">
                                    <small id="bankholderError" class="error-message"></small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Bank A/C Number<i>*</i></label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" name="bankacnumber" value="<?php echo $get_bank_acnumber; ?>" required id="bnakno" maxlength="20" >
                                    <small id="banknoError" class="error-message"></small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Routing Number <i>*</i></label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" name="rotingnumber" value="<?php echo $get_bank_roting; ?>" required id="rotingno" maxlength="15" >
                                    <small id="routingnoError" class="error-message"></small>
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label"></label>
                                <div class="col-lg-9">
                                    <input type="submit" class="btn btn-primary" value="Save Changes" name="adddetilas" id="bankdetailss">
                                    <div id="formMessage"></div>
                                </div>
                            </div>
                        </form>
                        <!--/row-->
                    </div>
                </div>
            </div>
            <!-- <div class="col-lg-4 order-lg-1 text-center">
                <img src="https://buyjee.com/assets/images/vendor_images/logo.png" class="mx-auto img-fluid img-circle d-block" alt="avatar">
                <h6 class="mt-2">Upload a different photo</h6>
                <label class="custom-file">
                    <input type="file" id="file" class="custom-file-input">
                    <span class="custom-file-control">Choose file</span>
                </label>
            </div> -->
        </div>
        </div>
    	
        </div>
  </div>
<!-- /////////// footer section ////////////// -->
<?php

require_once("include/footer.php");

?>

<script>
$(document).ready(function () {

    $("#bankname").on("input", function () {
    this.value = this.value.replace(/[^a-zA-Z\s]/g, ""); 
});

 $("#bankacname").on("input", function () {
    this.value = this.value.replace(/[^a-zA-Z\s]/g, ""); 
});

    $("#bnakno").on("input", function () {
        this.value = this.value.replace(/[^0-9]/g, ""); 
    });

    $("#rotingno").on("input", function () {
        this.value = this.value.replace(/[^0-9]/g, ""); 
    });

  
    $("#bankdetailss").click(function (e) {
        e.preventDefault(); 
        
          $(".error-message").text("");
            $("#formMessage").text("");
         
         var bankname = $("#bankname").val();
        var bankAcName = $("#bankacname").val();
        var bankNo = $("#bnakno").val();
        var routingNo = $("#rotingno").val();

        var isValid = true;
        
        var alphaRegex = /^[a-zA-Z\s]+$/;
        
         if (bankname.length === 0) {
             $("#banknameError").text("Bank Name is required.");
            isValid = false;
        } else if (!alphaRegex.test(bankname)) {
             $("#banknameError").text("Bank Name should contain only alphabets and spaces.");
            isValid = false;
        }
        if (bankNo.length === 0) {
          $("#banknoError").text("Bank A/C Number is required.");
            isValid = false;
        } else if (bankNo.length > 20) {
              $("#banknoError").text("Bank A/C Number cannot exceed 20 digits.");
            isValid = false;
        }
        
         
        // Validate Account Holder Name 
        if (bankAcName.length === 0) {
             $("#bankholderError").text("Account Holder Name is required.");
            isValid = false;
        } else if (!alphaRegex.test(bankAcName)) {
             $("#bankholderError").text("Account Holder Name should contain only alphabets and spaces.");
            isValid = false;
        }

        // Validate Routing Number
        if (routingNo.length === 0) {
              $("#routingnoError").text("Routing Number is required.");
            isValid = false;
        } else if (routingNo.length > 15) {
              $("#routingnoError").text("Routing Number cannot exceed 15 digits.");
            isValid = false;
        }

        // If valid, proceed with AJAX submission
        if (isValid) {
           /* var bankName = $("#bankname").val();
            var bankAcName = $("#bankacname").val();*/

            // Send data via AJAX
            $.ajax({
                type: "POST",
                url: "", // Leave empty to submit to the same page
                data: {
                    adddetilas: true, 
                    bankname: bankname, 
                    bankacname: bankAcName, 
                    bankacnumber: bankNo, 
                    rotingnumber: routingNo
                },
                success: function(response) {
                    alert("Successfully Added.");
                   location.reload();
                    $("form")[0].reset();
                },
                error: function() {
                    alert("Error occurred. Please try again.");
                }
            });
        }
    });
});


</script>








