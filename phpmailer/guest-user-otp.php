<?php
 require_once 'PHPMailer/src/PHPMailer.php';
require_once 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

$get_customeruid = "SELECT * FROM userlogntable WHERE user_email='$email' AND user_first_name='Guest' AND user_type='customer'";
$query_get_uid = $contdb->query($get_customeruid);
while($row_get_uid = $query_get_uid->fetch_array()){
	$get_uid = $row_get_uid['user_auto'];

	$get_customer_data = "SELECT * FROM customer WHERE customer_ui_id='$get_uid' AND customer_type='Guest'";
	$query_cutr_data = $contdb->query($get_customer_data);
	while($row_get_custata = $query_cutr_data->fetch_array()){
		$get_cust_name = $row_get_custata['customer_fname'].' '.$row_get_custata['customer_lname'];
	}
}
     $gueststring;
	$to = $email;

	$subject = "your OTP BuyJee Guest Account";

	$from = "no-reply@jioitservices.com";
	
	$message = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>

	<html xmlns='http://www.w3.org/1999/xhtml'>

	<head>

	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />

	<title>Bujee</title>

	<meta name='viewport' content='width=device-width, initial-scale=1.0'/>

	</head>

	<body style='margin: 0; padding: 0;'>

	    <table border='0' cellpadding='0' cellspacing='0' width='100%'> 

	        <tr>

	            <td style='padding: 10px 0 30px 0;'>

	                <table align='center' border='0' cellpadding='0' cellspacing='0' width='600' style='border: 1px solid #cccccc; border-collapse: collapse;'>

	                    <tr>

	                        <td align='center' bgcolor='#0fa8ae' style='padding: 40px 0 30px 0; color: #FFF; font-size: 28px; font-weight: bold; font-family: Arial, sans-serif;'>

	                            <img src='https://buyjee.com/images/1347020945.png' alt='Gallery La La Logo' width='300' height='230' style='display: block;' />

	                        </td>

	                    </tr>

	                    <tr>

	                        <td bgcolor='#ffffff' style='padding: 40px 30px 40px 30px;'>

	                            <table border='0' cellpadding='0' cellspacing='0' width='100%'>

	                                <tr>

	                                    <td style='color: #153643; font-family: Arial, sans-serif; font-size: 20px; padding-bottom: 5px;'>

	                                        Dear<b> ".$get_cust_name.",</b><br/>

	                                    </td>

	                                </tr>

	                                <tr>

	                                    <td style='padding: 0px 0 30px 0; color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 30px;'>

	                                        You are almost done, use the OTP Code below to access your guest account-<br/>

	                                        Your One Time Password (OTP) : ".$gueststring."<br/><br/>

	                                        Regards,<br/>
	                                       Buyjee
	                                    </td>

	                                </tr>

	                            </table>

	                        </td>

	                    </tr>

	                    <tr>

	                        <td bgcolor='#0fa8ae' style='padding: 30px 30px 30px 30px;'>

	                            <table border='0' cellpadding='0' cellspacing='0' width='100%'>

	                                <tr>

	                                    <td style='color: #ffffff; font-family: Arial, sans-serif; font-size: 14px; text-align:center;' width='100%'>

	                                        &copy;2024 Buyjee. All Rights Reserved.

	                                    </td>

	                                </tr>

	                            </table>

	                        </td>

	                    </tr>

	                </table>

	            </td>

	        </tr>

	    </table>

	</body>

	</html>";

   // Send email using SMTP
        $mail = new PHPMailer(true);
        
        try {
            //Server settings
            $mail->SMTPDebug = 0;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'info@buyjee.com';               // SMTP username
            $mail->Password   = 'shqfashryuducxqc';                        // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
            $mail->Port       = 587;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom('info@buyjee.com', 'BuyJee');
            $mail->addAddress($to, 'BuyJee');     // Add a recipient

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body = $message;
      
                $mail->send();

            $return = "<div class='alert alert-success' role='alert'>Message has been sent successfully.</div>";
        } catch (Exception $e) {
            $return = "<div class='alert alert-danger' role='alert'>Message has been sent successfully but failed to send email notification. Error: {$mail->ErrorInfo}</div>";
        }
?>