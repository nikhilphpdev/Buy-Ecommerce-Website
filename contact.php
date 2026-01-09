<?php include 'includes/upper-header.php'; ?>
<?php include 'includes/main-header.php';?>

<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


function removeSpecialChars($message) {
    $pattern = '/[^\w\s]|[\[\]\(\)\{\}\*\&\$\%\#\@\!\?\.\,\-\+\=\~`|\;\:\;\'\"\(\)\[\]\{\}\*\&\$\%\#\@\!\?\.\,\-\+\=\~`|\;\:\;\'\"]/';
    return preg_replace($pattern, '', $message);
}

function validateEmail($email) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
    }
    
    $pattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
    if (!preg_match($pattern, $email)) {
        return false;
    }
    
    return true;
}

function validatePhoneNumber($phone) {
    $pattern = '/^(\+?[0-9]{1,3}[-\s.]*){0,2}[0-9]{10}$/';
    if (!preg_match($pattern, $phone)) {
        return false;
    }
    
    return true;
}


  $return=""; $error="";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = trim($_POST['name']);
        $email = filter_var(trim($_POST['email']));
        $phone = trim($_POST['phone']);
        $address = trim($_POST['address']);
        $message = removeSpecialChars(trim($_POST['message']));    
            $errors = [];
         if (!validateEmail($email)) {
         $errors[] = "Invalid email format";
            }
        
            if (!validatePhoneNumber($phone)) {
                $errors[] = "Invalid phone number format";
                
            }
        
            if (count($errors) > 0) {
                $return = "<div class='alert alert-danger' role='alert'>";
                foreach ($errors as $error) {
                    $return .= $error . "<br>";
                }
              $return .= "</div>";
            }
           else {         
         $sql = "INSERT INTO contact_us (name, email, phone, address, message) VALUES ('$name', '$email', '$phone', '$address', '$message')";
            $queryinsert = $contdb->query($sql);
       if ($queryinsert == true) {
       
        $mail = new PHPMailer(true);
        
        try {
            $mail->isSMTP();
            $mail->SMTPDebug = 0;  
            $mail->Host       = 'smtp.gmail.com';                 // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                             // Enable SMTP authentication
            $mail->Username   = 'info@buyjee.com';           // SMTP username
            $mail->Password   = 'shqfashryuducxqc';              // SMTP password (or App Password)
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption; `ssl` also accepted
            $mail->Port       = 587;                              // TCP port to connect to (587 for TLS, 465 for SSL)

            //Recipients
            $mail->setFrom($email, 'BuyJee');
            $mail->addAddress('info@buyjee.com', 'BuyJee');     // Add a recipient

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'New Contact Form Submission';
            $body = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
                         <html xmlns='http://www.w3.org/1999/xhtml'>
                         <head>
                         <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
                         <title>Contact</title>
                         <meta name='viewport' content='width=device-width, initial-scale=1.0'/>
                         </head>
                         <body style='font-family: Arial, sans-serif;'>
                         <p>Hello, Admin</p><br>
                         <h4 style='color: #333;'>Contact Form Details</h4>
                         <table border='1' cellpadding='5' style='border-collapse: collapse; width: 100%;'>
                         <tr></tr>
                         <tr><td style='background-color: #f2f2f2;'>Name:</td><td>$name</td></tr>
                         <tr><td style='background-color: #f2f2f2;'>Email:</td><td>$email</td></tr>
                         <tr><td style='background-color: #f2f2f2;'>Phone:</td><td>$phone</td></tr>
                         <tr><td style='background-color: #f2f2f2;'>Address:</td><td>$address</td></tr>
                         <tr><td style='background-color: #f2f2f2;'>Message:</td><td>$message</td></tr>
                         </table>
                         </body>
                         </html>";
                         
                     $mail->Body = str_replace(array('$name', '$email', '$phone', '$address', '$message'), array($name, $email, $phone, $address, $message), $body);
                
                $mail->send();

            $return = "<div class='alert alert-success' role='alert'>Message has been sent successfully.</div>";
        } catch (Exception $e) {
            $return = "<div class='alert alert-danger' role='alert'>Message has been sent successfully but failed to send email notification. Error: {$mail->ErrorInfo}</div>";
        }
    }
           else {
        $return = "<div class='alert alert-danger' role='alert'>Database error: " . $contdb->error . "</div>";
    }
    
}
}


?>

