<?php

include_once('admin_dist/includes/uper-header.php');

include_once('admin_dist/includes/main-header.php');

include_once('admin_dist/includes/top-bar.php');

include_once('admin_dist/includes/left-menu.php');

?>
<style>
    img.img-responsive {
    width: 100%;
}
span.staupdf {
    width: 100%;
    text-align: center;
    font-size: 60px;
    margin: auto;
    float: left;
    background: #007bff;
    margin-bottom: 10px;
    color: #FFF;
}
</style>
<?php
$edit_courseata = GetCustomerDataVal($_GET['autoid']);
foreach($edit_courseata as $valecourseval){
    
}
foreach(GetLoginUserDetails($_GET['autoid']) as $loginemailid){
	$emailid = $loginemailid['user_email'];
}


?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Customer</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo $url; ?>/admin-manager/index/">Home</a></li>
              <li class="breadcrumb-item active">Customer</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
  <div class="row">
    <div class="col-md-3">
      <!-- Profile Image -->
      <div class="card card-primary card-outline">
        <div class="card-body box-profile">
          <div class="text-center">
            <?php if($valecourseval['customer_img'] == "0" || $valecourseval['customer_img'] == ""): ?>
              <img class="profile-user-img img-fluid img-circle" 
                   src="<?php echo $url; ?>/customer/images/default-user-icon.jpg" 
                   alt="User profile picture" id="profile-picture">
            <?php else: ?>
              <img class="profile-user-img img-fluid img-circle" 
                   src="<?php echo $url; ?>/images/<?php echo $valecourseval['customer_img']; ?>" 
                   alt="User profile picture" id="profile-picture">
            <?php endif; ?>
            <!-- Add file input for image upload when in edit mode -->
            <div id="image-upload-container" style="display:none; margin-top:10px;">
              <input type="file" id="profile-image-upload" accept="image/*">
            </div>
          </div>

          <h3 class="profile-username text-center">
            <span id="display-name"><?php echo $valecourseval['customer_fname']; ?> <?php echo $valecourseval['customer_lname']; ?></span>
          </h3>
          <p class="text-muted text-center"><?php //echo $customertype; ?></p>
        </div>
      </div>

      <!-- About Me Box -->
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">About</h3>
        </div>
        <div class="card-body">
          <strong>Address</strong>
          <p class="text-muted">
            <span id="display-address"><?php echo $valecourseval['customer_address']; ?></span>
            <input type="text" class="form-control edit-field" id="edit-address"  name="edit-address" value="<?php echo $valecourseval['customer_address']; ?>" style="display:none;">
          </p>

          <hr>
          <strong>City</strong>
          <p class="text-muted">
            <span id="display-city"><?php echo $valecourseval['customer_city']; ?></span>
            <input type="text" class="form-control edit-field" id="edit-city" name="edit-city" value="<?php echo $valecourseval['customer_city']; ?>" style="display:none;">
          </p>

          <hr>
          <strong>State</strong>
          <p class="text-muted">
            <span id="display-state"><?php echo $valecourseval['customer_state']; ?></span>
            <input type="text" class="form-control edit-field" id="edit-state" name="edit-state" value="<?php echo $valecourseval['customer_state']; ?>" style="display:none;">
          </p>

          <hr>
          <strong>Pin Code</strong>
          <p class="text-muted">
            <span id="display-pincode"><?php echo $valecourseval['customer_pincode']; ?></span>
            <input type="text" class="form-control edit-field" id="edit-pincode" name="edit-pincode"   maxlength="6" value="<?php echo $valecourseval['customer_pincode']; ?>" style="display:none;">
              <div class="text-danger error-msg" id="pincode-error"></div>
          </p>

          <hr>
          <strong>Country</strong>
          <p class="text-muted">
            <span id="display-country"><?php echo $valecourseval['customer_country']; ?></span>
            <input type="text" class="form-control edit-field" id="edit-country" name="edit-country"  value="<?php echo $valecourseval['customer_country']; ?>" style="display:none;">
              <div class="text-danger error-msg" id="country-error"></div>
          </p>
        </div>
      </div>
    </div>
    
    <div class="col-md-9">
      <div class="card">
        <div class="card-header p-2">
          <ul class="nav nav-pills">
            <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Detail</a></li>
          </ul>
          <button id="edit-profile-btn" class="btn btn-primary float-right">Edit Profile</button>
          <button id="save-profile-btn" class="btn btn-success float-right" style="display:none; margin-right:5px;">Save Changes</button>
          <button id="cancel-edit-btn" class="btn btn-default float-right" style="display:none; margin-right:5px;">Cancel</button>
        </div>
        
        <div class="card-body">
          <div class="tab-content">
            <div class="active tab-pane" id="settings">
              <form class="form-horizontal" id="profile-form" enctype="multipart/form-data">
                <div class="form-group row">
                  <label for="inputName" class="col-sm-2 col-form-label">First Name :</label>
                  <div class="col-sm-10">
                    <span id="display-fname"><?php echo $valecourseval['customer_fname']; ?></span>
                    <input type="text" class="form-control edit-field" id="edit-fname" name="edit-fname" value="<?php echo $valecourseval['customer_fname']; ?>" style="display:none;">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputName" class="col-sm-2 col-form-label">Last Name :</label>
                  <div class="col-sm-10">
                    <span id="display-lname"><?php echo $valecourseval['customer_lname']; ?></span>
                    <input type="text" class="form-control edit-field" id="edit-lname" name="edit-lname" value="<?php echo $valecourseval['customer_lname']; ?>" style="display:none;">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputEmail" class="col-sm-2 col-form-label">Email :</label>
                  <div class="col-sm-10">
                    <span id="display-email"><?php echo $valecourseval['customer_email']; ?></span>
                    <input type="email" class="form-control edit-field" id="edit-email" name="edit-email" value="<?php echo  $valecourseval['customer_email']; ?>" style="display:none;">
                    <div class="text-danger error-msg" id="email-error"></div>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputName2" class="col-sm-2 col-form-label">Age :</label>
                  <div class="col-sm-10">
                    <span id="display-age"><?php echo $valecourseval['customer_age']; ?></span>
                    <input type="number" class="form-control edit-field" id="edit-age" name="edit-age" value="<?php echo $valecourseval['customer_age']; ?>" style="display:none;">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputExperience" class="col-sm-2 col-form-label">Gender :</label>
                  <div class="col-sm-10">
                    <span id="display-gender"><?php echo $valecourseval['customer_gender']; ?></span>
                    <select class="form-control edit-field" id="edit-gender" name="edit-gender" style="display:none;">
                      <option value="Male" <?php echo ($valecourseval['customer_gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
                      <option value="Female" <?php echo ($valecourseval['customer_gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
                      <option value="Other" <?php echo ($valecourseval['customer_gender'] == 'Other') ? 'selected' : ''; ?>>Other</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputPhone" class="col-sm-2 col-form-label">Phone :</label>
                  <div class="col-sm-10">
                    <span id="display-phone"><?php echo $valecourseval['customer_phone']; ?></span>
                    <input type="text" class="form-control edit-field" id="edit-phone" name="edit-phone" value="<?php echo $valecourseval['customer_phone']; ?>" maxlength="10"  style="display:none;">
                      <div class="text-danger error-msg" id="phone-error"></div>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputPhone" class="col-sm-2 col-form-label">password :</label>
                  <div class="col-sm-10">
                    <span id="display-phone"><?php echo $valecourseval['user_otp']; ?></span>
                    <input type="text" class="form-control edit-field" id="edit-otp" name="edit-phone" value="<?php echo $valecourseval['user_otp']; ?>" maxlength="10"  style="display:none;" disabled >
                      <div class="text-danger error-msg" id="phone-error"></div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- /.control-sidebar -->

</div>

<!-- ./wrapper -->
<?php

include_once('admin_dist/includes/footer.php');

?>

<script>
    /**************Customer update code**************************/

$(document).ready(function() {
   $('#edit-phone').on('keypress', function(e) {
  const charCode = e.which ? e.which : e.keyCode;
  if (charCode < 48 || charCode > 57) {
    e.preventDefault(); 
  }
});
  $('#edit-profile-btn').click(function() {
    $('span[id^="display-"]').hide();
    $('.edit-field').show();
    $('#image-upload-container').show();
    
   
    $(this).hide();
    $('#save-profile-btn').show();
    $('#cancel-edit-btn').show();
  });

  $('#cancel-edit-btn').click(function() {
    $('span[id^="display-"]').show();
    $('.edit-field').hide();
    $('#image-upload-container').hide();
    
    $('#edit-profile-btn').show();
    $('#save-profile-btn').hide();
    $('#cancel-edit-btn').hide();
  });

$('#save-profile-btn').click(function (e) {
  e.preventDefault();
   let customerid = "<?php echo $_GET['autoid']; ?>";
  var formElement = document.getElementById('profile-form');
  
    let pincode = $('#edit-pincode').val().trim();
  let country = $('#edit-country').val().trim();
   let phone = $('#edit-phone').val().trim();
   
   const lettersOnly = /^[A-Za-z\s]+$/;
  const numbersOnly = /^[0-9]+$/;
var email = $("#edit-email").val().trim();
var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  let hasError = false;

if (!emailPattern.test(email)) {
    $('#email-error').text("Please enter  email address.");
    hasError = true;
}
  if (!numbersOnly.test(pincode)) {
    $('#pincode-error').text("Pincode must contain only numbers.");
    hasError = true;
  }
if (!numbersOnly.test(phone)) {
  $('#phone-error').text("Phone number must contain only digits.");
  hasError = true;
} else if(phone.length !== 10) {
  $('#phone-error').text("Phone number must be exactly 10 digits.");
  hasError = true;
} 
if (!lettersOnly.test(country)) {
    $('#country-error').text("Country must contain only letters.");
    hasError = true;
  }

  if (hasError) return;

  
  var formData = new FormData(formElement); 
formData.append("edit-address", document.getElementById("edit-address").value);
formData.append("edit-city", document.getElementById("edit-city").value);
formData.append("edit-state", document.getElementById("edit-state").value);
formData.append("edit-pincode", document.getElementById("edit-pincode").value);
formData.append("edit-country", document.getElementById("edit-country").value);
 formData.append("customer_id", customerid);
  var fileInput = document.getElementById('profile-image-upload');
  if (fileInput.files.length > 0) {
    formData.append('profile_image', fileInput.files[0]); 
  }

  $.ajax({
    url: "<?php echo $url; ?>/admin-manager/customer-update.php",
    type: 'POST',
    data: formData,
    contentType: false,   
    processData: false, 
    dataType: "json",
    success: function (response) {
    //  console.log(response.data.fname);

      if (response.success) {
        $('#display-fname').text(response.data.fname);
        $('#display-lname').text(response.data.lname);
        $('#display-name').text(response.data.fname + ' ' + response.data.lname);
        $('#display-email').text(response.data.email);
        $('#display-age').text(response.data.age);
        $('#display-gender').text(response.data.gender);
        $('#display-phone').text(response.data.phone);
        $('#display-address').text(response.data.address);
        $('#display-city').text(response.data.city);
        $('#display-state').text(response.data.state);
        $('#display-pincode').text(response.data.pincode);
        $('#display-country').text(response.data.country);

        if (response.data.profile_img) {
          $('#profile-picture').attr('src', response.data.profile_img);
        }

        alert('Profile updated successfully!');
         window.location.reload();
        $('span[id^="display-"]').show();
        $('.edit-field').hide();
        $('#image-upload-container').hide();
        $('#edit-profile-btn').show();
        $('#save-profile-btn').hide();
        $('#cancel-edit-btn').hide();
        
       
      } else {
        alert('Error: ' + response.message);
      }
    
    },
    error: function (xhr, status, error) {
      console.error(xhr.responseText);  
      alert('AJAX Error: ' + error);
    }
  });
});

  
  $('#profile-image-upload').change(function() {
    if (this.files && this.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        $('#profile-picture').attr('src', e.target.result);
      }
      reader.readAsDataURL(this.files[0]);
    }
  });
});

$('#cancel-edit-btn').click(function () {
  // Clear all error messages
  $('.error-msg').text('');

  // Optionally also clear input fields (if needed)
   $('#profile-form')[0].reset();
});
$('#edit-profile-btn').click(function () {
  $('#profile-form')[0].reset(); // Resets form fields
  $('.error-msg').text('');      // Clears error messages
  $('.form-control').removeClass('is-invalid'); // Clears error styling (if used)
});
</script>
