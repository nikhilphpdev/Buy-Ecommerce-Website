<?php

session_start();

include_once('../config_db/conn_connect.php');

$conn = conndata();

date_default_timezone_get();

$date = date("d-m-Y");

$time = date("h:i A");

$full_path = realpath(dirname(__FILE__));
$explode_file_path = explode('/subvendor', $full_path);
$file_path = $explode_file_path[0]."/images";

if(isset($_SESSION['subvendorsessionlogin'])){

	$session_data = $_SESSION['subvendorsessionlogin'];

	$checcksession = "SELECT * FROM userlogntable WHERE subvendor_id='$session_data'";

	$querycehckk = mysqli_query($conn, $checcksession);

	if(mysqli_num_rows($querycehckk)){

		$ip = $_SERVER['REMOTE_ADDR'];

		$auto_id = rand(888888,9999999);

		$singlvarbl = $ip.','.$auto_id;
		$charArray = str_split($singlvarbl);
		$shaff_data = shuffle($charArray);
		$cehck_active = "SELECT * FROM loginactive WHERE active_userid='$session_data' AND active_status='1'";

		$queryactive = mysqli_query($conn, $cehck_active);

		if(mysqli_num_rows($queryactive)){}else{

			$insert_acctive = "INSERT INTO loginactive(active_type,active_ip,active_status,active_autoid,active_userid,active_date,active_time)VALUES('subvendor','$ip','1','$shaff_data','$session_data','$date','$time')";

			$insert_data = mysqli_query($conn, $insert_acctive);

		}

	}else{

		unset($_SESSION['subvendorsessionlogin']);

		header("Location: https://testing.buyjee.com");

	}

}else{

	unset($_SESSION['subvendorsessionlogin']);

	header("Location: https://testing.buyjee.com");

}

?>