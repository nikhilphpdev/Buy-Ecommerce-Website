<?php include 'includes/upper-header.php'; ?>  

<?php include 'includes/main-header.php'; ?>
<style>
 .custom-lg {
    padding-top: 20px;
    border-radius: 0px 9px 9px 0px;
    background-color: #dfdede;
    right: 0px;
    width: 45px;
    text-align: center;
    font-size: 20px;
}
.error { color: red; }

p.btn-danger-custom {
    color: red;
}
.red {
  color: red;
    font-size: 16px;
}

.green {
    color: #1156a4;
      font-size: 16px;
}

/*customer Type drop down*/
    .dropdown-container {
      position: relative;
      display: inline-block;
    }

    .multiselect-container {
      display: none;
      position: absolute;
      z-index: 999;
      background: #fff;
      border: 1px solid #ccc;
      max-height: 250px;
      overflow-y: auto;
      width: 250px;
      padding: 5px;
    }

    .dropdown-container.open .multiselect-container {
      display: block;
    }
    
.check-select{
    width:100% !important;
    
}  
.
.input-check{
    width:20% !important;
    height:20px !important;
    
}
.drop-cls {
    width: 100% !important;
    color: #000000bd !important;
    background: #dddddd8a !important;
    border: 1px solid #cdcaca !important;
    border-radius: 8px;
}
.drop-cls:hover{
   /* background:#1156a4;*/
   background:#fff;
}
    .with-icon {
        display: inline-block;
    width: 0;
    height: 0;
    margin-left: 2px;
    vertical-align: middle;
    border-top: 4px solid;
    border-right: 4px solid transparent;
    border-left: 4px solid transparent;
    }
.input-icon-wrapper .icon {
    position: absolute;
    top: 50%;
    right: 15%;
    transform: translateY(-50%);
    color: #666;
    font-size: 20px;
    pointer-events: none;
  }

 </style>
 
 
