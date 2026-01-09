<?php
include_once('dis-setting/connection.php');

date_default_timezone_set("Asia/Kolkata"); 

$date = date('Y-m-d');

$time = date('H:i:s');


if(isset($_POST['firstname'])){
   
	$fname = trim(addslashes($_POST['firstname']));
	$lname = trim(addslashes($_POST['lname']));
	$email = trim(addslashes($_POST['emailid']));
	$phone = trim(addslashes($_POST['phoneid']));
	$compny = trim(addslashes($_POST['Comname']));
	$website_url = $_POST['weburl'];
	$gstno= trim($_POST['gstno']);

	$singlvednname = $fname.'-'.$lname;
	$lasturlval = makeurl($singlvednname);
	if($compny == ""){
		$singlvedlast = makeurl($singlvednname);
		$sing_val_data = $singlvedlast;
	}else{
		$sing_val_data = makeurl($compny);
	}
	$auto_num = rand(888888,9999999);
	$singlauto = $auto_num.$email;
	$shaffauto = str_shuffle($singlauto);

	// Check if the email is already registered
	$cehck_email = "SELECT * FROM userlogntable WHERE user_email='$email'";
	$cehkquery = mysqli_query($contdb, $cehck_email);
	if(mysqli_num_rows($cehkquery)){
		echo json_encode([
			"status" => "error",
			"message" => "This email address is already registered. Please try another one."
		]);
		exit();
	}

	// Check if the first and last name is already registered
	/*$checkname = "SELECT * FROM vendor WHERE vendor_f_name='$fname' AND vendor_l_name='$lname'";
	$query_namecehck = mysqli_query($contdb, $checkname);
	if(mysqli_num_rows($query_namecehck)){
		echo json_encode([
			"status" => "error",
			"message" => "This First Name and Last Name is already registered. Please try another one."
		]);
		exit();
	}*/
		// Check if the GST NO is already registered
	$checkname = "SELECT * FROM vendor WHERE gst_no='$gstno'";
	$query_gstcheck = mysqli_query($contdb, $checkname);
	if(mysqli_num_rows($query_gstcheck)){
		echo json_encode([
			"status" => "error",
			"message" => "This GST No is already registered. Please try another one."
		]);
		exit();
	}

	// Check if the company name or website is already registered
/*	$checkname = "SELECT * FROM vendor WHERE vendor_uni_name='$sing_val_data'";
	$query_namecehck = mysqli_query($contdb, $checkname);
	if(mysqli_num_rows($query_namecehck)){
		echo json_encode([
			"status" => "error",
			"message" => "This company name or website is already registered. Please try another one."
		]);
		exit();
	}
*/
	// Insert into userlogntable
	$vendorinsert = "INSERT INTO userlogntable(user_first_name,user_email,user_lastname,user_mobileno,user_password,user_session_id,user_cookies,user_type,user_status,user_auto) VALUES ('$fname','$email','$lname','$phone','0','0','0','vendor','0','$shaffauto')";
	$vendor_login = mysqli_query($contdb, $vendorinsert);

	$date = date("Y/m/d"); 
	$time = date("h:i A");

	// Insert into vendor table
	$vendorall = "INSERT INTO vendor(vendor_f_name,vendor_l_name,vendor_uni_name,vendor_company,vendor_email,vendor_phone,vendor_url,gst_no,vendor_date,vendor_time,vendor_auto) VALUES ('$fname','$lname','$sing_val_data','$compny','$email','$phone','$website_url','$gstno','$date','$time','$shaffauto')";
	$venderquery = mysqli_query($contdb, $vendorall);

	// Insert permissions
	$venderpermission = "INSERT INTO userpermission(user_p_email_ap,user_p_block,user_p_delete,user_p_id,user_p_auto_id,user_p_type) VALUES ('0','0','0','$shaffauto','$auto_num','vendor')";
	$venderquerypermis = mysqli_query($contdb, $venderpermission);

	if($venderquerypermis == true){
	    $get_val_form = "vendor";
		$get_name_form = $email;
		$get_name = $fname;
         	 include('phpmailer/mail.php'); 
       
		echo json_encode([
			"status" => "success",
			"message" => "Thanks for your inquiry.",
		    "redirect" => $url . "/thanks-for-vendor-inqueiry/"
		]);
		exit();
	} else {
		echo json_encode([
			"status" => "error",
			"message" => "There was an issue processing your request. Please try again."
		]);
		exit();
	}
}

?>