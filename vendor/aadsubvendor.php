<?php



date_default_timezone_set("Asia/Kolkata");   //India time (GMT+5:30)

$date = date('d-m-Y');

$uploadTime = date('H:i:s');

include_once __DIR__."/directory/url.php";

include_once __DIR__."/functions.php";
header('Content-Type: application/json');
$session_data = $_SESSION['vendorsessionlogin'];

$vendordetail = "SELECT * FROM vendor WHERE vendor_auto='$session_data'";
    $cehkquery = mysqli_query($conn, $vendordetail);
   
     if(mysqli_num_rows($cehkquery) > 0) {
            while ($row = mysqli_fetch_assoc($cehkquery)) {
                $vendorf =  $row['vendor_f_name'];
                $vendorl =  $row['vendor_l_name'];
            $vendor_uni =  $row['vendor_uni_name'];
            $vendor_company =  $row['vendor_company'];
            $vendor_url =  $row['vendor_url'];
            }
           $vendorname = $vendorf . $vendorl;

        } 

if (isset($_POST['upsubvendor'])) {
    $id      = $_POST['id'];
    $fname   = trim($_POST['upfname']);
    $lname   = trim($_POST['uplname']);
    $upemail = trim($_POST['upemail']);
    $mobile  = trim($_POST['upmobileno']);

    // Fetch current data
    $result = mysqli_query($conn, "SELECT subvendor_fname, subvendor_lname, subvendor_email, subvendor_phone, subvendor_auto 
                                   FROM subvendor WHERE id = '$id'");
    $row = mysqli_fetch_assoc($result);

    if (!$row) {
        echo json_encode(['status' => 'error', 'msg' => 'Subvendor not found.']);
        exit;
    }

    $current_fname  = trim($row['subvendor_fname']);
    $current_lname  = trim($row['subvendor_lname']);
    $current_email  = trim($row['subvendor_email']);
    $current_mobile = trim($row['subvendor_phone']);
    $subvendorAuto  = $row['subvendor_auto'];

    // 🚨 Check if nothing changed
    if (
        $fname   === $current_fname &&
        $lname   === $current_lname &&
        $upemail === $current_email &&
        $mobile  === $current_mobile
    ) {
        echo json_encode([
            'status' => 'warning',
            'msg'    => 'No changes detected. Please update at least one field.'
        ]);
        exit;
    }

    // ✅ Email duplicate check only if changed
    if ($upemail !== $current_email) {
        $check = mysqli_query($conn, "SELECT subvendor_email FROM subvendor WHERE subvendor_email = '$upemail' AND id != '$id'");
        if (mysqli_num_rows($check) > 0) {
            echo json_encode([
                'status' => 'email_exists',
                'msg'    => 'This Email Id is already registered.'
            ]);
            exit;
        }
    }

    // Prepare update for subvendor
    $updateParts = [];
    if ($fname !== '')  $updateParts[] = "subvendor_fname = '" . mysqli_real_escape_string($conn, $fname) . "'";
    if ($lname !== '')  $updateParts[] = "subvendor_lname = '" . mysqli_real_escape_string($conn, $lname) . "'";
    if ($upemail !== '') $updateParts[] = "subvendor_email = '" . mysqli_real_escape_string($conn, $upemail) . "'";
    if ($mobile !== '') $updateParts[] = "subvendor_phone = '" . mysqli_real_escape_string($conn, $mobile) . "'";

    if (!empty($updateParts)) {
        $updateSQL = implode(', ', $updateParts);
        $query = "UPDATE subvendor SET $updateSQL WHERE id = '$id'";
        if (mysqli_query($conn, $query)) {
            // Update userlogntable also
            if (!empty($subvendorAuto)) {
                $userUpdateParts = [];
                if ($fname !== '')   $userUpdateParts[] = "user_first_name = '" . mysqli_real_escape_string($conn, $fname) . "'";
                if ($lname !== '')   $userUpdateParts[] = "user_lastname = '" . mysqli_real_escape_string($conn, $lname) . "'";
                if ($upemail !== '') $userUpdateParts[] = "user_email = '" . mysqli_real_escape_string($conn, $upemail) . "'";
                if ($mobile !== '')  $userUpdateParts[] = "user_mobileno = '" . mysqli_real_escape_string($conn, $mobile) . "'";

                if (!empty($userUpdateParts)) {
                    $userUpdateSQL = implode(', ', $userUpdateParts);
                    $userUpdateQuery = "UPDATE userlogntable SET $userUpdateSQL WHERE subvendor_id = '$subvendorAuto'";
                    mysqli_query($conn, $userUpdateQuery);
                }
            }
            echo json_encode(['status' => 'success', 'message' => 'Subvendor updated successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'msg' => 'Update failed: ' . mysqli_error($conn)]);
        }
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

if (isset($_POST['subvendor'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $mobileno = $_POST['mobileno'];
     $password = MD5($_POST['password']);
    $session_data = $_SESSION['vendorsessionlogin'];
	$auto_num = rand(888888,9999999);
	$singlauto = $auto_num.$email;
	$shaffauto = str_shuffle($singlauto);
    $cehck_email = "SELECT * FROM userlogntable WHERE user_email='$email'";
	$cehkquery = mysqli_query($conn, $cehck_email);
	if (mysqli_num_rows($cehkquery)) {
    echo json_encode([
        'status' => 'error',
        'msg' => 'This Email Id is already registered.'
    ]);
    exit;
}
	else{
	 
    $vendorinsert = "INSERT INTO userlogntable(user_first_name,user_email,user_lastname,user_mobileno,user_password,user_session_id,user_cookies,user_type,user_status,user_auto,subvendor_id,subtye)
                       VALUES('$fname','$email','$lname','$mobileno','$password','0','0','vendor','0','$session_data','$shaffauto','subvendor')";
	
	$vendor_login = mysqli_query($conn, $vendorinsert);
	
	$date = date("Y/m/d"); 

    $time = date("h:i A");

	$vendorall = "INSERT INTO subvendor(subvendor_fname,subvendor_lname,vendor_uni_name,parentvendor,vendor_company,subvendor_email,subvendor_phone,vendor_url,subvendor_date,subvendor_time,subvendor_auto,subvedor_status,session_auto)VALUES('$fname','$lname','$vendor_uni','$vendorname','$vendor_company','$email','$mobileno','$vendor_url','$date','$time','$shaffauto',0,'$session_data')";
	$venderquery = mysqli_query($conn, $vendorall);
	$subvenderpermission = "INSERT INTO userpermission(user_p_email_ap,user_p_block,user_p_delete,user_p_id,user_p_auto_id,user_p_type,user_vendor_type)VALUES('0','0','0','$shaffauto','$auto_num','vendor','subvendor')";
	$subvenderquerypermis = mysqli_query($conn, $subvenderpermission);
	if ($venderquery && $subvenderquerypermis) {
    include_once('../phpmailer/subvendor-email.php');
    echo json_encode([
        'status' => 'success',
        'message' => 'Subvendor has been created successfully.'
    ]);
} else {
    echo json_encode([
        'status' => 'error',
        'msg' => 'Something went wrong. Please try again.'
    ]);
}

	}

}
}

?>