<main class="main pages">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="<?php echo $url; ?>/" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> Register
                </div>
            </div>
        </div>
        <div class="page-content pt-80 pb-80">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-lg-10 col-md-12 m-auto">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="login_wrap widget-taber-content background-white">
                                    <div class="padding_eight_all bg-white">
                                        <div class="heading_s1">
                                            <h1 class="mb-5">Customer Registration</h1>
                                        </div>
                                      
                                        <p id="resultts"></p>

                                        <form class="theme-form"  id="password-form" role='form' method="post" enctype="multipart/form-data">
    
                                            <div class="row">
    
                                                <div class="col-md-4">
    
                                                    <div class="form-group">
    
                                                        <!-- <label for="First name">First Name</label>  -->
    
                                                     <input type="text" id="Firstname" placeholder="First Name" name="Firstname" class="form-control">
                                                        <div class="error-msg"  style="color:red; display:none;"></div>
    
                                                    </div>
    
                                                </div>
    
                                                <div class="col-md-4">
    
                                                    <div class="form-group">
    
                                                        <!-- <label for="lname">Last Name</label>  -->
                                                       <input type="text" id="lname" placeholder="Last Name" name="lname" class="form-control" >
                                                        <div class="error-msg"  style="color:red; display:none;"></div>
                                                    </div>
    
                                                </div>
    
                                            
    
                                                <div class="col-md-4">
    
                                                    <div class="form-group">
    
                                                        <!-- <label for="email">Email</label>  -->
                                                        <input type="text" placeholder="Email ID" name="emailid" id="emailid" class="form-control">
                                                         <div class="error-msg"  style="color:red; display:none;"></div>
                                                    </div>
                                                    
                                                </div>
                                                <div class="col-md-4">
    
                                                    <div class="form-group">
    
                                                        <!-- <label for="email">Mbile</label>  -->
                                                        <input type="text " placeholder="Mobile Number" name="mobileno" id="mobileno" maxlength="10" class="form-control">
                                                            <div class="error-msg"  style="color:red; display:none;"></div>
                                                    </div>
    
                                                </div>
                                                   <div class="col-md-4">
    
                                                  <div class="form-group">
                                                      <div class="dropdown-container input-icon-wrapper" style="width:100% !important;">
                                                            <input type="button" class="btn btn-default dropdown-toggle drop-cls with-icon" value="Choose Customer Types" id="customerTypeBtn">
                                                             <i class="fa fa-caret-down icon"></i>

                                                            
                                                              <ul class="multiselect-container dropdown-menu " style="width:100% !important;">
                                                                <li class="multiselect-item multiselect-all">
                                                                  <a tabindex="0">
                                                                    <label class="checkbox check-select">
                                                                      <input type="checkbox" id="select-all" class="input-check" value="multiselect-all" style="width:10% !important;height:17px !important;"> Select all
                                                                    </label>
                                                                  </a>
                                                                </li>
                                                                <li><a tabindex="0"><label class="checkbox check-select"><input type="checkbox" style="width:10% !important;height:17px !important;" class="option-checkbox input-check" value="Retail Customer"> Retail Customer</label></a></li>
                                                                <li><a tabindex="0"><label class="checkbox check-select"><input type="checkbox" style="width:10% !important;height:17px !important;" class="option-checkbox input-check" value="Wholesale Buyer"> Wholesale Buyer</label></a></li>
                                                                <li><a tabindex="0"><label class="checkbox check-select"><input type="checkbox"  style="width:10% !important;height:17px !important;"class="option-checkbox input-check" value="Corporate Buyer"> Corporate Buyer</label></a></li>
                                                                <li><a tabindex="0"><label class="checkbox check-select"><input type="checkbox" style="width:10% !important;height:17px !important;" class="option-checkbox input-check" value="Reseller/Distributor"> Reseller/Distributor</label></a></li>
                                                                <li><a tabindex="0"><label class="checkbox check-select"><input type="checkbox" style="width:10% !important;height:17px !important;" class="option-checkbox input-check" value="Institutional Buyer"> Institutional Buyer</label></a></li>
                                                                <li><a tabindex="0"><label class="checkbox check-select"><input type="checkbox" style="width:10% !important;height:17px !important;" class="option-checkbox input-check" value="Government Buyer"> Government Buyer</label></a></li>
                                                                <li><a tabindex="0"><label class="checkbox check-select"><input type="checkbox"  style="width:10% !important;height:17px !important;"class="option-checkbox input-check" value="Online Seller"> Online Seller</label></a></li>
                                                                <li><a tabindex="0"><label class="checkbox check-select"><input type="checkbox" style="width:10% !important;height:17px !important;" class="option-checkbox input-check" value="Export Buyer"> Export Buyer</label></a></li>
                                                                <li><a tabindex="0"><label class="checkbox check-select"><input type="checkbox" style="width:10% !important;height:17px !important;" class="option-checkbox input-check" value=" Franchise Inquiry"> Franchise Inquiry</label></a></li>
                                                                <li><a tabindex="0"><label class="checkbox check-select"><input type="checkbox" style="width:10% !important;height:17px !important;" class="option-checkbox input-check" value="Event Organizer / Bulk Order Customer"> Event Organizer / Bulk Order<br><span style="padding-left:35px;"> Customer</span></label></a></li>
                                                              </ul>
                                                            </div>

                                                          <div class="error-msg" style="color: red;">
                                                          </div>
                                                        </div>

    
                                                </div>
    
                                                <div class="col-md-4">
                                                    <div class="form-group"> 
                                                        <div class="input-group" id="show_hide_password">
                                                          <input type="password"  name="password" id="password"  placeholder="Password" class="form-control" autocomplete="off" /> 
                                                          
                                                          <div class="input-group-addon custom-lg">
                                                            <a href="javascript:void(0)"><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                                          </div>
                                                          
                                                        </div>
                                                     <div id="password-error" style="color: red;"></div>
                                                    </div>
                                                    <!--<div id="password-strength-status" class="error"></div>-->
                                                        
                                                     
                                                </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                      
                                                    <button type="submit" class="login-btn" name='customer' id="customer">Create Account</button>                                    
                                                  
                                                    <p class="float-right mt-2">Already have an account? <a href="<?php echo $url; ?>/login/" class="txt-default">Click here </a>to Login</p>
    
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
        </div>
    </main>

<!-- /////////// footer section ////////////// -->

<?php include 'includes/footer.php'; ?>

<script type="text/javascript">

$('#mobileno').keypress(function (e) {
         if (String.fromCharCode(e.keyCode).match(/[^0-9]/g)) return false;
      });


