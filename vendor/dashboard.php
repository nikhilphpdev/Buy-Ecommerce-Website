<?php


require_once("session.php");

require_once("include/header.php");

require_once("functions.php");

require_once("include/left_menu.php");


$folder_path = realpath(dirname(__FILE__));
$explode_path = explode('/vendor', $folder_path);
$echozeo = $explode_path[0];

$session_data = $_SESSION['vendorsessionlogin'];

$msg = "";
$passchange = "";
if(isset($_POST['adddetilas'])){
    $f_name = $_POST['fname'];
    $l_name = $_POST['lname'];
    $p_phone = $_POST['phone'];
    $e_email = $_POST['email'];
    $a_address = $_POST['address'];
    $a_city = $_POST['cityval'];
    $a_state = $_POST['stateval'];
    $a_coluntry = $_POST['countryval'];
    $a_zip = $_POST['zipval'];
    $a_storeurl = $_POST['storurl'];
    $replace_vale = preg_replace("/[^A-Za-z0-9]/","-", $a_storeurl);

    $insertdata = vendorprofile($f_name,$l_name,$p_phone,$e_email,$a_address,$session_data,$replace_vale,$a_city,$a_state,$a_coluntry,$a_zip);
    if($insertdata == true){
        $msg = "Successfully Updated";
    }else{
        $msg = "Please Try Again";
    }
}

$get_bankdetal = "SELECT * FROM vendor WHERE vendor_auto='$session_data'";
$queryval = mysqli_query($conn,$get_bankdetal);
while($row = mysqli_fetch_array($queryval)){
    $fname = $row['vendor_f_name'];
    $lanme = $row['vendor_l_name'];
    $email = $row['vendor_email'];
    $phone = $row['vendor_phone'];
     $gst_no = $row['gst_no'];
    $address = $row['vendor_address'];
    $city = $row['vendor_city'];
    $state = $row['vendor_state'];
    $country = $row['vendor_country'];
    $zipcode = $row['vendor_zipcode'];
    $vendor_nameurl = $row['vendor_uni_name'];

}

$get_country_show = "SELECT * FROM countries_db WHERE name='$country' ORDER BY id ASC";
$query_count_show = mysqli_query($conn, $get_country_show);
while($rowcount_count_show = mysqli_fetch_array($query_count_show)){
    $get_ids_vale_show = $rowcount_count_show['id'];
}

$selectstat_show = "SELECT * FROM states WHERE name='$state' ORDER BY name ASC";
$queryvale_show = $conn->query($selectstat_show);
while($rowvaluestate_show = $queryvale_show->fetch_array()){
    $stateshow = $rowvaluestate_show['name'];
   
}

if (isset($_POST['changepassword'])) {
    $oldpassword = $_POST['oldpassswoed'];
    $newpassword = $_POST['newpassword'];

    // Call the function to update password
    $changepassword = changepssval($oldpassword, $newpassword, $session_data, $conn);

    if ($changepassword === true) {
        echo "<script>alert('Successfully Updated.');</script>";
    } elseif ($changepassword === "same") {
        echo "<script>alert('New password cannot be the same as old password.');</script>";
    } else {
        echo "<script>alert('Please try again. Your old password is incorrect.');</script>";
    }
}

if(isset($_POST['imgedit'])){
    //$img_nmame = $_POST['prodtmainimg'];
    $get_data_vednor = "SELECT * FROM vendor WHERE vendor_auto='$session_data' LIMIT 1";
    $sqli_query = mysqli_query($conn,$get_data_vednor);
    while($rowvaledata = mysqli_fetch_array($sqli_query)){
        $get_id_vale = $rowvaledata['id'];
        $get_anem_vale = $rowvaledata['vendor_f_name'];
        $get_img_vale = $rowvaledata['vendor_img'];
    }
    $imag_path = $weburl."/assets/images/vendor_images/";
    //die();
    $productimgnewfilename = $_FILES['prodtmainimg']['name'];
    $prodtaddimagsize = $_FILES['prodtmainimg']['size'];
    $prodtaddimagtmp_name = $_FILES['prodtmainimg']['tmp_name'];
    //die();
    $prodtaddimag_type = $_FILES['prodtmainimg']['type'];

    // $fileData = pathinfo(basename($prodtaddimagname));
    // $single_imag_name = $get_anem_vale.$get_id_vale;
    // $productimgnewfilename = $single_imag_name.'.'.$fileData['extension'];
    // $singl_remove = $imag_path.$productimgnewfilename;
   //$filess = move_uploaded_file($prodtaddimagtmp_name, "$imag_path/$productimgnewfilename");
   
   $target_path ="../images/" . basename($_FILES['prodtmainimg']['name']);
   $filess = move_uploaded_file($_FILES['prodtmainimg']['tmp_name'], $target_path);
    $insert_img = insertvendorprofilepick($session_data,$productimgnewfilename);
    if($filess == true){
        echo "<script>alert('Successfully Updated.');</script>";
    }else{
        echo "<script>alert('Please Try Again.');</script>";
    }
}
?>


