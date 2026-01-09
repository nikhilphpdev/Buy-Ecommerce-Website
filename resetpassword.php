<?php include 'includes/upper-header.php'; ?>  

    <meta name="description" content="">

    <meta name="keywords" content="">

    <title>Reset Password</title>
    <style>
        .error {
            color: red;
        }
        .success {
            color: green;
        }
        .customss{
            margin-bottom:20px;
        }
        .mt-6{
                margin: 11px;
        }
  .bedssscustom {
   padding: 20px;
    background-color: #fff;
    border-bottom: 1px solid #ececec;
    font-family: "Quicksand", sans-serif;
}
    </style>
    
<?php include 'includes/main-header.php'; ?>
<?php

if(isset($_GET['token']) && isset($_GET['auto']) && isset($_GET['email'])){

  $get_token = $_GET['token'];
  $auto_token = $_GET['auto'];
  $email_token = $_GET['email'];
  $valdate = valedatevalue($get_token,$auto_token,$email_token);
  if($valdate == true){
    //echo "1";
  }else{
    //echo "2";
    header("Location: ".$url."/");
  }
  if(isset($_POST['resetpass'])){
    $new_password = $_POST['newpassword'];
    $renewpassword = $_POST['renewpass'];
    if($new_password == $renewpassword){
      $query_vale = setnewpass($new_password,$auto_token,$email_token,$get_token);

      if($query_vale == true){
        echo "<script>alert('Successfully Update Your Password');window.location.href='$url/login';</script>";
      }else{
        echo "<script>alert('Please Try Again.');</script>";
      }
    }else{
        echo "<script>alert('Your New Password and Re-Enter New Password not match.');</script>";
    }
  }
}else{
    header("Location: ".$url."/");
  }
?>
<div class="page-header.breadcrumb-wrap bedssscustom">
            <div class="container">
                <div class="breadcrumb">
                    <a href="https://buyjee.com/" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span>Reset Password 
                </div>
            </div>
        </div>
<section class="about-top p-tb50"> 

 

    <div class="container">

      <div class="row">

        <div class="col-lg-12 col-md-12">

          <div class="content-section">

            <div class="login-section">

                <div class="row">

                    <div class="col-xl-8 col-lg-10 col-md-12 m-auto">

                        <h3 class="mt-6">Reset Password</h3>

                        <div class="forgot-theme-card"><span>

                      <form class="theme-form" role="form" method="post" id="changePasswordForm">
  <div class="form-group">
    <div class="input-group mb-3" id="new_password_wrapper">
      <input type="password" placeholder="Enter new password" id="newPassword" name="newpassword" class="form-control">
      <div class="input-group-append">
        <span class="input-group-text">
          <a href="#" class="toggle-password" data-target="#newPassword" style="text-decoration: none;">
            <i class="fa fa-eye-slash" aria-hidden="true"></i>
          </a>
        </span>
      </div>
    </div>
    <span class="error-message" id="newPassError" style="color: red; display: none;"></span>
  </div>

  <div class="form-group">
    <div class="input-group mb-3" id="confirm_password_wrapper">
      <input type="password" placeholder="Enter Confirm password" id="confirmPassword" name="renewpass" class="form-control">
      <div class="input-group-append">
        <span class="input-group-text">
          <a href="#" class="toggle-password" data-target="#confirmPassword" style="text-decoration: none;">
            <i class="fa fa-eye-slash" aria-hidden="true"></i>
          </a>
        </span>
      </div>
    </div>
    <span class="error-message" id="retypePassError" style="color: red; display: none;"></span>
  </div>
   <div id="message"></div><br>
  <button type="submit" class="login-btn customss" name="resetpass">Reset Password</button>
</form>


                        </span>

                    </div>

                </div>

                

                </div>

                

                

            </div>

          </div>

        </div>

      </div>

    </div>

 

</section>

<!-- /////////// footer section ////////////// -->

<?php include 'includes/footer.php'; ?>

<script>
  $(document).ready(function() {
      
       // Toggle password visibility
    $('.toggle-password').on('click', function(event) {
        event.preventDefault();
        var targetInput = $($(this).data('target'));
        var inputType = targetInput.attr('type') === 'password' ? 'text' : 'password';
        targetInput.attr('type', inputType);
        $(this).find('i').toggleClass('fa-eye-slash fa-eye');
    });
            $('#changePasswordForm').on('submit', function(event) {
                var newPassword = $('#newPassword').val();
                var confirmPassword = $('#confirmPassword').val();
                var message = $('#message');
                    var passwordPattern = /^(?=.*[a-zA-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
                
                var isPasswordValid = passwordPattern.test(newPassword);
                var isPasswordsMatch = (newPassword === confirmPassword);

                if (!isPasswordValid) {
                    event.preventDefault(); // Prevent form submission
                    message.text('Password must be at least 8 characters long and include letters, numbers, and special characters.').addClass('error').removeClass('success');
                } else if (!isPasswordsMatch) {
                    event.preventDefault(); // Prevent form submission
                    message.text('Passwords do not match').addClass('error').removeClass('success');
                } else {
                    addClass('success').removeClass('error');
                }
            });
        });

  </script>