$(document).ready(function () {
     $('#Firstname, #lname').on('keypress', function (e) {
        let char = String.fromCharCode(e.which);
        if (!/^[a-zA-Z\s]*$/.test(char)) {
            e.preventDefault(); // Block non-alphabet input
        }
    });
    // Show/hide password functionality
    $('#show_hide_password a').on('click', function (event) {
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

    // Validate input fields
  function validateField(selector, pattern, errorMessage) {
    let el = $(selector);
    if (!el.length) return false; // Element not found

    let value = el.val() ? el.val().trim() : '';
    if (!pattern.test(value)) {
        el.next('.error-msg').text(errorMessage).show();
        return false;
    } else {
        el.next('.error-msg').hide();
        return true;
    }
}

    $('#password-form').on('submit', function (e) {

        e.preventDefault();

                 let isValid = true;
            let selectedValues = [];
            
         
            $('.option-checkbox:checked').each(function () {
              selectedValues.push($(this).val());
            });
            
            if (selectedValues.length === 0) {
              $('.option-checkbox').addClass('is-invalid'); 
              $('.error-msg').text('Please select a customer type.').show();
              isValid = false;
            } else {
              $('.option-checkbox').removeClass('is-invalid');
              $('.error-msg').hide();
            }
        // Validate first name (only alphabets)
        if (!validateField('#Firstname', /^[a-zA-Z\s]+$/, 'First name must contain only alphabets.')) {
            isValid = false;
        }

        // Validate last name (only alphabets)
        if (!validateField('#lname', /^[a-zA-Z\s]+$/, 'Last name must contain only alphabets.')) {
            isValid = false;
        }

        // Validate email format
        if (!validateField('#emailid', /^[^\s@]+@[^\s@]+\.[^\s@]+$/, 'Enter a valid email address.')) {
            isValid = false;
        }
       
        // Validate mobile number (10 digits)
        if (!validateField('#mobileno', /^\d{10}$/, 'Enter a valid 10-digit mobile number.')) {
            isValid = false;
        }

                    let password = $('input[name="password"]').val().trim();
            let passwordStatus = $('#password-error');
            
            // Regular expression for validation
            let passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/;
            
            if (!passwordRegex.test(password)) {
                passwordStatus.text('Password must be at least 8 characters long and include an uppercase letter, a lowercase letter, a number, and a special character.').show();
                isValid = false;
            } else {
                passwordStatus.hide();  // Hide error if password is valid
            }
        
        if (isValid) {
            // If valid, submit the form using AJAX
            let formData = {
                Firstname: $('#Firstname').val(),
                lname: $('#lname').val(),
                emailid: $('#emailid').val(),
                mobileno: $('#mobileno').val(),
                customerType :selectedValues.join(','),
                password: $('#password').val()
            };
           // console.log(formData);
              $('#page-loader').show();

    // Optional: Disable button to prevent double-click
    $(this).prop('disabled', true);

    // Simulate delay or replace with AJAX
    setTimeout(function() {
      $('#page-loader').hide();
      $('#customer').prop('disabled', false);
    }, 4000); // Simulate a process (e.g., AJAX)

            $.ajax({
                url: '/customer_registration.php',
                method: 'POST',
                data: formData,
                dataType: 'json',
                success: function (response) {
                    if (response.status === 'success') {
                        $("#resultts").html('<span class="green">' + response.message + '</span>');
                        window.location.href = '/login';
                    } else {
                       $("#resultts").html('<span class="red">' + response.message + '</span>');
                    }
                },
                error: function (xhr) {
                    console.log('Error:', xhr.responseText);
                }
            });
        }
    });

    // Hide error messages as the user types
    $('input').on('input', function () {
        $(this).next('.error-msg').hide();
    });
});


/*select option in customer type*/
 // Toggle dropdown
  $('.dropdown-toggle').on('click', function () {
    $(this).closest('.dropdown-container').toggleClass('open');
  });

  // Select all functionality
  $('#select-all').on('change', function () {
    $('.option-checkbox').prop('checked', this.checked);
  });

  // Auto-uncheck "Select all" if any option is manually unchecked
  $('.option-checkbox').on('change', function () {
    if (!this.checked) {
      $('#select-all').prop('checked', false);
    } else {
      let allChecked = $('.option-checkbox').length === $('.option-checkbox:checked').length;
      $('#select-all').prop('checked', allChecked);
    }
  });

  // Close dropdown when clicking outside
  $(document).on('click', function (e) {
    if (!$(e.target).closest('.dropdown-container').length) {
      $('.dropdown-container').removeClass('open');
    }
  });

</script>