<style type="text/css">
#custmnone  {
   padding: 15px;
}
#custmnone .user_images {
   width: 100%;
    padding: 15px;
    border: 1px solid #ccc;
}

#custmnone .user_images img{ width: 100%; border-radius: 4px; }

.mr-3 {
    width: 100%;
}
.custom-file {
    position: relative;
    display: inline-block;
    width: 100%;
   
    margin-bottom: 0;
   
}
label.custom-file {
    margin-bottom: 41px;
}
.custom-file-input {
    position: relative;
    z-index: 2;
    width: 100%;
    display: block;
height: 42px;
border: 1px solid #ccc;

padding: 7px 10px;
    
}
.custom-file-control {
    border: 1px solid #015a7a;
    padding: 6px 25px;
    border-radius: 15px;
     display: none;
}
.btn-primary.centerimg {
    background-color: #015a7a;
    border: 1px solid #015a7a;
    padding: 8px 30px;
    color: #FFF;
}
#imagePreview img {
    width: 100%;
}

.bank-detail .glltxtlogo{
    display: block;
    text-align: center;
    margin-top: 30px;
}

.bank-detail .glltxtlogo img{
    width: 100%;
max-width: 250px;
margin-bottom: 15px;
}

h6#message {
      color: green;
    text-align: center;
    font-size: 17px;

}

.error { color: red; }
</style>
<!-- ========= main banner section ========== -->
<div class="page-wrapper">

            <!-- ============================================================== -->

            <!-- Bread crumb and right sidebar toggle -->

            <!-- ============================================================== -->

