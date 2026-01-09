<?php include 'includes/upper-header.php'; ?>

<title>Vendor Inquiry</title>
<meta name="description" content="">
<meta name="keywords" content="">
<link rel="canonical" href="#"> 
<style>
#result {
    margin-bottom: 20px;
        color: #17a2b8;
}

 .error-message {
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
#gstno {
    text-transform: uppercase;
}

</style>


<?php include 'includes/main-header.php';?>

<main class="main pages">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="<?php echo $url; ?>/" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> Vendor Inquiry
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
                                            <h1 class="mb-5">Vendor Inquiry</h1>
                                        </div>
                                        <div id="results" style="margin-bottom: 10px;"></div>
                                        <form class="theme-form" role="form" method="post" enctype="multipart/form-data" action="" id="vendorForm">
                                        <div class="row">
                                           
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <span><input type="text" id="fname" placeholder="First Name" name="firstname" class="form-control" > <span class="validate-error error-message" id="fnameerror"></span></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <span><input type="text" id="lname" placeholder="Last Name" name="lname" class="form-control" > 
                                                        <span class="validate-error error-message" id="lnameerror"></span></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <span><input type="email" id="email" placeholder="Email ID" name="emailid" class="form-control" > <span  class="validate-error error-message" id="emailerror"></span></span>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <span><input type="phone" id="phone" placeholder="Phone" maxlength="10" name="phoneid" class="form-control" > <span style="color:red" id="phoneerror" class="validate-error error-message"></span></span>
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <span><input type="text" id="gstno" placeholder="GST No" name="gstno" maxlength="15" class="form-control" > <span style="color:red" id="gstnoerror" class="validate-error error-message"></span></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <span><input type="text" id="cname" placeholder="Company Name" name="Comname" class="form-control" > <span style="color:red" id="cnameerror" class="validate-error error-message"></span></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <span><input type="text" id="weburl" placeholder="Website" name="weburl" class="form-control" > <span style="color:red" id="weburlerror" class="validate-error error-message"></span></span>
                                                </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                    <button type="button" class="login-btn" name="vendor" id="vendor">Submit Inquiry</button>
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
<!--about top-->
<?php include 'includes/footer.php'; ?>

<script>

setTimeout(function() {
    $('#result').fadeOut();
}, 3000);

     $('#phone').keypress(function (e) {
         if (String.fromCharCode(e.keyCode).match(/[^0-9]/)) return false;
      });
      
      $('#gstno').keypress(function (e) {
       if (!String.fromCharCode(e.keyCode).match(/[a-zA-Z0-9]/)) {
    e.preventDefault(); // block all non-alphanumeric keys
  }
      });
      let gstValue = $('#gstno').val().replace(/\s+/g, ''); // removes all spaces
        $('#gstno').val(gstValue); 


$(document).ready(function () {
    $('#fname, #lname').on('keypress', function (e) {
        let char = String.fromCharCode(e.which);
        if (!/^[a-zA-Z\s]*$/.test(char)) {
            e.preventDefault(); // Block non-alphabet input
        }
    });
    // Function to validate individual fields
    function validateField(selector, pattern, errorMsg, errorSelector) {
        const value = $(selector).val().trim();
        if (!pattern.test(value)) {
            $(errorSelector).text(errorMsg).show();
            return false;
        } else {
            $(errorSelector).hide();
            return true;
        }
    }

    // Validate on form submission
    $('#vendor').on('click', function (e) {
        e.preventDefault(); // Prevent button's default behavior

        let isValid = true;

        // Validate first name (only alphabets)
        if (!validateField('#fname', /^[a-zA-Z\s]+$/, 'First name must contain only alphabets.', '#fnameerror')) {
            isValid = false;
        }

        // Validate last name (only alphabets)
        if (!validateField('#lname', /^[a-zA-Z\s]+$/, 'Last name must contain only alphabets.', '#lnameerror')) {
            isValid = false;
        }

        // Validate email
        if (!validateField('#email', /^[^\s@]+@[^\s@]+\.[^\s@]+$/, 'Enter a valid email address.', '#emailerror')) {
            isValid = false;
        }

        // Validate phone number (only 10 digits)
        if (!validateField('#phone', /^\d{10}$/, 'Enter a valid 10-digit phone number.', '#phoneerror')) {
            isValid = false;
        }
           if (!validateField('#gstno', /^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$/, 'Enter a valid 15-character GST number.', '#gstnoerror')) {
            isValid = false;
        }
        // Validate company name
        if (!validateField('#cname', /^[a-zA-Z\s]+$/, 'Enter Company Name.', '#cnameerror')) {
            isValid = false;
        }
         
         
         if (!validateField('#weburl', /^(https?:\/\/)?([\w-]+\.)+[\w-]{2,}(\/\S*)?$/, 'Enter a valid website URL.', '#weburlerror')) {
             isValid = false;
      }
        // If the form is invalid, stop further execution
        if (!isValid) {
            return;
        }

        // Form data serialization
        let formData = $('#vendorForm').serialize();
        
        
         $('#page-loader').show();

    // Optional: Disable button to prevent double-click
    $(this).prop('disabled', true);

    // Simulate delay or replace with AJAX
    setTimeout(function() {
      $('#page-loader').hide();
      $('#vendor').prop('disabled', false);
    }, 4000); 
        $.ajax({
            type: 'POST',
            url: '<?php echo $url; ?>/vendor_data/', 
            data: formData,
            dataType: 'json', 
            success: function (response) {
                console.log(response);
        
                if (response.status === "error") {
                    $("#results").html('<span class="red">' + response.message + '</span>');
                } else if (response.status === "success") {
                    $("#results").html('<span class="green">' + response.message + '</span>');
                      window.location.href = response.redirect;
                }
            },
            error: function (xhr, status, error) {
                console.error('AJAX Error:', status, error, xhr.responseText);

                $("#result").html(
                    '<span class="red">There was an error submitting your form. Please try again.</span>'
                );
            }
        });
    });

    // Hide error messages as the user types
    $('input').on('input', function () {
        const errorSelector = '#' + $(this).attr('id') + 'error';
       // alert(errorSelector); 
        $(errorSelector).hide();
    });
});

</script>







