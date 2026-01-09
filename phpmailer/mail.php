<?php


include_once('dis-setting/connection.php');

 require_once 'PHPMailer/src/PHPMailer.php';
require_once 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$getmailjt = "SELECT * FROM emailsendata WHERE emailsd_type='$get_val_form'";

$query_dataval = mysqli_query($contdb,$getmailjt);

while($rowdataval = mysqli_fetch_array($query_dataval)){

	$show_type_data = $rowdataval['emailsd_type'];

	$show_data_title = $rowdataval['emailsd_title'];

	$show_data_text = $rowdataval['emailsd_destext'];

	$show_data_ft_one = $rowdataval['emailsd_footer_one'];

	$show_data_ft_two = $rowdataval['emailsd_footer_two'];

	$show_data_ft_three = $rowdataval['emailsd_footer_three'];

	$show_data_copyright = $rowdataval['emailsd_compyright'];

	$show_data_ccval = $rowdataval['emailsd_cc'];

	$show_data_from = $rowdataval['emailsd_from'];

	$show_data_subjt = $rowdataval['emailsd_subjt'];



	if($show_type_data == "vendor"){

		$to = $get_name_form;
		$subject = $show_data_subjt;
		$from = $show_data_from;

		$message = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>

		<html xmlns='http://www.w3.org/1999/xhtml'>

		<head>

		<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />

		<title>BuyJee</title>

		<meta name='viewport' content='width=device-width, initial-scale=1.0'/>

		</head>

		<body style='margin: 0; padding: 0;'>

		    <table border='0' cellpadding='0' cellspacing='0' width='100%'> 

		        <tr>

		            <td style='padding: 10px 0 30px 0;'>

		                <table align='center' border='0' cellpadding='0' cellspacing='0' width='600' style='border: 1px solid #cccccc; border-collapse: collapse;'>

		                    <tr>

		                        <td align='center' bgcolor='#0fa8ae' style='padding: 40px 0 30px 0; color: #FFF; font-size: 28px; font-weight: bold; font-family: Arial, sans-serif;'>

		                            <img src='".$url."/assets/images/logo.png' alt='Buyjee' width='300' height='230' style='display: block;' />

		                        </td>

		                    </tr>

		                    <tr>

		                        <td bgcolor='#ffffff' style='padding: 40px 30px 40px 30px;'>

		                            <table border='0' cellpadding='0' cellspacing='0' width='100%'>

		                                <tr>

		                                    <td style='color: #153643; font-family: Arial, sans-serif; font-size: 24px; padding-bottom: 30px; text-align: center;'>

		                                        <b>".$show_data_subjt."</b>

		                                    </td>

		                                </tr>

		                                <tr>

		                                    <td style='color: #153643; font-family: Arial, sans-serif; font-size: 20px; padding-bottom: 5px;'>

		                                        Hello<b> ".$get_name.",</b>

		                                    </td>

		                                </tr>

		                                <tr>

		                                    <td style='padding: 0px 0 30px 0; color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 30px;'>

		                                        ".$show_data_title."<br/>

		                                        ".$show_data_text."<br/>

		                                        ".$show_data_ft_one."<br/>

		                                        ".$show_data_ft_two."<br/>

		                                        ".$show_data_ft_three."<br/>

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

		                                        &copy;2024 Buyjee. All Rights Reserved.<br/>

		                                        <a href='".$url."/' style='color: #ffffff; margin-right: 15px;'><font color='#ffffff'>Home</font></a>

		                                        <a href='".$url."/aboutus' style='color: #ffffff; margin-right: 15px;'><font color='#ffffff'>About Us</font></a>

		                                        <a href='".$url."/contact.php' style='color: #ffffff;'><font color='#ffffff'>Contact Us</font></a>

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
            
            	   $mail = new PHPMailer(true);
            
                try {
                    // Server settings
                    $mail->SMTPDebug = 0;                      // Enable verbose debug output
                    $mail->isSMTP();                                            // Send using SMTP
                    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
                    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                    $mail->Username   = 'info@buyjee.com';                     // SMTP username
                    $mail->Password   = 'shqfashryuducxqc';                               // SMTP password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
                    $mail->Port       = 587;                                    // TCP port to connect to
            
                    // Recipients
                    $mail->setFrom($from);
                    $mail->addAddress($to);
                    $mail->addAddress('info@buyjee.com');
                    $mail->addReplyTo($from);
                    
                    if (!empty($show_data_ccval)) {
                        $mail->addCC($show_data_ccval);
                    }
            
                     $mail->addCustomHeader('X-Mailer', 'PHPMailer');
                     $mail->addCustomHeader('X-Priority', '3');
            
                    $mail->isHTML(true);                                  // Set email format to HTML
                    $mail->Subject = $subject;
                    $mail->Body    = $message;
                    $mail->AltBody = strip_tags($message);
            
                    // Send email
                    if ($mail->send()) {
                        //echo 'Message has been sent';
            
                        // Send admin email (similar to above)
                        // ...
            
                    } else {
                        echo 'Message could not be sent.';
                        echo 'Mailer Error: ' . $mail->ErrorInfo;
                    }
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }



	    if($show_type_data == "admin"){
         try {
                // SMTP configuration
                $smtpHost = 'smtp.gmail.com';
                $smtpPort = 587; // Typically 587 for TLS, 465 for SSL
                $smtpUsername = 'info@buyjee.com';
                $smtpPassword = 'shqfashryuducxqc';


		   	$getmailjt_admin = "SELECT * FROM emailsendata WHERE emailsd_type='admin'";

			$query_dataval = mysqli_query($contdb,$getmailjt);

			while($rowdataval_admin = mysqli_fetch_array($query_dataval)){

				$show_type_data_admin = $rowdataval_admin['emailsd_type'];

				$show_data_title_admin = $rowdataval_admin['emailsd_title'];

				$show_data_text_admin = $rowdataval_admin['emailsd_destext'];

				$show_data_ft_one_admin = $rowdataval_admin['emailsd_footer_one'];

				$show_data_ft_two_admin = $rowdataval_admin['emailsd_footer_two'];

				$show_data_ft_three_admin = $rowdataval_admin['emailsd_footer_three'];

				$show_data_copyright_admin = $rowdataval_admin['emailsd_compyright'];

				$show_data_ccval_admin = $rowdataval_admin['emailsd_cc'];

				$show_data_from_admin = $rowdataval_admin['emailsd_from'];

				$show_data_subjt_admin = $rowdataval_admin['emailsd_subjt'];



		    	$to = "info@buyjee.com";

				$subject = $show_data_subjt_admin;

				$from = "no-reply@jioitservices.com";
				
				$message = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>

				<html xmlns='http://www.w3.org/1999/xhtml'>

				<head>

				<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />

				<title>Buyjee</title>

				<meta name='viewport' content='width=device-width, initial-scale=1.0'/>

				</head>

				<body style='margin: 0; padding: 0;'>

				    <table border='0' cellpadding='0' cellspacing='0' width='100%'> 

				        <tr>

				            <td style='padding: 10px 0 30px 0;'>

				                <table align='center' border='0' cellpadding='0' cellspacing='0' width='600' style='border: 1px solid #cccccc; border-collapse: collapse;'>

				                    <tr>

				                        <td align='center' bgcolor='#0fa8ae' style='padding: 40px 0 30px 0; color: #FFF; font-size: 28px; font-weight: bold; font-family: Arial, sans-serif;'>

				                            <img src='".$url."/assets/images/logo.png' alt='Bayjee' width='300' height='230' style='display: block;' />

				                        </td>

				                    </tr>

				                    <tr>

				                        <td bgcolor='#ffffff' style='padding: 40px 30px 40px 30px;'>

				                            <table border='0' cellpadding='0' cellspacing='0' width='100%'>

				                                <tr>

				                                    <td style='color: #153643; font-family: Arial, sans-serif; font-size: 24px; padding-bottom: 30px; text-align: center;'>

				                                        <b>".$show_data_subjt_admin."</b>

				                                    </td>

				                                </tr>

				                                <tr>

				                                    <td style='color: #153643; font-family: Arial, sans-serif; font-size: 20px; padding-bottom: 5px;'>

				                                        Hello<b> ".$get_name.",</b>

				                                    </td>

				                                </tr>

				                                <tr>

				                                    <td style='padding: 0px 0 30px 0; color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 30px;'>

				                                        ".$show_data_title_admin."<br/>
				                                        ".$show_data_text_admin."<br/>

				                                        ".$show_data_ft_one_admin."<br/>

				                                        ".$show_data_ft_two_admin."<br/>

				                                        ".$show_data_ft_three_admin."<br/>

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
														&copy;20245 Buyjee. All Rights Reserved.<br/>

				                                        <a href='".$url."/' style='color: #ffffff; margin-right: 15px;'><font color='#ffffff'>Home</font></a>

				                                        <a href='".$url."/aboutus' style='color: #ffffff; margin-right: 15px;'><font color='#ffffff'>About Us</font></a>

				                                        <a href='".$url."/contact-us' style='color: #ffffff;'><font color='#ffffff'>Contact Us</font></a>

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
				
                   $mail = new PHPMailer(true);
                
                        $mail->SMTPDebug = 0;       
                        $mail->isSMTP();
                        $mail->Host = $smtpHost;
                        $mail->Port = $smtpPort;
                        $mail->SMTPSecure = 'tls'; // or 'ssl' depending on your server
                        $mail->SMTPAuth = true;
                        $mail->Username = $smtpUsername;
                        $mail->Password = $smtpPassword;
                
                        // Set email parameters
                        $mail->setFrom($from);
                        $mail->addAddress($to);
                        $mail->addAddress('info@buyjee.com');
                        $mail->addCC($show_data_ccval_admin);
                        $mail->Subject = $subject;
                        $mail->msgHTML($message);
                
                        // Send email
                        if ($mail->send()) {
                            echo "Email sent successfully!";
                        } else {
                            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                        }
                    }
                } catch (Exception $e) {
                    echo "An error occurred: ", $e->getMessage();
                }


	}
	}
	


}

?>