<div class="page-breadcrumb" style="display: none;">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo $url; ?>">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> Profile </li>
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
            
            <div class="col-lg-8">
                <div class="glltxtlogo"><img src="https://buyjee.com/assets/images/logo.png"></div>
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a href="" data-target="#profile" data-toggle="tab" class="nav-link active">Profile </a>
                    </li>
                    <?php if($addressval == "no"){}elseif($addressval == "yes"){?>
                    <li class="nav-item">
                        <a href="" data-target="#messages" data-toggle="tab" class="nav-link">Edit </a>
                    </li>
                    <li class="nav-item">
                        <a href="" data-target="#password" data-toggle="tab" class="nav-link">Change Password </a>
                    </li>
                    <?php } ?>
                </ul>
                <div class="tab-content py-4">
                    <div class="tab-pane active" id="profile">
                        <h5 class="mb-3">Profile</h5>
                       <h6 id="message" class="msgg"> <?php echo $msg; ?> </h6>
                        <?php echo $passchange; ?>
                        <table class="table table-bordered table-striped">
                            <!-- <thead>
                              <tr>
                                <th colspan="2"><h6>Contact Information</h6></th>
                                <th>Lastname</th>                            
                              </tr>
                            </thead> -->
                            <tbody>
                              <tr>
                                <td>Full Name</td>
                                <td><?php echo $fname; ?> <?php echo $lanme; ?></td>                            
                              </tr>
                              <tr>
                                <td>Email</td>
                                <td><?php echo $email; ?></td>                           
                              </tr>
                              <tr>
                                <td>Phone</td>
                                <td><?php echo $phone; ?></td>                            
                              </tr>
                               <tr>
                                <td>Gst No.</td>
                                <td><?php echo $gst_no; ?></td>                            
                              </tr>
                              <tr>
                                <td>Address</td>
                                <td><?php echo $address; ?></td>                            
                              </tr>
                              <tr>
                                <td>Town / City</td>
                                <td><?php echo $city; ?></td>                            
                              </tr>
                              <tr>
                                <td>Country / State</td>
                                <td><?php echo $country; ?> / <?php echo !empty($stateshow) ? $stateshow: " "; ?></td>                            
                              </tr>
                              <tr>
                                <td>Postal / Zip Code</td>
                                <td><?php echo $zipcode; ?></td>                            
                              </tr>
                              <tr>
                                <td>Store URL</td>
                                <td><a href="<?php echo $weburl; ?><?php echo $vendor_nameurl; ?>" target="_blank"><?php echo $weburl; ?><?php echo $vendor_nameurl; ?></td>                            
                              </tr>
                            </tbody>
                          </table>
                        <!--/row-->
                    </div>
                    <?php 
                        $url_vale = preg_replace("/[^A-Za-z0-9]/"," ", $vendor_nameurl);
                    ?>
                    <div class="tab-pane" id="messages">
                        <h5 class="mb-3">Update Your Profile Information.</h5>
                      <form role="form" method="post" action="" enctype="multipart/form-data">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">First Name</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" name="fname" value="<?php echo $fname; ?>" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Last Name</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" name="lname" value="<?php echo $lanme; ?>" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Email</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" name="email" value="<?php echo $email; ?>" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Phone</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" name="phone" value="<?php echo $phone; ?>" required>
                                </div>
                            </div>
                             <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Gst No.</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" name="gstno" value="<?php echo $gst_no; ?>" required disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Address</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" name="address" value="<?php echo $address; ?>" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Town / City</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" name="cityval" value="<?php echo $city; ?>" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Country / State</label>
                                <div class="col-lg-5">
                                    <select class='form-control country' name='countryval' required>
                                        <?php
                                        $countname = "SELECT * FROM countries_db ORDER BY name ASC";
                                        $query = mysqli_query($conn, $countname);
                                        while($rowcount = mysqli_fetch_array($query)){
                                            if($country == "" && $country == "0"){
                                                echo "<option vlaue='".$rowcount['name']."'>".$rowcount['name']."</option>";
                                            }else{
                                                if($country == $rowcount['name']){
                                                    echo "<option vlaue='".$country."' selected>".$country."</option>";
                                                }else{
                                                    echo "<option vlaue='".$rowcount['name']."'>".$rowcount['name']."</option>";
                                                }
                                            }
                                        }
                                       /* $countyname = $country;
                                        $get_countryset = "SELECT * FROM countries_db WHERE name='$countyname' ORDER BY id ASC";
                                
                                        $query_count = mysqli_query($conn, $get_countryset);
                                        while($rowcount_count = mysqli_fetch_array($query_count)){
                                            $get_ids_vale = $rowcount_count['id'];
                                        }*/
                                        ?>
                                    </select>
                                </div>
                                <div class="col-lg-4">
                                    <select class='form-control response' name='stateval' required>
                                       <option value="" disabled selected>Select state</option>
                                        <?php
                                        $selectstatev = "SELECT * FROM tbl_states WHERE country_id='101' ORDER BY name ASC";
                                        $queryvale = $conn->query($selectstatev);
                                        while($rowvaluestate = $queryvale->fetch_array()) {
                                            $get_allstateval = $rowvaluestate['name'];

                                            if($get_allstateval == $stateshow){
                                                echo $get_arrayshppin[] = "<option value='".$get_allstateval."' selected>".$get_allstateval."</option>";
                                            }else{
                                                echo $get_arrayshppin[] = "<option value='".$rowvaluestate['name']."'>".$rowvaluestate['name']."</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Postal / Zip Code</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" name="zipval" value="<?php echo $zipcode; ?>" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Store URL</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" name="storurl" value="<?php echo $url_vale; ?>" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label"></label>
                                <div class="col-lg-9">
                                    <input type="submit" class="btn btn-primary" value="Update" name="adddetilas">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane" id="password">
                        <h5 class="mb-3">Change Password</h5>
                        <form role="form" method="post" action="" enctype="multipart/form-data" id="vendor-password-change"  onsubmit="return validatePassword()">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Old Password <span style="color: red;">*</span></label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="password" name="oldpassswoed" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">New Password<span style="color: red;">*</span></label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="password" name="newpassword" id="newpassword" required>
                                     <div id="password-strength-status" class="error"></div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Confirm Password <span style="color: red;">*</span></label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="password" name="conpassword" id="conpassword" required>
                                    <span id="confirmpasswordError" class="text-danger small"></span>
                                </div>
                            </div>

                            
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label"></label>
                                <div class="col-lg-9">
                                    <input type="submit" class="btn btn-primary" value="Update" name="changepassword">
                                </div>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-4  text-center">
                <div id="custmnone">
                    <div class="user_images">
                        <img src="<?php echo vendoruserimg($session_data); ?>" alt="avatar"></div>            </div>
                <div id="imagePreview"></div>
                <?php if($profiel_hide == "no"){}elseif($profiel_hide == "yes"){ ?>
                <h6 class="mt-2">Upload profile picture (Size: between 450x550 px and 540x660 px)</h6>
                <form role="form" method="post" enctype="multipart/form-data" action="">
                    <label class="custom-file">
                        <input type="file" class="custom-file-input" id="productmainimg" name="prodtmainimg" onchange="return singlfileValidation()" required>
                        <span class="custom-file-control">Choose file</span>
                    </label>
                    <div class="col-lg-12">
                        <input type="submit" class="btn btn-primary centerimg" value="Update" name="imgedit">
                    </div>
                </form>
                <?php  } ?>
            </div>
            <!-- <div class="col-lg-4 order-lg-1 text-center">-->
            <!--    <img src="https://gallerylala.com/assets/images/vendor_images/logo.png" class="mx-auto img-fluid img-circle d-block" alt="avatar">-->
            <!--    <h6 class="mt-2">Upload a different photo</h6>-->
            <!--    <label class="custom-file">-->
            <!--        <input type="file" id="file" class="custom-file-input">-->
            <!--        <span class="custom-file-control">Choose file</span>-->
            <!--    </label>-->
            <!--</div> -->
        </div>
        </div>
        
        </div>
  </div>
<!-- /////////// footer section ////////////// -->
<?php

require_once("include/footer.php");

?>
<script type="text/javascript">

$(document).ready(function(){
    $("select.country").change(function(){
        var selectedCountry = $(".country option:selected").val();
        $.ajax({
            type: "POST",
            url: "https://buyjee.com/get_state/",
            data: { country : selectedCountry } 
        }).done(function(data){
            $(".response").html(data);
        });
    });
});

    function singlfileValidation() {
    var fileInput = document.getElementById('productmainimg');
    var file = fileInput.files[0];
    var filePath = fileInput.value;

    var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;

    if (!allowedExtensions.exec(filePath)) {
        alert('Please upload file having extensions .jpeg/.jpg/.png/.gif only.');
        fileInput.value = '';
        return false;
    }


    if (file.size > 2097152) {
        alert('Please upload file less than 2MB.');
        fileInput.value = '';
        return false;
    }

    if (fileInput.files && file) {
        var reader = new FileReader();
        reader.onload = function (e) {
            var img = new Image();
            img.src = e.target.result;

            img.onload = function () {

                        if (img.width >= 450 && img.width <= 550 && img.height >= 540 && img.height <= 660) {
                    document.getElementById('imagePreview').innerHTML =
                        '<img src="' + e.target.result + '" class="img-responsive"/>';
                    document.getElementById('custmnone').innerHTML = '';
                    $('#image-error').remove();
                } else {
                    alert('Image size must be between 450x540 px and 550x660 px');
                    
                    
                }
            };

            img.onerror = function () {
                alert('Invalid image file.');
                fileInput.value = '';
            };
        };

        reader.readAsDataURL(file);
    }
}



function hideMessage() {
        var messageElement = document.getElementById('message');
        messageElement.style.display = 'none';
    }
    setTimeout(hideMessage, 4000);
    
    
     // new password  validation 
    $(document).ready(function() {
    // Function to validate password
    function validatePassword(password) {
        // Regular expression for password validation
        const passwordPattern = /^(?=.*[a-zA-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
        return passwordPattern.test(password);
    }

    // Handle form submission
    $('#vendor-password-change').on('submit', function(event) {
        // Get the password value
        const password = $('#newpassword').val();
        const passwordHint = $('#password-strength-status');
        
        // Validate the password
        if (!validatePassword(password)) {
            passwordHint.text('Password must be at least 8 characters long and include letters, numbers, and special characters.');
            event.preventDefault(); // Prevent form submission
        } else {
            passwordHint.text(''); // Clear error message
        }
    });
});
 
function validatePassword() {
    var newPassword = document.getElementById("newpassword").value;
    var confirmPassword = document.getElementById("conpassword").value;
    var errorSpan = document.getElementById("confirmpasswordError");

    if (newPassword !== confirmPassword) {
        errorSpan.textContent = "New password and confirm password do not match.";
        return false; 
    } else {
        errorSpan.textContent = ""; 
        return true;
    }
}

</script>