<style>
.custom-cont{
 /*   text-align: center;*/
}
.addess{
  font-weight: 400;
  font-size: 29px;
}
.int-box{
    margin-bottom:15px;
}
.addesss{
    line-height: 30px;
}
.custom-con ul li:after{
        position: absolute;
}
.comm{
    line-height: 41px;
    font-size: 18px;
}
#googleMap{
        width: 227%;
    height: 372px;
    position: relative;
    overflow: hidden;
    text-align: center;
}
p.addessss {
    font-weight: bolder;
    color: #000;
}
</style>
<main class="main pages">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="<?php echo $url; ?>/" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> Contact us
                </div>
            </div>
        </div>
        <div class="page-content pt-80 pb-80">
            <div class="container">
                <div class="row">
                    <div class="col-xl-10 col-lg-10 col-md-12 m-auto">
                        <div class="row">
                            <div class="col-lg-6 col-md-12">
                                <div class="login_wrap widget-taber-content background-white">
                                    <div class="padding_eight_all bg-white">
                                         <div class ='msg' > <?php echo $return; ?></div>
                                         
                                        <div class="heading_s1">
                                            <h4 class="mb-5 addess">Get In Touch</h4>
                                        </div>
                                       <form class="contact100-form validate-form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="myContactForm">
                                        <div class="wrap-input100 validate-input int-box" data-validate="Please enter your name">
                                        <input class="input100" type="text" name="name" placeholder="Full Name" required>
                                        <span class="focus-input100"></span>
                                       
                                        </div>
                                        <div class="wrap-input100 validate-input int-box"  data-validate="Please enter your email: ex@.com">
                                        <input class="input100" type="text" name="email" id="email" placeholder="E-mail" required>
                                        <span class="focus-input100" id=""></span>
    
                                        </div>
                                        <div class="wrap-input100 validate-input int-box" data-validate="Please enter your phone" >
                                        <input class="input100" type="text" name="phone" id="phone" placeholder="Phone" maxlength="10" required>
                                        <span class="focus-input100"></span>
                                        </div>
                                         <div class="wrap-input100 validate-input int-box" data-validate="Please enter your address" >
                                        <input class="input100" type="text" name="address" placeholder="address" required>
                                        <span class="focus-input100"></span>
                                        </div>
                                        <div class="wrap-input100 validate-input int-box" data-validate="Please enter your message" >
                                        <textarea class="input100" name="message" placeholder="Your Message" required></textarea>
                                        <span class="focus-input100"></span>
                                        </div>
                                        <div class="container-contact100-form-btn int-box">
                                        <button class="contact100-form-btn btn btn-primary" type="submit" name="submit">Submit</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 custom-cont">
                                <div class="heading_s1" style="margin-left: 17px;">
                                            <h4 class="mb-5 addess">Address Info</h4>
                                      
                                                <ul>
                                                    <li>
                                                        <p class="addessss">BuyJee Yamunanagar<br>
                                                       <p class="addesss">Near Vardaan Hospital, opp. Dimple Cinema,<br>
                                                                     Puran Vihar, Sector 17, Huda Jagadhri,<br>
                                                                     Haryana 135003
                                                                  </p>
                                                    </li>
                                                    <li class="phones comm">
                                                        <p>+91-8221964901</p>
                                                    </li>
                                                    <li class="phones comm">
                                                        <p>info@buyjee.com</p>
                                                    </li>
                                                    <li class="phones comm">
                                                        <p class="addessss">Working Hours: Monday – Saturday (10 AM – 6 PM)</p>
                                                    </li>
                                                </ul>
                                           
                                        </div>
                                        <div class="col-md-6">
                                       <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3449.849380195583!2d77.3047695626099!3d30.155721990120114!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390efb1b0adc52d3%3A0x9ecc12b485ba8793!2sBuyJee%20Yamunanagar!5e0!3m2!1sen!2sin!4v1744783877068!5m2!1sen!2sin" width="600" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>     
                                        </iframe>
                                        </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

<?php include 'includes/footer.php'; ?>

<script>
setTimeout(function() {
    $('.msg').fadeOut();
}, 5000);

//Email validation
$(document).ready(function() {
  // Function to validate email
function validateEmail(email) {
    try {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/i.test(email);
    } catch (e) {
        console.error("Error validating email:", e);
        return false;
    }
}

function validatePhoneNumber(phone) {
    try {
        return /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/.test(phone);
    } catch (e) {
        console.error("Error validating phone number:", e);
        return false;
    }
}
  
   $('#email').on('input', function() {
    if (!validateEmail($(this).val())) {
      $(this).next('.error-message').remove();
      $('<span class="error-message"  style="color:red;">Invalid email address</span>').insertAfter(this);
   
    } else {
      $(this).next('.error-message').remove();
    }
  });

  $('#phone').on('input', function() {
    if (!validatePhoneNumber($(this).val())) {
       $(this).next('.error-message').remove();
      
      $('<span class="error-message" style="color:red;">Invalid phone number</span>').insertAfter(this);
      
    } else {
      $(this).next('.error-message').remove();
    }
  });
});

function myMap() {
var mapProp= {
  center:new google.maps.LatLng(51.508742,-0.120850),
  zoom:5,
};
var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
}

</script>
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY&callback=myMap"></script>






















